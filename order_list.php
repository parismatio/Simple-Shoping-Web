<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT orders.order_id, orders.order_date, order_details.product_id, order_details.quantity, orders.total_price, orders.status, products.product_name, products.imageurl, order_details.price FROM orders INNER JOIN order_details ON orders.order_id = order_details.order_id INNER JOIN products ON order_details.product_id = products.product_id WHERE user_id = $user_id ORDER BY orders.order_id DESC";
    $result = mysqli_query($koneksi, $query);
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
include ('header.php');
?>

<section class="orderlist">
    <div class="container">
        <div class="orderlist-middle">
          <h1>Order List</h1>
            <?php
            $last_order_id = -1;
            while($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $total_price = $row['total_price'];
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];
                $product_name = $row['product_name'];
                $imageurl = $row['imageurl'];
                $priceperitem = $row['price'];

                if ($order_id != $last_order_id) {
                    // start a new order card
                    if ($last_order_id != -1) {
                        // close the previous order card
                        echo '</div>';
                    }
                    $last_order_id = $order_id;
                    echo '<div class="orderlist-card">';
                    echo '<div class="card-header">';
                    echo '<div class="card-h3">';
                    echo '<h3>Tanggal Order: '.$order_date.'</h3>';
                    echo '<h3>Order ID: '.$order_id.'</h3>';
                    echo '</div>';
                    echo '<div class="card-h3">';
                    echo '<h3>STATUS PEMBAYARAN</h3>';
                    echo '<h3>'.$status.'</h3>';
                    echo '</div>';
                    echo '<div class="card-h3 borderless">';
                    echo '<h3>TOTAL HARGA</h3>';
                    echo '<h3>Rp '.number_format($total_price).'</h3>';
                    echo '</div>';
                    echo '</div>'; // close card-header div
                }

                // output product information
                echo '<div class="card-content">';
                echo '<div class="card-image">';
                echo '<img src="'.$imageurl.'" width="64">';
                echo '</div>';
                echo '<div class="card-text">';
                echo '<h3>'.$product_name.'</h3>';
                echo '<h3> Rp. '.number_format($priceperitem).'</h3>';
                echo '<h3>Qty: '.$quantity.'</h3>';
                echo '</div>';
                echo '</div>'; // close card-content div

            }
            // close the last order card
            if ($last_order_id != -1) {
                echo '</div></div>';
            }
            ?>
        </div>
    </div>
</section>
