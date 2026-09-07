<?php
include 'lib/header.php';
?>
<?php
/*محصول اصلي*/
$id = htmlspecialchars($_GET['id']);
$sql_post = "SELECT * FROM posts WHERE id = :id ";
$stmt_post = $db->prepare($sql_post);
$params = array("id" => $id);
$stmt_post->execute($params);
$post = $stmt_post->fetch();
/*بسته پيشنهادي*/
$category_check = $post['category_id'];
$brand_check = $post['brand_id'];
$sql_post_recommended = "SELECT * FROM posts WHERE category_id = $category_check AND id != $id LIMIT 1";
$rs_post_recommended = $db->query($sql_post_recommended);
$suggested_products = $rs_post_recommended->fetch(PDO::FETCH_ASSOC);
/*گارانتی های*/
$sql_guaranty = "SELECT * FROM guaranty";
$guaranty = $db->query($sql_guaranty);
/*مسیر پست*/
$categories = "SELECT * FROM categories WHERE id = $category_check LIMIT 1";
$category = $db->query($categories);
$category_item = $category->fetch(PDO::FETCH_ASSOC);
$brands = "SELECT * FROM brands WHERE id = $brand_check LIMIT 1";
$brand = $db->query($brands);
$brand_item = $brand->fetch(PDO::FETCH_ASSOC);
/*پيام ثبت */
if (isset($_GET['mas'])) {
    $mas = htmlspecialchars($_GET['mas']);
    echo <<<HTML
    <script>alert("$mas")</script>
HTML;

}
?>
    <!-- =========================================
         SINGLE PRODUCT SECTION
    ========================================= -->
    <section class="single-product flex-grow-1 " >
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container mt-3 px-5  ">
            <!-- مسیر راهنما (Breadcrumb) -->
            <div class="row justify-content-end  mx-1  py-2 border-lig" >
                <div class="col-auto  single-product-track" dir="rtl">
                    <span>خانه</span>
                    <span>/</span>
                    <span><?php echo $category_item['title'] ?></span>
                    <span>/</span>
                    <span><?php echo $brand_item['title'] ?></span>
                    <span>/</span>
                    <span class="single-product-track-here"><?php echo $post['title'] ?></span>
                </div>
            </div>

            <div class="row mx-1  justify-content-end py-3 g-3 ">
                <!-- گالری تصاویر -->
                <div class="col-md-3 order-md-2 ps-md-0">
                    <!-- تصویر اصلی -->
                    <button class="single-product-gallery border-lig mb-3 " type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal0">
                        <img
                                class=""
                                src="upload/posts/<?php echo $post['image']; ?>"
                                alt="product">
                    </button>
                    <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img
                                            class="img-fluid"
                                            src="upload/posts/<?php echo $post['image']; ?>"
                                            alt="product">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تصاویر کوچک -->
                    <div class="row g-1 justify-content-end">
                        <button class="col border-lig single-product-gallery-sub" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <img
                                    class=""
                                    src="upload/posts/<?php echo $post['sub_img_1']; ?>"
                                    alt="product">
                        </button>
                        <button class="col border-lig single-product-gallery-sub" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <img
                                    class=""
                                    src="upload/posts/<?php echo $post['sub_img_2']; ?>"
                                    alt="product">
                        </button>
                        <button class="col border-lig single-product-gallery-sub" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            <img
                                    class=""
                                    src="upload/posts/<?php echo $post['sub_img_3']; ?>"
                                    alt="product">
                        </button>
                        <button class="col border-lig single-product-gallery-sub" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal4">
                            <img
                                    class=""
                                    src="upload/posts/<?php echo $post['sub_img_4']; ?>"
                                    alt="product">
                        </button>
                        <button class="col border-lig single-product-gallery-sub" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal5">
                            <img
                                    class=""
                                    src="upload/posts/<?php echo $post['sub_img_5']; ?>"
                                    alt="product">
                        </button>

                        <!-- مودال‌های تصاویر -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img
                                                class="img-fluid"
                                                src="upload/posts/<?php echo $post['sub_img_1']; ?>"
                                                alt="product">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img
                                                class="img-fluid"
                                                src="upload/posts/<?php echo $post['sub_img_2']; ?>"
                                                alt="product">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img
                                                class="img-fluid"
                                                src="upload/posts/<?php echo $post['sub_img_3']; ?>"
                                                alt="product">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img
                                                class="img-fluid"
                                                src="upload/posts/<?php echo $post['sub_img_4']; ?>"
                                                alt="product">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img
                                                class="img-fluid"
                                                src="upload/posts/<?php echo $post['sub_img_5']; ?>"
                                                alt="product">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- اطلاعات محصول -->
                <div class="col-md-7 order-md-1" dir="rtl">
                    <div class="col-12 py-1 ps-2  single-product-content">
                        <span class=""><?php echo $post['title']; ?> </span>
                    </div>
                    <div class="col-12  mt-2 ps-2 pt-2 border-lig">
                        <div class="w-100" style="height: 200px !important;">
                            <p class="main-color mb-0 mb-md-3 "> <?php echo $price = number_format($post['price']); ?> ریال</p>
                            <form action="cart.php" method="post" class="single-product-form">
                                <div class="row ">
                                    <div class="col-12 ">
                                        <?php
                                        if ($guaranty -> rowCount() > 0) {
                                            echo '
                                            <label class="form-label light-text w-25 pe-2" style="display: inline !important;">گارانتی :</label>
                                            <select class="form-select  w-75 " name="guaranty" aria-label="Default select example" style="display: inline !important;">

                                            ';
                                            foreach ($guaranty as $guaranty_item) {
                                                echo <<<HTML
                                                <option value="{$guaranty_item['title']}">{$guaranty_item['title']}</option >

HTML;
                                            }
                                            echo '</select>';
                                        }
                                        ?>
                                        <div class="single-product-box d-inline-block  ms-2 mt-1 mt-md-1">
                                            <label class="form-check-label products-lable" for="products-box1">
                                                بیمه :
                                            </label>
                                            <input class="form-check-input " name="Insurance" type="checkbox" value="1" id="products-box1">
                                        </div>
                                    </div>
                                </div>
                                <!-- دکمه افزودن به سبد خرید -->
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <input type="hidden" name="post_price" value="<?php echo $post['price']; ?>">
                                <input type="hidden" name="post_title" value="<?php echo $post['title']; ?>">
                                <input type="hidden" name="post_image" value="<?php echo $post['image']; ?>">
                                <input type="hidden" name="post_limitation" value="<?php echo $post['limitation']; ?>">
                                <input type="hidden" name="post_count" value="<?php echo $post['quantity']; ?>">
                                <div class="col-12 mt-3 mb-md-2 mb-1 ms-0  ">
                                    <?PHP
                                    $quantity = $post['quantity'];
                                    if ($quantity < 1) {
                                        echo '
                                        <button class="single-product-button btn pe-none  text-white" style="background-color: gray !important;">
                                        <i class="bi bi-cart3 fw-bold"></i>
                                        افزودن به سبد خرید</button>
                                         ';
                                    }
                                    else{
                                        echo '
                                        <button type="submit" name="add-cart" class="single-product-button btn  text-white ">
                                        <i class="bi bi-cart3 fw-bold"></i>
                                        افزودن به سبد خرید</button>
                                         ';
                                    }
                                    ?>
                                </div>
                                <!-- وضعیت ارسال -->
                                <div class="btn single-product-more pe-none mb-2 py-1 border-lig ">
                                    <?PHP
                                     $quantity = $post['quantity'];
                                     if ($quantity < 1) {
                                         echo '
                                             <i class="bi bi-box-seam"></i>
                                             <span>موجود نيست</span>
                                         ';
                                     }
                                     else{
                                         echo '
                                            <i class="bi bi-truck"></i>
                                            <span>آماده ارسال</span>
                                         ';
                                     }
                                    ?>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- دکمه‌های علاقه‌مندی و مقایسه -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="row g-0  py-2  justify-content-start border-lig" style="margin-top:12px ">
                                <div class="col-auto me-1 ms-2">
                                    <div class="single-product-more-1 py-1 px-2 border-lig">
                                        <i class="bi bi-heart"></i>
                                        <span>افزودن به لیست علاقه مندی ها</span>
                                    </div>
                                </div>
                                <div class="col-auto ">
                                    <div class="single-product-more-1 py-1 px-2 border-lig">
                                        <i class="bi-sliders"></i>
                                        <span>مقایسه محصول</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- بسته پیشنهادی -->
                <div class="col-md-2 main-dark-bg-cover text-center">
                    <?php
                    if($suggested_products){
                        $sql_sub_features = "SELECT * FROM `post_features` WHERE post_id = {$suggested_products['id']}";
                        $sub_features = $db->query($sql_sub_features);

                        $price_rec = number_format($suggested_products['price']);
                        echo <<<HTML
                    <div class="single-product-recommended-img pt-2">
                        <a href="single-product.php?id={$suggested_products['id']}" class="text-white">
                            <img src="upload/posts/{$suggested_products['image']}"
                                 alt="product">
                        </a>
                    </div>
                    <div class="single-product-recommended-content pt-2 " dir="rtl">
                        <p class="text-white pb-0 mb-0">
                            <a href="single-product.php?id={$suggested_products['id']}" class="text-white">
                                بسته پیشنهادی
                            </a>
                        </p>
                        <a href="single-product.php?id={$suggested_products['id']}">
                            <span class="text-white mt-1">{$suggested_products['title']} </span>
                        </a>
                        <div class="text-start mt-2 single-product-recommended-feature ps-1">
HTML;
                        foreach ($sub_features as $sub_feature) {
                            echo <<<HTML
                            <a href="single-product.php?id={$suggested_products['id']}">
                                <p class=" text-white mb-2">+  {$sub_feature['body']} </p>
                            </a>
HTML;
                        }
                        echo <<<HTML
                        </div>
                        <p class="text-white mb-0 pt-3">
                            <a href="single-product.php?id={$suggested_products['id']}" class="text-white">
                                $price_rec ریال 
                            </a>
                        </p>
                    </div>
HTML;

                    }else{
                        echo <<<HTML
                    <div class="single-product-recommended-content pt-2 mb-2 " dir="rtl">
                        <p class="text-white pb-0 mb-0">
                            بسته پيشنهادی موجود نيست.
                        </p>
                    </div>
HTML;

                    }
                    ?>

                </div>


            </div>

            <!-- ویژگی‌های محصول -->
            <div class="row g-2 justify-content-around mx-1  py-2 border-lig" dir="rtl" >
                <div class="col-md-auto  single-product-more-2">
                    <i class="bi bi-truck"></i>
                    <span>ارسال اکسپرس</span>
                </div>
                <div class="col-md-auto  single-product-more-2">
                    <i class="bi bi-check2-square"></i>
                    <span>ضمانت اصل بودن کالا</span>
                </div>
                <div class="col-md-auto  single-product-more-2">
                    <i class="bi bi-send"></i>
                    <span>ارسال به سراسر ایران</span>
                </div>
                <div class="col-md-auto  single-product-more-2">
                    <i class="bi bi-arrow-return-left"></i>
                    <span>مرجوعی در صورت نقص فنی کالا</span>
                </div>
                <div class="col-md-auto  single-product-more-2">
                    <i class="bi bi-gift"></i>
                    <span>بسته بندی زیبا</span>
                </div>
            </div>

            <!-- تب‌های محصول -->
            <div class="row justify-content-end my-2 mx-1  py-3 px-2 "  dir="rtl">
                <ul class="nav nav-tabs" id="productTab" role="tablist" style="background-color: var(--border-color)">
                    <?php
                    $sql_features = "SELECT * FROM post_features WHERE post_id = $id";
                    $stmt_features = $db->query($sql_features);
                    if ($stmt_features->rowCount() > 0) {
                        echo '
                            <li class="nav-item single-product-nav" role="presentation">
                                <button class="nav-link active" id="features-tab" data-bs-toggle="tab"
                                        data-bs-target="#features" type="button" role="tab"  >
                                    مشخصات
                                </button>
                            </li>';
                    }
                    ?>

                    <li class="nav-item single-product-nav" role="presentation">
                        <button class="nav-link" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab">
                            نقد و برسی
                        </button>
                    </li>
                    <li class="nav-item single-product-nav" role="presentation">
                        <button class="nav-link" id="qa-tab" data-bs-toggle="tab"
                                data-bs-target="#qa" type="button" role="tab">
                            پرسش و پاسخ
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="productTabContent">
                    <!-- تب مشخصات -->
                    <div class="tab-pane fade show active" id="features" role="tabpanel">
                        <?php
                        foreach ($stmt_features as $feature) {
                            echo <<<HTML
                        <div class="row mt-2">
                            <div class="col-3 py-2  single-product-content">
                                <span class=""> {$feature['title']} </span>
                            </div>
                            <div class="col-9 py-2 ">
                            <span style="font-size: 14px">
                        {$feature['body']}
                            </span>
                            </div>
                        </div>
HTML;

                        }
                        ?>
                    </div>

                    <!-- تب نقد و بررسی -->
                    <div class="tab-pane mt-3 fade" id="description" role="tabpanel">
                        <div class="row mt-2 justify-content-center">
                            <div class="col-md-9 col-12 text-center ">
                                <div class="single-weblog-content w-100" dir="rtl">
                                    <div class="single-weblog-image w-100 mb-md-3">
                                        <img src="upload/posts/<?php echo $post['review_img']?>" class="" alt="product">
                                    </div>
                                    <p>
                                        <?php echo $post['review']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تب پرسش و پاسخ -->
                    <div class="tab-pane mt-3 fade" id="qa" role="tabpanel">
                        <div class="row mt-2 justify-content-start" dir="rtl">
                            <div class="row justify-content-start mb-2">
                                <div class="col-auto">
                                    <div class="products-explain">
                                        <i class="bi bi-question-circle-fill"></i>
                                        <h4 class="text-start d-inline-block">
                                            پرسش و پاسخ
                                        </h4>
                                    </div>

                                </div>
                            </div>
                            <div class="row" dir="rtl">
                                <div class="col-md-9 col-12">
                                    <ul class="list-group ">
                                        <?php
                                        $sql_qs = "SELECT * FROM `q&a` WHERE status = 1 AND post_id = $id";
                                        $result_qs = $db->query($sql_qs);
                                        if($result_qs->rowCount() > 0){
                                            foreach($result_qs as $row_qs){
                                                echo <<<HTML
                                                <li class="list-group-item border-0 mt-2"><i class="bi bi-chevron-down small"></i> 
                                                {$row_qs['question']}
                                                </li>
                                                <li class="list-group-item border-0 ">
                                                   <small>{$row_qs['answer']}</small>
                                                </li>
HTML;
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <!-- فرم سوال -->
                                <div class="col-md-9 col-12 text-center  mb-5 mt-3">
                                    <div class="contact-form text-start w-100">

                                        <h3 class="contact-title">
                                            سوال شما
                                        </h3>
                                        <?php
                                        if(isset($_POST['add-question'])){
                                            if(trim($_POST['name']) != "" && trim($_POST['comment']) != ""){
                                                $name = htmlspecialchars(truncateText(trim($_POST['name'])),100);
                                                $comment = htmlspecialchars(truncateText(trim($_POST['comment']),2000));
                                                $sql_qs = "INSERT INTO `q&a` (`post_id`,`name`, `question`) VALUES ( {$_GET['id']},:name, :comment)";
                                                $stmt_qs = $db->prepare($sql_qs);
                                                $params = ['name' => $name, 'comment' => $comment];
                                                $stmt_qs->execute($params);
                                                header("location:single-product.php?id={$id}&mas=" . 'با موفقیت ثبت شد.');
                                                exit();
                                            }
                                        }
                                        ?>
                                        <form action="#" method="post">

                                            <div class="row g-2 mb-2">

                                                <div class="col-12 col-sm-12 order-1 order-md-1">

                                                    <input
                                                            type="text"
                                                            name="name"
                                                            class="form-control"
                                                            placeholder=" نام  "
                                                            maxlength="100"
                                                            required
                                                    >

                                                </div>

                                            </div>

                                            <div class="mb-2">

                                            <textarea
                                                    name="comment"
                                                    class="form-control contact-textarea"
                                                    placeholder="سوال شما"
                                                    maxlength="2000"
                                                    required
                                            ></textarea>

                                            </div>

                                            <button
                                                    type="submit"
                                                    class="btn main-btn contact-submit"
                                                    name="add-question"
                                            >
                                                ارسال
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php
include 'lib/footer.php';
?>