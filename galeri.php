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
<link rel="stylesheet" href="css/galeri.css?v=<?php echo time(); ?>"/>
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
	
<div class="conten">
	<?php
	$atas="select * from galeri where galeri = 'Slide Atas'";
	$q1 = mysqli_query($connect,$atas);
	
	while ($r1= mysqli_fetch_array($q1)){
	?>
	<img class="mySlides" src="images/gallery/<?=$r1['foto']?>" style="width:100%;display: none;background-size: cover">
	<?php
	}
	?>
</div>

<div class="conten">
	<?php
	$tengah="select * from galeri where galeri = 'Slide Tengah'";
	$q2 = mysqli_query($connect,$tengah);
	
	while ($r2= mysqli_fetch_array($q2)){
	?>
	<div class="frame"><img src="images/gallery/<?=$r2['foto']?>"></div>
	<?php
	}
	?>
</div>



<div class="container-slide">
	<h3>Activity</h3>
	<?php
	
	$bawah="select * from galeri where galeri = 'Slide Bawah'";
	$q3 = mysqli_query($connect,$bawah);
	
	while ($r3= mysqli_fetch_array($q3)){	
	?>
	<div class="slides">
    <img src="images/gallery/<?=$r3['foto']?>" style="width:100%">
  	</div>
	<?php
	}
	?>
 
<div class="cursor">
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>
</div>

  <div class="caption-container">
	<p id="caption"></p>
  </div>

  <div class="row">
	<?php
	 $keterangan="";
	$bawah="select * from galeri where galeri = 'Slide Bawah'";
	$q3 = mysqli_query($connect,$bawah);
	$no=1;
	while ($r3= mysqli_fetch_array($q3)){
		$keterangan=$r3['keterangan'];
	?>
	<div class="column">
      <img class="demo cursor" src="images/gallery/<?=$r3['foto']?>" style="width:100%" onclick="currentSlide(<?=$no++ ?>)" alt="<?php echo $keterangan?>">
    </div>
	<?php
	}
	?>  
  </div>
</div>


<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

	
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 2 seconds
}

const navIn = document.querySelector('.in');
const navLog = document.querySelector('.nav-login');
navIn.onclick = function(){
	navLog.classList.toggle('active');
}

</script>
</body>
</html>