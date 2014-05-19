<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fotouploader | Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/login_styles.css">
</head>
<body>
  <div class="container">
    <form class="form-signin" role="form" action="login" method="post">
    <h2 class="form-signin-heading">Log ind</h2>
      <input type="text" class="form-control" placeholder="Emailadresse" required autofocus name="email">
      <input type="password" class="form-control" placeholder="Adgangskode" required name="password">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log ind</button>
    </form>
  </div>
</body>
</html>