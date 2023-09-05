<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){

    if(isset($_POST['cart_id'])){
        $cart_id = $_POST['cart_id'];

        $query = "DELETE FROM carts WHERE cart_id = $cart_id";
        mysqli_query($koneksi, $query);
        header('Location: cart.php');
    }
    else{
        echo '<script>alert("Terjadi kesalahan!"); window.location.href = "view_cart.php";</script>';
    }
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
?>
