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
                $edite = "SELECT * FROM brands WHERE id = '{$_GET["id"]}'";
                $edite_rusult = $db->query($edite);
                $brand_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php
            if (isset($_POST['edite-brand'])) {
                if (trim($_POST['title']) != "") {
                    $title = $_POST['title'];
                    if(isset($_FILES['img']['name']) && trim($_FILES['img']['name']) != ''){
                        $img_name =rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                        $img_tmp = $_FILES['img']['tmp_name'];
                        move_uploaded_file($img_tmp,"../upload/brands/{$img_name}");
                        $sql = "UPDATE `brands` SET `title` = :title , `img` = :img_name WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'id' => $_GET['id'] , 'img_name' => $img_name ];
                        if ($stmt->execute($params)) {
                            header("Location:brand-edite.php?tex=با موفقيت ویرایش شد &id=" . $brand_edite['id']);
                            exit();
                        } else {
                            header("Location:brand-edite.php?tex=متاسفانه ویرایش نشد &id=" . $brand_edite['id']);
                            exit();
                        }
                    }
                    else{
                        $sql = "UPDATE `brands` SET `title` = :title WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'id' => $_GET['id']];
                        if ($stmt->execute($params)) {
                            header("Location:brand-edite.php?tex=با موفقيت ویرایش شد &id=" . $brand_edite['id']);
                            exit();
                        } else {
                            header("Location:brand-edite.php?tex=متاسفانه ویرایش نشد &id=" . $brand_edite['id']);
                            exit();
                        }
                    }

                } else {
                    echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                }
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">عنوان</span>
                    <input value="<?php echo $brand_edite['title'] ?>" name="title" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label ">عكس اصلی را انتخاب کنید</label>
                    <div class="mb-2">
                        <img class="img-fluid d-block" style="max-height: 200px;" src="../upload/brands/<?php echo $brand_edite['img'] ?>">
                        <small class="d-block text-muted">عکس فعلی</small>
                    </div>
                    <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                </div>
                <button type="submit" name="edite-brand" class="btn title-color">ويرايش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

