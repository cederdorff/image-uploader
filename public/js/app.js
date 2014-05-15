(function () {
    'use strict';

    var isOnGitHub = window.location.hostname === 'blueimp.github.io',
    url = '/images';

    angular.module('imageUploader', [
        'blueimp.fileupload'
        ])
    .config([
        '$httpProvider', 'fileUploadProvider',
        function ($httpProvider, fileUploadProvider) {
            delete $httpProvider.defaults.headers.common['X-Requested-With'];
            fileUploadProvider.defaults.redirect = window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
                );
            if (isOnGitHub) {
                    // Demo settings:
                    angular.extend(fileUploadProvider.defaults, {
                        // Enable image resizing, except for Android and Opera,
                        // which actually support image resizing, but fail to
                        // send Blob objects via XHR requests:
                        disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                        maxFileSize: 5000000,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                    });
                }
            }
            ])

.controller('ImageController', [
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