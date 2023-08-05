<?php
    session_start();
    if(isset($_POST['s'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $con = mysqli_connect("localhost","root","","app_db");
        $select= "SELECT * FROM users WHERE username = '$username' && password = '$password'";
        $check = mysqli_query($con,$select);
        if(mysqli_num_rows($check) > 0) {
            $row = mysqli_fetch_array($check);
            if($row['role'] == 'a') {
                $_SESSION['admin_name'] = $row['username'];
                $_SESSION['admin'] = $row['role'];
                header('location:main.php');
            }
            elseif($row['role'] == 'u') {
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user'] = $row['role'];
                header('location:posts-user.php');
            }
        }
        else {
            $error[] = 'Incorrect Username or Password!';
        }
    }
    if(isset($_GET['success']) && $_GET['success'] == 1) {
        echo('<script>window.alert("تم انشاء الحساب");</script>');
    }
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>موقع محاماة</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h2>تسجيل الدخول</h2>
            <div class="form-container">
                <form method="post">
                    <div class="txt_field">
                        <input type="text" name="username" placeholder=" " required>
                        <span></span>
                        <label>أسم المستخدم</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" name="password" placeholder=" " required>
                        <span></span>
                        <label>كلمة المرور</label>
                    </div>
                    <div class="links">
                        <a href="register.php">سجل هنا</a>
                    </div>
                    <input type="submit" class="submit" name="s" value="سجل الدخول">
                </form>
            </div>
            <div class="logo-container">
                <img src="pngegg.png">
            </div>
        </div>
    </body>
</html>