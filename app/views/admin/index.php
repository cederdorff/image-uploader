<!-- index.html -->
<!DOCTYPE html>
<html>
<head>

	<!-- CSS -->
	<!-- load bootstrap (bootswatch version) -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/readable/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	
	<!-- JS -->
	<!-- load angular, ngRoute, ngAnimate -->
	<script src="http://code.angularjs.org/1.2.13/angular.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-route.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-animate.js"></script>
	<script src="js/app_image.js"></script>

</head>

<!-- apply our angular app -->
<body ng-app="imageUploaderApp">
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="uploader">Fotouploader</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class=""><a href="uploader">Uploader</a></li>
					<li ng-show="authUser.type=='admin'"><a href="users">Users</a></li>
					<li><a href="#about">About test</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a>{{authUser.name}}</a></li>
					<li><a href="/logout">Log ud</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>  
	<div ng-view></div>

</body>
</html>
