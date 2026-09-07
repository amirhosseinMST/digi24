<?php
include("lib-admin/header.php");
?>
<!--<main section start>-->
<?php
if (isset($_GET['mas'])) {
    $msa = htmlspecialchars($_GET['mas']);
    echo <<<HTML
    <script>alert("$msa")</script>
HTML;
}
$sql_weblog = "SELECT * FROM `weblog` ORDER BY `id` DESC";
$weblogs = $db->query($sql_weblog);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'weblog') {
            $query = "DELETE FROM `weblog` WHERE `id`='$id'";
        }
        $db->query($query);
        header("Location:weblog.php?mas=با موفقیت حذف شد.");
        exit();
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
                    <div class="col-6"><h3 class="d-inline-block">وبلاگ</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="weblog-new.php" class="btn btn-primary">ایجاد مطلب
                            جدید</a>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">

                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">نويسنده</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($weblogs as $weblog) {
                            echo <<<HTML
                        <tr>
                            <td>{$weblog['title']}</td>
                            <td>{$weblog['author']}</td>
                            <td>
                            <a href="weblog-edite.php?id={$weblog['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                            <a href="weblog.php?entity=weblog&action=delete&id={$weblog['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
                            </td>
                        </tr>

HTML;
                        }
                        ?>
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
