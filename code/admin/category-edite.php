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
                $edite = "SELECT * FROM categories WHERE id = '{$_GET["id"]}'";
                $edite_rusult = $db->query($edite);
                $category_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php
            if (isset($_POST['edite-category'])) {
                if (trim($_POST['title']) != "" && trim($_POST['content']) != "") {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    if(isset($_FILES['img']['name']) && trim($_FILES['img']['name']) != ''){
                        $img_name = rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                        $img_tmp = $_FILES['img']['tmp_name'];
                        move_uploaded_file($img_tmp,"../upload/categories/".$img_name);
                        $sql = "UPDATE `categories` SET `title` = :title , `img` = :img_name , `body` = :content WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'id' => $_GET['id'] , 'img_name' => $img_name , 'content' => $content ];
                        if ($stmt->execute($params)) {
                            header("Location:category-edite.php?tex=با موفقيت ویرایش شد &id=" . $category_edite['id']);
                            exit();
                        } else {
                            header("Location:category-edite.php?tex=متاسفانه ویرایش نشد &id=" . $category_edite['id']);
                            exit();
                        }
                    }
                    else{
                        $sql = "UPDATE `categories` SET `title` = :title ,`body` = :content WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'id' => $_GET['id'] , 'content' => $content ];
                        if ($stmt->execute($params)) {
                            header("Location:category-edite.php?tex=با موفقيت ویرایش شد &id=" . $category_edite['id']);
                            exit();
                        } else {
                            header("Location:category-edite.php?tex=متاسفانه ویرایش نشد &id=" . $category_edite['id']);
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
                    <input value="<?php echo $category_edite['title'] ?>" name="title" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-text title-color border-0 rounded-0">توضيحات</span>
                    <textarea id="content" name="content" rows="5"
                              class=" none-shadow form-control border-0 rounded-0 button-color"
                              aria-label="With textarea"><?php echo $category_edite['body'] ?>
                    </textarea>
                </div>
                <div class="my-3">
                    <label for="formFile" class="form-label ">عكس اصلی را انتخاب کنید</label>
                        <div class="mb-2">
                            <img class="img-fluid d-block" style="max-height: 200px;" src="../upload/categories/<?php echo $category_edite['img'] ?>">
                            <small class="d-block text-muted">عکس فعلی</small>
                        </div>
                    <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                </div>
                <button type="submit" name="edite-category" class="btn title-color mb-2">ويرايش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

