<?php
include 'lib/header.php';
?>
    <!-- =========================================
         WEBLOG SECTION
    ========================================= -->
    <section class="weblog flex-grow-1 " >
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container mt-5 px-5">
            <!-- توضیحات وبلاگ -->
            <div class="weblog-content text-center mb-4" dir="rtl">
                <h2 class="weblog-title text-start mb-3">
                    مجله <span>Digi</span><span class="main-color">24</span>
                </h2>
                <p>
                    به وبلاگ تخصصی دنیای دوربین و عکاسی خوش آمدید! در اینجا جدیدترین مقالات، آموزش‌ها و بررسی‌های تخصصی در حوزه دوربین‌های دیجیتال، لنزها، تجهیزات جانبی و تکنیک‌های عکاسی حرفه‌ای را مطالعه خواهید کرد.
                    هدف ما ارائه محتوای کاربردی و به‌روز برای علاقه‌مندان به عکاسی، از مبتدی تا حرفه‌ای است. با ما همراه باشید تا دنیای شگفت‌انگیز تصویر را کشف کنیم و لحظات ناب را با بهترین کیفیت به ثبت برسانیم.
                    اگر به دنبال خرید دوربین مناسب، یادگیری تکنیک‌های پیشرفته عکاسی یا آشنایی با جدیدترین تکنولوژی‌های تصویربرداری هستید، مطالب ما را از دست ندهید.
                </p>
            </div>

            <!-- لیست مطالب -->
            <div class="row pb-4 g-3 justify-content-end">
                <!-- مطلب 1 -->
                <?php
                $per = 9 ;
                if(isset($_GET['offset'])){
                    $temp = htmlspecialchars($_GET['offset']);
                    $offset = ($temp - 1) * $per; ;
                }
                else{
                    $offset = 0;
                }
                $sql_weblogs = "SELECT * FROM weblog ORDER BY id DESC LIMIT $offset,$per"; ;
                $result_weblogs = $db->query($sql_weblogs);
                foreach($result_weblogs as $row_weblogs) {
                    $content = truncateText($row_weblogs['content_header'],150);
                    echo <<<HTML
                <div class="col-6 col-md-4">
                    <div class="weblog-card">
                        <img src="upload/weblog/{$row_weblogs['img_header']}"
                             class="weblog-img"
                             alt="weblogs">
                    </div>
                    <div class="weblog-card-content mt-3" dir="rtl" >
                        <h3>{$row_weblogs['title']}</h3>
                        <p>
                           $content
                        </p>
                    </div>
                    <div class="weblog-card-footer text-end" dir="rtl">
                        <a href="single-weblog.php?id={$row_weblogs['id']}"><span>ادامه مطلب >></span></a>
                    </div>
                </div>
HTML;

                }
                ?>


                <?php
                    $sql_posts = "SELECT * FROM  weblog";
                    $result_posts = $db->query($sql_posts);
                    if($result_posts->rowCount() > 0){
                        $total_posts = $result_posts->rowCount();
                        $total_pages = ceil($total_posts/$per);
                        ?>
                        <!-- صفحه‌بندی -->
                        <?php
                        $current_page = isset($_GET['offset']) ? (int)$_GET['offset'] : 1;
                        $active_first = ($current_page == 1)? "pagination-active" : "pagination-link";
                        if($total_pages > 1){
                            $active_last = ($current_page == $total_pages)? "pagination-active" : "pagination-link";
                        }
                        else{
                            $active_last = "pagination-link";
                        }

                        if($total_pages > 1){
                        ?>
                        <div class="pagination-section">
                            <div class="row justify-content-center pt-5">
                                <ul class="pagination justify-content-center align-items-center mb-0">

                                    <li class="page-item ">
                                        <a class="page-link <?php echo $active_last; ?>" href="weblogs.php?offset=<?php echo $total_pages ?>">
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
                                    <a class="page-link $active" href="weblogs.php?offset=$i">
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
                                        <a class="page-link <?php echo $active_first; ?>" href="weblogs.php?offset=1">
                                            1
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php }
                }?>
        </div>
    </section>

<?php
include 'lib/footer.php';
?>