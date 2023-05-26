<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <form action="login_process.php" method="post">
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <input type="submit" value="Login">
    </form>
    <p>Don't have an account yet? <a href="register.php">Register here</a>.</p>
  </div>
</body>
</html>