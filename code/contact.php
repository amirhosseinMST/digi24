<?php
include 'lib/header.php';
?>
<?php
$sql = "SELECT * FROM `about`";
$result = $db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
?>
    <!-- =========================================
         ABOUT + CONTACT SECTION
    ========================================= -->

    <section class="about-contact-section flex-grow-1">
        <div class="container ">
            <!-- بنر بالایی -->
            <div class="row  about-camera position-relative ">
                <div class="about-ribbon"></div>
                <img
                        src="upload/about/<?php echo $row['image'] ?>"
                        class=""
                        alt="دوربین"
                >
            </div>
        </div>

        <div class="container ">

            <!-- بخش درباره ما -->
            <div class="about-section ">

                <div class="row justify-content-center px-1 px-md-5" dir="rtl">
                    <div class="col-12 ">

                        <div class="about-content text-center">
                            <h2 class="about-title text-start mb-3">
                                درباره <span>Digi</span><span class="main-color">24</span>
                            </h2>
                            <p>
                                <?php echo $row['body'] ?>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- بخش تماس با ما -->
            <div class="row justify-content-center align-items-start g-4 my-4" dir="rtl">

                <!-- فرم تماس -->
                <div class="col-12 col-lg-6 order-3 order-md-1 ">

                    <div class="contact-form">

                        <h3 class="contact-title">
                            فرم ارتباط با ما
                        </h3>

                        <form action="#" method="post">

                            <!-- فیلد نام -->
                            <div class="mb-2">

                                <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="نام"
                                        maxlength="100"
                                        required
                                >

                            </div>

                            <!-- فیلد ایمیل و موضوع -->
                            <div class="row g-2 mb-2">

                                <div class="col-12 col-sm-6">

                                    <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="آدرس ایمیل"
                                            maxlength="100"
                                            required
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <input
                                            type="text"
                                            name="subject"
                                            class="form-control"
                                            placeholder="موضوع"
                                            maxlength="100"
                                            required
                                    >

                                </div>

                            </div>

                            <!-- فیلد متن پیام -->
                            <div class="mb-2">

                            <textarea
                                    name="message"
                                    class="form-control contact-textarea"
                                    placeholder="متن پیام"
                                    maxlength="2000"
                                    required
                            ></textarea>

                            </div>

                            <!-- دکمه ارسال -->
                            <button
                                    type="submit"
                                    class="btn main-btn contact-submit"
                            >
                                ارسال
                            </button>

                        </form>

                    </div>

                </div>

                <!-- اطلاعات تماس -->
                <div class="col-12 col-sm-6 col-lg-3 order-1 order-md-3">

                    <div class="">

                        <h3 class="contact-title">
                            راه های ارتباطی
                        </h3>

                        <!-- آدرس اول -->
                        <div class="contact-item">

                            <i class="bi bi-geo-alt-fill"></i>

                            <p>
                                <?php echo $row['address_1'] ?>
                            </p>

                        </div>

                        <!-- آدرس دوم -->
                        <div class="contact-item">

                            <i class="bi bi-geo-alt-fill"></i>

                            <p>
                                <?php echo $row['address_2'] ?>
                            </p>

                        </div>

                        <!-- تلفن -->
                        <div class="contact-item">

                            <i class="bi bi-telephone-fill"></i>

                            <p>
                                <?php echo $row['mobile'] ?>
                                - ۰۲۱
                            </p>

                        </div>

                        <!-- موبایل -->
                        <div class="contact-item">

                            <i class="bi bi-phone-fill"></i>

                            <p>
                                <?php echo $row['phone'] ?>

                            </p>

                        </div>

                    </div>

                </div>

                <!-- ساعت کاری -->
                <div class="col-12 col-sm-6 col-lg-2 order-2">

                    <div class="working-hours">

                        <h3 class="contact-title">
                            ساعت کاری
                        </h3>

                        <!-- تصویر ساعت کاری -->
                        <div class="w-100 d-flex align-items-center ms-5">
                            <i class="bi-clock main-color" style="font-size: 30px"></i>
                        </div>

                        <!-- لیست ساعات کاری -->
                        <ul class="list-unstyled working-list mb-0">

                            <li>
                                <?php echo $row['hour1'] ?>
                            </li>

                            <li>
                                <?php echo $row['hour2'] ?>
                            </li>

                            <li>
                                <?php echo $row['hour3'] ?>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </section>


<?php
include 'lib/footer.php';
?>