<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fotouploader | Admin</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
	<!-- Custom Styles -->
	<link rel="stylesheet" href="css/styles.css">
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
<body ng-app="imageUploaderAdmin">
	<div class="navbar navbar-default navbar-fixed-top" role="navigation" ng-controller="userController">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="/">Fotouploader</a> </div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class=""><a href="#">Uploader</a></li>
						<li ng-show="authUser.type=='admin'"><a href="#users">Users</a></li>
					</ul>
					<ul class="nav navbar-nav">
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a>{{authUser.name}}</a></li>
						<li><a href="/logout">Log ud</a></li>
					</ul>
				</div>
				<!--/.nav-collapse --> 
			</div>
		</div>
		<div class="container" ng-view></div>

		<!-- scripts -->
		<script src="libs/jquery/jquery-v1.11.0.min.js"></script>
		<script src="libs/angularjs/angular.min.js"></script>
		<script src="libs/angularjs/angular-route.min.js"></script>
		<script src="js/app_admin.js"></script>
		<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
		<script src="libs/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
		<!-- blueimp Gallery script -->
		<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="libs/jquery-file-upload/js/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload.js"></script>
		<!-- The File Upload processing plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-process.js"></script>
		<!-- The File Upload image preview & resize plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-image.js"></script>
		<!-- The File Upload audio preview plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
		<!-- The File Upload video preview plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-video.js"></script>
		<!-- The File Upload validation plugin -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
		<!-- The File Upload Angular JS module -->
		<script src="libs/jquery-file-upload/js/jquery.fileupload-angular.js"></script>
		<script src="libs/bootstrap/js/bootstrap.min.js"></script>
	</body>
	</html>
