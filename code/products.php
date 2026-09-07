<?php
include 'lib/header.php';
?>
    <!-- =========================================
         PRODUCTS SECTION
    ========================================= -->
    <section class="products flex-grow-1 ">
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container mt-5 px-5">
            <div class="row ">
                <!-- لیست محصولات -->
                <div class="col-md-9 col-12 order-2 order-md-1">
                    <div class="row mb-2 g-2" dir="rtl">
                        <?php
                        /*نمایش محصولات*/
                        if(isset($_GET['id'])) {
                            $id = htmlspecialchars($_GET['id']);
                            $per = 12 ;
                            if(isset($_GET['offset'])){
                                $temp = htmlspecialchars($_GET['offset']);
                                $offset = ($temp - 1) * $per; ;
                            }
                            else{
                                $offset = 0;
                            }
                            $sql_posts = "SELECT * FROM posts WHERE category_id = :id ORDER BY id DESC LIMIT $offset,$per";
                            $stmt_posts = $db->prepare($sql_posts);
                            $params = array("id" => $id);
                            $stmt_posts->execute($params);
                            $result_posts = $stmt_posts;
                        }
                            if($result_posts->rowCount() > 0){
                                foreach($result_posts as $row_posts){
                                    $price = number_format($row_posts['price']);
                                    echo <<<HTML
                                    <div class="col-md-3 col-sm-6 col-12  ">
                                        <div class="slider-product  py-2">
                                            <a href="single-product.php?id={$row_posts['id']}" class="slider-product-image">
            
                                                <img
                                                        src="upload/posts/{$row_posts['image']}"
                                                        alt="posts"
                                                >
            
                                            </a>
            
                                            <div class="slider-product-info ">
                                                <a href="single-product.php?id={$row_posts['id']}">
                                                            <span  class="slider-product-name ps-1">
                                                                {$row_posts['title']}
                                                            </span>
            
                                                    <div class="slider-product-price ">
            
                                                        <strong>
                                                            $price
                                                        </strong>
            
                                                        <span>
                                                                    ریال
                                                        </span>
            
                                                    </div>
<!--                                                    <div>
                                                        <del class="mb-2 " style="color: gray; font-size: 10px">32,000,000
                                                            ریال
                                                        </del>
                                                    </div>-->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
HTML;

                                }
                            }
                            else{
                                header("Location: index.php?error= محصولی وجود ندارد.");
                                exit();
                            }

                        ?>
                    </div>
                    <?php
                    if(isset($_GET['id'])) {
                    $sql_posts = "SELECT * FROM posts WHERE category_id = :id";
                    $stmt_posts = $db->prepare($sql_posts);
                    $params = array("id" => $id);
                    $result_posts = $stmt_posts;
                    $stmt_posts->execute($params);
                    if($result_posts->rowCount() > 0){
                        $total_posts = $result_posts->rowCount();
                        $total_pages = ceil($total_posts/$per);
                    ?>
                    <!-- صفحه‌بندی -->
                    <?php
                    $current_page = isset($_GET['offset']) ? $_GET['offset'] : 1;
                    $active_first = ($current_page == 1)? "pagination-active" : "pagination-link";
                    $active_last = ($current_page == $total_pages)? "pagination-active" : "pagination-link";
                        if($total_pages > 1){
                    ?>
                    <div class="pagination-section">
                        <div class="row justify-content-center pt-5">
                            <ul class="pagination justify-content-center align-items-center mb-0">

                                <li class="page-item ">
                                    <a class="page-link <?php echo $active_last; ?>" href="products.php?offset=<?php echo $total_pages ?>&id=<?php echo $id ?>">
                                        <?php
                                        if($total_pages > 1){
                                            echo $total_pages ;
                                        }
                                        ?>
                                    </a>
                                </li>
                            <?php if($total_pages > 2){ ?>
                                <li class="page-item">
                            <span class="pagination-dots">
                                ...
                            </span>

                                </li>
                            <?php } ?>
                                <?php
                                for($i = 2; $i < $total_pages; $i++){
                                    $active = ($current_page == $i) ? "pagination-active" : "pagination-link";
                                    echo <<<HTML
                                <li class="page-item ">
                                    <a class="page-link $active" href="products.php?offset=$i&id=$id">
                                        $i
                                    </a>
                                </li>
HTML;

                                }
                                ?>
                            <?php if($total_pages > 2){ ?>
                                <li class="page-item">
                            <span class="pagination-dots">
                                ...
                            </span>
                                </li>
                            <?php } ?>
                                <li class="page-item ">
                                    <a class="page-link <?php echo $active_first; ?>" href="products.php?offset=1&id=<?php echo $id ?>">
                                        1
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php } }
                    }
                    ?>
                </div>


                <!-- سایدبار فیلترها -->
                <div class="col-md-3 order-1 order-md-2 col-12">
                    <div class="col-12" dir="rtl">
                        <form method="get">
                            <!-- جستجو -->
                            <h3 class="products-title">
                                جستجو
                            </h3>
                            <div class="input-group search-box">

                                <input type="text" class="form-control ps-1 ms-2"
                                  name="search"     placeholder="محصول مورد نظر را جستجو نمایید" dir="rtl">
                                <button class="btn pe-0 me-2" type="submit"><i class="bi bi-search "></i></button>

                            </div>

                            <!-- فیلتر برند -->
                            <div class="py-2 mt-4 mb-2 products-box ">
                                <h3 class="products-title">
                                    برند
                                </h3>
                                <?php
                                $sql_brand_top = "SELECT * FROM `brands` LIMIT 1";
                                $result_brand_top = $db->query($sql_brand_top);
                                if($result_brand_top->rowCount() > 0){
                                $row_brand_top = $result_brand_top->fetch();
                                echo <<<HTML
                                <input class="form-check-input" type="checkbox" value="" id="products-box1">
                                <label class="form-check-label products-lable" for="products-box1">
                                    {$row_brand_top['title']}
                                </label>
HTML;
                                }
                                ?>
                            </div>

                            <!-- فیلتر محدوده قیمت -->
                            <h3 class="products-title">
                                محدوده قیمت
                            </h3>
                            <input type="range" value="0" class="form-range" id="products-range1">
                            <div class="d-flex justify-content-between">
                                <label class="form-check-label products-lable" for="products-box1">
                                    0
                                </label>
                                <label class="form-check-label products-lable" for="products-box1">
                                    120,000,000 ریال
                                </label>
                            </div>

                            <!-- فیلتر دیگر برندها -->
                            <div class="py-2 mt-4 mb-2 products-box border-0">
                                <h3 class="products-title">
                                    دیگر برند ها
                                </h3>
                                <?php
                                $sql_brand = "SELECT * FROM `brands` LIMIT 1,100";
                                $result_brand = $db->query($sql_brand);
                                if($result_brand->rowCount() > 0){
                                    foreach($result_brand as $row_brand){
                                        echo <<<HTML
                                        <input class="form-check-input" type="checkbox" value="" id="products-box2">
                                        <label class="form-check-label products-lable" for="products-box2">
                                            {$row_brand['title']}
                                        </label><br>
HTML;

                                    }
                                }
                                ?>
                            </div>
                            <!--<button type="submit" class="btn btn-outline-danger main-color" style="font-size: 15px">اعمال فیلتر ها</button>-->
                        </form>
                    </div>
                </div>
            </div>

            <!-- توضیحات پایین صفحه -->
            <?php
            echo '
            <div class="row justify-content-start my-5">
                <div class="col-12">
                    <div class="products-explain text-start mb-4" dir="rtl">
              ';
            if(isset($_GET['id'])){
                $sql_catogry = "SELECT * FROM `categories` WHERE `id` = {$_GET['id']} ";
                $result_catogry = $db->query($sql_catogry);
                $row_catogry = $result_catogry->fetch(PDO::FETCH_ASSOC);
                if($row_catogry){
                    echo <<<HTML
                        <p>
                            {$row_catogry['body']}
                        </p>
HTML;
                }
                        }



            echo '
                    </div>
                </div>
            </div>
            ';
?>
            <!-- سوالات متداول -->
            <?php if(isset($_GET['id'])) { ?>
            <div class="row justify-content-start " dir="rtl">
                <div class="row justify-content-start mb-2">
                    <div class="col-auto">
                        <div class="products-explain">
                            <i class="bi bi-question-circle-fill"></i>
                            <h4 class="text-start d-inline-block">
                                سوالات متداول
                            </h4>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="list-group ">
                        <?php
                        $sql_qs = "SELECT * FROM `q&a` WHERE status = 1 ORDER BY `id` DESC LIMIT 5";
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
            </div>
            <?php } ?>
        </div>
    </section>
<?php
include 'lib/footer.php';
?>