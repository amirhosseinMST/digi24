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
            if (isset($_POST['add-shipping'])) {
                if (trim($_POST['title']) != "" && trim($_POST['price']) != "" && trim($_POST['delivery_time']) != "") {
                    $title = $_POST['title'];
                    $delivery_time = $_POST['delivery_time'];
                    $price = $_POST['price'];
                    $sql = "INSERT INTO `shipping_methods` (title , price , delivery_time) VALUES (:title , :price , :delivery_time) ";
                    $stmt = $db->prepare($sql);
                    $params = ['title' => $title, 'price' => $price, 'delivery_time' => $delivery_time];
                    if ($stmt->execute($params)) {
                        header("Location:shipping-new.php?tex=با موفقيت ثبت شد ");
                        exit();
                    } else {
                        header("Location:shipping-new.php?tex=متاسفانه ثبت نشد ");
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
                    <input name="title" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                           placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">قیمت</span>
                    <input name="price" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color place-white"
                           placeholder="قیمت به ریال"
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">زمان ارسال</span>
                    <input name="delivery_time" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <button type="submit" name="add-shipping" class="btn title-color">ایجاد</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

