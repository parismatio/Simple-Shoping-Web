<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		// If the 'username' session variable is not set, redirect to the login page
		echo '<script>alert("Belum Login!"); window.location.href = "login.php";</script>';
		exit; // Exit the script to prevent further execution
	}
include ('header.php');

?>

<section class="account">
	<div class="container">
		<div class="account-middle">
			<h1>Account Information</h1>
			<table>
					<?php
					include('connection/koneksi.php');
					$usernamesession = $_SESSION['username'];
					$accountquery = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$usernamesession'");

					while($row = mysqli_fetch_array($accountquery)){
				 		echo "<tr>
							<td>Username</td>
							<td>$row[username]</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>$row[email]</td>
						</tr>
						<tr>
							<td>No Hp.</td>
							<td>$row[no_hp]</td>
						</tr>

				 			";
				 	}
					 ?>
			</table>
			<a class="logout" href="logout.php">LOG OUT</a>
		</div>
	</div>
</section>

<?php include ('footer.php'); ?>
