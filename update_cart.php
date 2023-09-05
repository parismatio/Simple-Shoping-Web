<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){

    if(isset($_POST['cart_id']) && isset($_POST['product_id']) && isset($_POST['action'])){
        $cart_id = $_POST['cart_id'];
        $product_id = $_POST['product_id'];
        $action = $_POST['action'];

        if($action == 'increment'){
            $query = "UPDATE carts SET quantity = quantity + 1 WHERE cart_id = $cart_id AND product_id = $product_id";
        }
        else if($action == 'decrement'){
            $query = "UPDATE carts SET quantity = quantity - 1 WHERE cart_id = $cart_id AND product_id = $product_id";
        }

        mysqli_query($koneksi, $query);
        header('Location: cart.php');
    }
    else{
        echo '<script>alert("Terjadi kesalahan!"); window.location.href = "cart.php";</script>';
    }
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
?>
