<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fotogalleri</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
<!-- Custom Styles -->
<link rel="stylesheet" href="css/styles.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
</head>
<body data-ng-app="imageUploader">
<!--   <header ng-include src="'includes/header.html'"></header> -->
<div class="container">
  <h1>Galleri</h1>
  <br>
  <div data-ng-controller="ImageController"> <a data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a> </div>
</div>

<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
  <div class="slides"></div>
  <h3 class="title"></h3>
  <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a> <a class="play-pause"></a>
  <ol class="indicator">
  </ol>
</div>
<footer ng-include src="'includes/footer.html'"></footer>

<!-- scripts --> 
<script src="libs/jquery/jquery-v1.11.0.min.js"></script> 
<script src="libs/angularjs/angular.min.js"></script> 
<!-- blueimp Gallery script --> 
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script> 
<!-- The File Upload Angular JS module --> 
<script src="libs/jquery-file-upload/js/jquery.fileupload-angular.js"></script> 
<script src="js/app.js"></script> 
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>