<!DOCTYPE html>
<html>
    <head>
        <title>
            LOGIN
        </title>
        <link rel="stylesheet" href="http://localhost/rentcar/login.css">
    </head>
    <body>
        <div class="login">
            <h1>Login Admin</h1>
            <form action="proseslogin.php" method="POST">
                <p><input type="text" name="txt_user" placeholder="   Username" class="input"></p>
                <p><input type="password" name="txt_pass" placeholder="   Password" class="input"></p>
                <p><input type="submit" value="login" class="btn-login"></p>
            </form>
        </div>
    </body>
</html>