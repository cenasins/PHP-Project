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
<link rel="stylesheet" href="css/tentang_kami.css?v=<?php echo time(); ?>"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
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
	
<div class="container">
	<div class="box">
	<div class="img col1"><h2>Sejarah Perusahaan</h2></div>
	<p>PT Tiga Ksatria Indonesia adalah perusahaan swasta nasional yang bergerak dalam bidang jasa konsultasi manajemen bisnis khususnya jasa konsultasi penyediaan sumber daya manusia dan manajemen sumber daya manusia, jasa konsultasi dalam pengurusan legalitas perusahaan, jasa konsultasi dalam pengurusan dokumen tenaga kerja asing  serta jasa dalam bidang pelatihan kerja. Latar belakang berdirinya PT Tiga Ksatria Indonesia berawal dari rangkaian pengalaman yang penuh tantangan dan tuntuan yang tinggi akan tanggung jawab serta dedikasi dalam bidang jasa oleh para pendiri dan untuk membuka lapangan kerja yang seluas-luasnya, maka PT Tiga Ksatria Indonesia didirikan pada tahun 2022. Kami merupakan satu perusahaan di Indonesia dengan pertumbuhan yang stabil seiring berjalannya waktu. Melalui kemampuan teknikal dan pengalaman kami, Kami bekerja dengan yakin, memiliki komitmen yang kuat, dukungan sumber daya manusia yang handal, mitra jaringan yang luas. Kami tidak hanya menyediakan jasa saja, namun kami lebih menekankan pada solusi, menanamkan integritas yang tinggi kepada semua personel karena dengan integritas itulah perusahaan kami dapat menjunjung tinggi moral dan etika serta menyediakan jasa terbaik dengan standar profesional yang dapat kami berikan untuk kepuasan pelanggan.</p>
	</div>
	
	<div class="box">
	<div class="img col2"><h2>Visi</h2></div>
	<p>Menjadi perusahaan swasta nasional dibidang jasa yang profesional, berintegritas dan berkualias</p>
	</div>
		
	<div class="box">
	<div class="img col3"><h2>Misi</h2></div>
	<p>Memberikan pelayanan prima dan berkomitmen sesuai dengan slogan kami "Giving The Best Solution"</p>
	</div>
	
	<div class="box2">
	<div class="head"><h2>Struktur Organisasi</h2></div>
	<div class="chart dir1">
		<div class="data">
		<div class="pic"></div>
		<h3>Abdul Ajiz</h3>
		<a>Komisaris</a>
		</div>
		<div class="data">
		<div class="pic"></div>
		<h3>David Afero</h3>
		<a>Direktur Utama</a>
		</div>
		<div class="data">
		<div class="pic"></div>
		<h3>Endang Lukman</h3>
		<a>Direktur</a>
		</div>
	</div>
	<div class="chart dir2">
		<div class="data">
		<div class="pic"></div>
		<h4>Widiya Astuti Wulandari</h4>
		<a>Finance & Accounting</a>
		</div>
		<div class="data">
		<div class="pic"></div>
		<h4>Abdul Fajar Sidik</h4>
		<a>Operational</a>
		</div>
		<div class="data">
		<div class="pic"></div>
		<h4>Ujang Badru Salam</h4>
		<a>Research & Development</a>
		</div>
		<div class="data">
		<div class="pic"></div>
		<h4>Yukio Takaki</h4>
		<a>Advisor</a>
		</div>
	</div>
	</div>
	
	<div class="box3">
	<h2>Bisnis Partner</h2>
	<div class="swiper-container">
        <div class="slider mySwiper">
            <div class="image-items swiper-wrapper">
			<?php
			$sql7   = "select * from partner ORDER BY id_partner";
        	$q7     = mysqli_query($connect,$sql7);
			$nom=1;
			while ($r7 = mysqli_fetch_array($q7)){
			$foto = $r7['partner_dir'];
			$nama = $r7['nama'];
			?>
                <div class="image swiper-slide">
					<img src="images/partner/<?php echo $foto?>" alt="">
					<a class="part"><?php echo $nama?></a>
				</div>
			<?php
			}
			?>
			</div>
            <div class="swiper-button-next arrowButton right"></div>
            <div class="swiper-button-prev arrowButton left"></div>
        </div>
    </div>
	</div>
	
	</div>
	
	
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerGroup: 1,
        loop: true,
        fade: true,
        grabCursor: true,
        loopFillGroupWithBlank: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          500: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          868: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
          1000: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
          1250: {
            slidesPerView: 5,
            spaceBetween: 30,
          },
        },
      });
	
const navIn = document.querySelector('.in');
const navLog = document.querySelector('.nav-login');
navIn.onclick = function(){
	navLog.classList.toggle('active');
}

</script>
</body>
</html>