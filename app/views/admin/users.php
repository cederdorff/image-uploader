
<h1>Brugere</h1>
<form class="form-horizontal " role="form">
  <div class="form-group">
    <div class="col-sm-4">
      <input ng-model="searchText" type="text" class="form-control" placeholder="Søg">
    </div>
    <label class="col-lg-1 col-sm-2 control-label">Sorter efter:</label>
    <div class="col-sm-2">
      <select class="form-control" ng-model="selectedOrder">
        <option value="name">navn</option>
        <option value="email">email</option>
        <option value="type">type</option>
        <option value="created_at">oprettet den</option>
        <option value="updated_at">opdateret den</option>
      </select>
    </div>
    <button id="createUserBtn" class="btn btn-success pull-right" ng-click="showUser(null)">Opret bruger</button>
  </div>
</form>
<div class="list-group">
  <a class="list-group-item" ng-repeat="user in userData | filter:searchText | orderBy: selectedOrder">
    <div class="pull-right">
      <button class="btn btn-primary" ng-click="showUser(user)">Rediger</button>
      <button class="btn btn-danger" ng-click="deleteUser(user)">Slet</button>
    </div>
    <h4 class="list-group-item-heading">{{user.name}} <small>({{user.type}})</small></h4>
    <p class="list-group-item-text"><small>Email: </small>{{user.email}}</p>
  </a>
</div>
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <form class="form-horizontal simple-form" role="form" name="userForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Navn</label>
            <div class="col-sm-10">
              <input ng-model="user.name" type="text" class="form-control" id="inputName" placeholder="Navn" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input ng-model="user.email" type="text" class="form-control" id="inputEmail" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Adgangskode</label>
            <div class="col-sm-10">
              <input ng-model="user.password" type="password" class="form-control" id="inputPassword" placeholder="Adgangskode" required>
            </div>
          </div>
          <div class="form-group">
            <label for="type" class="col-sm-2 control-label">Brugertype</label>
            <div class="col-sm-10">
              <select ng-model="user.type" id="type" class="form-control" name="type" required>
                <option value="admin" selected>Admin</option>
                <option value="superuser">Superuser</option>
                <option value="user">User</option>
              </select>
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