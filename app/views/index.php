<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fotouploader | Frontend</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/stylesFrontend.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="libs/jquery-file-upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="libs/jquery-file-upload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="libs/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="libs/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>
</head>

<!-- apply our angular app -->
<body ng-app="imageGalleryApp">
    <div class="container header">
        <a class="navbar-brand" href="#"> <img src="../img/logo1.png"/></a> 
    </div>
    <div class="container" ng-view></div> <!-- content -->

    <!-- scripts -->
    <script src="libs/jquery/jquery-v1.11.0.min.js"></script>
    <script src="libs/angularjs/angular.min.js"></script>
    <script src="libs/angularjs/angular-route.min.js"></script>
    <script src="js/app.js"></script>
    <!-- blueimp Gallery script -->
    <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The File Upload Angular JS module -->
    <script src="libs/jquery-file-upload/js/jquery.fileupload-angular.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
