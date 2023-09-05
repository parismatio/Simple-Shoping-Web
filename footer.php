<script type="text/javascript">
var currentDropdown = null;

function dropdownFunction(dropdownId) {
  var dropdown = document.getElementById(dropdownId);
  if (currentDropdown && currentDropdown != dropdown) {
    currentDropdown.classList.remove("show");
  }
  dropdown.classList.toggle("show");
  currentDropdown = dropdown;
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var dropdown = dropdowns[i];
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        currentDropdown = null;
      }
    }
  }
}

   </script>
<footer>
  <div class="container">
    <div class="footer-content">
      <h4>Bantuan</h4>
      <ul>
        <li><a href="carapemesanan.php">Cara Pemesanan</a></li>
        <li><a href="syaratketentuan.php">Syarat & Ketentuan</a></li>
        <li><a href="pengembalian.php">Pengembalian Barang</a></li>
      </ul>
    </div>
    <div class="footer-content">
      <h4>Metode Pembayaran</h4>
      <div class="metode-bayar">
        <img src="images/logo-bca.png" alt="logobca" style="width:22%; border-radius:4px;">
        <img src="images/logo-dana.png" alt="logodana" style="width:22%; border-radius:4px;">
        <img src="images/logo-gopay.png" alt="logogopay" style="width:22%; border-radius:4px;">
        <img src="images/logo-ovo.png" alt="logoovo" style="width:22%; border-radius:4px;">
      </div>
      <br>
      <h4>Social Media</h4>
      <div class="logo-ig">
        <img src="images/logo-ig.png" alt="logoig"  style="width:22%;">
      </div>
    </div>
    <div class="footer-content">
      <a href="index.html"><img src="images/logo-primary.png" class="nav-logo" alt="YAB!" width="80px"></a>
      <p>Jl. Gading Serpong Boulevard No.1, Curug Sangereng, Kelapa Dua, Tangerang, Banten, Indonesia.</p>
      <p>Find the simple & cool Japanese Clothes<br>
        <b>Only at YAB! - Simple & Fun</b>
      </p>
    </div>
  </div>
</footer>
<hr>
<div class="copyright">
  <h5>Copyright © 2023, YAB!</h5>
</div>
