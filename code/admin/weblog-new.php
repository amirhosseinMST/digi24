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
                $sql_author = "SELECT * FROM users WHERE email = :email";
                $stmt = $db->prepare($sql_author);
                $stmt->execute(['email' => $_SESSION['email']]);
                $authors = $stmt->fetch(PDO::FETCH_ASSOC);
                $author = $authors['first_name'] . " " . $authors['last_name'];
                if (isset($_POST['add-weblog'])) {
                    if (trim($_POST['title']) != "" && trim($_POST['type']) != "" &&
                        trim($_FILES['img_header']['name']) != "" && trim($_FILES['img_body']['name']) != "" &&
                        trim($_FILES['img_footer']['name']) != "" && trim($_POST['content_header']) != "" &&
                        trim($_POST['content_body']) != "" && trim($_POST['content_footer']) != ""
                    ){
                        $title = $_POST['title'];
                        $type = $_POST['type'];
                        $img_header_name = rand(1,1000).date('dmyhis').$_FILES['img_header']['name'];
                        $img_header_tmp = $_FILES['img_header']['tmp_name'];
                        $img_body_name = rand(1,1000).date('dmyhis').$_FILES['img_body']['name'];
                        $img_body_tmp = $_FILES['img_body']['tmp_name'];
                        $img_footer_name = rand(1,1000).date('dmyhis').$_FILES['img_footer']['name'];
                        $img_footer_tmp = $_FILES['img_footer']['tmp_name'];
                        $content_header = $_POST['content_header'];
                        $content_body = $_POST['content_body'];
                        $content_footer = $_POST['content_footer'];
                        move_uploaded_file($img_header_tmp, "../upload/weblog/$img_header_name");
                        move_uploaded_file($img_body_tmp, "../upload/weblog/$img_body_name");
                        move_uploaded_file($img_footer_tmp, "../upload/weblog/$img_footer_name");
                        $sql = "INSERT INTO `weblog` (title, type, img_header, img_body, img_footer, content_header, content_body, content_footer, author) 
                    VALUES (:title, :type, :img_header, :img_body, :img_footer, :content_header, :content_body, :content_footer, :author)";

                        $stmt = $db->prepare($sql);
                        $params = [
                            'title' => $title,
                            'type' => $type,
                            'img_header' => $img_header_name,
                            'img_body' => $img_body_name,
                            'img_footer' => $img_footer_name,
                            'content_header' => $content_header,
                            'content_body' => $content_body,
                            'content_footer' => $content_footer,
                            'author' => $author,
                        ];
                        if ($stmt->execute($params)) {
                            header("Location:weblog-new.php?tex=با موفقيت ثبت شد ");
                            exit();
                        } else {
                            header("Location:weblog-new.php?tex=متاسفانه ثبت نشد ");
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
                        <input name="title" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">نوع</span>
                        <input name="type" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس ابتدایی را انتخاب کنید</label>
                        <input name="img_header" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                               id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس میانه را انتخاب کنید</label>
                        <input name="img_body" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                               id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس انتهایی را انتخاب کنید</label>
                        <input name="img_footer" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                               id="formFile">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا ابتدا</span>
                        <textarea id="content" name="content_header" rows="5"
                                  class="none-shadow form-control border-0 rounded-0 button-color"
                                  aria-label="With textarea"></textarea>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا میانه</span>
                        <textarea id="content" name="content_body" rows="5"
                                  class="none-shadow form-control border-0 rounded-0 button-color"
                                  aria-label="With textarea"></textarea>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text title-color border-0 rounded-0">محتوا انتها</span>
                        <textarea id="content" name="content_footer" rows="5"
                                  class="none-shadow form-control border-0 rounded-0 button-color"
                                  aria-label="With textarea"></textarea>
                    </div>
                    <button type="submit" name="add-weblog" class="btn title-color my-2">ایجاد</button>
                </form>
            </div>
        </div>
    </div>
<?php
include("lib-admin/footer.php");
?>