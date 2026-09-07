<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header("Location:../index.php?error=ابتدا وارد شوید.");
    exit();
}
require("config.php");
$email = $_SESSION['email'];
$sql_check = "SELECT * FROM `users` WHERE email = :email";
$stmt = $db->prepare($sql_check);
$result = $stmt->execute(array(":email" => $email));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row['role'] == 'user'){
    header("Location:../index.php?error=ابتدا وارد شوید.");
    exit();
}
?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/code.css">
    <link rel="stylesheet" href="../https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Digi24</title>
</head>
<body dir="rtl">
<!--<navbar section start>-->
<?php
$sql = "SELECT * FROM `logo`";
$logo = $db->query($sql);
$img = $logo->fetch();
?>
<nav class="navbar">
    <div class="container-xxl border-bottom border-dark border-2 " >
        <div class="row  align-items-center justify-content-between  w-100 p-0 m-0">
            <div class="col-md-auto col-12">
                <a class="navbar-brand">
                    <img src="../upload/logo/<?php echo $img['image']?>" alt="Logo" width="160" height="60""
                    class="d-inline-block align-text-top">
                </a>
            </div>
            <div class="col-md-auto col-12 mb-1">
                <button class="btn button-color d-xl-none "
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#adminSidebar">
                    <i class="bi bi-list"></i>
                    منوی مدیریت
                </button>
            </div>
            <div class="col-md-auto col-12 mb-1 " dir="ltr">
                <a class="btn btn-danger rounded-1 px-4 py-2  "
                   href="../admin/logout.php">
                    <!--            🚪-->
                    خروج
                </a>
            </div>
        </div>

    </div>
</nav>
<!--<navbar section end>-->