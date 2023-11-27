<?php
ob_start();
include( 'inc/config.php' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tiga Ksatria Indonesia</title>
<link rel="icon" href="images/Logo-only.svg">
<link rel="stylesheet" href="css/hubungi_kami.css?v=<?php echo time(); ?>"/>
</head>

<body>
<div class="setting">
  <div class="logo"> <img src="images/Logo.svg" alt="" onClick="location.href='index.php'"> </div>
  <div class="bahasa"> <a class="item-bahasa en">Inggris</a> <a class="item-bahasa id">Indonesia</a> <a class="item-bahasa jp">Jepang</a> </div>
</div>
<div class="navbar">
  <ul>
    <li><a href="index.php">Beranda</a></li>
    <li><a href="tentang_kami.php">Tentang Kami</a></li>
    <li class="dropdown"> <a class="dropdown-btn">Layanan Kami &#x25BE;</a>
      <div class="dropdown-content"> <a href="daftar_loker.php">Pencarian Lowongan Kerja</a> <a href="konsultasi_visa.php">Konsultasi Visa</a> <a href="pencarian_kandidat.php">Pencari Kandidat</a> </div>
    </li>
    <li><a href="galeri.php">Galeri</a></li>
    <li><a href="hubungi_kami.php">Hubungi Kami</a></li>
  </ul>
  <div class="akun">
    <?php
    if ( isset( $_SESSION[ 'is_login' ] ) == "" ) {
      echo '<a class="daftar" href="daftar.php">Daftar</a>';
      echo '<a class="in">Login</a>';
    } else {
      echo '<a class="dash" class="dashboard" href="dashboard.php">Dashboard</a>';
      echo '<a class="out" href="inc/inc_logout.php">Hai, ' . $_SESSION[ 'is_login' ] . '</a>';
    }
    ?>
  </div>
  <form method="post" class="nav-login">
    <?php
    if ( isset( $_POST[ 'submit' ] ) ) {
      $username = strip_tags( $_POST[ 'username' ] );
      $password = strip_tags( $_POST[ 'password' ] );
      $remember = ( !empty( $_POST[ 'remember_me' ] ) ? $_POST[ 'remember_me' ] : '' );

      $sql1 = "select * from candidate where username = '$username'";
      $q1 = mysqli_query( $connect, $sql1 );
      $r1 = mysqli_fetch_array( $q1 );
      $n1 = mysqli_num_rows( $q1 );
      if ( $n1 < 1 ) {
        $sql2 = "select * from candidate where email = '$username'";
        $q2 = mysqli_query( $connect, $sql2 );
        $r2 = mysqli_fetch_array( $q2 );
        $n2 = mysqli_num_rows( $q2 );
        if ( $n2 < 1 ) {
          echo '<script> alert("Username atau Email tidak ditemukan")</script>';
        } elseif ( password_verify( $password, $r2[ 'password' ] ) ) {
          $_SESSION[ 'is_login' ] = $r2[ 'username' ];
          echo "<script>document.location.href = 'dashboard.php'</script>";
        } else {
          echo '<script type="text/javascript"> alert("Password Salah")</script>';
        }
      } elseif ( password_verify( $password, $r1[ 'password' ] ) ) {
        $_SESSION[ 'is_login' ] = $r1[ 'username' ];
        echo "<script> document.location.href = 'dashboard.php'</script>";
      } else {
        echo '<script type="text/javascript"> alert("Password Salah")</script>';
      }
    }
    ?>
    <span>Username/Email :</span>
    <input type="text" placeholder="Masukan Username/Email" name="username" required>
    <span>Password :</span>
    <input type="password" placeholder="Masukan Password" name="password" required>
    <button type="submit" name="submit">Login</button>
  </form>
</div>
<div class="content-caontact">
  <section class="contac">
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.1413352854433!2d106.82952507593079!3d-6.375749062368255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec08d307e203%3A0x25e317ba5f3085d8!2sJalan%20Margonda%20Raya%20No.1%2C%20Kemiri%20Muka%2C%20Kecamatan%20Beji%2C%20Kota%20Depok%2C%20Jawa%20Barat%2016424!5e0!3m2!1sid!2sid!4v1686500870444!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"> </iframe>
    <div class="ket">
      <div class="contact-info"> <img class= "custom" src="images/ico/office.png">
        <p class="mb-0"> Jl. Margonda Raya No. 01, Pondok Cina, Beji, Kota Depok, Jawa Barat 16424 </p>
      </div>
      <div class="contact-info"> <img class="custom" src="images/ico/web.png">
        <p class="mb-0"> <a href="#" class="site-footer-link">www.tigaksatria.co.id</a> </p>
      </div>
      <div class="contact-info"> <img class="custom" src="images/ico/telepon.png">
        <p class="mb-0"> <a href="tel: 305-240-9671" class="site-footer-link">(+62) 21 - 7273 9662</a> </p>
      </div>
      <div class="contact-info"> <img class="custom" src="images/ico/email.png">
        <p class="mb-0"> <a href="mailto:info@yourgmail.com" class="site-footer-link">recruitment_legal@tigaksatria.co.id</a> </p>
      </div>
    </div>
  </section>
</div>
<script>
const navIn = document.querySelector('.in');
const navLog = document.querySelector('.nav-login');
navIn.onclick = function(){
	navLog.classList.toggle('active');
}
</script>
</body>
</html>