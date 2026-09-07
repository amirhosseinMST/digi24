<?php
include("lib-admin/header.php");
?>
<!--<main section start>-->
<?php
if(isset($_GET['mas'])){
    $msa = htmlspecialchars($_GET['mas']);
    echo <<<HTML
    <script>alert("$msa")</script>
HTML;
}
$sql = "SELECT * FROM users WHERE `role` != 'user'";
$admins = $db->query($sql);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'admin') {
            $query = "DELETE FROM `users` WHERE `id`='$id'";
            $db->query($query);
            header("Location:admins.php?mas=با موفقیت حذف شد.");
            exit();
        }
    }
}
?>
<div class="container-xxl">
    <div class="row">
        <div class="col-auto">
            <?php
            include("lib-admin/sidebar.php");
            ?>
        </div>
        <div class="col-xl-10">
            <div class="row">
                <div class="row justify-content-between mb-2">
                    <div class="col-6"><h3 class="d-inline-block">مدير ها</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="admin-new.php" class="btn btn-primary">مدیر جدید</a>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">

                        <thead>
                        <tr>
                            <th scope="col">نام</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">نقش</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($admins as $admin) { ?>

                            <tr>
                                <td><?php echo $admin['first_name'] ." " . $admin['last_name']  ?></td>
                                <td><?php echo $admin['email'] ?></td>
                                <td><?php echo $admin['role'] ?></td>
                                <td>
                                    <a href="admin-edite.php?id=<?php echo $admin['id'] ?>"
                                       class="btn btn-outline-primary mb-2">ویرایش</a>
                                    <?php
                                    if ($admin['role'] != "main-admin") {
                                        echo <<<HTML
                                                       <a href="admins.php?entity=admin&action=delete&id={$admin['id']}"  class="btn btn-outline-danger mb-2">حذف</a> 
HTML;
                                    }
                                    ?>

                                </td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<main section end>-->
<?php
include("lib-admin/footer.php");
?>

