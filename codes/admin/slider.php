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
$sql_sliders = "SELECT * FROM `slider` ORDER BY `id` DESC";
$sliders = $db->query($sql_sliders);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'slider') {
            $query = "DELETE FROM `slider` WHERE `id`='$id'";
            $db->query($query);
            header("Location:slider.php?mas=با موفقت حذف شد.");
            exit();
        }
    } elseif ($action == 'active') {
        if ($entity == 'slider') {
            $query_disable = "UPDATE `slider` SET `active`='0'";
            $db->query($query_disable);
            $query_active = "UPDATE `slider` SET `active`='1' WHERE `id`='$id'";
            $db->query($query_active);
            header("Location:slider.php?mas=با موفقیت تنظیم شد.");
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
                    <div class="col-6"><h3 class="d-inline-block">اسلایدر ها</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="slider-new.php" class="btn btn-primary">ايجاد اسلایدر
                            جديد</a></div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">


                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">اسلاید فعال</th>
                            <th scope="col">فعال</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($sliders as $slider) {
                            if ($slider['active'] == 1) {
                                $dis = "";
                            } else {
                                $dis = "disabled btn-secondary";
                            }
                            echo <<<HTML
                        <tr>
                            <td>{$slider['title']}</td>
                            <td><button class="btn btn-primary pe-none $dis">فعال</button></td>
                            <td>
                            <a href="slider.php?entity=slider&action=active&id={$slider['id']}" class="btn  btn-primary  ">تنظیم به عنوان فعال</a>
                            </td>
                            <td>
                            <a href="slider-edite.php?id={$slider['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                            <a href="slider.php?entity=slider&action=delete&id={$slider['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
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

