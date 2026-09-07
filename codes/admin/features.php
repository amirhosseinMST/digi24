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
$sql = "SELECT * FROM features";
$features = $db->query($sql);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'feature') {
            $query = "DELETE FROM `features` WHERE `id`='$id'";
            $db->query($query);
            header("Location:features.php?mas=با موفقیت حذف شد.");
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
                        <div class="col-6 p-0 m-0 pe-3"><h3 class="d-inline-block">ویژگی‌ها</h3></div>
                        <div class="col-6 text-start p-0 m-0"><a href="features-new.php" class="btn btn-primary">ایجاد ویژگی جدید</a></div>
                    </div>
                    <div class="col-12">
                        <table class="table admin-table">

                            <thead>
                            <tr>
                                <th scope="col">عنوان</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($features as $feature) {
                                echo <<<HTML
                        <tr>
                            <td>{$feature['title']}</td>
                            <td>
                                <a href="features-edit.php?id={$feature['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                                <a href="features.php?entity=feature&action=delete&id={$feature['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
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