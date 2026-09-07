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
                $edite = "SELECT * FROM slider WHERE id = '{$_GET["id"]}'";
                $edite_rusult = $db->query($edite);
                $slider_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php
            if (isset($_POST['edite-slider'])) {
                if (trim($_POST['title']) != "" && trim($_POST['content']) != "") {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $category = $_POST['category'];

                    if (trim($_FILES['img']['name']) != "") {
                        $img_name =rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                        $img_tmp = $_FILES['img']['tmp_name'];
                        move_uploaded_file($img_tmp, "../upload/slider/$img_name");
                        $sql = "UPDATE `slider` SET title = :title, body = :content ,  image = :img_name WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'content' => $content, 'img_name' => $img_name, 'id' => $slider_edite['id']];
                    } else {
                        $sql = "UPDATE `slider` SET title = :title, body = :content  WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'content' => $content, 'id' => $slider_edite['id']];
                    }

                    if ($stmt->execute($params)) {
                        header("Location:slider-edite.php?tex=با موفقيت ثبت شد &id=" . $slider_edite['id']);
                        exit();
                    } else {
                        header("Location:slider-edite.php?tex=متاسفانه ثبت نشد &id=" . $slider_edite['id']);
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
                    <input value="<?php echo $slider_edite['title'] ?>" name="title" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-text title-color border-0 rounded-0">توضيحات</span>
                    <textarea id="content" name="content"
                              class=" none-shadow form-control border-0 rounded-0 button-color"
                              aria-label="With textarea"><?php echo $slider_edite['body'] ?></textarea>
                </div>
                <img class="img-fluid my-3" src="../upload/slider/<?php echo $slider_edite['image'] ?>">
                <div class="mb-3">
                    <label for="formFile" class="form-label ">یک عکس انتخاب کنید.</label>
                    <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                           id="formFile">
                </div>
                <button type="submit" name="edite-slider" class="btn title-color mb-2">ويرايش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

