<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" />
</head>
<body>
<form align="center"  action="login.php" method="post">
    <div class="form-group">
        <h1> <span> Login </span></h1>
    </div>
    <div class="form-group">
        <input type="text" name="username" required placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" name="password" required placeholder="Password">
    </div>
    <div>
        <button class="button-primary" type="submit">Submit</button>
        <a class="button button-primary" href="register" role="button">Register</a>
    </div>
</form>
</body>
</html>