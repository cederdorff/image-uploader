// app.js

// define our application and pull in ngRoute and ngAnimate
var imageUploaderApp = angular.module('imageUploaderApp', ['ngRoute', 'ngAnimate']);

// ROUTING ===============================================
// set our routing for this application
// each route will pull in a different controller
imageUploaderApp.config(function($routeProvider) {

    $routeProvider

        // home page
        .when('/', {
            templateUrl: 'page-home.html',
            controller: 'mainController'
        })

        // about page
        .when('/about', {
            templateUrl: 'about.php',
            controller: 'aboutController'
        })

        // contact page
        .when('/contact', {
            templateUrl: 'page-contact.html',
            controller: 'contactController'
        });

});


// // CONTROLLERS ============================================
// // home page controller
// animateApp.controller('mainController', function($scope) {
//     $scope.pageClass = 'page-home';
// });

// // about page controller
// animateApp.controller('aboutController', function($scope) {
//     $scope.pageClass = 'page-about';
// });

// // contact page controller
// animateApp.controller('contactController', function($scope) {
//     $scope.pageClass = 'page-contact';
// });
