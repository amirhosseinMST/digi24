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
            if (isset($_POST['add-category'])) {
                if (trim($_POST['title']) != "" && trim($_FILES['img']['name']) != "" && trim($_POST['content']) != "") {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $img_name =rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                    $img_tmp = $_FILES['img']['tmp_name'];
                    move_uploaded_file($img_tmp, "../upload/categories/" . $img_name);
                    $sql = "INSERT INTO `categories` (title , img , body) VALUES (:title , :img , :content) ";
                    $stmt = $db->prepare($sql);
                    $params = ['title' => $title , 'img' => $img_name , 'content' => $content];
                    if ($stmt->execute($params)) {
                        header("Location:category-new.php?tex=با موفقيت ثبت شد ");
                        exit();
                    } else {
                        header("Location:category-new.php?tex=متاسفانه ثبت نشد ");
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
                <div class="input-group">
                    <span class="input-group-text title-color border-0 rounded-0">توضيحات</span>
                    <textarea id="content" name="content" rows="5"
                              class=" none-shadow form-control border-0 rounded-0 button-color"
                              aria-label="With textarea"></textarea>
                </div>
                <div class="my-3">
                    <label for="formFile" class="form-label ">یک عکس انتخاب کنید</label>
                    <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                           id="formFile">
                </div>
                <button type="submit" name="add-category" class="btn title-color">ایجاد</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>


