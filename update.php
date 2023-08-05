<?php   
    session_start();
    if(!isset($_SESSION['admin_name'])){
        header('location:index.php');
        exit();
    }
    $key = $_GET['key'];
    $con = mysqli_connect("localhost","root","","app_db");
    $row2['admin'] = $_SESSION['admin_name'];
    $queryu = "SELECT * FROM `user` WHERE `key` = '$key'";
    $showdata = mysqli_query($con, $queryu);
    $arr = mysqli_fetch_array($showdata);
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
        $query =  "UPDATE `user` SET `id` = '$id', `with_n` = '$with_n', `against_n` = '$against_n', `court` = '$court', `judge` = '$judge', `date` = '$mysqlDate', `note` = '$note' WHERE `key` = '$key'";
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
                    <h2 class="page-title">تعديل الملف</h2>
                        <form action="" method="post">
                            <div class = "create-form">
                            <div class= "row">
                            <div class= "column" id="vr">
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">رقم الملف</label>
                                    <input type="number" name="id" class="text-input" value="<?php echo $arr['id']; ?>" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم الموكل</label>
                                    <input type="text" name="with_n" class="text-input" value="<?php echo $arr['with_n']; ?>" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم الخصم</label>
                                    <input type="text" name="against_n" class="text-input" value="<?php echo $arr['against_n']; ?>" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم المحكمة</label>
                                    <input type="text" name="court" class="text-input" value="<?php echo $arr['court']; ?>" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">أسم القاضي</label>
                                    <input type="text" name="judge" class="text-input" value="<?php echo $arr['judge']; ?>" require>
                                </div>
                                </div>
                                <div class= "column">
                                <div class="element">
                                    <label style="display: inline-block; margin-bottom: 30px; width: 150px;">التاريخ</label>
                                    <input type="date" name="date" class="text-input" value="<?php echo $arr['date']; ?>" require>
                                </div>
                                <div class="element">
                                    <label style="display: inline-block; width: 100px;">ملاحظات</label>
                                    <textarea rows="10" name="note" class="text-input"><?php echo $arr['note']; ?></textarea>
                                </div>
                                <input type="submit" name="submit" value="تعديل الملف" class="submit">
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