<?php
session_start();
include('connection/koneksi.php');

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT carts.cart_id, products.product_id, products.imageurl, products.product_name, products.price, carts.quantity, products.price * carts.quantity as total_price FROM carts INNER JOIN products ON carts.product_id = products.product_id WHERE user_id = $user_id";
    $result = mysqli_query($koneksi, $query);
}
else{
    echo '<script>alert("Anda harus login terlebih dahulu!"); window.location.href = "login.php";</script>';
}
include ('header.php');
?>
<section class="cart">
  <div class="container">
    <div class="cart-middle">
      <h1>Shopping Cart</h1>
      <table width="100%">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub Total</th>
            <th>Clear</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $grand_total = 0;
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
              <td class="qty">
                <form method="POST" action="update_cart.php">
                  <input type="hidden" name="cart_id" value="<?php echo $cart_id ?>">
                  <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                  <button type="submit" name="action" value="decrement">-</button>
                  <?php echo $quantity ?>
                  <button type="submit" name="action" value="increment">+</button>
                </form>
              </td>
              <td><?php echo "Rp " . number_format($total_price) ?></td>
              <td class="clear">
                <form method="POST" action="delete_cart.php">
                  <input type="hidden" name="cart_id" value="<?php echo $cart_id ?>">
                  <button type="submit">Clear</button>
                </form>
              </td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Semua</th>
            <td><?php echo "Rp " . number_format($grand_total) ?></td>
            <td><a href="checkout.php">Checkout</button></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>

<?php include ('footer.php'); ?>
