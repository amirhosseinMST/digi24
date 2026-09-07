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
$sql = "SELECT * FROM shipping_methods";
$shippings = $db->query($sql);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'shipping') {
            $query = "DELETE FROM `shipping_methods` WHERE `id`='$id'";
            $db->query($query);
            header("Location:shipping.php?mas=با موفقیت حذف شد.");
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
                    <div class="col-6 "><h3 class="d-inline-block">روش های ارسال</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="shipping-new.php" class="btn btn-primary">روش ارسال
                            جدید</a>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">

                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">قیمت</th>
                            <th scope="col">زمان ارسال</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($shippings as $shipping) {
                            $price = number_format($shipping['price']);
                            echo <<<HTML
                        <tr>
                            <td>{$shipping['title']}</td>
                            <td>$price ریال</td>
                            <td>{$shipping['delivery_time']}</td>
                            <td>
                                <a href="shipping-edite.php?id={$shipping['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                                <a href="shipping.php?entity=shipping&action=delete&id={$shipping['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
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

