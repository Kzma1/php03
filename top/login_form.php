<!DOCTYPE html>
<html lang="en">

    <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../style/main.css">
    </head>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2> Login Page</h2>
            <p>Login from here to access.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label>mail Adress</label>
                    <input type="text" class="form-control" placeholder="Mailadress" name="mail" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass" required>
                </div>
                <button type="submit" class="btn btn-black">Login</button>
            </form>
            <form action="signup.php">
            <button type="submit" class="btn btn-secondary">SignUp</button>
            </form>

            </div>
        </div>
    </div>
    
</body>

</html>

<?php
    session_start();
    // $maiにpostの値を入れて渡す
    // ログイン、サインアップでそれぞれ、ページを作る
    $_SESSION['mail'] = $_POST['mail'];
?>
