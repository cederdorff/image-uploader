'use strict';
var imageApp = angular.module('imageUploader', [
    'blueimp.fileupload'
    ]);

(function () {
	var url = '/images';
    imageApp.controller('ImageController', [
        '$scope', '$http', '$filter', '$window',
        function ($scope, $http) {
            $scope.options = {
                url: url
            };
            $scope.loadingFiles = true;
            $http.get(url)
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

}());