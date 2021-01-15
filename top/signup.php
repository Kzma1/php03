<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../style/main.css">
    <title>Document</title>
</head>
<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>Login Page</h2>
            <p>Register from here to access.</p>
        </div>
    </div>

    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Mail</label>
                        <input type="text" class="form-control" placeholder="Mailaddress" name="mail" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="pass" required>
                    </div>
                    <div class="form-group">
                    <p?>権限<br>
                    <input type="radio" name="Authority" value="0" required> 一般
                    <input type="radio" name="Authority" value="1" required> ルートユーザー
                    </p>
                </div>
                    <button type="submit" class="btn btn-black">SignUp</button>
                </form>
                <form action="login_form.php">
                        <button type="submit" class="btn btn-secondary">login</button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>