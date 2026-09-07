<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/code.css">
    <title>Digi24</title>
</head>
<body>
<?php
ob_start();
session_start();
require "config.php";
include("function/truncateText.php");
include("function/jdf.php");
?>
<!-- =========================================
  HEADER
=========================================  -->
<header class="header">

    <!-- رديف بالا-->
    <div class="container-xxl bg-white border-lig-bottom">

        <div class="row align-items-center justify-content-end py-2 ">

            <!-- آیکون‌ها -->
            <div class="col-auto order-3 order-md-1 mt-md-0 mt-2 ms-md-auto  " dir="rtl">
                <div class="d-flex align-items-center gap-3">

                    <a href="sign-in.php" class="header-icon ">
                        <i class="bi bi-person fw-bold"></i>
                    </a>
                    <span class="border-color ">|</span>
                    <a href="cart.php" class="header-icon me-md-2">
                        <i class="bi bi-cart3 fw-bold"></i>
                    </a>

                </div>
            </div>

            <!-- جستجو -->
            <div class="col-12 col-md-5 order-2 order-md-2 mt-2 mt-md-0">

                <form action="search.php" method="get">

                    <div class="input-group search-box" >

                        <input type="text" name="search" class="form-control ps-0 ms-0" placeholder="جستجو..." dir="rtl">

                        <button class="btn pe-0 me-2" type="submit"> <i class="bi bi-search "></i> </button>

                    </div>

                </form>

            </div>
            <?php
            $sql = "SELECT * FROM `logo`";
            $logo = $db->query($sql);
            $img = $logo->fetch();
            ?>
            <!-- لوگو -->
            <div class="col-auto  order-1 order-md-3">

                <a class="navbar-brand" href="index.php">
                    <img src="upload/logo/<?php echo $img['image'] ?>" alt="Bootstrap" width="150" height="60">
                </a>

            </div>

        </div>

    </div>

    <!--  نوبار -->
    <nav class="navbar navbar-expand-md main-navbar bg-white">

        <div class="container">

            <!-- دکمه همبرگری منو -->
            <button class="navbar-toggler border-0 shadow-none me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" >
                <i class="bi bi-list fs-4"></i>
            </button>

            <!-- منوی اصلی -->
            <div class="collapse navbar-collapse justify-content-center" id="mainMenu" >

                <ul class="navbar-nav align-items-md-center" dir="rtl">

                    <li class="nav-item">
                        <a class="nav-link " href="index.php">
                            صفحه اصلی
                        </a>
                    </li>
                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $result = $db->query($sql);
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                            echo <<<HTML
                            <li class="nav-item">
                                <a class="nav-link" href="products.php?id={$row['id']}">
                                    {$row['title']}
                                </a>
                            </li>
HTML;

                        }
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="weblogs.php">
                            وبلاگ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            تماس با ما
                        </a>
                    </li>
                    <?php
                    if(isset($_SESSION['email'])){
                        $sql_role = "SELECT * FROM `users` WHERE `email`='{$_SESSION['email']}'";
                        $role = $db->query($sql_role);
                        $role = $role->fetch();
                        if($role['role'] == 'user'){
                            echo <<<HTML
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="profile.php">
                                    پروفایل
                                </a>
                            </li>
HTML;
                        }
                    }
                    ?>
                </ul>

            </div>

        </div>

    </nav>

</header>
<!-- =========================================
     FLOATING CONTACT BUTTONS
========================================= -->

<!-- دکمه‌های شناور -->
<div class="floating-contact">

    <!-- دکمه سبد خرید -->
    <a href="cart.php" class="floating-item cart-floating">

        <i class="bi bi-cart3"></i>

        <span>
            سبد خرید
        </span>

    </a>

    <!-- دکمه تماس با ما -->
    <a href="contact.php" class="floating-item message-floating">

        <i class="bi bi-envelope"></i>

        <span>
            تماس با ما
        </span>

    </a>

</div>