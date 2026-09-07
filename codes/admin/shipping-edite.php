<?php
include("lib-admin/header.php");
?>
<div class="container-xxl">
    <div class="row">
        <div class="col-auto">
            <?php
            include("lib-admin/sidebar.php");
            ?>
        </div>
        <div class="col-xl-10">
            <?php
            if (isset($_GET['tex'])) {
                $tex = $_GET['tex'];
                echo <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">$tex</div>
HTML;
            }
            if (isset($_GET["id"])) {
                $edite = "SELECT * FROM shipping_methods WHERE id = '{$_GET["id"]}'";
                $edite_rusult = $db->query($edite);
                $shipping_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php
            if (isset($_POST['edite-shipping'])) {
                if (trim($_POST['title']) != "" && trim($_POST['delivery_time']) != "" && trim($_POST['price']) != "") {
                    $title = $_POST['title'];
                    $delivery_time = $_POST['delivery_time'];
                    $price = $_POST['price'];
                    $sql = "UPDATE `shipping_methods` SET `title` = :title, `price` = :price, `delivery_time` = :delivery_time WHERE id = :id";
                    $stmt = $db->prepare($sql);
                    $params = ['title' => $title, 'price' => $price, 'delivery_time' => $delivery_time, 'id' => $_GET['id']];

                    if ($stmt->execute($params)) {
                        header("Location:shipping-edite.php?tex=با موفقيت ویرایش شد &id=" . $shipping_edite['id']);
                        exit();
                    } else {
                        header("Location:shipping-edite.php?tex=متاسفانه ویراش نشد &id=" . $shipping_edite['id']);
                        exit();
                    }
                } else {
                    echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                }
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">عنوان</span>
                    <input value="<?php echo $shipping_edite['title'] ?>" name="title" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">قیمت</span>
                    <input value="<?php echo $shipping_edite['price'] ?>" name="price" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color place-white"
                           placeholder="قیمت به ریال"
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">زمان ارسال</span>
                    <input value="<?php echo $shipping_edite['delivery_time'] ?>" name="delivery_time" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <button type="submit" name="edite-shipping" class="btn title-color ">ويرايش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>


