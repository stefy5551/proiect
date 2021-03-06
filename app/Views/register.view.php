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
        <input type="text" name="username" required placeholder="Username">
    </div>
    <div class="form-group">
        <input type="text" name="name" required placeholder="Name">
    </div>
    <div class="form-group">
        <input type="email"  name="email" required placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" name="password" required placeholder="Password">
    </div>
    <div class="form-group">
        <input type="checkbox" name="is_doctor"> Doctor<br>

        <input type="text" name="specialization" placeholder="Specialization">
    </div>
    <div>
        <button class="button-primary" type="submit" >Submit</button>
        <a class="button button-primary" href="login" role="button">Login</a>
    </div>
    <div>
        <a>{{register_error}}</a>
    </div>
</form>
</body>
</html>