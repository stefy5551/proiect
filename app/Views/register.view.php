<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" />
</head>
<body>
<form align="center" action="auth/register" method="post">
    <div class="form-group">
        <h1> <span> Register </span></h1>
    </div>
    <div class="form-group">
        <input type="text" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="email"  name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <button class="button-primary" type="submit" >Submit</button>
        <a class="button button-primary" href="login" role="button">Login</a>
    </div>
</form>
</body>
</html>