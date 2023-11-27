<?php
ob_start();
include( 'inc/config.php' );
if ( isset( $_SESSION[ 'is_login' ] ) != '' ) {
	header('location:dashboard.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tiga Ksatria Indonesia</title>
<link rel="icon" href="images/Logo-only.svg">
<link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>"/>
</head>

<body>
<a href="https://api.whatsapp.com/send?phone=6283866752280&text=Halo." class="float" target="_blank"><img src="images/ico/whatsapp.svg" class="my-float"></a>
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
		if(isset($_SESSION['is_login'])==""){
			echo '<a class="daftar" href="daftar.php">Daftar</a>';
			echo '<a class="in">Login</a>';
		}else{
			echo '<a class="dash" class="dashboard" href="dashboard.php">Dashboard</a>';
			echo '<a class="out" href="inc/inc_logout.php">Hai, '.$_SESSION['is_login'].'</a>';
		}
		?>
	</div>
	<form method="post" class="nav-login">
		<span>Username/Email :</span>
		<input type="text" placeholder="Masukan Username/Email" name="username" required>
		<span>Password :</span>
		<input type="password" placeholder="Masukan Password" name="password" required>
		<button type="submit" name="submit">Login</button>
	</form>
</div>
<div class="container">
  <div class="content login">
    <form method="post">
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
      <div class="container-login">
        <label>Username/Email : </label>
        <input type="text" placeholder="Masukan Username/Email" name="username" required>
        <label>Password : </label>
        <input type="password" placeholder="Masukan Password" name="password" required>
        <button type="submit" name="submit">Login</button>
        <input type="checkbox" checked="checked" name="remember_me">
        Ingat Saya
        <button type="button" class="cancelbtn">Batal</button>
        Lupa <a href="/en" class="forgot"> Password? </a>
        <center>
          <h5>-------------------------------- atau --------------------------------</h5>
        </center>
        <button type="button" onClick="location.href='daftar.php';" class="registerbutton">Daftar</button>
      </div>
    </form>
  </div>
  <div class="content loker">
    <div class="field">
      <div class="list-title"></div>
      <div class="title">Loker Terbaru</div>
    </div>
    <div class="slide">
      <div class="list">
        <?php
        $sql7 = "select * from loker ORDER BY id_loker DESC LIMIT 8";
        $q7 = mysqli_query( $connect, $sql7 );
        $nom = 1;
        while ( $r7 = mysqli_fetch_array( $q7 ) ) {
          $kategori_pekerjaan = $r7[ 'kategori' ];
          $judul_pekerjaan = $r7[ 'judul_pekerjaan' ];
          $lokasi = $r7[ 'lokasi' ];
          $gaji = $r7[ 'gaji' ];
          $deskripsi = $r7[ 'deskripsi_pekerjaan' ];
          $icon = $r7[ 'icon_dir' ];
          $date = $r7[ 'tanggal_post' ];
          $foto = $r7[ 'illustrasi_dir' ];
          ?>
        <div class="card" value="<?php echo $nom++;?>">
          <div class="descr"><img src="images/loker/foto/<?=$foto?>"></div>
          <div class="titl"><?php echo $judul_pekerjaan;?></div>
          <div class="flexi">
            <div class="log"><img src="images/loker/logo/<?=$icon?>"></div>
            <span class="nam"><?php echo $kategori_pekerjaan;?></span>
            <div class="ico"><img src="images/ico/bookmark.svg"></div>
          </div>
          <div class="flexi">
            <div class="loc"> <img src="images/ico/location.svg"> <span><?php echo $lokasi;?></span> </div>
            <div class="time"> <img src="images/ico/time.svg"> <span><?php echo $date;?></span> </div>
          </div>
          <div class="flexi">
            <div class="salary"> <img src="images/ico/money.svg"> <span><?php echo $gaji;?></span> </div>
            <div class="apply">
              <button onClick="window.open('tampil_loker.php?id_loker=<?=$r7['id_loker']?>')">Tampilkan</button>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
      </div>
      <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
  </div>
 <div class="content tentang">
    <div class="about">
      <div class="field">
        <div class="list-title"></div>
        <div class="title">Tentang Kami</div>
      </div>
      <h2>PT TIGA KSATRIA INDONESIA</h2>
      <h4>Giving The Best Solutions</h4>
      <p> PT Tiga Ksatria Indonesia merupakan bentuk perusahaan yang bergerak dalam bidang jasa, khususnya jasa konsultasi pengurusan legalitas perusahaan, pengurusan visa, izin tenaga kerja asing serta penyediaan sumber daya manusia. </p>
      <a href="about_us.php" class="btn-about">Selengkapnya Tentang Kami</a> </div>
    <div class="gallery">
      <div class="field">
        <div class="list-title"></div>
        <div class="title">Galeri</div>
      </div>
      <div class="container-slide">
        <?php

        $bawah = "select * from galeri where galeri = 'Slide Bawah'";
        $q3 = mysqli_query( $connect, $bawah );

        while ( $r3 = mysqli_fetch_array( $q3 ) ) {
          ?>
        <div class="slides"> <img src="images/gallery/<?=$r3['foto']?>" style="width:100%"> </div>
        <?php
        }
        ?>
        <div class="cursor"> <a class="prev" onclick="plusSlides(-1)">❮</a> <a class="next" onclick="plusSlides(1)">❯</a> </div>
        <div class="caption-container">
          <p id="caption"></p>
        </div>
        <div class="row">
          <?php
          $keterangan = "";
          $bawah = "select * from galeri where galeri = 'Slide Bawah'";
          $q3 = mysqli_query( $connect, $bawah );
          $no = 1;
          while ( $r3 = mysqli_fetch_array( $q3 ) ) {
            $keterangan = $r3[ 'keterangan' ];
            ?>
          <div class="column"> <img class="demo cursor" src="images/gallery/<?=$r3['foto']?>" style="width:100%" onclick="currentSlide(<?=$no++ ?>)" alt="<?php echo $keterangan?>"> </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>

<div class="content kontak">
	  <div class="contact">
		  <img src="images/Logo.svg" class="logo-footer">
      <div class="icon">
		  <img src="images/ico/web.png">
		  <a href="index.php">www.tigaksatria.co.id</a>
		</div>
      <div class="icon">
		  <img src="images/ico/telepon.png">
		  <a>(+62)21 - 7273 9662</a>
		  </div>
      <div class="icon">
		  <img src="images/ico/email.png">
		  <a href="mailto:recruitment_legal@tigaksatria.co.id">recruitment_legal@tigaksatria.co.id</a>
	</div>
    </div>
    <div class="company"> <b>Site Map</b>
      <a href="index.php">Beranda</a>
      <a href="tentang_kami.php">Tentang Kami</a>
      <a>Layanan Kami</a>
      <li><a href="daftar_loker.php">Pencarian Kerja</a></li>
      <li><a href="konsultasi_visa.php">Konsultasi Visa</a></li>
      <li><a href="pencarian_kandidat.php">Pencari Kandidat</a></li>
      <a href="galeri.php">Galeri</a>
      <a href="hubungi_kami.php">Hubungi Kami</a>
    </div>
    <div class="languange"> <b>Bahasa</b>
      <a href="">Bahasa Inggris</a>
      <a href="">Bahasa Indonesia</a>
      <a href="">Bahasa Jepang</a>
    </div>
    <div class="notify">
      <h3>Ikuti Perkembangan Kami</h3>
      <div class="notify-col">
        <h3>Dapatkan Notifikasi Pembaruan</h3>
        <input type="email" class="email" placeholder="email@example.com">
      </div>
    </div>
  </div>
	  
  <div class="content footer">
    <div>Copyright &#169; PT TIGA KSATRIA INDONESIA</div>
    <a class="police" href="police">Privacy Policy</a> <a class="term" href="term">Terms</a> </div>
</div>

</div>
<script src="js/index.js?v=<?php echo time(); ?>"></script>
</body>
</html>