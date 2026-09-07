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
$sql = "SELECT * FROM guaranty";
$guaranty = $db->query($sql);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'guaranty') {
            $query = "DELETE FROM `guaranty` WHERE `id`='$id'";
            $db->query($query);
            header("Location:guaranty.php?mas=با موفقیت حذف شد.");
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
                    <div class="col-6 p-0 m-0 pe-3"><h3 class="d-inline-block">گارانتی ها</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="guaranty-new.php" class="btn btn-primary">ايجاد گارانتی
                            جديد</a></div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">

                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($guaranty as $row) {
                            echo <<<HTML
                        <tr>
                            <td>{$row['title']}</td>
                            <td>
                                <a href="guaranty-edite.php?id={$row['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                                <a href="guaranty.php?entity=guaranty&action=delete&id={$row['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
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

