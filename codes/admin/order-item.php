<?php
include("lib-admin/header.php");
include '../function/jdf.php';
?>

<div class="container-xxl">
    <div class="row">
        <div class="col-auto mb-3">
            <?php
            include("lib-admin/sidebar.php");
            ?>
        </div>

        <div class="col-xl-10">
            <h4 class="mb-3">مدیریت سفارشات</h4>

            <div class="table-responsive">
                <table class="table table-striped table-hover admin-table">
                    <thead class="table-dark">
                    <tr>
                        <th>محصولات</th>
                        <th>تعداد</th>
                        <th>گارانتی</th>
                        <th>بیمه</th>
                        <th>قیمت محصول</th>
                        <th>قیمت مجموع محصولات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $order_id = $_GET['order_id'];

                    $sql_item = "SELECT * FROM `order_items` WHERE `order_id` = '$order_id'";
                    $items = $db->query($sql_item);

                    foreach ($items as $item) {
                        $sql_post = "SELECT * FROM `posts` WHERE `id` = '{$item['post_id']}'";
                        $posts = $db->query($sql_post);
                        $post = $posts->fetch(PDO::FETCH_ASSOC);
                        $insurance = $item['Insurance']==0?"ندارد":"دارد";
                        $price_per_item = number_format($item['price_per_item']);
                        $total_price = number_format($item['total_price']);
                        echo <<<HTML
                            <td>{$post['title']}</td>
                            <td>{$item['quantity']}</td>
                            <td>{$item['guaranty']}</td>
                            <td>$insurance</td>
                            <td>$price_per_item ریال</td>
                            <td>$total_price ریال</td>
                     </tr>
HTML;

                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include("lib-admin/footer.php");
        ?>

