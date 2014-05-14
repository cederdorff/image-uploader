var userApp = angular.module("userApp", []);
/*
 * Factory metode, som beskriver de services der anvendes og tilbydes.
 * load, save og delete sender alle et http request med parametre,
 * der behandles på serveren og sender et response tilbage, evt med data.
 */
 userApp.factory("UserData", ["$http",
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
/*
 * Controlleren DataCtrl initialiseres.
 * Vha $scope forbindes view og controller
 */
 userApp.controller("DataCtrl", function($scope, UserData) {
    /*
     * Loader data i scope. $scope.userData sættes med alle brugere fra databsen, som returneres i response
     */
     $scope.load = function() {
        UserData.load().then(function(result) {
            $scope.userData = result.data;
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
            $scope.message = "Please enter a name, email and password";
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
            $("#userModal .modal-title").html("Edit '" + userToEdit.name + "'");
        } else {
            $("#userModal .modal-title").html("Create New User");
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
        message += messages.password;
    }
    return message;
}