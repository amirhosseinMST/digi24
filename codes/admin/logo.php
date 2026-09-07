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
            $sql = "SELECT * FROM `logo` ";
            $logo = $db->query($sql);
            $img = $logo->fetch();
            $image = $img['image'];
            $id = $img['id'];
            if (isset($_POST['add-logo'])) {
                if (trim($_FILES['image']['name']) != "") {
                    $img_name =rand(1,1000).date('dmyhis').$_FILES['image']['name'];
                    $img_tmp = $_FILES['image']['tmp_name'];
                    move_uploaded_file($img_tmp, "../upload/logo/$img_name");
                    $sql = "UPDATE `logo` SET `image` = :image WHERE `id` = '$id'";
                    $stmt = $db->prepare($sql);
                    $params = [":image" => $img_name];
                    if ($stmt->execute($params)) {
                        header("Location:logo.php?tex=با موفقيت ثبت شد &id=" . $img['id']);
                    } else {
                        header("Location:logo.php?tex=متاسفانه ثبت نشد &id=" . $img['id']);
                    }
                } else {
                    echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                }
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <img class="img-fluid mb-2" src="../upload/logo/<?php echo $img['image'] ?>" width="110">
                <div class="mb-3">
                    <label for="formFile" class="form-label ">یک عکس انتخاب کنید.</label>
                    <input name="image" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                           id="formFile">
                </div>
                <button type="submit" name="add-logo" class="btn title-color">ویرایش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>
