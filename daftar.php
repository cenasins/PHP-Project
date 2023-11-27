<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registrasi</title>
<link rel="icon" href="images/Logo-only.svg">
<link rel="stylesheet" href="css/daftar.css?v=<?php echo time(); ?>"/>
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
</div>
	
	<div class="container">
		<div class="title">
		Register
		</div>
		<form action="inc/inc_register.php" method="POST">
		<div class="horizon">
		<div class="wraper">
        	<div class="label">Full Name :</div>
            <input type="text" name="fullname" required>
			<div class="label">Birth Place :</div>
			<input type="text" name="birthplace" required>	
			<div class="label">Date Of Birth :</div>
            <input type="date" name="birthdate" required>
			<div class="label">Gender :</div>
			<div class="gender-details">
				<input type="radio" name="gender" id="dot-1" value="Laki-Laki">
				<input type="radio" name="gender" id="dot-2" value="Perempuan">
				<div class="category">
				<label for="dot-1">
				<span class="dot one"></span>
				<span class="gender">Male</span>
				</label>
				<label for="dot-2">
				<span class="dot two"></span>
				<span class="gender">Female</span>
				</label>
				</div>									  
			</div>
		</div>
		<div class="wraper">
            <div class="label">Email :</div>
            <input type="text" name="email" required>
            <div class="label">Username :</div>
            <input type="text" name="user" required>
            <div class="label">Password :</div>
            <input type="password" name="password" class="pw" required>
			<div class="label">Password Confirmation :</div>
            <input type="password" name="confirm" class="conpw" required>
		</div>
		</div>
			<div class="notice">
			<p style="color: yellow;">Notice!</p>
			<input type="checkbox" onchange="document.getElementById('sendNewSms').disabled = !this.checked;">  
			<span class="span-notice">By checking this box, you state that you have read, understood and agreeing to our terms of service and conditions.
			</span> 
			</div>
			<button class="signup-btn" id="sendNewSms" type="submit" name="submit" onclick="klik()" disabled>Sign Up</button>
		</form>
		<div class="message validasi" id="validasi">&check;</div>
		<div class="message confirm" id="confirm">&check;</div>
		<div class="bubble">
			<p>Password must contain the following :</p>
			<p>lowercase/uppercase letter,number,minimum 6 characters</p>
		</div>
	</div>

<script src="js/daftar.js"></script>
</body>
</html>
