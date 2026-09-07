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
                    $edite = "SELECT * FROM posts WHERE id = '{$_GET["id"]}'";
                    $edite_rusult = $db->query($edite);
                    $post_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);

                    $sql_feature = "SELECT * FROM post_features WHERE post_id = :post_id";
                    $stmt_feature = $db->prepare($sql_feature);
                    $stmt_feature->execute(['post_id' => $post_edite['id']]);
                    $features = $stmt_feature->fetchAll(PDO::FETCH_ASSOC);
                }
                ?>
                <?php
                if (isset($_POST['edite-post'])) {
                    if (trim($_POST['title']) != "" && trim($_POST['content']) != "" && trim($_POST['category']) != "" && trim($_POST['price']) != "" && trim($_POST['quantity']) != "" && trim($_POST['limitation']) != "" && trim($_POST['brand']) != "" && trim($_POST['review']) != "") {
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $category = $_POST['category'];
                        $price = $_POST['price'];
                        $quantity = $_POST['quantity'];
                        $limitation = $_POST['limitation'];
                        $brand = $_POST['brand'];
                        $review = $_POST['review'];

                        if (trim($_FILES['img']['name']) != "") {
                            $img_name =rand(1,1000).date('dmyhis').$_FILES['img']['name'];
                            $img_tmp = $_FILES['img']['tmp_name'];
                            move_uploaded_file($img_tmp, "../upload/posts/$img_name");
                            $sql = "UPDATE `posts` SET title = :title, body = :content , category_id = :category, image = :img_name , price = :price , quantity = :quantity , limitation = :limitation , brand_id = :brand , review = :review WHERE id = :id";
                            $stmt = $db->prepare($sql);
                            $params = ['title' => $title, 'content' => $content, 'category' => $category, 'img_name' => $img_name, 'id' => $post_edite['id'], 'price' => $price, 'quantity' => $quantity, 'limitation' => $limitation, 'brand' => $brand, 'review' => $review];
                        } else {
                            $sql = "UPDATE `posts` SET title = :title, body = :content , category_id = :category , price = :price , quantity = :quantity , limitation = :limitation , brand_id = :brand , review = :review WHERE id = :id";
                            $stmt = $db->prepare($sql);
                            $params = ['title' => $title, 'content' => $content, 'category' => $category, 'id' => $post_edite['id'], 'price' => $price, 'quantity' => $quantity, 'limitation' => $limitation, 'brand' => $brand, 'review' => $review];
                        }

                        if (trim($_FILES['sub-img-1']['name']) != "") {
                            $img_name_1 =rand(1,1000).date('dmyhis').$_FILES['sub-img-1']['name'];
                            $img_tmp_1 = $_FILES['sub-img-1']['tmp_name'];
                            move_uploaded_file($img_tmp_1, "../upload/posts/$img_name_1");
                            $sql_1 = "UPDATE `posts` SET sub_img_1 = :sub_img_1 WHERE id = :id";
                            $stmt_1 = $db->prepare($sql_1);
                            $params_1 = ['sub_img_1' => $img_name_1, 'id' => $post_edite['id']];
                            $stmt_1->execute($params_1);
                        }
                        if (trim($_FILES['sub-img-2']['name']) != "") {
                            $img_name_2 =rand(1,1000).date('dmyhis').$_FILES['sub-img-2']['name'];
                            $img_tmp_2 = $_FILES['sub-img-2']['tmp_name'];
                            move_uploaded_file($img_tmp_2, "../upload/posts/$img_name_2");
                            $sql_2 = "UPDATE `posts` SET sub_img_2 = :sub_img_2 WHERE id = :id";
                            $stmt_2 = $db->prepare($sql_2);
                            $params_2 = ['sub_img_2' => $img_name_2, 'id' => $post_edite['id']];
                            $stmt_2->execute($params_2);
                        }
                        if (trim($_FILES['sub-img-3']['name']) != "") {
                            $img_name_3 =rand(1,1000).date('dmyhis').$_FILES['sub-img-3']['name'];
                            $img_tmp_3 = $_FILES['sub-img-3']['tmp_name'];
                            move_uploaded_file($img_tmp_3, "../upload/posts/$img_name_3");
                            $sql_3 = "UPDATE `posts` SET sub_img_3 = :sub_img_3 WHERE id = :id";
                            $stmt_3 = $db->prepare($sql_3);
                            $params_3 = ['sub_img_3' => $img_name_3, 'id' => $post_edite['id']];
                            $stmt_3->execute($params_3);
                        }
                        if (trim($_FILES['sub-img-4']['name']) != "") {
                            $img_name_4 =rand(1,1000).date('dmyhis').$_FILES['sub-img-4']['name'];
                            $img_tmp_4 = $_FILES['sub-img-4']['tmp_name'];
                            move_uploaded_file($img_tmp_4, "../upload/posts/$img_name_4");
                            $sql_4 = "UPDATE `posts` SET sub_img_4 = :sub_img_4 WHERE id = :id";
                            $stmt_4 = $db->prepare($sql_4);
                            $params_4 = ['sub_img_4' => $img_name_4, 'id' => $post_edite['id']];
                            $stmt_4->execute($params_4);
                        }
                        if (trim($_FILES['sub-img-5']['name']) != "") {
                            $img_name_5 =rand(1,1000).date('dmyhis').$_FILES['sub-img-5']['name'];
                            $img_tmp_5 = $_FILES['sub-img-5']['tmp_name'];
                            move_uploaded_file($img_tmp_5, "../upload/posts/$img_name_5");
                            $sql_5 = "UPDATE `posts` SET sub_img_5 = :sub_img_5 WHERE id = :id";
                            $stmt_5 = $db->prepare($sql_5);
                            $params_5 = ['sub_img_5' => $img_name_5, 'id' => $post_edite['id']];
                            $stmt_5->execute($params_5);
                        }
                        if (trim($_FILES['review-img']['name']) != "") {
                            $review_img_name =rand(1,1000).date('dmyhis').$_FILES['review-img']['name'];
                            $review_img_tmp = $_FILES['review-img']['tmp_name'];
                            move_uploaded_file($review_img_tmp, "../upload/posts/$review_img_name");
                            $sql_review = "UPDATE `posts` SET review_img = :review_img WHERE id = :id";
                            $stmt_review = $db->prepare($sql_review);
                            $params_review = ['review_img' => $review_img_name, 'id' => $post_edite['id']];
                            $stmt_review->execute($params_review);
                        }

                        if ($stmt->execute($params)) {
                            $post_id = $post_edite['id'];

                            for ($i = 0; $i < 5; $i++) {

                                $feature_title = trim($_POST['feature-title-' . ($i + 1)]);
                                $feature_body = trim($_POST['feature-body-' . ($i + 1)]);

                                if ($feature_title != "" && $feature_body != "") {

                                    if (isset($features[$i])) {

                                        $sql_feature = "UPDATE post_features SET title = :title, body = :body WHERE id = :id";

                                        $stmt_feature = $db->prepare($sql_feature);

                                        $stmt_feature->execute([
                                                'title' => $feature_title,
                                                'body' => $feature_body,
                                                'id' => $features[$i]['id']
                                        ]);

                                    } else {

                                        $sql_feature = "INSERT INTO post_features (post_id, title, body) VALUES (:post_id, :title, :body)";

                                        $stmt_feature = $db->prepare($sql_feature);

                                        $stmt_feature->execute([
                                                'post_id' => $post_id,
                                                'title' => $feature_title,
                                                'body' => $feature_body
                                        ]);
                                    }

                                } elseif (isset($features[$i])) {

                                    $sql_feature = "DELETE FROM post_features WHERE id = :id";

                                    $stmt_feature = $db->prepare($sql_feature);

                                    $stmt_feature->execute([
                                            'id' => $features[$i]['id']
                                    ]);
                                }
                            }
                            header("Location:post-edite.php?tex=با موفقيت ثبت شد &id=" . $post_edite['id']);
                            exit();
                        } else {
                            header("Location:post-edite.php?tex=متاسفانه ثبت نشد &id=" . $post_edite['id']);
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
                        <input value="<?php echo $post_edite['title'] ?>" name="title" type="text" class="form-control border-0 rounded-0 none-shadow button-color" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text title-color border-0 rounded-0">توضيحات</span>
                        <textarea id="content" name="content" rows="5" class=" none-shadow form-control border-0 rounded-0 button-color" aria-label="With textarea"><?php echo $post_edite['body'] ?></textarea>
                    </div>
                    <select name="category" class=" none-shadow cursor-pointer form-select mt-3 border-0 rounded-0 button-color mb-2" aria-label="Default select example">
                        <option selected value="">دسته بندی</option>
                        <?php
                        $sql = "SELECT * FROM `categories`";
                        $categories = $db->query($sql);
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                                $selected = $category['id'] == $post_edite['category_id'] ? "selected" : "";
                                echo <<<HTML
                        <option value="{$category['id']}" $selected >{$category['title']}</option>
HTML;
                            }
                        }
                        ?>
                    </select>
                    <select name="brand" class=" none-shadow cursor-pointer form-select mt-3 border-0 rounded-0 button-color mb-2" aria-label="Default select example">
                        <option selected value="">برند</option>
                        <?php
                        $sql_brand = "SELECT * FROM `brands`";
                        $brands = $db->query($sql_brand);
                        if ($brands->rowCount() > 0) {
                            foreach ($brands as $brand) {
                                $selected = $brand['id'] == $post_edite['brand_id'] ? "selected" : "";
                                echo <<<HTML
                        <option value="{$brand['id']}" $selected >{$brand['title']}</option>
HTML;
                            }
                        }
                        ?>
                    </select>
                    <div class="mb-3">
                        <label for="formFile" class="form-label ">عكس اصلی را انتخاب کنید</label>
                        <?php if($post_edite['image']): ?>
                            <div class="mb-2">
                                <img class="img-fluid" style="max-height: 200px;" src="../upload/posts/<?php echo $post_edite['image'] ?>">
                                <small class="d-block text-muted">عکس فعلی</small>
                            </div>
                        <?php endif; ?>
                        <input name="img" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                    </div>
                    <div class="row mb-3 justify-content-start">
                        <div class=" col-md-6">
                            <div class="">
                                <label for="formFile" class="form-label ">عکس اول</label>
                                <?php if($post_edite['sub_img_1']): ?>
                                    <div class="mb-2">
                                        <img class="img-fluid" style="max-height: 100px;" src="../upload/posts/<?php echo $post_edite['sub_img_1'] ?>">
                                        <small class="d-block text-muted">عکس فعلی</small>
                                    </div>
                                <?php endif; ?>
                                <input name="sub-img-1" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="">
                                <label for="formFile" class="form-label ">عکس دوم</label>
                                <?php if($post_edite['sub_img_2']): ?>
                                    <div class="mb-2">
                                        <img class="img-fluid" style="max-height: 100px;" src="../upload/posts/<?php echo $post_edite['sub_img_2'] ?>">
                                        <small class="d-block text-muted">عکس فعلی</small>
                                    </div>
                                <?php endif; ?>
                                <input name="sub-img-2" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="">
                                <label for="formFile" class="form-label ">عکس سوم</label>
                                <?php if($post_edite['sub_img_3']): ?>
                                    <div class="mb-2">
                                        <img class="img-fluid" style="max-height: 100px;" src="../upload/posts/<?php echo $post_edite['sub_img_3'] ?>">
                                        <small class="d-block text-muted">عکس فعلی</small>
                                    </div>
                                <?php endif; ?>
                                <input name="sub-img-3" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="">
                                <label for="formFile" class="form-label ">عکس چهارم</label>
                                <?php if($post_edite['sub_img_4']): ?>
                                    <div class="mb-2">
                                        <img class="img-fluid" style="max-height: 100px;" src="../upload/posts/<?php echo $post_edite['sub_img_4'] ?>">
                                        <small class="d-block text-muted">عکس فعلی</small>
                                    </div>
                                <?php endif; ?>
                                <input name="sub-img-4" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="">
                                <label for="formFile" class="form-label ">عکس پنجم</label>
                                <?php if($post_edite['sub_img_5']): ?>
                                    <div class="mb-2">
                                        <img class="img-fluid" style="max-height: 100px;" src="../upload/posts/<?php echo $post_edite['sub_img_5'] ?>">
                                        <small class="d-block text-muted">عکس فعلی</small>
                                    </div>
                                <?php endif; ?>
                                <input name="sub-img-5" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3">
                        <h5>ویژگی های محصول</h5>
                        <small>الزامی نیست.</small>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[0]['title'] ?? '' ?>"
                                   name="feature-title-1"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="عنوان ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[0]['body'] ?? '' ?>"
                                   name="feature-body-1"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="مقدار ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[1]['title'] ?? '' ?>"
                                   name="feature-title-2"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="عنوان ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[1]['body'] ?? '' ?>"
                                   name="feature-body-2"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="مقدار ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[2]['title'] ?? '' ?>"
                                   name="feature-title-3"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="عنوان ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[2]['body'] ?? '' ?>"
                                   name="feature-body-3"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="مقدار ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[3]['title'] ?? '' ?>"
                                   name="feature-title-4"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="عنوان ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[3]['body'] ?? '' ?>"
                                   name="feature-body-4"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="مقدار ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[4]['title'] ?? '' ?>"
                                   name="feature-title-5"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="عنوان ویژگی">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input value="<?php echo $features[4]['body'] ?? '' ?>"
                                   name="feature-body-5"
                                   type="text"
                                   class="form-control place-white border-0 rounded-0 none-shadow button-color"
                                   placeholder="مقدار ویژگی">
                        </div>

                    </div>
                    <div class="input-group">
                        <span class="input-group-text title-color border-0 rounded-0">نقد و برسی</span>
                        <textarea id="content" name="review" rows="5" class=" none-shadow form-control border-0 rounded-0 button-color" aria-label="With textarea"><?php echo $post_edite['review'] ?></textarea>
                    </div>
                    <div class="my-3">
                        <label for="formFile" class="form-label ">عکس مربوط به نقد و برسی را انتخاب کنید.</label>
                        <?php if($post_edite['review_img']): ?>
                            <div class="mb-2">
                                <img class="img-fluid" style="max-height: 200px;" src="../upload/posts/<?php echo $post_edite['review_img'] ?>">
                                <small class="d-block text-muted">عکس فعلی</small>
                            </div>
                        <?php endif; ?>
                        <input name="review-img" class="none-shadow form-control border-0 rounded-0 button-color" type="file" id="formFile">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text border-0 rounded-0 button-color">$</span>
                        <input name="price" type="text" class="place-white none-shadow form-control border-0 rounded-0 button-color" value="<?php echo $post_edite['price'] ?>" placeholder="قیمت به ریال" aria-label="قیمت به ریال">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">تعداد</span>
                        <input value="<?php echo $post_edite['quantity'] ?>" name="quantity" type="text" class="form-control border-0 rounded-0 none-shadow button-color" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">محدودیت در هر خرید مشتری</span>
                        <input value="<?php echo $post_edite['limitation'] ?>" name="limitation" type="text" class="form-control border-0 rounded-0 none-shadow button-color" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <button type="submit" name="edite-post" class="btn title-color mb-2">ويرايش</button>
                </form>
            </div>
        </div>
    </div>
<?php
include("lib-admin/footer.php");
?>