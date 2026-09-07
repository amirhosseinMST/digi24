<?php
include 'lib/header.php';
?>
<?php
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo <<<HTML
    <script>alert("$error")</script>
HTML;
}
?>
    <!-- =========================================
        HERO SECTION
    =========================================  -->
    <section class="hero-section pb-0 pb-md-5">
        <div class="container-xxl">
            <div class="row justify-content-center">
                <div id="heroSlider" class="carousel slide px-md-5" data-bs-ride="carousel" dir="rtl">
                    <?php
                    $sql_slider = "SELECT * FROM slider ORDER BY id DESC ";
                    $stmt_slider = $db->query($sql_slider);
                    if ($stmt_slider->rowCount() > 0) {
                        echo'                    
                    <div class="carousel-inner">';
                        foreach ($stmt_slider as $slider) {
                            $active = ($slider['active'] == 1) ? "active" : "";
                            echo <<<HTML
                        <div class="carousel-item $active position-relative">
                            <img src="upload/slider/{$slider['image']}" class="d-block hero-image"
                                 alt="slider">
                            <div class="hero-content d-flex align-items-center justify-content-center px-md-5">
                                <h1>
                                  {$slider['body']}
                                </h1>
                            </div>
                        </div>
HTML;

                        }
                        echo '</div>';
                        ?>
                        <!-- دکمه‌های کنترلی اسلایدر -->
                        <div class="hero-controls-wrapper">
                            <button class="carousel-control-prev hero-control hero-control-prev" type="button"
                                    data-bs-target="#heroSlider" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">قبلی</span>
                            </button>

                            <button class="carousel-control-next hero-control hero-control-next" type="button"
                                    data-bs-target="#heroSlider" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">بعدی</span>
                            </button>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="carousel-indicators hero-indicators">
                        <?php
                        $temp = 0 ;
                        $sql_slider_truk = "SELECT * FROM slider ORDER BY id DESC";
                        $stmt_slider_truk = $db->query($sql_slider_truk);
                        if ($stmt_slider_truk->rowCount() > 0) {
                            foreach ($stmt_slider_truk as $slider_truk) {
                                $active = ($slider_truk['active'] == 1) ? "active" : "";
                                echo <<<HTML
                        <!-- نشانگرهای اسلایدر -->
                            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{$temp}" class="{$active}"></button>
    HTML;
                                $temp = $temp + 1;
                            }
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =========================================
      ABOUT SECTION
   =========================================  -->
    <section class="about-section py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-12 col-md-10 col-lg-9 text-center" >

                    <!-- عنوان درباره ما -->
                    <h2 class="section-title mb-3 ">
                        <span>Digi</span><span class="main-color">24</span> کوتاه از
                    </h2>

                    <!-- متن درباره ما -->
                    <p class="about-text text-center" dir="rtl">
                <?php
                $sql_contact = "SELECT * FROM about ORDER BY id DESC ";
                $stmt_contact = $db->query($sql_contact);
                if ($stmt_contact->rowCount() > 0) {
                    $contact = $stmt_contact->fetch();
                    echo <<<HTML
                    {$contact['body']}
HTML;
                }
                ?>
                    </p>

                </div>

            </div>

        </div>

    </section>
    <!-- =========================================
      FEATURES SECTION
   =========================================  -->
    <section class="features-section pb-5">

        <div class="container">

            <div class="row g-4 text-center justify-content-center">
                <?php
                $sql_features = "SELECT * FROM features ORDER BY id DESC ";
                $stmt_features = $db->query($sql_features);
                if ($stmt_features->rowCount() > 0) {
                    foreach ($stmt_features as $feature) {
                        echo <<<HTML
                <div class="col-12 col-md-auto">

                    <h3 class="feature-title">
                        {$feature['title']}
                    </h3>

                    <p class="feature-text mx-auto">
                        {$feature['body']}
                    </p>

                </div>
HTML;
                    }
                }
                ?>
            </div>

        </div>

    </section>
    <!-- =========================================
        CATEGORIES SECTION
    ========================================= -->

    <section class="categories-section pb-5">

        <div class="container">

            <!-- عنوان -->
            <div class="text-center m-0 p-0 mb-3">

                <h2 class="section-title pb-0 mb-5">
                    گالری محصولات
                </h2>

            </div>

            <!-- دسته بندی ها -->
            <div class="row g-4 justify-content-center">
                <?php
                $sql_categories = "SELECT * FROM categories ";
                $stmt_categories = $db->query($sql_categories);
                if ($stmt_categories->rowCount() > 0) {
                    foreach ($stmt_categories as $category) {
                        echo <<<HTML
                <div class="col-6 col-md-4 ">

                    <a href="products.php?id={$category['id']}" class="category-item d-block text-center px-2">

                        <div class="category-image ">

                            <img
                                    src="upload/categories/{$category['img']}"
                                    class="img-fluid "
                                    alt="انواع دوربین عکاسی"
                            >
                            <span class="category-more">
                            <i class="bi bi-eye px-2 pt-2 pb-1"></i>
                        </span>

                        </div>

                        <h3 class="category-title">
                            {$category['title']}
                        </h3>

                    </a>

                </div>
HTML;

                    }
                }
                ?>
            </div>

        </div>

    </section>

    <!-- =========================================
         LATEST PRODUCTS SECTION
    ========================================= -->

    <section class="latest-products-section pt-5">

        <div class="container">

            <!-- عنوان  -->
            <div class=" text-center mb-4">

                <h2 class="section-title">
                    برخی از جدیدترین محصولات
                </h2>

            </div>
            <?php
            $sql_categories_title = "SELECT * FROM categories ORDER BY id DESC LIMIT 3";
            $stmt_categories_title = $db->query($sql_categories_title);
            $categories = $stmt_categories_title->fetchAll();
            if ($stmt_categories_title->rowCount() > 0) {
                foreach ($categories as $category) {
                    $category_id = $category['id'];
                    $category_title = $category['title'];
                    ?>
                    <div class="product-slider-box mb-4">

                        <!-- عنوان + کنترل های بالایی -->
                        <div class="product-slider-header row mx-md-5 mx-4 my-3 ">

                            <div class="product-slider-controls col-auto ">

                                <button
                                        type="button"
                                        class="slider-square-btn"
                                        data-bs-target="#productSlider1"
                                        data-bs-slide="next"
                                >
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button
                                        type="button"
                                        class="slider-square-btn"
                                        data-bs-target="#productSlider1"
                                        data-bs-slide="prev"
                                >
                                    <i class="bi bi-chevron-right"></i>
                                </button>

                            </div>

                            <h3 class="product-slider-title col-auto ms-4 mt-2">
                                <?php echo $category_title; ?>
                            </h3>

                        </div>

                        <!-- Carousel -->
                        <div id="productSlider1" class="carousel slide product-carousel " data-bs-interval="false">

                            <div class="carousel-inner " dir="rtl">

                                <!-- اسلاید اول -->
                                <div class="carousel-item active ">
                                    <div class="container ">
                                        <div class="row product-slider-row g-3  ps-5 justify-content-center">
                                            <?php
                                            $sql_products = "SELECT * FROM posts WHERE category_id = '$category_id' ORDER BY id DESC LIMIT 0,5";
                                            $stmt_products = $db->query($sql_products);
                                            if ($stmt_products->rowCount() > 0) {
                                                foreach ($stmt_products as $product) {
                                                    $price = number_format($product['price']);
                                                    $product_id = $product['id'];
                                                    $product_title = $product['title'];
                                                    $product_image = $product['image'];
                                                    ?>
                                                    <div class="slider-product col-md-2 col-sm-5 col-10 px-0  py-2">
                                                        <!-- ریبون -->
                                                        <!--                                <div class="product-ribbon">
                                                                                            <i class="bi bi-star-fill"></i>
                                                                                        </div>-->

                                                        <a href="single-product.php?id=<?php echo $product_id; ?>" class="slider-product-image">

                                                            <img
                                                                    src="upload/posts/<?php echo $product_image; ?>"
                                                                    alt="posts"
                                                            >

                                                        </a>

                                                        <div class="slider-product-info ">
                                                            <a href="single-product.php?id=<?php echo $product_id; ?>">
                                                            <span href="weblogs.php " class="slider-product-name ps-1">
                                                                <?php echo $product_title; ?>
                                                            </span>

                                                                <div class="slider-product-price ">

                                                                    <strong>
                                                                        <?php echo $price; ?>
                                                                    </strong>

                                                                    <span>
                                                                    ريال
                                                                    </span>

                                                                </div>
<!--                                                                <div>
                                                                    <del class="mb-2 " style="color: gray; font-size: 10px">32,000,000
                                                                        تومان
                                                                    </del>
                                                                </div>-->
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- اسلاید دوم -->
                                <?php
                                $sql_products = "SELECT * FROM posts WHERE category_id = '$category_id' ORDER BY id DESC LIMIT 5,5";
                                $stmt_products = $db->query($sql_products);
                                if ($stmt_products->rowCount() > 0) {
                                ?>
                                <div class="carousel-item  ">
                                    <div class="container ">
                                        <div class="row product-slider-row g-3  ps-5 justify-content-center">

                                            <?php
                                                foreach ($stmt_products as $product) {
                                                    $price = number_format($product['price']);
                                                    $product_id = $product['id'];
                                                    $product_title = $product['title'];
                                                    $product_image = $product['image'];
                                                    ?>
                                                    <div class="slider-product col-md-2 col-sm-5 col-10 px-0  py-2">
                                                        <!-- ریبون -->
                                                        <!--                                <div class="product-ribbon">
                                                                                            <i class="bi bi-star-fill"></i>
                                                                                        </div>-->

                                                        <a href="single-product.php?id=<?php echo $product_id; ?>" class="slider-product-image">

                                                            <img
                                                                    src="upload/posts/<?php echo $product_image; ?>"
                                                                    alt="posts"
                                                            >

                                                        </a>

                                                        <div class="slider-product-info ">
                                                            <a href="single-product.php?id=<?php echo $product_id; ?>">
                                                            <span href="weblogs.php " class="slider-product-name">
                                                                <?php echo $product_title; ?>
                                                            </span>

                                                                <div class="slider-product-price ">

                                                                    <strong>
                                                                        <?php echo $price; ?>
                                                                    </strong>

                                                                    <span>
                                                                    ريال
                                                                </span>

                                                                </div>
                                                                <div>
                                                                    <del class="mb-2 " style="color: gray; font-size: 10px">32,000,000
                                                                        تومان
                                                                    </del>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            </div>

                        </div>

                        <!-- مشاهده سایر محصولات -->
                        <div class="product-more-wrapper me-3 my-3">

                            <a href="products.php?id=<?php echo $category_id; ?>" class="product-more-btn px-2 py-1">
                                <i class="bi bi-chevron-left"></i>
                                مشاهده سایر محصولات
                            </a>

                        </div>

                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </section>
    <!-- =========================================
         LATEST ARTICLES
    ========================================= -->
    <?php
    $sql_weblog = "SELECT * FROM weblog ORDER BY id DESC LIMIT 3";
    $stmt_weblog = $db->query($sql_weblog);
    $weblog = $stmt_weblog->fetchAll();
    if($stmt_weblog ->rowCount() > 2){
    ?>
    <section class="latest-section main-dark-bg my-5">

        <div class="container   py-5">

            <!-- عنوان بخش -->
            <div class="text-center mb-4">

                <h2 class="latest-title">
                    تازه‌های دنیای عکاسی و فیلمبرداری
                </h2>

                <p class="latest-description">
                    جدیدترین مطالب، آموزش‌ها و اخبار دنیای عکاسی و فیلمبرداری
                </p>

            </div>

            <!-- مطالب -->
            <div class="row g-3">
                <?php

                    echo <<<HTML
                <!-- مطلب بزرگ -->
                <div class="col-12 col-md-7">
                    <a href="single-weblog.php?id={$weblog[0]['id']}" class="latest-post latest-post-large d-block">

                        <img
                                src="upload/weblog/{$weblog[0]['img_header']}"
                                class="img-fluid w-100 py-1"
                                alt="weblog"
                        >

                        <div class="latest-post-overlay">

                            <h3>
                                 {$weblog[0]['title']}
                            </h3>

                            <span>
                                ادامه مطلب
                                <i class="bi bi-arrow-left"></i>
                            </span>

                        </div>

                    </a>

                </div>

                <!-- دو مطلب کوچک -->
                <div class="col-12 col-md-5">

                    <div class="row g-3">

                        <!-- مطلب کوچک اول -->
                        <div class="col-12">

                            <a href="single-weblog.php?id={$weblog[1]['id']}" class="latest-post latest-post-small d-block">

                                <img
                                        src="upload/weblog/{$weblog[1]['img_header']}"
                                        class="img-fluid w-100 py-1"
                                        alt="آموزش عکاسی"
                                >

                                <div class="latest-post-overlay">

                                    <h3>
                                        {$weblog[1]['title']}
                                    </h3>

                                    <span>
                                    ادامه مطلب
                                    <i class="bi bi-arrow-left"></i>
                                </span>

                                </div>

                            </a>

                        </div>

                        <!-- مطلب کوچک دوم -->
                   <div class="col-12">

                            <a href="single-weblog.php?id={$weblog[2]['id']}" class="latest-post latest-post-small d-block">

                                <img
                                        src="upload/weblog/{$weblog[2]['img_header']}"
                                        class="img-fluid w-100 py-1"
                                        alt="آموزش عکاسی"
                                >

                                <div class="latest-post-overlay">

                                    <h3>
                                        {$weblog[2]['title']}
                                    </h3>

                                    <span>
                                    ادامه مطلب
                                    <i class="bi bi-arrow-left"></i>
                                </span>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>
HTML;
                ?>
            </div>

        </div>

    </section>
        <?php }?>
    <!-- =========================================
          TESTIMONIALS SECTION
    ========================================= -->

    <section class="testimonials-section my-4">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-12 col-lg-9">
                <?php
                $sql_comment = "SELECT * FROM comments ORDER BY id DESC ";
                $stmt_comment = $db->query($sql_comment);
                if($stmt_comment ->rowCount() > 0){
                ?>
                    <div
                            id="testimonialSlider"
                            class="carousel slide"
                            data-bs-ride="carousel"
                    >

                        <div class="carousel-inner">
                            <?php
                            $counter = 0;
                            foreach($stmt_comment as $comment){
                                if($counter == 0){
                                    $active = "active";
                                }
                                else{
                                    $active = "";
                                }
                                ?>
                            <div class="carousel-item <?php echo $active ?>">

                                <div class="testimonial text-center">

                                    <!-- عنوان -->
                                    <div class="section-heading mb-3">

                                        <h2 class="section-title">
                                            <span>Digi</span><span class="main-color">24</span>
                                            نظرات شما عزیزان در رابطه با تجربه خرید از

                                        </h2>

                                    </div>

                                    <!-- تصویر مشتریان -->
                                    <!--                                    <div class="testimonial-avatar">
                                                                            <img
                                                                                    src="upload/categories/1.webp"
                                                                                    class="img-fluid"
                                                                                    alt="مشتری"
                                                                            >
                                                                        </div>-->

                                    <!-- خط زیر تصویر -->
                                    <div class="testimonial-line mb-4"></div>

                                    <!-- متن -->
                                    <p class="testimonial-text" dir="rtl">

                                    <?php
                                    $comm = $comment['comment'];
                                    echo $comm;
                                    ?>
                                    </p>

                                    <!-- امتیاز -->
                                    <!--                                    <div class="testimonial-rating">

                                                                            <i class="bi bi-star-fill"></i>
                                                                            <i class="bi bi-star-fill"></i>
                                                                            <i class="bi bi-star-fill"></i>
                                                                            <i class="bi bi-star-fill"></i>
                                                                            <i class="bi bi-star-fill"></i>

                                                                        </div>-->

                                    <!-- نام -->
                                    <h3 class="testimonial-name">
                                        <?php echo $comment['name']; ?>
                                    </h3>

                                </div>

                            </div>
                            <?php
                            $counter++;}
                            ?>
                            <!-- دکمه قبلی -->
                            <button
                                    class="carousel-control-prev testimonial-control"
                                    type="button"
                                    data-bs-target="#testimonialSlider"
                                    data-bs-slide="prev"
                            >

                                <i class="bi bi-chevron-right"></i>

                                <span class="visually-hidden">
                            قبلی
                        </span>

                            </button>

                            <!-- دکمه بعدی -->
                            <button
                                    class="carousel-control-next testimonial-control"
                                    type="button"
                                    data-bs-target="#testimonialSlider"
                                    data-bs-slide="next"
                            >

                                <i class="bi bi-chevron-left"></i>

                                <span class="visually-hidden">
                            بعدی
                        </span>

                            </button>

                        </div>
                <?php

                    }?>
                </div>

            </div>

        </div>

    </section>
    <!-- =========================================
         BRANDS
    ========================================= -->

    <section class="brands-section py-4 py-md-5">

        <div class="container">

            <div class="text-center mb-4">
                <h2 class="section-title">
                    برندهایی که ما با آن‌ها کار می‌کنیم
                </h2>

            </div>

            <div class="row justify-content-center align-items-center g-3 g-md-4">
                <?php
                $sql_brands = "SELECT * FROM brands ORDER BY id DESC ";
                $stmt_brands = $db->query($sql_brands);
                if($stmt_brands ->rowCount() > 0){
                    foreach($stmt_brands as $brand) {
                        echo <<<HTML
                <div class="col-4 col-md-2 ">

                    <div class="brand-logo text-center">

                        <img
                                src="upload/brands/{$brand['img']}"
                                class=""
                                alt="brand"
                        >

                    </div>

                </div>
HTML;
                    }

                }
                ?>

            </div>

        </div>

    </section>
<?php
include 'lib/footer.php';
?>