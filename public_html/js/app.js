'use strict';
var imageGalleryApp = angular.module('imageGalleryApp', ['ngRoute']);


// ROUTING ===============================================
// set our routing for this application
// each route will pull in a different controller
imageGalleryApp.config(function($routeProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'home.php',
	})
	.when('/paul', {
		templateUrl: 'paul.php',
	});
});

imageGalleryApp.controller('imageGalleryController', [
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
			},
			function () {
				$scope.loadingFiles = false;
			}
			);
	}
	]);
