<?php
include 'lib/header.php';
if (!isset($_SESSION['email'])) {
    header("location: index.php?error=ابتدا وارد شوید.");
    exit();
}
?>
<!--دریافت محصول-->
<?php
if(isset($_POST['add-cart'])){
    $Insurance = isset($_POST['Insurance'])? 1 : 0;
    $guaranty = $_POST['guaranty'];
    $post_id = $_POST['post_id'];
    $price = $_POST['post_price'];
    $title = $_POST['post_title'];
    $image = $_POST['post_image'];
    $limitation = $_POST['post_limitation'];
    $count = $_POST['post_count'];

    if(isset($_SESSION['cart'][$post_id])){
        if($_SESSION['cart'][$post_id]['quantity'] >= $_SESSION['cart'][$post_id]['count']){
            $_SESSION['cart'][$post_id]['quantity'] = $_SESSION['cart'][$post_id]['count'] ;
        }
        elseif ($_SESSION['cart'][$post_id]['quantity'] < $_SESSION['cart'][$post_id]['limitation']) {
            $_SESSION['cart'][$post_id]['quantity']++;
        }
        else{
            $_SESSION['cart'][$post_id]['quantity'] = $_SESSION['cart'][$post_id]['limitation'] ;
        }
    }
    else{
        $_SESSION['cart'][$post_id] = [
            'quantity' => 1,
            'guaranty' => $guaranty,
            'Insurance' => $Insurance,
            'price' => $price,
            'title' => $title,
            'image' => $image,
            'limitation' => $limitation,
            'count' => $count
        ];
    }
}
/*عمليات ها*/

if(isset($_GET['delete'])){
    unset($_SESSION['cart'][$_GET['delete']]);
}


if(isset($_GET['plus'])){
    if($_SESSION['cart'][$_GET['plus']]['quantity'] >= $_SESSION['cart'][$_GET['plus']]['count']){
        $_SESSION['cart'][$_GET['plus']]['quantity'] = $_SESSION['cart'][$_GET['plus']]['count'] ;
    }
    elseif ($_SESSION['cart'][$_GET['plus']]['quantity'] < $_SESSION['cart'][$_GET['plus']]['limitation']) {
        $_SESSION['cart'][$_GET['plus']]['quantity']++;
    }
    else{
        $_SESSION['cart'][$_GET['plus']]['quantity'] = $_SESSION['cart'][$_GET['plus']]['limitation'] ;
    }
}


if(isset($_GET['minus'])){
    if($_SESSION['cart'][$_GET['minus']]['quantity'] < 2){
        unset($_SESSION['cart'][$_GET['minus']]);
    }
    else{
        $_SESSION['cart'][$_GET['minus']]['quantity']--;
    }
}

if (empty($_SESSION['cart'])) {
    header("location: index.php?error=محصولی اضافه نشده.");
    exit();
}

?>
    <!-- =========================================
         CART SECTION
    ========================================= -->
    <section class="crat flex-grow-1 " >
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container mt-3 px-5  ">
            <div class="row">
                <!-- لیست محصولات سبد خرید -->
                <div class="col-md-7 order-md-1 order-1"  dir="rtl">
                    <?php
                    $total_price = 0 ;
                    foreach ($_SESSION['cart'] as $value => $item) {
                        $price = number_format($item['price']);
                        echo <<<HTML
                    <div class="card mb-3">
                        <div class="row g-0 mt-2">
                            <div class="col-md-4 px-1">
                                <img src="upload/posts/{$item['image']}" class="img-fluid" alt="محصول">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"> {$item['title']}</h5>
                                    <!--<p class="card-text text-muted">توضیحات </p>-->
                                    <p class="card-text fw-bold main-color">$price ریال</p>

                                    <div class="row align-items-center gap-2 ">
                                        <div class="col-auto  text-strat">
                                            <a href="single-product.php?id=$value" class="btn btn-outline-dark text-color  btn-sm">مشاهده</a>
                                        </div>
                                        <div class="col-auto  text-strat">
                                            <a href="cart.php?delete=$value" class="btn main-color-bg cart-delete  text-white btn-sm ">حذف</a>
                                        </div>
                                        <!-- کنترل تعداد -->
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="cart.php?minus=$value" class="btn btn-outline-secondary btn-sm" >−</a>
                                                <input type="text" class="form-control none-shadow  form-control-sm text-center" style="width: 60px;" value="{$item['quantity']}"  readonly>
                                                <a href="cart.php?plus=$value" class="btn btn-outline-secondary btn-sm" >+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
HTML;
                        $per_price = $item['price'] * $item['quantity'];
                        $total_price += $per_price;
                    }
                    ?>

                </div>

                <!-- فرم ثبت سفارش -->
                <div class="col-md-5 mb-2 order-md-2 order-2 " dir="rtl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ثبت سفارش</h5>
                            <form action="add-order.php" method="post"  >
                                <!-- روش ارسال -->
                                <div class="mb-3">
                                    <label class="form-label">روش ارسال</label>
                                    <select class="form-select none-shadow cursor-pointer" name="shipping" id="shipping"  required>
                                        <option value="">انتخاب کنید</option>
                                        <?php
                                        $sql_shipping = "SELECT * FROM `shipping_methods`";
                                        $result_shipping = $db->query($sql_shipping);
                                        foreach ($result_shipping as  $shipping) {
                                            echo <<<HTML
                                            <option  value="{$shipping['price']}"> {$shipping['title']}</option>
HTML;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- روش پرداخت -->
                                <div class="mb-3">
                                    <label class="form-label">روش پرداخت</label>
                                    <select name="payment-method" class="form-select none-shadow cursor-pointer " required>
                                        <option value="online">پرداخت آنلاین</option>
                                        <option value="cash">پرداخت در محل</option>
                                    </select>
                                </div>

                                <!-- توضیحات -->
                                <div class="mb-3">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="notes" class="form-control none-shadow" maxlength="300" rows="2"></textarea>
                                </div>

                                <!-- پذیرش قوانین -->
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input none-shadow cursor-pointer cart-check" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">قوانین را می‌پذیرم</label>
                                    </div>
                                </div>

                                <!-- هزینه نهایی -->
                                <div class="mb-3">
                                    <button id="show-price" class="btn w-100 main-color-bg pe-none text-white" ></button>
                                </div>

                                <!-- دکمه ثبت سفارش -->
                                <button type="submit" class="btn btn-outline-dark w-100">ثبت سفارش</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        let shipping = document.getElementById("shipping");
        let show_price = document.getElementById("show-price");
        let price = <?php echo $total_price; ?>;

        let final_show = 0;

        function update() {

            let shipping_price = parseInt(shipping.value) || 0;

            final_show = price + shipping_price;

            show_price.innerHTML = "هزینه نهایی: " + final_show.toLocaleString() + " ریال";
        }

        shipping.addEventListener("change", update);

        update();
    </script>
<?php
include 'lib/footer.php';
?>