<?php
include("lib-admin/header.php");
include '../function/jdf.php';

?>
    <!--<main section start>-->
<?php
$sql = "SELECT * FROM users WHERE role = 'user' ORDER BY id DESC ";
$subscribers = $db->query($sql);
?>
    <div class="container-xxl">
        <div class="row">
            <div class="col-auto ">
                <?php
                include("lib-admin/sidebar.php");
                ?>
            </div>
            <div class="col-xl-10">
                <div class="table-responsive">
                    <h3 class="my-3">مشترکین</h3>
                    <table class="table table-striped table-hover admin-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام کاربری</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام خانوادگی</th>
                            <th scope="col">جنسیت</th>
                            <th scope="col">تاریخ تولد</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">تلفن</th>
                            <th scope="col">موبایل</th>
                            <th scope="col">استان</th>
                            <th scope="col">شهر</th>
                            <th scope="col">آدرس</th>
                            <th scope="col">کد پستی</th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">آخرین بروزرسانی</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $counter = $subscribers->rowCount();
                        foreach ($subscribers as $subscriber) {
                            $genderText = ($subscriber['gender'] == 'male') ? 'مرد' : 'زن';
                            ?>
                            <tr>
                                <th scope="row"><?php echo $counter--; ?></th>
                                <td><?php echo $subscriber['username']; ?></td>
                                <td><?php echo $subscriber['first_name']; ?></td>
                                <td><?php echo $subscriber['last_name']; ?></td>
                                <td><?php echo $genderText; ?></td>
                                <td><?php echo jdate('Y/m/d', strtotime($subscriber['birth_date'])); ?></td>
                                <td><?php echo $subscriber['email']; ?></td>
                                <td><?php echo $subscriber['phone']; ?></td>
                                <td><?php echo $subscriber['mobile']; ?></td>
                                <td><?php echo $subscriber['province']; ?></td>
                                <td><?php echo $subscriber['city']; ?></td>
                                <td><?php echo $subscriber['address']; ?></td>
                                <td><?php echo $subscriber['postal_code']; ?></td>
                                <td><?php echo jdate('Y/m/d H:i', strtotime($subscriber['created'])); ?></td>
                                <td><?php echo jdate('Y/m/d H:i', strtotime($subscriber['updated'])); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--<main section end>-->
<?php
include("lib-admin/footer.php");
?>