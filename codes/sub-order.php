<?php
include 'lib/header.php';
if (!isset($_SESSION['email'])) {
    header("location: index.php?mas=ابتدا وارد شوید.");
    exit();
}
$id = $_GET['id'];

$sql = "SELECT * FROM `orders` where user_id='$id' ORDER BY id DESC";
$result = $db->query($sql);

if ($result->rowCount() <= 0) {
    header("location: profile.php?mas=سفارشی وجود نداره .");
    exit();
}
?>

<div class="container py-4 flex-grow-1" dir="rtl">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-box-seam main-color" style="vertical-align: -4px !important;"></i> آخرین سفارشات
        </h5>
        <a href="profile.php" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left" style="vertical-align: -2px !important;"></i> برگشت به پروفایل
        </a>
    </div>


    <?php
    foreach ($result as $order) {
        $total_amount = number_format($order['total_amount']);
        $created = jdate("Y/m/d H:i:s", strtotime($order['created_at']));
        $payment_method = ($order['payment_method'] == "online") ? "آنلاین" : "نقدی";

        $sql_item = "SELECT * FROM `order_items` WHERE order_id = '{$order['id']}'";
        $orders = $db->query($sql_item);

        echo <<<HTML

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="d-flex flex-wrap align-items-center gap-2 justify-content-between">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="badge bg-light text-dark border py-2 px-3">
                            <i class="bi bi-hash"></i> {$order['order_number']}
                        </span>
                        <span class="badge main-dark-bg p-2 px-3" >
                             {$order['order_status']}
                        </span>
                    </div>
                    <div class="text-muted small me-1 me-md-0">
                        <i class="bi bi-calendar3"></i> $created	 
                    </div>
                </div>

                <hr class="my-3"/>

                <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light main-color border border-secondary">
                    <i class="bi bi-truck"></i> {$order['shipping_method']}
                </span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">
                    <i class="bi bi-credit-card"></i> $payment_method
                </span>
                    <span class="badge bg-light text-dark border">
                    <i class="bi bi-box"></i> {$order['order_count']}
                </span>
                </div>

                <div class="border rounded p-3 bg-light mb-2 ">
                <!-- دسکتاپ -->
                <div class="row border-bottom pb-2 mb-2 d-none d-md-flex">
                    <div class="col-4 fw-bold small">محصول</div>
                    <div class="col-2 fw-bold small text-center">قیمت</div>
                    <div class="col-2 fw-bold small text-center">تعداد</div>
                    <div class="col-4 fw-bold small text-end">جمع</div>
                </div>
                
                <!-- موبایل -->
                <div class="row border-bottom pb-2 mb-2 d-flex d-md-none">
                    <div class="col-8 fw-bold small">محصول</div>
                    <div class="col-4 fw-bold small text-end">جمع</div>
                </div>

HTML;

        foreach ($orders as $item) {
            $Insurance = $item['Insurance']==1 ? 'دارد': 'ندارد';
            $query = "SELECT * FROM `posts` WHERE id = '{$item['post_id']}'";
            $posts = $db->query($query);
            $post = $posts->fetch();
            $price_per_item = number_format($item['price_per_item']);
            $total_price = number_format($item['total_price']);
            echo <<<HTML
                <!-- دسکتاپ -->
                <div class="row my-2 d-none d-md-flex align-items-center">
                    <div class="col-4">{$post['title']}</div>
                    <div class="col-2 text-center">$price_per_item</div>
                    <div class="col-2 text-center">{$item['quantity']}</div>
                    <div class="col-4 text-end">$total_price</div>
                </div>
                
                <!-- موبایل -->
                <div class="row d-md-none justify-content-between align-items-center border-bottom py-2">
                
                    <div class="pe-2 col-7" >
                        <div class="fw-bold text-break">
                            {$post['title']}
                        </div>
                
                        <div class="small text-muted mt-1">
                            قیمت: $price_per_item
                            <span class="mx-1">|</span>
                            تعداد: {$item['quantity']}
                        </div>
                    </div>
                
                    <div class="col-5 text-end ">
                        <div class="fw-bold">$total_price</div>
                    </div>
                
                </div>
HTML;

        }
        $shipping_cost = number_format($order['shipping_cost']);
        echo <<<HTML
                    <div class="row  border-top pb-2 mt-4 pt-2 mb-2">
                        <div class="col-12 small my-1 small">
                            <strong>روش ارسال :</strong> {$order['shipping_method']}
                        </div>
                        <div class="col-12 small my-1 small">
                            <strong>گارانتی :</strong> {$item['guaranty']}
                        </div>
                        <div class="col-12 small my-1 small">
                            <strong>بیمه :</strong> {$Insurance}
                        </div>
                        <div class="col-12 small my-1 small">
                            <strong>هزینه ارسال :</strong> {$shipping_cost}
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-between align-items-center mt-3 p-2 main-color-bg bg-opacity-10 rounded">
                    <span class="fw-bold text-white">جمع کل</span>
                    <span class="fw-bold text-white fs-6"> $total_amount  ریال</span>
                </div>

                <div class="col-12 mt-2 text-start">
                        <i class="bi bi-chat-dots"></i> توضیحات: {$order['notes']} 

                </div>

            </div>
        </div>
HTML;

    }
    ?>

</div>

<?php
include 'lib/footer.php';
?>
