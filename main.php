<?php   
    session_start();
    if(!isset($_SESSION['admin_name'])){
        header('location:index.php');
        exit();
    }
    $con = mysqli_connect("localhost","root","","app_db");
    $row2['admin'] = $_SESSION['admin_name'];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!--font awesome-->
        <script src="fonts.js"></script>
        <link rel="stylesheet" href="column.css">
        <link rel="stylesheet" href="style2.css">
        <title>أدارة الملفّات</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <h1 class="logo-text"><span>مرحبا </span><?php echo $row2['admin']; ?></h1>
            </div>
            <a><i class="fa fa-bars menu-toggle"></i></a>
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
                <li class="username">
                <form action="" method="POST">
                    <input type="text" name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" placeholder="أبحث...">
                    <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                </form>
                </li>
            </ul>
        </header>

        <div class="admin-wrapper">
            <div class="admin-content">
                <div class="content">
                    <h2 class="page-title">أدارة الملفّات</h2>
                    <div class="table-responsive">
                    <table>
                        <thead>
                            <th>#</th>
                            <th>رقم الملف</th>
                            <th>أسم الموكل</th>
                            <th>أسم الخصم</th>
                            <th>المحكمة</th>
                            <th>أسم القاضي</th>
                            <th>تاريخ الجلسة</th>
                            <th>ملاحظات</th>
                            <th colspan=2>العمليات</th>
                        </thead>
                        <tbody>
                            <?php
                            $name = $row2['admin'];
                            $select= "SELECT * FROM users";
                            $select1 = "SELECT * FROM user  WHERE username = '$name'";
                            $query_run1 = mysqli_query($con,$select);
                            $query_run = mysqli_query($con,$select1);
                            if(isset($_POST['submit']))
                                    {
                                        $filtervalues = $_POST['search'];
                                        $query = "SELECT * FROM user WHERE with_n LIKE '%$filtervalues%' AND username = '$name'";
                                        $query_run2 = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run2) > 0)
                                        {
                                            foreach($query_run2 as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?= $items['id']; ?></td>
                                                    <td><?= $items['with_n']; ?></td>
                                                    <td><?= $items['against_n']; ?></td>
                                                    <td><?= $items['court']; ?></td>
                                                    <td><?= $items['judge']; ?></td>
                                                    <td><?= $items['date']; ?></td>
                                                    <td><?= $items['note']; ?></td>
                                                    <input type="hidden" name="undo_main_id" value="' . $row['id'] . '" />
                                                    <td><a href="update.php?key=<?php echo $items['key'];?>" data-toggle="tooltip" data-placement="bottom" title="تعديل" style="color:green;"><i class="fa fa-edit" aria-hidden="true"></a></td>
                                                    <td><a onclick="confirmDelete()" href="delete.php?key=<?php echo $items['key'];?>" data-toggle="tooltip" data-placement="bottom" title="أزالة" style="color:red;"><i class="fa fa-trash" aria-hidden="true"></a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                else {
                                    $query = "SELECT * FROM user WHERE username = '$name'";
                                        $query_run2 = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run2) > 0)
                                        {
                                            foreach($query_run2 as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?= $items['id']; ?></td>
                                                    <td><?= $items['with_n']; ?></td>
                                                    <td><?= $items['against_n']; ?></td>
                                                    <td><?= $items['court']; ?></td>
                                                    <td><?= $items['judge']; ?></td>
                                                    <td><?= $items['date']; ?></td>
                                                    <td><?= $items['note']; ?></td>
                                                    <td><a href="update.php?key=<?php echo $items['key'];?>" data-toggle="tooltip" data-placement="bottom" title="تعديل" style="color:green;"><i class="fa fa-edit" aria-hidden="true"></a></td>
                                                    <td><a onclick="confirmDelete()" href="delete.php?key=<?php echo $items['key'];?>" data-toggle="tooltip" data-placement="bottom" title="أزالة" style="color:red;"><i class="fa fa-trash" aria-hidden="true"></a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                }
                            ?>                                
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
        <script>
            function confirmDelete() {
                var result = confirm('هل أنت متأكد؟');
                if(result == false) {
                    event.preventDefault();
                }
            }
        </script>
    </body>
</html>