<?php
include ('inc/config.php');
function limitTextWords($content = false, $limit = false, $stripTags = false, $ellipsis = false) 
{
    if ($content && $limit) {
        $content = ($stripTags ? strip_tags($content) : $content);
        $content = explode(' ', $content, $limit+1);
        array_pop($content);
        if ($ellipsis) {
            array_push($content, '...');
        }
        $content = implode(' ', $content);
    }
    return $content;
}
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
?>
<!doctype html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tiga Ksatria Indonesia</title>
<link rel="icon" href="images/Logo-only.svg">
<link rel="stylesheet" href="css/daftar_loker.css?v=<?php echo time(); ?>"/>
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
	
<div class="container">
		<div class="pencarian">
			<h1>Cari Lowongan Kerja</h1>
			<a>Temukan pekerjaan yang mungkin Anda minati.</a>
			<form method="get">
				<input type="text" class="cari" placeholder="Cari Judul atau Kategori Pekerjaan">
				<button class="btncari" name="cari">&#128269;</button>
			</form>
		</div>
		
		<div class="pekerjaan">
			<div class="dir">Dashboard/Pencarian Lowongan Kerja</div>
		<?php
        $sqltambahan = "";
        $per_halaman = 5;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(judul like '%" . $array_katakunci[$x] . "%' or kutipan like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan    = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "select * from loker $sqltambahan";
        $page   = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1     = mysqli_query($connect,$sql1);
        $total  = mysqli_num_rows($q1);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1." order by id_loker desc limit $mulai,$per_halaman";

        $q1     = mysqli_query($connect, $sql1);
      
        while ($r1 = mysqli_fetch_array($q1)) {
			$kategori_pekerjaan = $r1['kategori'];
			$judul_pekerjaan = $r1['judul_pekerjaan'];
			$lokasi = $r1['lokasi'];
			$gaji = $r1['gaji'];
			$deskripsi = $r1['deskripsi_pekerjaan'];
			$icon = $r1['icon_dir'];
			$date = $r1['tanggal_post'];
			$foto = $r1['illustrasi_dir'];
        ?>
			<div class="list" value="<?php echo $nomor++ ?>">
				<div class="icon"><img src="images/loker/logo/<?=$icon?>"></div>
				<div class="judul"><?php echo $judul_pekerjaan;?></div>
				<div class="ico-lok"><img src="images/ico/location.svg"></div>
				<div class="text1">Lokasi</div>
				<div class="lok"><?php echo $lokasi;?></div>
				<div class="deskripsi"><?php echo limitTextWords($deskripsi, 30, true, true);;?></div>
				<div class="ico-tanggal"><img src="images/ico/time.svg"></div>
				<div class="text2">Tanggal Post</div>
				<div class="tanggal"><?php echo $date;?></div>
				<div class="kategori"><?php echo $kategori_pekerjaan;?></div>
				<div class="ico-gaji"><img src="images/ico/money.svg"></div>
				<div class="text3">Gaji</div>
				<div class="gaji"><?php echo $gaji;?></div>
				<div class="tombol">
					<button class="show" onClick="window.open('tampil_loker.php?id_loker=<?=$r1['id_loker']?>')">Tampilkan</button>
					<button class="simpan">Simpan &#128278;</button>
				</div>
			</div>
		<?php
		}
		?>
		</div>
		<nav aria-label="Page navigation example" style="display: flex; background-color: #45C8FE; border-radius: 50px; padding: 10px; margin-bottom: 20px;">
    	<?php
		echo "<ul class='pagination' style='display: flex'>";

		for ($i=1; $i<=$pages; $i++) {
		echo "<a href='daftar_loker.php?page=".$i."'>".$i."-</a>";
		}
		if($page>1){
		echo "<li style='list-style-type:none;margin-left:10px;'>";
		if($page>2){
		echo "<a href='daftar_loker.php?page=".($page-1)."'class='button'>Previous</a>";
		}else{
		echo "<a href='daftar_loker.php' class='button'>Previous</a>";}
		echo "</li>";}
		echo "<li style='list-style-type:none;margin-left:10px;'><a href='daftar_loker.php?page=".($page+1)."' class='button'>Next</a></li>";
	
		echo "</ul>"; 
		?>
		</nav>
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
