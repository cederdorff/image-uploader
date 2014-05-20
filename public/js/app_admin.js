// app.js

// define our application and pull in ngRoute and ngAnimate
var imageUploaderApp = angular.module('imageUploaderAdmin', ['ngRoute', 'blueimp.fileupload'
    ])
.config([
    '$httpProvider', 'fileUploadProvider',
    function ($httpProvider, fileUploadProvider) {
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        fileUploadProvider.defaults.redirect = window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
            );
    }
    ]);

// ROUTING ===============================================
// set our routing for this application
// each route will pull in a different controller
imageUploaderApp.config(function($routeProvider) {
    
    $routeProvider

    .when('/', {
        templateUrl: '/uploader',
    })

    .when('/users', {
        templateUrl: '/users',
        controller: 'userController'
    });

});

/*
 * Factory metode, som beskriver de services der anvendes og tilbydes.
 * load, save og delete sender alle et http request med parametre,
 * der behandles på serveren og sender et response tilbage, evt med data.
 */
 imageUploaderApp.factory("UserData", ["$http",
    function($http) {
        return {
            load: function() {
                var promise = $http({
                    url: "/api/users",
                    method: "GET"
                });
                return promise;
            },
            save: function(user) {
                var promise = $http({
                    url: "/api/users",
                    method: "POST",
                    data: user
                });
                return promise;
            },
            update: function(user) {
                var promise = $http({
                    url: "/api/users/" + user.id,
                    method: "PUT",
                    data: user
                });
                return promise;
            },
            delete: function(id) {
                var promise = $http({
                    url: "/api/users/" + id,
                    method: "DELETE"
                });
                return promise;
            }
        }
    }
    ]);
// CONTROLLERS =====================================================================
imageUploaderApp.controller('ImageUserController', [
    '$scope', '$http', '$filter', '$window',
    function ($scope, $http) {
        $scope.options = {
            url: '/api/images'
        };
        $scope.loadingFiles = true;
        $http.get('/api/images')
        .then(
            function (response) {
                $scope.loadingFiles = false;
                $scope.queue = response.data.files || [];
                $scope.authUser = response.data.authUser;
            },
            function () {
                $scope.loadingFiles = false;
            }
            );
    }
    ]);

imageUploaderApp.controller('FileDestroyController', [
    '$scope', '$http',
    function ($scope, $http) {
        var file = $scope.file,
        state;
        if (file.url) {
            file.$state = function () {
                return state;
            };
            file.$destroy = function () {
                state = 'pending';
                return $http({
                    url: "/api/images/"+file.id,
                    method: "DELETE"
                }).then(
                function () {
                    state = 'resolved';
                    $scope.clear(file);
                },
                function () {
                    state = 'rejected';
                }
                );
            };
        } else if (!file.$cancel && !file._index) {
            file.$cancel = function () {
                $scope.clear(file);
            };
        }
    }
    ]);

// about page controller
imageUploaderApp.controller('userController', function($scope, UserData) {
        /*
     * Loader data i scope. $scope.userData sættes med alle brugere fra databsen, som returneres i response
     */
     $scope.load = function() {
        UserData.load().then(function(result) {
            $scope.userData = result.data.users;
            $scope.authUser = result.data.authUser;
        }, function(error) {
            console.log("Error: " + error);
        });
    };
    // kalder denovenstående load metode
    $scope.load();
    // set default selected order til 'name'
    $scope.selectedOrder = "name";
    /*
     * Kalder factory service, der står for at gemme bruger, på baggrund af den givne bruger 'user'.
     */
     $scope.saveUser = function(user) {

        if (user == null) {
            $scope.message = "Indtast venligst navn, email, adgangskode og brugertype";
        } else {
            if (user.id == null) { 
                UserData.save(user).success(function(response) {
                    if(response.success){
                        $scope.load(); // Når der oprrettes ny, har vi behov for id fra databasen.
                        $("#userModal").modal("hide");
                        // reset user 
                        $scope.user = null;
                        $scope.selecedtedUserIndex = null;
                    } else{
                        $scope.message = setScopeMessage(response.message);
                    }
                }, function(error) {
                    console.log("Error: " + error);
                });
            } else {
                UserData.update(user).success(function(response) {
                    if(response.success){
                        // Opdaterer bruger i scope
                        $scope.userData[$scope.selecedtedUserIndex] = angular.copy(user);
                        $("#userModal").modal("hide");
                    // reset user 
                    $scope.user = null;
                    $scope.selecedtedUserIndex = null;
                } else {
                    $scope.message = setScopeMessage(response.message);
                }

            }, function(error) {
                console.log("Error: " + error);
            });
            }
        }
    };
    /*
     * Kalder factory service, der står for at slette bruger udfra det givne user.id.
     * Går det godt, slettes brugeren fra scope's user data.
     */
     $scope.deleteUser = function(user) {
        UserData.delete(user.id).success(function() {
            $scope.userData.splice($scope.userData.indexOf(user), 1);
        });
    };
    /*
     * Viser enten valgt bruger i modal, eller mulighed for at oprette en ny,
     * på baggrund af userToEdit != null
     */
     $scope.showUser = function(userToEdit) {
        $scope.message = "";
        if (userToEdit != null) {
            $scope.user = JSON.parse(JSON.stringify(userToEdit)); // laver kopi af den valgte bruger, så der ikke redigeres direkte på den valgte
            $scope.selecedtedUserIndex = $scope.userData.indexOf(userToEdit);
            $("#userModal .modal-title").html("Rediger '" + userToEdit.name + "'");
        } else {
            $("#userModal .modal-title").html("Opret ny bruger");
            $scope.user = null;
        }
        $("#userModal").modal("show");
    }
});

function setScopeMessage(messages){
    var message = "";
    if(messages.name){
        message = messages.name + " ";
    }
    if(messages.email){
        message += messages.email + " ";
    }
    if(messages.password){
        message += messages.password + " ";
    }
    if(messages.type){
        message += messages.type;
    }
    return message;
}
