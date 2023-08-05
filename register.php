<?php
    if(isset($_POST['s'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if($role == 123456789) {
            $r = a;
        }
        else {
            $r = u;
        }
        $con = mysqli_connect("localhost","root","","app_db");
        $select= "SELECT * FROM users WHERE username = '$username'";
        $check = mysqli_query($con,$select);
        if(mysqli_num_rows($check) > 0) {
            echo('<script>window.alert("لقد تم استعمال هذا الأسم من قبل");</script>');
        }
        else {
            $query="INSERT INTO users (username,password,role) VALUES ('$username', '$password','$r')";
            mysqli_query($con, $query);
            header('location:index.php?success=1');
        }
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
            <h2>انشاء حساب جديد</h2>
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
                        <label>انشاء كلمة مرور</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" name="role" placeholder=" ">
                        <span></span>
                        <label>الدور</label>
                    </div>
                    <div class="links register">
                        <a href="index.php">سجل الدخول</a>
                    </div>
                    <input type="submit" class="submit" name="s" value="انشئ حسابك">
                </form>
            </div>
            <div class="logo-container">
                <img src="pngegg.png">
            </div>
        </div>
    </body>
</html>