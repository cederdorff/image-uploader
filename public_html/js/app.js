'use strict';
var imageGalleryApp = angular.module('imageGalleryApp', ['ngRoute']);


// ROUTING ===============================================
// set our routing for this application
// each route will pull in a different controller
imageGalleryApp.config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'pages/home',
	})
	.when('/paul', {
		templateUrl: 'pages/paul',
	})
	.otherwise({ redirectTo: '/' });

	//pretty urls
	$locationProvider.html5Mode(true);
});

imageGalleryApp.controller('imageGalleryController', [
	'$scope', '$http', '$filter', '$window',
	function ($scope, $http) {
		$scope.options = {
			url: '/images'
		};
		$scope.loadingFiles = true;
		$http.get('/images')
		.then(
			function (response) {
				$scope.loadingFiles = false;
				$scope.queue = response.data.files || [];
			},
			function () {
				$scope.loadingFiles = false;
			}
			);
	}
	]);
