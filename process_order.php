<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $total_price = $_POST['grand_total'];
    $status = 'Belum Dibayar';

    // Insert order information to orders table
    $query = "INSERT INTO orders (user_id, name, phone, address, payment_method, total_price, status) VALUES ('$user_id', '$name', '$phone', '$address', '$payment_method', '$total_price', '$status')";
    $result = mysqli_query($koneksi, $query);

    // Get the order ID that was just inserted
    $order_id = mysqli_insert_id($koneksi);

    // Get the cart items and insert them to order details table
    $query = "SELECT carts.product_id, carts.quantity, products.price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE user_id = $user_id";
    $result = mysqli_query($koneksi, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $subtotal = $price * $quantity;
        $query2 = "INSERT INTO order_details (order_id, product_id, price, quantity, subtotal) VALUES ('$order_id', '$product_id', '$price', '$quantity', '$subtotal')";
        mysqli_query($koneksi, $query2);
    }

    // Empty the user's cart
    $query = "DELETE FROM carts WHERE user_id = $user_id";
    mysqli_query($koneksi, $query);

    echo '<script>alert("Pesanan berhasil ditempatkan!"); window.location.href = "order_list.php";</script>';
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
?>
