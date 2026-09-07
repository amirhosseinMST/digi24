<?php
include 'lib/header.php';
?>
    <!-- =========================================
         SINGLE WEBLOG SECTION
    ========================================= -->
    <section class="single-weblog flex-grow-1 " >
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container mt-5 px-5">
            <?php
            if(isset($_GET['mas'])){
                $mas = htmlspecialchars($_GET['mas']);
                echo <<<HTML
                <script>alert("$mas")</script>
HTML;
            }
                /*وبلاگ ها*/
                if(isset($_GET['id'])){
                $id = htmlspecialchars($_GET['id']);
                $sql_weblog = "SELECT * FROM weblog WHERE id = :id";
                $stmt_weblog = $db->prepare($sql_weblog);
                $params = array(':id' => $id);
                $stmt_weblog->execute($params);
                $weblog = $stmt_weblog->fetch(PDO::FETCH_ASSOC);
                $created  = jdate("Y/m/d",strtotime($weblog['created']));
                }

                /*كامنت ها*/
                $sql_comment = "SELECT * FROM comments WHERE weblog_id = :weblog_id AND status = 1 ORDER BY id DESC";
                $stmt_comment = $db->prepare($sql_comment);
                $stmt_comment->execute(['weblog_id' => $id]);

            ?>
            <!-- عنوان مطلب -->
            <div class="row justify-content-center">
                <div class="col-auto single-weblog-title">
                    <h2>
                        <?php echo $weblog['title']; ?>
                    </h2>
                </div>
            </div>

            <!-- اطلاعات نویسنده و تاریخ -->
            <div class="row justify-content-center  g-3" dir="rtl">
                <div class="col-md-auto text-center ">
                    <div class="single-weblog-info w-100">
                        <i class="bi bi-person-fill"></i>
                        <span><?php echo $weblog['author']; ?></span>
                    </div>
                </div>
                <div class="col-md-auto text-center ">
                    <div class="single-weblog-info w-100">
                        <i class="bi bi-calendar2-week"></i>
                        <span><?php echo $created ?></span>
                    </div>
                </div>
                <div class="col-md-auto text-center ">
                    <div class="single-weblog-info w-100">
                        <i class="bi bi-collection"></i>
                        <span><?php echo $weblog['type']; ?></span>
                    </div>
                </div>
            </div>

            <!-- محتوای اصلی مطلب -->
            <div class="row justify-content-center  mt-md-5">
                <!-- پاراگراف اول -->
                <div class="col-md-9 col-12  text-center ">
                    <div class="single-weblog-content w-100" dir="rtl">
                        <div class="single-weblog-image w-100 mb-md-3">
                            <img src="upload/weblog/<?php echo $weblog['img_header']; ?>" class="" alt="weblog">
                        </div>
                        <p>
                            <?php echo $weblog['content_header']; ?>
                        </p>
                    </div>
                </div>

                <!-- پاراگراف دوم -->
                <div class="col-md-9 col-12 text-center ">
                    <div class="single-weblog-content w-100" dir="rtl">
                        <div class="single-weblog-image w-100 mb-md-3">
                            <img src="upload/weblog/<?php echo $weblog['img_body']; ?>" class="" alt="weblog">
                        </div>
                        <p>
                            <?php echo $weblog['content_body']; ?>
                        </p>
                    </div>
                </div>

                <!-- پاراگراف سوم -->
                <div class="col-md-9 col-12 text-center ">
                    <div class="single-weblog-content w-100" dir="rtl">
                        <div class="single-weblog-image w-100 mb-md-3">
                            <img src="upload/weblog/<?php echo $weblog['img_footer']; ?>" class="" alt="weblog">
                        </div>
                        <p>
                            <?php echo $weblog['content_footer']; ?>
                        </p>
                    </div>
                </div>

                <!-- اطلاعات نویسنده و اشتراک‌گذاری -->
                <div class="col-md-9 col-12 text-center my-3">
                    <div class="row justify-content-end align-items-center" dir="rtl">
