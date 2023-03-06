<title>
  .: Profile :.
</title>
<?php include('../../configuration/koneksi.php');
include('../../assets/head.php'); 
@session_start();
if($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin'){
    @header('location:../modul-petugas/');
}
?>
<body>
<?php
  include('../../assets/navbar.php')
?>

</aside>
<main id="main" class="main">
    <div class="card">
    <ul class="list-group">
    <div class="alert alert-primary" role="alert">
    Selamat Datang <?= $_SESSION['nama'] ?>
    </div>
    <?php 
        $nik = $_SESSION['nik'];
        $q = mysqli_query($con, "SELECT * FROM masyarakat WHERE nik = '$nik'");
        $o = mysqli_fetch_object($q);

        ?> 
            <li class="list-group-item">NIK : <?= $o -> nik ?></li>
            <li class="list-group-item">Nama : <?= $o -> nama ?></li>
            <li class="list-group-item">Username : <?= $o -> username ?></li>
            <li class="list-group-item">Nomor Telpon : <?= $o -> telp ?></li>
        <?php
    ?>
    </ul>
    </div>

</main>

  <?php 
  include('../../assets/body.php');
  ?>

</body>

</html>