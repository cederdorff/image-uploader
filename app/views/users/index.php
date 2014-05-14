<!DOCTYPE html>
<html lang="en" ng-app="userApp" ng-controller="DataCtrl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User CRUD</title>
  <!-- Bootstrap -->
  <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
  <div ng-include src="'includes/header.html'"></div>
  <div class="container">
    <h1>User CRUD</h1>
    <form class="form-horizontal " role="form">
      <div class="form-group">
        <div class="col-sm-4">
          <input ng-model="searchText" type="text" class="form-control" placeholder="Search">
        </div>
        <label class="col-lg-1 col-sm-2 control-label">Order by:</label>
        <div class="col-sm-2">
          <select class="form-control" ng-model="selectedOrder">
            <option value="name">name</option>
            <option value="email">email</option>
            <option value="created_at">created at</option>
            <option value="updated_at">updated at</option>
          </select>
        </div>
        <button id="createUserBtn" class="btn btn-success pull-right" ng-click="showUser(null)">Create New User</button>
      </div>
    </form>
    <div class="list-group">
      <a class="list-group-item" ng-repeat="user in userData | filter:searchText | orderBy: selectedOrder">
        <div class="pull-right">
          <button class="btn btn-primary" ng-click="showUser(user)">Edit</button>
          <button class="btn btn-danger" ng-click="deleteUser(user)">Delete</button>
        </div>
        <h4 class="list-group-item-heading">{{user.name}}</h4>
        <p class="list-group-item-text"><small>Email: </small>{{user.email}}</p>
      </a>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <form class="form-horizontal simple-form" role="form">
          <div class="modal-body">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input ng-model="user.name" type="text" class="form-control" id="inputName" placeholder="Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input ng-model="user.email" type="text" class="form-control" id="inputEmail" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input ng-model="user.password" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group" ng-show="message">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="alert alert-danger">{{message}}</div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" ng-click="saveUser(user)">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="libs/jquery/jquery-v1.11.0.min.js"></script>
  <script src="libs/angularjs/angular.min.js"></script>
  <script src="js/app_users.js"></script>
  <script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>