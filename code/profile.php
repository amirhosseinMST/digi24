<?php
include 'lib/header.php';
if (!isset($_SESSION['email'])) {
    header("location: index.php?error=ابتدا وارد شوید.");
    exit();
}
if (isset($_GET['mas'])) {
    $mas = htmlspecialchars($_GET['mas']);
    echo <<< HTML
       <script>alert("$mas")</script>
HTML;
}
/*اطلاعات کاربر*/
$sql = "SELECT * FROM `users` WHERE `email` = '{$_SESSION['email']}'";
$result = $db->query($sql);
$sub = $result->fetch(PDO::FETCH_ASSOC);
/*اطلاعات سفارشات کاربر*/
$sql_order = "SELECT * FROM `orders` WHERE `user_id` = '$sub[id]'";
$orders = $db->query($sql_order);
$order_count = 0;
foreach ($orders as $order) {
    $order_count++;
}
?>
<div class="container py-5 flex-grow-1" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header main-color-bg text-center py-4">

                    <h4 class="mb-3 text-white"><?php echo $sub['username'] ?></h4>

                    <p class="mb-0 mt-2 text-white-50 ">
                        <i class="bi bi-calendar3"></i> عضو از <?php
                        $date = jdate('Y/m/d ', strtotime($sub['created']));
                        echo $date ?>
                    </p>
                </div>

                <div class="card-body">

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-4">
                            <div class="bg-light shadow rounded-3 p-3 text-center">
                                <h5 class="text-success mb-0"><?php echo $order_count ?></h5>
                                <small class="text-muted">سفارشات</small>
                            </div>
                            <a href="sub-order.php?id=<?php echo $sub['id'] ?>"
                               class="btn main-color-bg text-white mt-3 me-2">
                                <i class="bi bi-bell-fill"></i> مشاهده سفارشات
                            </a>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">
                        <i class="bi bi-person-lines-fill main-color"></i> اطلاعات شخصی
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-person"></i> نام</small>
                                <span class="fw-medium"><?php echo $sub['first_name'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-person"></i> نام خانوادگی</small>
                                <span class="fw-medium"><?php echo $sub['last_name'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-envelope"></i> ایمیل</small>
                                <span class="fw-medium"><?php echo $sub['email'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-telephone"></i> تلفن ثابت</small>
                                <span class="fw-medium"><?php echo $sub['mobile'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-phone"></i> موبایل</small>
                                <span class="fw-medium"><?php echo $sub['phone'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-gender-ambiguous"></i> جنسیت</small>
                                <span class="fw-medium"><?php echo $sub['gender'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-calendar-event"></i> تاریخ
                                    تولد</small>
                                <span class="fw-medium"><?php
                                    $birth_date = jdate('Y/m/d ', strtotime($sub['birth_date']));
                                    echo $birth_date ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-mailbox"></i> کد پستی</small>
                                <span class="fw-medium"><?php echo $sub['postal_code'] ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-geo-alt"></i> استان</small>
                                <span class="fw-medium"><?php echo $sub['province'] ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi bi-geo"></i> شهر</small>
                                <span class="fw-medium"><?php echo $sub['city'] ?></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block"><i class="bi  bi-house"></i> آدرس</small>
                                <span class="fw-medium"><?php echo $sub['address'] ?></span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="profile-edite.php" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i> ویرایش اطلاعات
                        </a>

                        <a href="pass-edite.php" class="btn btn-outline-secondary">
                            <i class="bi bi-key"></i> تغییر رمز عبور
                        </a>
                        <form>
                            <button type="submit" name="logout" class="btn btn-outline-danger">
                                <i class="bi bi-box-arrow-right"></i> خروج
                            </button>
                        </form>
                        <?php
                        if (isset($_GET['logout'])) {
                            session_unset();
                            session_destroy();
                            header('Location: index.php');
                            exit();
                        }
                        ?>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php
include 'lib/footer.php';

?>
