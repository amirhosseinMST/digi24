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
            if (isset($_POST['add-post'])) {
                if (trim($_POST['title']) != "" && trim($_POST['content']) != "" &&
                        trim($_POST['category']) != "" && trim($_FILES['img']['name']) != "" &&
                        trim($_POST['price']) != "" && trim($_POST['quantity']) != "" &&
                        trim($_POST['limitation']) != "" && trim($_POST['brand']) != "" &&
                        trim($_FILES['sub-img-1']['name']) != "" && trim($_FILES['sub-img-2']['name']) != "" &&
                        trim($_FILES['sub-img-3']['name']) != "" && trim($_FILES['sub-img-4']['name']) != "" &&
                        trim($_FILES['sub-img-5']['name']) != "" && trim($_FILES['review-img']['name']) != "" &&
                        trim($_POST['review']) != ""
                ){
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $category = $_POST['category'];
                    $img_name =rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                    $img_tmp = $_FILES['img']['tmp_name'];
                    $img_name_1 =rand(1,1000).date('dmyhis').$_FILES['sub-img-1']['name'];
                    $img_tmp_1 = $_FILES['sub-img-1']['tmp_name'];
                    $img_name_2 =rand(1,1000).date('dmyhis').$_FILES['sub-img-2']['name'];
                    $img_tmp_2 = $_FILES['sub-img-2']['tmp_name'];
                    $img_name_3 =rand(1,1000).date('dmyhis').$_FILES['sub-img-3']['name'];
                    $img_tmp_3 = $_FILES['sub-img-3']['tmp_name'];
                    $img_name_4 =rand(1,1000).date('dmyhis').$_FILES['sub-img-4']['name'];
                    $img_tmp_4 = $_FILES['sub-img-4']['tmp_name'];
                    $img_name_5 =rand(1,1000).date('dmyhis').$_FILES['sub-img-5']['name'];
                    $img_tmp_5 = $_FILES['sub-img-5']['tmp_name'];
                    $review = $_POST['review'];
                    $review_img_name =rand(1,1000).date('dmyhis').$_FILES['review-img']['name'];
                    $review_img_tmp = $_FILES['review-img']['tmp_name'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $limitation = $_POST['limitation'];
                    $brand = $_POST['brand'];
                    move_uploaded_file($img_tmp, "../upload/posts/$img_name");
                    move_uploaded_file($img_tmp_1, "../upload/posts/$img_name_1");
                    move_uploaded_file($img_tmp_2, "../upload/posts/$img_name_2");
                    move_uploaded_file($img_tmp_3, "../upload/posts/$img_name_3");
                    move_uploaded_file($img_tmp_4, "../upload/posts/$img_name_4");
                    move_uploaded_file($img_tmp_5, "../upload/posts/$img_name_5");
                    move_uploaded_file($review_img_tmp, "../upload/posts/$review_img_name");
                    $sql = "INSERT INTO `posts` (title, body, category_id, image, price, author, quantity, limitation, brand_id, sub_img_1, sub_img_2, sub_img_3, sub_img_4, sub_img_5,review,review_img) 
                    VALUES (:title, :content, :category, :img_name, :price, :author, :quantity, :limitation, :brand, :sub_img_1, :sub_img_2, :sub_img_3, :sub_img_4, :sub_img_5 , :review, :review_img)";

                    $stmt = $db->prepare($sql);
                    $params = [
                            'title' => $title,
                            'content' => $content,
                            'category' => $category,
                            'img_name' => $img_name,
                            'price' => $price,
                            'author' => $author,
                            'quantity' => $quantity,
                            'limitation' => $limitation,
                            'brand' => $brand,
                            'sub_img_1' => $img_name_1,
                            'sub_img_2' => $img_name_2,
                            'sub_img_3' => $img_name_3,
                            'sub_img_4' => $img_name_4,
                            'sub_img_5' => $img_name_5,
                            'review' => $review,
                            'review_img' => $review_img_name,
                    ];
                    if ($stmt->execute($params)) {
                        $post_id = $db->lastInsertId();
                            $sql_feature = "INSERT INTO post_features (post_id, title, body) VALUES (:post_id, :title, :body)";

                            $stmt_feature = $db->prepare($sql_feature);

                            if (trim($_POST['feature-title-1']) != "" && trim($_POST['feature-body-1']) != "") {
                                $stmt_feature->execute([
                                    'post_id' => $post_id,
                                    'title' => $_POST['feature-title-1'],
                                    'body' => $_POST['feature-body-1']
                                ]);
                            }

                            if (trim($_POST['feature-title-2']) != "" && trim($_POST['feature-body-2']) != "") {
                                $stmt_feature->execute([
                                    'post_id' => $post_id,
                                    'title' => $_POST['feature-title-2'],
                                    'body' => $_POST['feature-body-2']
                                ]);
                            }

                            if (trim($_POST['feature-title-3']) != "" && trim($_POST['feature-body-3']) != "") {
                                $stmt_feature->execute([
                                    'post_id' => $post_id,
                                    'title' => $_POST['feature-title-3'],
                                    'body' => $_POST['feature-body-3']
                                ]);
                            }

                            if (trim($_POST['feature-title-4']) != "" && trim($_POST['feature-body-4']) != "") {
                                $stmt_feature->execute([
                                    'post_id' => $post_id,
                                    'title' => $_POST['feature-title-4'],
                                    'body' => $_POST['feature-body-4']
                                ]);
                            }

                            if (trim($_POST['feature-title-5']) != "" && trim($_POST['feature-body-5']) != "") {
                                $stmt_feature->execute([
                                    'post_id' => $post_id,
                                    'title' => $_POST['feature-title-5'],
                                    'body' => $_POST['feature-body-5']
                                ]);
                            }
                        header("Location:post-new.php?tex=با موفقيت ثبت شد ");
                        exit();
                    } else {
                        header("Location:post-new.php?tex=متاسفانه ثبت نشد ");
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
                <select name="category" class=" none-shadow cursor-pointer form-select mt-3 border-0 rounded-0 button-color mb-2"
                        aria-label="Default select example">
                    <option selected value="">دسته بندی</option>
                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $categories = $db->query($sql);
                    if ($categories->rowCount() > 0) {
                        foreach ($categories as $category) {
                            echo <<<HTML
                        <option value="{$category['id']}" >{$category['title']}</option>
HTML;

                        }
                    }
                    ?>
                </select>
                <select name="brand" class=" none-shadow cursor-pointer form-select mt-3 border-0 rounded-0 button-color mb-2"
                        aria-label="Default select example">
                    <option selected value="">برند</option>
                    <?php
                    $sql_brand = "SELECT * FROM `brands`";
                    $brands = $db->query($sql_brand);
                    if ($brands->rowCount() > 0) {
                        foreach ($brands as $brand) {
                            echo <<<HTML
                        <option value="{$brand['id']}" >{$brand['title']}</option>
HTML;

                        }
                    }
                    ?>
                </select>
                <div class="mb-3">
                    <label for="formFile" class="form-label ">عكس اصلی را انتخاب کنید</label>
                    <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                           id="formFile">
                </div>
                <div class="row mb-3 justify-content-start">
                    <div class=" col-md-6 ">
                        <div class="">
                            <label for="formFile" class="form-label ">عکس اول</label>
                            <input name="sub-img-1" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                                   id="formFile">
                        </div>
                    </div>
                    <div class=" col-md-6 ">
                        <div class="">
                            <label for="formFile" class="form-label ">عکس دوم</label>
                            <input name="sub-img-2" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                                   id="formFile">
                        </div>
                    </div>
                    <div class=" col-md-6 ">
                        <div class="">
                            <label for="formFile" class="form-label ">عکس سوم</label>
                            <input name="sub-img-3" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                                   id="formFile">
                        </div>
                    </div>
                    <div class=" col-md-6 ">
                        <div class="">
                            <label for="formFile" class="form-label ">عکس چهارم</label>
                            <input name="sub-img-4" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                                   id="formFile">
                        </div>
                    </div>
                    <div class=" col-md-6 ">
                        <div class="">
                            <label for="formFile" class="form-label ">عکس پنجم</label>
                            <input name="sub-img-5" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                                   id="formFile">
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-3">
                    <h5>ویژگی های محصول</h5>
                    <small>الزامی نیست.</small>
                </div>

                <div class="row mb-3">

                    <div class="col-md-6 mb-2">
                        <input name="feature-title-1" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="عنوان ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-body-1" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="مقدار ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-title-2" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="عنوان ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-body-2" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="مقدار ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-title-3" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="عنوان ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-body-3" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="مقدار ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-title-4" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="عنوان ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-body-4" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="مقدار ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-title-5" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="عنوان ویژگی :">
                    </div>

                    <div class="col-md-6 mb-2">
                        <input name="feature-body-5" type="text"
                               class="form-control border-0  rounded-0 place-white none-shadow button-color"
                               placeholder="مقدار ویژگی :">
                    </div>

                </div>
                <div class="input-group">
                    <span class="input-group-text title-color border-0 rounded-0">نقد و برسی</span>
                    <textarea id="content" name="review" rows="5"
                              class=" none-shadow form-control border-0 rounded-0 button-color"
                              aria-label="With textarea"></textarea>
                </div>
                <div class="my-3">
                    <label for="formFile" class="form-label ">عکس مربوط به نقد و برسی را انتخاب کنید.</label>
                    <input name="review-img" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                           id="formFile">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text border-0 rounded-0 button-color">$</span>
                    <input name="price" type="text"
                           class="place-white none-shadow form-control border-0 rounded-0 button-color"
                           placeholder="قیمت به ریال" aria-label="قیمت به ریال">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">تعداد</span>
                    <input name="quantity" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">محدودیت در هر خرید مشتری</span>
                    <input name="limitation" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <button type="submit" name="add-post" class="btn title-color mb-2">ایجاد</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>
