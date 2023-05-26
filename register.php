<!DOCTYPE html>
<html>
<head>
  <title>Registration Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="login-box">
    <h2>Register</h2>
    <form action="register_process.php" method="post">
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <div class="user-box">
        <input type="email" name="email" required="">
        <label>Email</label>
      </div>
      <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="index.php">Login here</a>.</p>
  </div>
</body>
</html>