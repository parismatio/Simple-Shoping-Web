<?php include ('header.php'); ?>

<section class="login">
  <div class="container">
    <div class="login-left">
      <div class="login-title">
        <h2>LOGIN</h2>
        <h4>Belum punya akun? <a href="register.php">Daftar di sini!</a></h4>
      </div>
      <form class="form-login" method="POST" action="login.php">
        <label for="username">Username</label>
        <input class="form-style mb3" type="text" name="username">
        <label for="password">Password</label>
        <input class="form-style" type="password" name="password">
        <small style="float: right; font-weight: 700; margin: 1vh 0 4vh;">Lupa password?</small>
        <input class="form-button" type="submit" id="submit" value="Masuk" name="login">
      </form>
    </div>
    <div class="login-right">
      <div class="login-content">
        <h3 class="mb3">Butuh bantuan? Hubungi kami melalui sosial media kami:</h3>
        <div class="contact">
          <img src="images/wa.png" alt="wa" style="width:50%;">
          <img src="images/ig.png" alt="ig" style="width:45%;">
        </div>
      </div>

    </div>
  </div>
</section>

<?php
	session_start();
	include('connection/koneksi.php');

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
		$cek = mysqli_num_rows($data);
		if($cek > 0){
      $user = mysqli_fetch_assoc($data);
        $_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $username;
				$_SESSION['status'] = "login";
			echo '<script>alert("Berhasil Login!"); window.location.href = "index.php";</script>';
		}else {
			echo '<script>alert("Gagal Login!: Password/Username Salah!");</script>';
		}
	}
  mysqli_close($koneksi);
?>

<?php include ('footer.php'); ?>
