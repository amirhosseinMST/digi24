<?php
include 'lib/header.php';
if (trim($_POST['shipping']) != '' && trim($_POST['payment-method']) != '') {
    $shipping_cost = $_POST['shipping'];
    $payment_method = $_POST['payment-method'];
    $notes = htmlspecialchars(truncateText($_POST['notes'], 200));
    $order_count = count($_SESSION['cart']);

    $sql_shipping = "SELECT * FROM `shipping_methods` WHERE `price`='{$shipping_cost}'";
    $shipping_result = $db->query($sql_shipping);
    $shipping_row = $shipping_result->fetch(PDO::FETCH_ASSOC);
    $shipping_method = $shipping_row['title'];

    $sql_sub = "SELECT * FROM `users` WHERE `email`='{$_SESSION['email']}'";
    $sub_result = $db->query($sql_sub);
    $sub_row = $sub_result->fetch(PDO::FETCH_ASSOC);
    $user_id = $sub_row['id'];


    $total_price = 0;
    foreach ($_SESSION['cart'] as $value => $item) {

        $per_price = $item['price'] * $item['quantity'];
        $total_price += $per_price;
    }
    $total_amount = $total_price + $shipping_cost;

    $order_number = "ORD-" . date("YmdHis") . rand(100000, 999999);


    $payment_status = "paid";

    if ($payment_status == "paid") {
        $sql_order = "INSERT INTO `orders` (
                            `user_id`, `order_count`, `order_number`, `total_amount`, 
                            `shipping_cost`, `shipping_method`, `payment_method`,
                            `payment_status`, `notes`
                        ) VALUES (
                            :user_id, :order_count, :order_number, :total_amount, 
                            :shipping_cost, :shipping_method, :payment_method,
                            :payment_status, :notes
                        )";

        $stmt_order = $db->prepare($sql_order);
        $params = [
            'user_id' => $user_id,
            'order_count' => $order_count,
            'order_number' => $order_number,
            'total_amount' => $total_amount,
            'shipping_cost' => $shipping_cost,
            'shipping_method' => $shipping_method,
            'payment_method' => $payment_method,
            'payment_status' => "$payment_status",
            'notes' => $notes
        ];
        $stmt_order->execute($params);

        $order_id = $db->lastInsertId();

        foreach ($_SESSION['cart'] as $post_id => $item) {

            $quantity = $item['quantity'];
            $price = $item['price'];
            $guaranty = $item['guaranty'];
            $Insurance = $item['Insurance'];
            $total_item_price = $price * $quantity;

            $sql_item = "INSERT INTO order_items (
                                order_id, post_id, quantity, price_per_item, total_price , guaranty , Insurance
                            ) VALUES (
                                :order_id, :post_id, :quantity, :price_per_item, :total_price , :guaranty , :Insurance
                            )";
            $stmt_item = $db->prepare($sql_item);
            $stmt_item->execute([
                ':order_id' => $order_id,
                ':post_id' => $post_id,
                ':quantity' => $quantity,
                ':price_per_item' => $price,
                ':total_price' => $total_item_price,
                ':guaranty' => $guaranty,
                ':Insurance' => $Insurance
            ]);

            $sql_select = "SELECT * FROM `posts` WHERE `id`='$post_id'";
            $post_select = $db->query($sql_select);
            $post_row = $post_select->fetch(PDO::FETCH_ASSOC);
            $post_quantity = $post_row['quantity'];
            $post_quantity -= $quantity;

            $sql_update = "UPDATE `posts` SET `quantity`='$post_quantity' WHERE `id`='$post_id'";
            $stmt_update = $db->query($sql_update);

        }


        unset($_SESSION['cart']);
        header("location:profile.php?mas=سفارش شما ثبت شد.");
        exit();
    }
} else {
    header("location:cart.php?mas=متاسفانه ثبت نشد.");
    exit();
}
?>
