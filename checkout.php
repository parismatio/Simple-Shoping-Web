<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT carts.cart_id, products.product_id, products.imageurl, products.product_name, products.price, carts.quantity, products.price * carts.quantity as total_price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE user_id = $user_id";
    $result = mysqli_query($koneksi, $query);
    $grand_total = 0;
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
include ('header.php');
?>

<section class="checkout">
  <div class="container">
    <div class="checkout-left">
      <h1>Order Detail</h1>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_assoc($result)) {
              $cart_id = $row['cart_id'];
              $product_id = $row['product_id'];
              $imageurl = $row['imageurl'];
              $product_name = $row['product_name'];
              $price = $row['price'];
              $quantity = $row['quantity'];
              $total_price = $row['total_price'];
              $grand_total += $total_price;
          ?>
          <tr>
              <td><img src="<?php echo $imageurl ?>" width="75"></td>
              <td><?php echo $product_name ?></td>
              <td><?php echo "Rp " . number_format($price) ?></td>
              <td><?php echo $quantity ?></td>
              <td><?php echo "Rp " . number_format($total_price) ?></td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Semua</th>
            <td><?php echo "Rp " . number_format($grand_total) ?></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="checkout-right">
      <h1>Formulir Order</h1>
      <form class="form-checkout" method="POST" action="process_order.php">
        <label for="name">Nama Lengkap</label>
        <input class="form-style mb3" type="text" name="name" required>

        <label for="phone">Nomor Hp. (WA)</label>
        <input class="form-style mb3" type="tel" name="phone" required>

        <label for="address">Alamat Pengiriman</label>
        <input class="form-style mb3" type="text" name="address" required>

        <label for="payment_method">Metode Pembayaran</label>
        <select class="mb3" name="payment_method" required>
          <option value="Cash on Delivery">Cash on Delivery</option>
          <option value="Bank Transfer">Bank Transfer</option>
          <option value="Credit Card">Credit Card</option>
        </select>
        <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">

        <input class="form-button" value="Pesan" type="submit">
      </form>
    </div>
  </div>
</section>
