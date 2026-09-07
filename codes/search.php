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
        <div class="container mt-5  px-5">
            <div class="row justify-content-center">
                <div class="row  justify-content-center mb-5">
                    <div class="col-auto">
                        <h4 class="main-color-bg d-inline p-2 rounded-3 text-white">محصولات</h4>
                    </div>
                </div>
                <!-- لیست محصولات -->
                <div class="col-md-9 col-12 order-2 order-md-1">
                    <div class="row mb-2 g-2" dir="rtl">
                        <?php
                        /*نمایش محصولات*/
                        if(isset($_GET['search'])) {
                            $search = htmlspecialchars($_GET['search']);
                            $per = 12 ;
                            $current_page = 1;
                            if(isset($_GET['offset'])){
                                $current_page = htmlspecialchars($_GET['offset']);
                                $offset = ($current_page - 1) * $per;
                            }
                            else{
                                $offset = 0;
                            }

                            $sql_posts = "SELECT * FROM posts WHERE title REGEXP :search ORDER BY id DESC LIMIT $offset,$per";
                            $stmt_posts = $db->prepare($sql_posts);
                            $param = ["search" => "[[:<:]]{$search}[[:>:]]"];
                            $stmt_posts->execute($param);
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
                                                            <span  class="slider-product-name">
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
                                                    <div>
                                                        <del class="mb-2 " style="color: gray; font-size: 10px">32,000,000
                                                            ریال
                                                        </del>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
HTML;
                            }
                        }
                        ?>
                    </div>
                    <?php
                    /*صفحه بندی*/
                    $per = 12;

                    $sql_posts_count = "SELECT * FROM posts WHERE title REGEXP :search";
                    $stmt_posts_count = $db->prepare($sql_posts_count);
                    $param_count = ["search" => "[[:<:]]{$search}[[:>:]]"];
                    $stmt_posts_count->execute($param_count);
                    $result_posts_count = $stmt_posts_count;

                    if($result_posts_count->rowCount() > 0){
                        $total_posts = $result_posts_count->rowCount();
                        $total_pages = ceil($total_posts / $per);

                        if($total_pages > 1){
                            ?>
                            <div class="pagination-section">
                                <div class="row justify-content-center pt-5">
                                    <ul class="pagination justify-content-center align-items-center mb-0">
                                        <li class="page-item ">
                                            <a class="page-link <?php echo ($current_page == $total_pages) ? "pagination-active" : "pagination-link"; ?>" href="search.php?search=<?php echo $search ?>&offset=<?php echo $total_pages ?>">
                                                <?php echo $total_pages; ?>
                                            </a>
                                        </li>
                                        <?php if($total_pages > 2){ ?>
                                            <li class="page-item">
                                                <span class="pagination-dots">...</span>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        for($i = 2; $i < $total_pages; $i++){
                                            $active = ($current_page == $i) ? "pagination-active" : "pagination-link";
                                            echo <<<HTML
                                            <li class="page-item ">
                                                <a class="page-link $active" href="search.php?search=$search&offset=$i">
                                                    $i
                                                </a>
                                            </li>
HTML;
                                        }
                                        ?>
                                        <?php if($total_pages > 2){ ?>
                                            <li class="page-item">
                                                <span class="pagination-dots">...</span>
                                            </li>
                                        <?php } ?>
                                        <li class="page-item ">
                                            <a class="page-link <?php echo ($current_page == 1) ? "pagination-active" : "pagination-link"; ?>" href="search.php?search=<?php echo $search ?>&offset=1">
                                                1
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>












        <!--وبلاگ ها-->
        <div class="container mt-5 px-5">
            <div class="row justify-content-center">
                <div class="row  justify-content-center mb-5">
                    <div class="col-auto">
                        <h4 class="main-color-bg d-inline p-2 rounded-3 text-white">وبلاگ ها</h4>
                    </div>
                </div>
                <!-- لیست وبلاگ ها -->
                <div class="col-md-9 col-12 order-2 order-md-1">
                    <div class="row mb-2 g-2" dir="rtl">
                        <?php
                        /*نمایش وبلاگ ها*/
                        if(isset($_GET['search'])) {
                            $search_weblog = htmlspecialchars($_GET['search']);
                            $per_weblog = 9 ;
                            if(isset($_GET['offset_weblog'])){
                                $temp_weblog = htmlspecialchars($_GET['offset_weblog']);
                                $offset_weblog = ($temp_weblog - 1) * $per_weblog;
                            }
                            else{
                                $offset_weblog = 0;
                            }

                            $sql_weblog = "SELECT * FROM weblog WHERE title REGEXP :search_weblog ORDER BY id DESC LIMIT $offset_weblog,$per_weblog";
                            $stmt_weblog = $db->prepare($sql_weblog);
                            $param_weblog = ["search_weblog" => "[[:<:]]{$search_weblog}[[:>:]]"];
                            $stmt_weblog->execute($param_weblog);
                            $result_weblog = $stmt_weblog;
                        }

                        if($result_weblog->rowCount() > 0){
                            foreach($result_weblog as $row_weblog){
                                $content_weblog = truncateText($row_weblog['content_header'],150);
                                echo <<<HTML
                                <div class="col-6 col-md-4">
                                    <div class="weblog-card">
                                        <img src="upload/weblog/{$row_weblog['img_header']}"
                                             class="weblog-img"
                                             alt="weblogs">
                                    </div>
                                    <div class="weblog-card-content mt-3" dir="rtl" >
                                        <h3>{$row_weblog['title']}</h3>
                                        <p>
                                           $content_weblog
                                        </p>
                                    </div>
                                    <div class="weblog-card-footer text-end" dir="rtl">
                                        <a href="single-weblog.php?id={$row_weblog['id']}"><span>ادامه مطلب >></span></a>
                                    </div>
                                </div>
HTML;
                            }
                        }
                        ?>
                    </div>
                    <?php
                    /*صفحه بندی*/
                    $per_weblog = 9;

                    $sql_weblog_count = "SELECT * FROM weblog WHERE title REGEXP :search_weblog";
                    $stmt_weblog_count = $db->prepare($sql_weblog_count);
                    $param_weblog_count = ["search_weblog" => "[[:<:]]{$search_weblog}[[:>:]]"];
                    $stmt_weblog_count->execute($param_weblog_count);
                    $result_weblog_count = $stmt_weblog_count;

                    if($result_weblog_count->rowCount() > 0){
                        $total_weblog = $result_weblog_count->rowCount();
                        $total_pages_weblog = ceil($total_weblog / $per_weblog);

                        if($total_pages_weblog > 1){
                            $current_page_weblog = isset($_GET['offset_weblog']) ? $_GET['offset_weblog'] : 1;
                            ?>
                            <div class="pagination-section">
                                <div class="row justify-content-center pt-5">
                                    <ul class="pagination justify-content-center align-items-center mb-0">
                                        <li class="page-item ">
                                            <a class="page-link <?php echo ($current_page_weblog == $total_pages_weblog) ? "pagination-active" : "pagination-link"; ?>" href="search.php?search=<?php echo $search_weblog ?>&offset_weblog=<?php echo $total_pages_weblog ?>">
                                                <?php echo $total_pages_weblog; ?>
                                            </a>
                                        </li>
                                        <?php if($total_pages_weblog > 2){ ?>
                                            <li class="page-item">
                                                <span class="pagination-dots">...</span>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        for($i = 2; $i < $total_pages_weblog; $i++){
                                            $active_weblog = ($current_page_weblog == $i) ? "pagination-active" : "pagination-link";
                                            echo <<<HTML
                                            <li class="page-item ">
                                                <a class="page-link $active_weblog" href="search.php?search=$search_weblog&offset_weblog=$i">
                                                    $i
                                                </a>
                                            </li>
HTML;
                                        }
                                        ?>
                                        <?php if($total_pages_weblog > 2){ ?>
                                            <li class="page-item">
                                                <span class="pagination-dots">...</span>
                                            </li>
                                        <?php } ?>
                                        <li class="page-item ">
                                            <a class="page-link <?php echo ($current_page_weblog == 1) ? "pagination-active" : "pagination-link"; ?>" href="search.php?search=<?php echo $search_weblog ?>&offset_weblog=1">
                                                1
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php
include 'lib/footer.php';
?>