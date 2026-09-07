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
                    $edit = "SELECT * FROM features WHERE id = '{$_GET["id"]}'";
                    $edit_result = $db->query($edit);
                    $feature_edit = $edit_result->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <?php
                if (isset($_POST['edit-feature'])) {
                    if (trim($_POST['title']) != "" && trim($_POST['body']) != "") {
                        $title = $_POST['title'];
                        $body = $_POST['body'];
                        $sql = "UPDATE `features` SET `title` = :title , `body` = :body WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'body' => $body, 'id' => $_GET['id']];
                        if ($stmt->execute($params)) {
                            header("Location:features-edit.php?tex=با موفقيت ویرایش شد &id=" . $feature_edit['id']);
                            exit();
                        } else {
                            header("Location:features-edit.php?tex=متاسفانه ویرایش نشد &id=" . $feature_edit['id']);
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
                        <input value="<?php echo $feature_edit['title'] ?>" name="title" type="text"
                               class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                               aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon2">متن ویژگی</span>
                        <textarea name="body" class="form-control border-0 rounded-0 none-shadow button-color" rows="5"
                                  placeholder="متن توضیحات ویژگی را وارد کنید"><?php echo $feature_edit['body'] ?></textarea>
                    </div>
                    <button type="submit" name="edit-feature" class="btn title-color">ویرایش</button>
                </form>
            </div>
        </div>
    </div>
<?php
include("lib-admin/footer.php");
?>