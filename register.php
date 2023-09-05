<?php include ('header.php'); ?>

<section class="register">
  <div class="container">
    <div class="register-middle">
      <div class="register-title">
        <h2>DAFTAR</h2>
        <h4>Punya akun? <a href="login.php">Masuk di sini!</a></h4>
      </div>
      <form class="form-register" method="POST" action="register.php">
        <label for="username">Username</label>
        <input class="form-style mb3" type="text" name="username" required>
        <label for="email">Email</label>
        <input class="form-style mb3" type="email" name="email" required>
        <label for="no_hp">No Hp.</label>
        <input class="form-style mb3" type="tel" name="no_hp" required>
        <label for="password">Password</label>
        <input class="form-style" type="password" name="password" required>
        <br>
        <input class="form-button" type="submit" value="Daftar" name="register">
      </form>
    </div>
  </div>
</section>

<?php
include('connection/koneksi.php');

if (isset($_POST["register"])) {
  $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
  $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
  $no_hp = mysqli_real_escape_string($koneksi, $_POST["no_hp"]);
  $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

  // Check if the username or email already exists in the table
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
      // If the username or email already exists, display an error message using JavaScript
      echo '<script>alert("Username or email already exists!");</script>';
    } else {
      // Construct the SQL query to insert the data into the table
      $sql = "INSERT INTO users (username, email, no_hp, password)
              VALUES ('$username', '$email', '$no_hp', '$password')";

      // Execute the query and check if it was successful
      if (mysqli_query($koneksi, $sql)) {
        echo '<script>alert("Berhasil Daftar")</script>';
      } else {
        echo '<script>alert("Error: Gagal Daftar")</script>';
      }
    }
  }

// Close the database connection
mysqli_close($koneksi);
?>

<?php include ('footer.php'); ?>
