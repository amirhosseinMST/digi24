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
                        <th>شماره سفارش</th>
                        <th>کاربر</th>
                        <th>تعداد محصول</th>
                        <th>مبلغ کل</th>
                        <th>روش ارسال</th>
                        <th>هزینه ارسال</th>
                        <th>وضعیت پرداخت</th>
                        <th>وضعیت سفارش</th>
                        <th>تاریخ</th>
                        <th>عملیات</th>
                        <th>سفارش ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_GET['mas'])) {
                        echo <<<HTML
                        <script>alert("{$_GET['mas']}")</script>
HTML;

                    }
                    if (isset($_POST['id'])) {
                        if (trim($_POST['order-status']) != "") {
                            $id = $_POST['id'];
                            $order_status = $_POST['order-status'];
                            $sql_up = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `id` = '$id'";
                            $result_up = $db->query($sql_up);
                            if ($result_up->rowCount() > 0) {
                                header("Location:orders.php?mas=وضعیت سفارش تغییر کرد.");
                                exit();
                            } else {
                                header("Location:orders.php?mas=متاسفانه وضعیت سفارش تغییر نکرد");
                                exit();
                            }

                        } else {
                            header("Location:orders.php?mas=متاسفانه وضعیت سفارش تغییر نکرد");
                            exit();
                        }
                    }
                    $sql = "SELECT * FROM `orders` ORDER BY `id` DESC";
                    $result = $db->query($sql);
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                            $query = "SELECT * FROM `users` WHERE `id` = {$row['user_id']}";
                            $posts = $db->query($query);
                            $post = $posts->fetch(PDO::FETCH_ASSOC);
                            $first_name = $post['first_name'];
                            $last_name = $post['last_name'];
                            $email = $post['email'];
                            $total_amount = number_format($row['total_amount']);
                            $payment_status = ($row['payment_status'] == "paid") ? "پرداخت شده" : "پرداخت نشده";
                            $created_date = jdate("Y-m-d H:i:s", strtotime($row['created_at']));
                            $shipping_cost = number_format($row['shipping_cost']);

                            echo <<<HTML
                                            <tr>
                        <td><strong>{$row['order_number']}</strong></td>
                        <td>$first_name  $last_name<br><small class="text-muted">$email</big></td>
                        <td>{$row['order_count']}</td>
                        <td>$total_amount ریال</td>
                        <td>{$row['shipping_method']}</td>
                        <td>$shipping_cost ریال</td>  
                        <td><span class="badge bg-secondary">$payment_status</span></td>
                        <td><span class="badge bg-warning text-dark">{$row['order_status']}</span></td>
                        <td>$created_date</td>
                        <td>
                            <form class="d-flex gap-1 justify-content-center" method="post"  >
                                <select class="form-select form-select-sm" style="width: 130px;" name="order-status">
                                    <option value="در حال ارسال" >در حال ارسال</option>
                                    <option value="تحویل شده">تحویل شده</option>
                                    <option value="لغو شده">لغو شده</option>
                                    <option value="در انتظار">در انتظار</option>
                                    <option value="در حال پردازش">در حال پردازش</option>
                                </select>
                                <input type="hidden" name="id" value="{$row['id']}">
                                <button type="submit"  class="btn btn-success btn-sm">✓</button>
                            </form>
                        </td>
                        <td>
                            <a href="order-item.php?order_id={$row['id']}" class="btn btn-primary">جزئیات</a>
                        </td>
                    </tr>
HTML;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include("lib-admin/footer.php");
        ?>
