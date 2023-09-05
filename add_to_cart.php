<?php
    session_start();
    include('connection/koneksi.php');

    if(!isset($_SESSION['user_id'])) {
        // user is not logged in, redirect to login page
        echo '<script>alert("Belum Login!"); window.location.href = "login.php";</script>';
        exit();
    }

    if(isset($_POST['product_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        // check if the item is already in the cart
        $query = "SELECT * FROM carts WHERE user_id=$user_id AND product_id=$product_id";
        $result = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($result) > 0) {
            // item is already in the cart, update the quantity
            $row = mysqli_fetch_assoc($result);
            $quantity = $row['quantity'] + 1;
            $query = "UPDATE carts SET quantity=$quantity WHERE id={$row['id']}";
            mysqli_query($koneksi, $query);
        } else {
            // item is not yet in the cart, insert a new record
            $query = "INSERT INTO carts (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
            mysqli_query($koneksi, $query);
        }

        // redirect to the cart page
        echo '<script>alert("Berhasil Memasukkan!"); window.location.href = "index.php";</script>';
        exit();
    }
    mysqli_close($koneksi);
?>
