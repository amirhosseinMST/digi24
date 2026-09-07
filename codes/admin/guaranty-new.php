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
            if (isset($_POST['add-guaranty'])) {
                if (trim($_POST['title']) != "") {
                    $title = $_POST['title'];
                    $sql = "INSERT INTO `guaranty` (title) VALUES (:title) ";
                    $stmt = $db->prepare($sql);
                    $params = ['title' => $title];
                    if ($stmt->execute($params)) {
                        header("Location:guaranty-new.php?tex=با موفقيت ثبت شد ");
                        exit();
                    } else {
                        header("Location:guaranty-new.php?tex=متاسفانه ثبت نشد ");
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
                <button type="submit" name="add-guaranty" class="btn title-color">ایجاد</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

