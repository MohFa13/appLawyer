<?php   
    session_start();
    if(!isset($_SESSION['admin_name'])){
        header('location:index.php');
        exit();
    }
    $con = mysqli_connect("localhost","root","","app_db");
    $row2['admin'] = $_SESSION['admin_name'];
    if(isset($_POST['submit'])) {
        $with_n = $_POST['with_n'];
        $against_n = $_POST['against_n'];
        $username = $row2['admin'];
        $id = $_POST['id'];
        $court = $_POST['court'];
        $judge = $_POST['judge'];
        $date = $_POST['date'];
        $note = $_POST['note'];
        $mysqlDate = date("Y-m-d",strtotime($date));
        $query =  "INSERT INTO user (username, id, with_n, against_n,court,judge,date,note) VALUES ('$username', '$id', '$with_n', '$against_n','$court','$judge','$mysqlDate','$note')";
        mysqli_query($con,$query);
        header('location:main.php');
    }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!--font awesome-->
        <script src="fonts.js"></script>

        <link rel="stylesheet" href="style2.css">
        <title>أدارة الملفّات</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <h1 class="logo-text"><span>مرحبا </span><?php echo $row2['admin']; ?></h1>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav">
                <li class="username">
                    <a class= "closeBtn">
                    <i class="fa-regular fa-xmark"></i></a>
                </li>
                <li class="username">
                <a href="logout.php" class="logout">
                    <i class="fa-regular fa-key-skeleton"></i>
                </a>
                </li>
                <li class="username">
                <a href="createp.php" class="logout">
                    <i class="fa-regular fa-pen"></i>
                </a>
                </li>
                <li class="username">
                    <a href="main.php" class="logout">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </li>
            </ul>
        </header>

        <div class="admin-wrapper ac">
        <div class="admin-content ac">
                <div class="content">
                    <h2 class="page-title">أظافة ملف</h2>
                        <form action="createp.php" method="post">
                            <div class = "create-form">
                            <div class= "row">
                            <div class= "column" id="vr">
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">رقم الملف</label>
                                    <input type="number" name="id" class="text-input" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم الموكل</label>
                                    <input type="text" name="with_n" class="text-input" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم الخصم</label>
                                    <input type="text" name="against_n" class="text-input" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم المحكمة</label>
                                    <input type="text" name="court" class="text-input" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم القاضي</label>
                                    <input type="text" name="judge" class="text-input" require>
                                </div>
                                </div>
                                <div class= "column">
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">التاريخ</label>
                                    <input type="date" name="date" class="text-input" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; width: 100px;">ملاحظات</label>
                                    <textarea rows="10" name="note" class="text-input" ></textarea>
                                </div>
                                <input type="submit" name="submit" value="أظافة" class="submit">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>