<!--                        <div class="col-md-auto text-center mb-2 mb-md-0">
                            <div class="single-weblog-created w-100">
                                <img src="upload/categories/1.webp" class="" alt="weblog">
                                <span>امیرحسین مراد</span>
                            </div>
                        </div>
                        <div class="col-md-auto me-auto text-center ">
                            <div class="single-weblog-created pt-md-1 w-100">
                                <i class="bi bi-calendar2-week"></i>
                                <span>1405/09/12</span>
                            </div>
                        </div>-->
                        <div class="col-md-auto mt-1 pt-1">
                            <div class="single-weblog-logo w-100" >
                                <span>اشتراک گذاری</span>
                                <a href="#" aria-label="Facebook">
                                    <i class="bi bi-heart main-color"></i>
                                </a>
                                <span class="light-text" style="font-size: 15px">
                                |
                                </span>
                                <a href="#" aria-label="Facebook">
                                    <i class="bi bi-facebook light-text"></i>
                                </a>

                                <a href="#" aria-label="Twitter">
                                    <i class="bi bi-twitter light-text"></i>
                                </a>

                                <a href="#" aria-label="Instagram">
                                    <i class="bi bi-instagram light-text"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- فرم دیدگاه -->
                <?php
                if (isset($_POST['add-comment'])) {
                    if (trim($_POST['comment']) != '' && trim($_POST['name']) != '') {
                        $name = truncateText(htmlspecialchars($_POST['name']), 100);
                        $comment = truncateText(htmlspecialchars($_POST['comment']), 2000);

                        $sql = "INSERT INTO comments (name, comment, weblog_id) VALUES (:name, :comment, :weblog_id)";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':name' => $name, ':comment' => $comment, ':weblog_id' => $id]);

                        header("Location: single-weblog.php?mas=بعد از تایید مدير کامنت شما ثبت میشود.&id=" . $id);
                        exit();
                    } else {
                        $error = "لطفا تمامی فیلدها را پر کنید";
                    }
                }
                ?>
                <div class="col-md-9 col-12 text-center  mb-5 mt-3">
                    <div class="contact-form text-start w-100">

                        <h3 class="contact-title">
                            دیدگاه شما
                        </h3>

                        <form  method="post">

                            <div class="row g-2 mb-2">

                                <div class="col-12 ">

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
                                    placeholder="دیدگاه شما"
                                    maxlength="2000"
                                    required
                            ></textarea>

                            </div>

                            <button
                                    type="submit"
                                    name="add-comment"
                                    class="btn main-btn contact-submit"
                            >
                                ارسال
                            </button>

                        </form>

                    </div>
                </div>

                <!-- نظرات کاربران -->
                <?php
                if($stmt_comment->rowCount() > 0){
                    foreach ($stmt_comment as $comment) {
                        $time = jdate("Y/m/d",strtotime($comment['date']));
                    echo <<<HTML
                <div class="col-md-9 col-12 text-center ">
                    <div class="row justify-content-end">
                        <div class="col-auto text-center ">
                            <div class="single-weblog-comment w-100">
                                <span>{$comment['name']}</span>
                            </div>
                        </div>
                        <div class="col-auto  text-center ">
                            <div class="single-weblog-comment  w-100">
                                <span>$time</span>
                                <i class="bi bi-calendar2-week"></i>
                            </div>
                        </div>
                        <div class="col-12 my-2 text-end ">
                            <p class="about-text text-start w-100">

                                {$comment['comment']}

                            </p>
                        </div>
                    </div>
                </div>
HTML;

                    }
                }
                ?>


                <!-- مطالب مرتبط -->
                <div class="col-md-9 text-start mb-4" dir="rtl">
                    <?php
                    $type = $weblog['type'];
                    $sql_re = "SELECT * FROM weblog WHERE id != '$id' AND type = '$type' LIMIT 3 ";
                    $result_re = $db->query($sql_re);
                    ?>
                    <h3 class="single-weblog-more mt-3 pb-2">دیگر مطالب مرتبط</h3>
                    <div class="row g-3">
                        <?php
                        if($result_re->rowCount() > 0){
                            foreach ($result_re as $re) {
                                $content = truncateText($re['content_header'] , 100);
                                echo <<<HTML
                                <div class="col-6 col-md-4">
                                    <div class="weblog-card">
                                        <img src="upload/weblog/{$re['img_header']}"
                                             class="weblog-img"
                                             alt="weblogs">
                                    </div>
                                    <div class="weblog-card-content mt-3" dir="rtl" >
                                        <h3>{$re['title']}</h3>
                                        <p>
                                            $content
                                        </p>
                                    </div>
                                    <div class="weblog-card-footer text-end" dir="rtl">
                                        <a href="single-weblog.php?id={$re['id']}"><span>ادامه مطلب >></span></a>
                                    </div>
                                </div>
HTML;

                            }
                        }
                        else{
                            echo <<<HTML
                                <div class="col-12 text-start">
                                    <span class="small text-secondary">
                                    مطلب مرتبط یافت نشد.
                                    </span>
                                </div>
HTML;

                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php
include 'lib/footer.php';
?>