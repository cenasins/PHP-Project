<?php
include( 'inc/config.php' ); // Koneksi ke database.
if ( $_SESSION[ 'is_login' ] == '' ) {
  header( "location:index.php" );
  exit();
}
include( 'inc/inc_select.php' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo 'Dashboard | '. $_SESSION['is_login'] ?></title>
<link rel="icon" href="images/Logo-only.svg">
<link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>"/>
</head>

<body>
<div class="setting">
  <div class="logo"> <img src="images/Logo.svg" alt="" onClick="location.href='index.php'"> </div>
  <div class="bahasa"> <a class="item-bahasa en">Inggris</a> <a class="item-bahasa id">Indonesia</a> <a class="item-bahasa jp">Jepang</a> </div>
</div>
<div class="navbar">
  <ul>
    <li><a href="index.php">Beranda</a></li>
    <li><a href="daftar_loker.php">Lowongan Kerja</a></li>
    <li><a href="konsultasi_visa.php">Konsultasi Visa</a></li>
    <li><a href="hubungi_kami.php">Hubungi Kami</a></li>
  </ul>
  <div class="akun">
    <?php
    if ( isset( $_SESSION[ 'is_login' ] ) == "" ) {
      echo '<a class="dashboard" href="daftar.php">Daftar</a>';
      echo '<a href="login.php">Login</a>';
    } else {
      echo '<a class="dash" class="dashboard" href="dashboard.php">Dashboard</a>';
      echo '<a class="out" href="inc/inc_logout.php">Hai, ' . $_SESSION[ 'is_login' ] . '</a>';
    }
    ?>
  </div>
</div>
<div class="container">
	<div id="user" style="display:none"><?=$_SESSION['is_login']?></div>
  <div class="sidenav">
    <div class="foto-profile">
      <?php
      $sql1 = "select * from profile where username = '$user'";
      $q1 = mysqli_query( $connect, $sql1 );
      if ( $r1 = mysqli_fetch_array( $q1 ) ) {
        $foto = "images/candidate/foto/" . $r1[ 'foto_dir' ];
        $alamat = $r1[ 'alamat' ];
        $tinggi = $r1[ 'tinggi_badan' ];
        $berat = $r1[ 'berat_badan' ];
        $status = $r1[ 'status_pernikahan' ];
        $darah = $r1[ 'golongan_darah' ];
        $jepang = $r1[ 'pernah_ke_jepang' ];
        $passport = $r1[ 'passport' ];
        $agama = $r1[ 'agama' ];
        $hobi = $r1[ 'hobi' ];
      } else {
        $foto = "images/defaultfoto.jpg";
        $alamat = "";
        $tinggi = "";
        $berat = "";
        $status = "";
        $darah = "";
        $jepang = "";
        $passport = "";
        $agama = "";
        $hobi = "";
      }
      ?>
      <img src="<?=$foto?>">
      <p onClick="showDashboard()">
        <?=$peg['nama']?>
      </p>
    </div>
    <div class="sidenav-menu">
      <div class="field">
        <p>0</p>
        <a>Status Lamaran</a> </div>
      <div class="field">
        <p>4</p>
        <a>Status Pengajuan Visa</a> </div>
      <div class="field">
        <p onClick="showResume()">3</p>
        <a onClick="showResume()">Edit Resume</a> </div>
      <div class="field">
        <p onClick="showProfile()">2</p>
        <a onClick="showProfile()">Edit Profile</a> </div>
    </div>
    <div class="field">
      <p onClick="location.href = 'inc/inc_logout.php'">1</p>
      <a href="inc/inc_logout.php">Logout</a> </div>
  </div>
  <div class="content">
    <section class="dashboard">
      <div class="dir">Dashboard</div>
      <div class="dashboard-container">
        <div class="flex-dashboard">
          <div class="grid-dashboard slide">
            <div class="field-btn">
              <button class="next" onClick="marginnext1()">Selanjutnya ▶️</button>
            </div>
            <div Class="judul">Profil</div>
            <table>
              <tr>
                <td class="tdprofile">Email</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php
                if ( $peg[ 'username' ] ) {
                  echo $peg[ 'email' ];
                } else {
                  echo null;
                }
                ?></td>
              </tr>
              <tr>
                <td class="tdprofile">Alamat</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $alamat?></td>
              </tr>
              <tr>
                <td class="tdprofile">Tempat, Tanggal Lahir</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php
                if ( $peg[ 'username' ] ) {
                  echo $peg[ 'tempat_lahir' ] . ' ' . $peg[ 'tanggal_lahir' ];
                } else {
                  echo null;
                }
                ?></td>
              </tr>
              <tr>
                <td class="tdprofile">Jenis Kelamin</td>
                <td class="tdspasi">:</td>
                <td><?php
                if ( $peg[ 'username' ] ) {
                  echo $peg[ 'jenis_kelamin' ];
                } else {
                  echo null;
                }
                ?></td>
              </tr>
              <tr>
                <td class="tdprofile">Tinggi Badan</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $tinggi . " cm"?></td>
              </tr>
              <tr>
                <td class="tdprofile">Berat Badan</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $berat . " kg"?></td>
              </tr>
              <tr>
                <td class="tdprofile">Agama</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $agama?></td>
              </tr>
              <tr>
                <td class="tdprofile">Status Pernikahan</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $status?></td>
              </tr>
              <tr>
                <td class="tdprofile">Golongan Darah</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $darah?></td>
              </tr>
              <tr>
                <td class="tdprofile">Pernah Ke Jepang</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $jepang?></td>
              </tr>
              <tr>
                <td class="tdprofile">Pernah Memiliki Passport</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $passport?></td>
              </tr>
              <tr>
                <td class="tdprofile">Hobi</td>
                <td class="tdspasi">:</td>
                <td class="tdisi"><?php echo $hobi?></td>
              </tr>
            </table>
          </div>
          <div class="grid-dashboard">
            <div class="field-btn">
              <button class="prev" onClick="marginprev1()">◀️ Sebelumnya</button>
              <button class="next" onClick="marginnext2()">Selanjutnya ▶️</button>
            </div>
            <div class="judul">Edukasi</div>
            <table border="1">
              <thead>
                <tr>
                  <th class="col1">Nama Sekolah</th>
                  <th class="col1">Jurusan</th>
                  <th class="col2">tanggal Masuk</th>
                  <th class="col2">Tanggal keluar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ( $r2 = mysqli_fetch_array( $q2 ) ) {
                  echo "<tr>";
                  echo "<td>" . $r2[ 'SD' ] . "</td>";
                  echo "<td>" . $r2[ 'jurusan_sd' ] . "</td>";
                  echo "<td>" . $r2[ 'mulai_sd' ] . "</td>";
                  echo "<td>" . $r2[ 'lulus_sd' ] . "</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td>" . $r2[ 'SMP' ] . "</td>";
                  echo "<td>" . $r2[ 'jurusan_smp' ] . "</td>";
                  echo "<td>" . $r2[ 'mulai_smp' ] . "</td>";
                  echo "<td>" . $r2[ 'lulus_smp' ] . "</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td>" . $r2[ 'SLTA' ] . "</td>";
                  echo "<td>" . $r2[ 'jurusan_slta' ] . "</td>";
                  echo "<td>" . $r2[ 'mulai_slta' ] . "</td>";
                  echo "<td>" . $r2[ 'lulus_slta' ] . "</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td>" . $r2[ 'kuliah' ] . "</td>";
                  echo "<td>" . $r2[ 'jurusan_kuliah' ] . "</td>";
                  echo "<td>" . $r2[ 'mulai_kuliah' ] . "</td>";
                  echo "<td>" . $r2[ 'lulus_kuliah' ] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
            <div Class="judul">Pengalaman Kerja</div>
            <div class="kotak">
              <table border="1">
                <thead>
                  <tr>
                    <th class="col2">No</th>
                    <th class="col1">Nama Perusahaan</th>
                    <th class="col1">Posisi</th>
                    <th class="col2">Mulai Kerja</th>
                    <th class="col2">Akhir Kerja</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  while ( $r3 = mysqli_fetch_array( $q3 ) ) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $r3[ 'perusahaan' ] . "</td>";
                    echo "<td>" . $r3[ 'posisi' ] . "</td>";
                    echo "<td>" . $r3[ 'mulai_kerja' ] . "</td>";
                    echo "<td>" . $r3[ 'selesai_kerja' ] . "</td>";
                    echo "</tr>";
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div Class="judul">Sertifikat</div>
            <div class="kotak">
              <table border="1">
                <thead>
                  <tr>
                    <th class="col2">No</th>
                    <th class="col1">Sertifikat</th>
                    <th class="col1">Deskripsi</th>
                    <th class="col2">Tanggal Terbit</th>
                    <th class="col2">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $numb = 1;
                  while ( $r4 = mysqli_fetch_array( $q4 ) ) {
                    echo "<tr>";
                    echo "<td>" . $numb . "</td>";
                    echo "<td>" . $r4[ 'sertifikat' ] . "</td>";
                    echo "<td>" . $r4[ 'deskripsi' ] . "</td>";
                    echo "<td>" . $r4[ 'terbit' ] . "</td>";
                    if ( $r4[ 'dir_sertifikat' ] ) {
                      echo "<td>✅</td>";
                    } else {
                      echo "<td>❌</td>";
                    }
                    echo "</tr>";
                    $numb++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="grid-dashboard slide">
            <div class="field-btn">
              <button class="prev" onClick="marginprev2()">◀️ Sebelumnya</button>
            </div>
            <div class="judul">Tujuan Pekerjaan</div>
            <table border="1">
              <thead>
                <tr>
                  <th class="col1">Lokasi</th>
                  <th class="col1">Tipe Pekerjaan</th>
                  <th class="col1">Kategori Pekerjaan</th>
                  <th class="col1">Resume</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ( $r5 = mysqli_fetch_array( $q5 ) ) {
                  echo "<tr>";
                  echo "<td>" . $r5[ 'lokasi' ] . "</td>";
                  echo "<td>" . $r5[ 'tipe_pekerjaan' ] . "</td>";
                  echo "<td>" . $r5[ 'kategori_pekerjaan' ] . "</td>";
                  if ( $r5[ 'resume_dir' ] ) {
                    echo "<td>✅</td>";
                  } else {
                    echo "<td>❌</td>";
                  }
                  echo "</tr>";
                  ?>
                <tr>
                  <th style="background-color: #45C8FE; color: white" colspan="6">Skill</th>
                </tr>
                <tr>
                  <td colspan="6"><?php echo $r5['skill']?></td>
                </tr>
                <tr>
                  <th style="background-color: #45C8FE; color: white" colspan="6">Motivasi Ingin Bekerja Di Jepang</th>
                </tr>
                <tr>
                  <td colspan="6"><?php echo $r5['motivasi']?></td>
                </tr>
                <tr>
                  <th style="background-color: #45C8FE; color: white" colspan="6">Alasan Melamar Pekerjaan Ini</th>
                </tr>
                <tr>
                  <td colspan="6"><?php echo $r5['alasan']?></td>
                </tr>
                <tr>
                  <th style="background-color: #45C8FE; color: white" colspan="6">Promosi Diri</th>
                </tr>
                <tr>
                  <td colspan="6"><?php echo $r5['promosi']?></td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <section class="edit-resume">
      <div class="dir">Dashboard/Edit Resume</div>
      <div class="progressbar">
        <div class="step">
          <div class="bullet dot1">
            <div class="number">1</div>
            <div class="check" style="display: none">&check;</div>
          </div>
          <div class="strip line1"></div>
          <div class="bullet dot2">
            <div class="number">2</div>
            <div class="check" style="display: none">&check;</div>
          </div>
          <div class="strip line2"></div>
          <div class="bullet dot3">
            <div class="number">3</div>
            <div class="check" style="display: none">&check;</div>
          </div>
        </div>
        <div class="step">
          <div class="ju jud1">Profile & Pendidikan</div>
          <div class="ju jud2">Pekerjaan & Sertifikasi</div>
          <div class="ju jud3">Tujuan Kerja & Deskripsi</div>
        </div>
      </div>
      <div class="outer">
        <form method="post" enctype="multipart/form-data" action="inc/submit.php">
          <div class="inner">
            <div class="konten">
              <div class="gridcontent con1">
                <div class="label">Alamat</div>
                <textarea class="input" rows="4" cols="50" name="address" style="resize:none"></textarea>
                <div class="label">Tinggi Badan</div>
                <input type="number" name="height">
                <span>cm</span>
                <div class="label">Berat Badan</div>
                <input type="number" name="weight">
                <span>kg</span>
                <div class="label">Agama</div>
                <select name="religion">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Christian</option>
                  <option value="Budha">Buddha</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Lainya">Other</option>
                </select>
                <div class="label">Status Pernikahan</div>
                <select name="marital">
                  <option value="Belum Menikah">Single</option>
                  <option value="Menikah">Menikah</option>
                  <option value="Bercerai">Cerai</option>
                </select>
              </div>
              <div class="gridcontent con2">
                <div class="label">Golongan Darah</div>
                <div class="gender-details">
                  <input type="radio" name="blood" id="dot-1" value="A">
                  A
                  <input type="radio" name="blood" id="dot-2" value="B">
                  B
                  <input type="radio" name="blood" id="dot-3" value="AB">
                  AB
                  <input type="radio" name="blood" id="dot-4" value="O">
                  O </div>
                <div class="label">Pernah Ke Jepang</div>
                <div class="gender-details">
                  <input type="radio" name="japan" id="dot-5" value="Pernah">
                  Ya
                  <input type="radio" name="japan" id="dot-6" value="Tidak Pernah">
                  Tidak </div>
                <div class="label">Pernah Memiliki Passport</div>
                <div class="gender-details">
                  <input type="radio" name="passport" id="dot-7" value="Pernah">
                  Ya
                  <input type="radio" name="passport" id="dot-8" value="Tidak Pernah">
                  Tidak </div>
                <div class="label">Hobi & Minat</div>
                <textarea class="input" rows="4" cols="50" name="hobi" style="resize:none"></textarea>
                <div class="label">Pas Foto Upload</div>
                <input type="file" class="myFile" name="foto">
              </div>
            </div>
            <div class="field-btn">
              <input type="button" class="nextprev" id="next-1" value="Next">
            </div>
          </div>
          <div class="inner">
            <div class="konten">
              <div class="gridcontent con3">
                <table>
                  <thead>
                    <tr>
                      <td class="label">Pendidikan</td>
                    </tr>
                    <tr>
                      <td colspan="2">Periode</td>
                      <td>Nama Sekolah</td>
                      <td>Jurusan</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="month" name="sdmulai"></td>
                      <td><input type="month" name="sdakhir"></td>
                      <td><input type="text" name="sd" placeholder="SD"></td>
                      <td><input type="text" name="sdjurusan" placeholder=""></td>
                    </tr>
                    <tr>
                      <td><input type="month" name="smpmulai"></td>
                      <td><input type="month" name="smpakhir"></td>
                      <td><input type="text" name="smp" placeholder="SMP"></td>
                      <td><input type="text" name="smpjurusan" placeholder=""></td>
                    </tr>
                    <tr>
                      <td><input type="month" name="sltamulai"></td>
                      <td><input type="month" name="sltaakhir"></td>
                      <td><input type="text" name="slta" placeholder="SMA/SMK"></td>
                      <td><input type="text" name="sltajurusan" placeholder="Jurusan"></td>
                    </tr>
                    <tr>
                      <td><input type="month" name="kuliahmulai"></td>
                      <td><input type="month" name="kuliahakhir"></td>
                      <td><input type="text" name="kuliah" placeholder="Kuliah"></td>
                      <td><input type="text" name="kuliahjurusan" placeholder="Jurusan"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="gridcontent con4">
                <div class="label">Pengalaman Kerja</div>
				<div class="table" id="insert-form">
				  <button type="button" id="btn-tambah-form">Tambah Pekerjaan ➕</button>
				  <button type="button" id="btn-reset-form">Reset 🔄️</button>
				  <span class="periode">Periode</span>
				  <span class="nama-perusahaan">Nama Perusahaan</span>
				  <span class="deskripsi-perusahaan">Deskripsi Pekerjaan</span>
				<input type="text" name="pengguna[]" value="<?=$peg['username']?>" hidden="true">
				<input type="month" name="mulai[]">
				<input type="month" name="akhir[]">
				<input type="text" name="perusahaan[]">
				<input type="text" name="posisi[]">
				</div>
              </div>
              <div class="gridcontent con5">
               <div class="label">Sertifikasi</div>
				<div class="table" id="insertcertificate">
				  <button type="button" id="btn-tambah">Tambahakan Sertifikat ➕</button>
				  <button type="button" id="btn-reset">Reset 🔄️</button>
				  <span>Terbit</span>
				  <span>Sertifikat</span>
				  <span class="periode">Keterangan</span>
				  <input type="text" name="nami[]" hidden="true" value="<?=$peg['username']?>">
				  <input type="date" name="issue[]">
				  <input type="text" name="certificate[]">
				  <input type="text" name="deskripsi[]">
				  <input type="file" class="myFile" name="filecertificate[]">
				</div>
              </div>
            </div>
            <div class="field-btn">
              <input type="button" class="nextprev" id="prev-2" value="Prev">
              <input type="button" class="nextprev" id="next-2" value="Next">
            </div>
          </div>
          <div class="inner">
            <div class="konten">
              <div class="gridcontent con6">
                <div class="field">
                  <div class="label">Lokasi Kerja</div>
                  <select class="country" name="country">
                    Pilih Negara
					
                    <option disabled selected hidden>Pilih...</option>
                    <option>Jepang</option>
                    <option>Indoesia</option>
                  </select>
                  <div class="label">Kategori Pekerjaan</div>
                  <select class="type" name="jobcategory">
                    Pilih Kategori Pekerjaan
					
                    <option value="" disabled selected hidden>Pilih...</option>
                    <option>Engineering</option>
                    <option>SSW</option>
                  </select>
                  <div class="label">Resume Upload</div>
                  <input type="file" class="myFile" name="resume">
                </div>
                <div class="field">
                  <div class="label">Jenis Pekerjaan</div>
                  <select class="job" name="jobtype">
                    Pilih Jenis Pekerjaan
                  </select>
                </div>
              </div>
              <div class="gridcontent con7">
                <div class="label">Keahlian Penunjang Pekerjaan Yang Dipilih</div>
                <textarea class="input" rows="4" cols="50" name="skill" ></textarea>
                <div class="label">Motivasi Bekerja Di jepang</div>
                <textarea class="input" rows="4" cols="50" name="motivation" ></textarea>
              </div>
              <div class="gridcontent con8">
                <div class="label">Alasan Memilih Pekerjaan Ini</div>
                <textarea class="input" rows="4" cols="50" name="reason" ></textarea>
                <div class="label">Promosi Diri</div>
                <textarea class="input" rows="4" cols="50" name="promote" ></textarea>
              </div>
            </div>
            <div class="field-btn">
              <input type="button" class="nextprev" id="prev-3" value="Prev">
              <input type="submit" class="btn" id="submit" name="submit" value="Save">
            </div>
          </div>
        </form>
      </div>
    </section>
    <section class="edit-profile">
      <div class="dir">Dashboard/Edit Profile</div>
      <form method="post" class="edit-profile-container" action="inc/inc_register.php?user=<?=$peg['username']?>">
        <div class="basic">
          <h3>Profile</h3>
          <div class="field">
            <div>Nama Lengkap :</div>
            <input type="text" name="fullname" value="<?=$peg['nama']?>">
          </div>
          <div class="field">
            <div>Tempat Lahir :</div>
            <input type="text" name="birthplace" value="<?=$peg['tempat_lahir']?>">
          </div>
          <div class="field">
            <div>Tanggal Lahir :</div>
            <input type="date" name="birthdate" value="<?=$peg['tanggal_lahir']?>">
          </div>
          <div class="field">
            <div>Jenis Kelamin :</div>
            <?php
            if ( $peg[ 'jenis_kelamin' ] == "Laki-Laki" ) {
              echo '<input name="gender" type="radio" checked value="Laki-Laki">Laki - Laki';
              echo '<input name="gender" type="radio" value="Perempuan">Perempuan';
            } else {
              echo '<input name="gender" type="radio" value="Laki-Laki">Laki - Laki';
              echo '<input name="gender" type="radio" checked value="Perempuan">Perempuan';
            }
            ?>
          </div>
          <button type="submit" name="update">Simpan</button>
        </div>
        <div class="acount">
          <h3>Akun</h3>
          <div class="field">
            <div>Email :</div>
            <input type="email" value="<?=$peg['email']?>" disabled>
          </div>
          <div class="field">
            <div>Password Lama:</div>
            <input type="Password" name="password_lama">
          </div>
          <div class="field">
            <div>Password Baru:</div>
            <input type="Password" name="password">
          </div>
          <button type="submit" name="update_password">Ganti Password</button>
        </div>
      </form>
    </section>
  </div>
</div>
<script type="text/javascript">
const btnTambah = document.getElementById('btn-tambah-form')
	const btnReset = document.getElementById('btn-reset-form')
	const insert = document.getElementById('insert-form')
	var jumlah = document.getElementById('jumlah-form')

btnTambah.onclick = function(){
	Element.prototype.setAttributes = function (attrs) {
    for (var idx in attrs) {
        if ((idx == 'styles' || idx == 'style') && typeof attrs[idx] == 'object') {
            for (var prop in attrs[idx]){this.style[prop] = attrs[idx][prop]}
        } else if (idx == 'html') {
            this.innerHTML = attrs[idx]
        } else {
            this.setAttribute(idx, attrs[idx]);
        }
    }
};
	
	const user = document.getElementById("user");
	const data = user.textContent;
	
	var inputPengguna = document.createElement('input');
	inputPengguna.setAttributes({
		'type':'text',
		'name':'pengguna[]',
		'value': data,
		'hidden': 'true'
	});
	var inputMulai = document.createElement('input');
	inputMulai.setAttributes({
		'type':'month',
		'name':'mulai[]'
	});
	var inputAkhir = document.createElement('input');
	inputAkhir.setAttributes({
		'type':'month',
		'name':'akhir[]'
	});
	var inputPerusahaan = document.createElement('input');
	inputPerusahaan.setAttributes({
		'type':'text',
		'name':'perusahaan[]'
	});
	var inputPosisi = document.createElement('input');
	inputPosisi.setAttributes({
		'type':'text',
		'name':'posisi[]'
	});
	insert.appendChild(inputPengguna);
	insert.appendChild(inputMulai);
	insert.appendChild(inputAkhir);
	insert.appendChild(inputPerusahaan);
	insert.appendChild(inputPosisi);
}
btnReset.onclick = function (){
	var tag = document.querySelectorAll('#insert-form input');
	for(let i=0;i<(tag.length - 5) ;i++){
		insert.removeChild(tag[i])
	}
}

const Tambah = document.getElementById('btn-tambah')
const Reset = document.getElementById('btn-reset')
const insertCer = document.getElementById('insertcertificate')
Tambah.onclick = function(){
	Element.prototype.setAttributes = function (attrs) {
    for (var idx in attrs) {
        if ((idx == 'styles' || idx == 'style') && typeof attrs[idx] == 'object') {
            for (var prop in attrs[idx]){this.style[prop] = attrs[idx][prop]}
        } else if (idx == 'html') {
            this.innerHTML = attrs[idx]
        } else {
            this.setAttribute(idx, attrs[idx]);
        }
    }
};
	
	const user = document.getElementById("user");
	const data = user.textContent;
	
	var inputNami = document.createElement('input');
	inputNami.setAttributes({
		'type':'text',
		'name':'nami[]',
		'value': data,
		'hidden': 'true'
	});
	var inputIssue = document.createElement('input');
	inputIssue.setAttributes({
		'type':'date',
		'name':'issue[]'
	});
	var inputCertificate = document.createElement('input');
	inputCertificate.setAttributes({
		'type':'text',
		'name':'certificate[]'
	});
	var inputDeskripsi = document.createElement('input');
	inputDeskripsi.setAttributes({
		'type':'text',
		'name':'deskripsi[]'
	});
	var inputFile = document.createElement('input');
	inputFile.setAttributes({
		'type':'file',
		'class':'myFile',
		'name':'filecertificate[]'
	});
	insertCer.appendChild(inputNami);
	insertCer.appendChild(inputIssue);
	insertCer.appendChild(inputCertificate);
	insertCer.appendChild(inputDeskripsi);
	insertCer.appendChild(inputFile);
}
Reset.onclick = function (){
	var tag = document.querySelectorAll('#insertcertificate input');
	for(let i=0;i<(tag.length - 5) ;i++){
		insertCer.removeChild(tag[i])
	}
}	
</script> 
<script src="js/dashboard.js?v=<?php echo time(); ?>"></script>
</body>
</html>