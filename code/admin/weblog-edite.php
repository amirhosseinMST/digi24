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
                    $edite = "SELECT * FROM weblog WHERE id = '{$_GET["id"]}'";
                    $edite_result = $db->query($edite);
                    $weblog_edite = $edite_result->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <?php
                if (isset($_POST['edite-weblog'])) {
                    if (trim($_POST['title']) != "" && trim($_POST['type']) != "" &&
                        trim($_POST['content_header']) != "" && trim($_POST['content_body']) != "" &&
                        trim($_POST['content_footer']) != ""
                    ) {
                        $title = $_POST['title'];
                        $type = $_POST['type'];
                        $content_header = $_POST['content_header'];
                        $content_body = $_POST['content_body'];
                        $content_footer = $_POST['content_footer'];

                        if (trim($_FILES['img_header']['name']) != "") {
                            $img_header_name = rand(1,1000).date('dmyhis').$_FILES['img_header']['name'];
                            $img_header_tmp = $_FILES['img_header']['tmp_name'];
                            move_uploaded_file($img_header_tmp, "../upload/weblog/$img_header_name");
                            $sql = "UPDATE `weblog` SET title = :title, type = :type, img_header = :img_header, content_header = :content_header, content_body = :content_body, content_footer = :content_footer WHERE id = :id";
                            $stmt = $db->prepare($sql);
                            $params = ['title' => $title, 'type' => $type, 'img_header' => $img_header_name, 'content_header' => $content_header, 'content_body' => $content_body, 'content_footer' => $content_footer, 'id' => $weblog_edite['id']];
                        } else {
                            $sql = "UPDATE `weblog` SET title = :title, type = :type, content_header = :content_header, content_body = :content_body, content_footer = :content_footer WHERE id = :id";
                            $stmt = $db->prepare($sql);
                            $params = ['title' => $title, 'type' => $type, 'content_header' => $content_header, 'content_body' => $content_body, 'content_footer' => $content_footer, 'id' => $weblog_edite['id']];
                        }

                        if (trim($_FILES['img_body']['name']) != "") {
                            $img_body_name = rand(1,1000).date('dmyhis').$_FILES['img_body']['name'];
                            $img_body_tmp = $_FILES['img_body']['tmp_name'];
                            move_uploaded_file($img_body_tmp, "../upload/weblog/$img_body_name");
                            $sql_body = "UPDATE `weblog` SET img_body = :img_body WHERE id = :id";
                            $stmt_body = $db->prepare($sql_body);
                            $params_body = ['img_body' => $img_body_name, 'id' => $weblog_edite['id']];
                            $stmt_body->execute($params_body);
                        }

                        if (trim($_FILES['img_footer']['name']) != "") {
                            $img_footer_name = rand(1,1000).date('dmyhis').$_FILES['img_footer']['name'];
                            $img_footer_tmp = $_FILES['img_footer']['tmp_name'];
                            move_uploaded_file($img_footer_tmp, "../upload/weblog/$img_footer_name");
                            $sql_footer = "UPDATE `weblog` SET img_footer = :img_footer WHERE id = :id";
                            $stmt_footer = $db->prepare($sql_footer);
                            $params_footer = ['img_footer' => $img_footer_name, 'id' => $weblog_edite['id']];
                            $stmt_footer->execute($params_footer);
                        }

                        if ($stmt->execute($params)) {
                            header("Location:weblog-edite.php?tex=با موفقيت ثبت شد &id=" . $weblog_edite['id']);
                            exit();
                        } else {
                            header("Location:weblog-edite.php?tex=متاسفانه ثبت نشد &id=" . $weblog_edite['id']);
                            exit();
                        }
                    } else {
                        echo '<div class="alert alert-danger">لطفا همه کادر ها پر شود.</div>';
                    }
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">عنوان</span>
                        <input value="<?php echo $weblog_edite['title'] ?>" name="title" type="text" class="form-control border-0 rounded-0 none-shadow button-color" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">نوع</span>
                        <input value="<?php echo $weblog_edite['type'] ?>" name="type" type="text" class="form-control border-0 rounded-0 none-shadow button-color" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس ابتدایی را انتخاب کنید</label>
                        <?php if($weblog_edite['img_header']): ?>
                            <div class="mb-2">
                                <img class="img-fluid" style="max-height: 200px;" src="../upload/weblog/<?php echo $weblog_edite['img_header'] ?>">
                                <small class="d-block text-muted">عکس فعلی</small>
                            </div>
                        <?php endif; ?>
                        <input name="img_header" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس میانه را انتخاب کنید</label>
                        <?php if($weblog_edite['img_body']): ?>
                            <div class="mb-2">
                                <img class="img-fluid" style="max-height: 200px;" src="../upload/weblog/<?php echo $weblog_edite['img_body'] ?>">
                                <small class="d-block text-muted">عکس فعلی</small>
                            </div>
                        <?php endif; ?>
                        <input name="img_body" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس انتهایی را انتخاب کنید</label>
                        <?php if($weblog_edite['img_footer']): ?>
                            <div class="mb-2">
                                <img class="img-fluid" style="max-height: 200px;" src="../upload/weblog/<?php echo $weblog_edite['img_footer'] ?>">
                                <small class="d-block text-muted">عکس فعلی</small>
                            </div>
                        <?php endif; ?>
                        <input name="img_footer" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا ابتدا</span>
                        <textarea id="content" name="content_header" rows="5" class="none-shadow form-control border-0 rounded-0 button-color" aria-label="With textarea"><?php echo $weblog_edite['content_header'] ?></textarea>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا میانه</span>
                        <textarea id="content" name="content_body" rows="5" class="none-shadow form-control border-0 rounded-0 button-color" aria-label="With textarea"><?php echo $weblog_edite['content_body'] ?></textarea>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا انتها</span>
                        <textarea id="content" name="content_footer" rows="5" class="none-shadow form-control border-0 rounded-0 button-color" aria-label="With textarea"><?php echo $weblog_edite['content_footer'] ?></textarea>
                    </div>
                    <button type="submit" name="edite-weblog" class="btn title-color my-2">ويرايش</button>
                </form>
            </div>
        </div>
    </div>
<?php
include("lib-admin/footer.php");
?>