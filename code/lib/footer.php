<!-- =========================================
     FOOTER
========================================= -->

<footer class="footer mt-5 pt-5 my-2 " dir="rtl">

    <div class="container-xxl ">
        <?php
        $sql = "SELECT * FROM `logo`";
        $logo = $db->query($sql);
        $img = $logo->fetch();
        ?>
        <div class="footer-box ">

            <!-- لوگو فوتر -->
            <div class="footer-logo">

                <a href="index.php">

                    <img
                            src="upload/logo/<?php echo $img['image'] ?>"
                            alt="Digi24"
                    >

                </a>

            </div>

            <!-- گوشه‌های تزئینی فوتر -->
            <span class="footer-corner footer-corner-top-right"></span>
            <span class="footer-corner footer-corner-top-left"></span>
            <span class="footer-corner footer-corner-bottom-right"></span>
            <span class="footer-corner footer-corner-bottom-left"></span>

            <!-- محتوای اصلی فوتر -->
            <div class="row g-0 footer-content">

                <!-- فروشگاه -->
                <div class="col-12 col-md-6 col-lg-3">

                    <div class="px-4 py-2">

                        <h3 class="footer-title">
                            فروشگاه اینترنتی 24
                        </h3>

                        <p class="footer-description">
                            Digi24، بزرگترین فروشگاه تخصصی محصولات
                            عکاسی و فیلمبرداری در ایران، با ارائه بهترین
                            برندها، قیمت مناسب و خدمات کم‌نظیر، همراه
                            همیشگی شما در مسیر خلق لحظه‌های خاص.
                        </p>

                    </div>

                </div>

                <!-- لینک های مرتبط -->
                <div class="col-12 col-md-6 col-lg-3 ps-md-5">

                    <div class="px-4 py-2">

                        <h3 class="footer-title">
                            لینک های مرتبط
                        </h3>

                        <ul class="footer-links list-unstyled mb-0">

                            <li>
                                <a href="contact.php">
                                    <i class="bi bi-chevron-left"></i>
                                    درباره ما
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    راهنمای خرید
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    سوالات متداول
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    قوانین و مقررات
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

                <!-- آخرین مطالب -->
                <div class="col-12 col-md-6 col-lg-3">

                    <div class="px-4 py-2">

                        <h3 class="footer-title">
                            آخرین مطالب
                        </h3>

                        <ul class="footer-links list-unstyled mb-0">

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    دنیای جذاب عکاسی
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    نکات انتخاب لنز
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    راهنمای خرید دوربین
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-left"></i>
                                    آموزش‌های کاربردی
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

                <!-- ارتباط با ما -->
                <div class="col-12 col-md-6 col-lg-3">

                    <div class="px-4 py-2 footer-contact">

                        <h3 class="footer-title">
                            ارتباط با ما
                        </h3>

                        <!-- ایمیل -->
                        <a
                                href="mailto:info@digi24.ir"
                                class="footer-email"
                        >

                            <span class="email-label">

                                <i class="bi bi-envelope-fill"></i>

                                ایمیل

                            </span>

                            <span class="email-address">
                                info@digi24.ir
                            </span>

                        </a>

                        <!-- شبکه های اجتماعی -->
                        <div class="footer-social">

                            <a href="#" aria-label="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>

                            <a href="#" aria-label="Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>

                            <a href="#" aria-label="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- بخش پایینی فوتر -->
        <div class="row justify-content-center ">

            <div class="footer-bottom border-0">

                <div class="footer-line"></div>

                <!-- کپی‌رایت -->
                <p class="mb-0">
                    © تمامی حقوق این سایت محفوظ است - Digi24
                </p>

                <div class="footer-line"></div>

            </div>
        </div>

    </div>

</footer>

<!-- اسکریپت بوت‌استرپ -->
<script
        src="js/bootstrap.bundle.min.js">
</script>
<?php ob_end_flush(); ?>
</body>
</html>