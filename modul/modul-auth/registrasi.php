<head>
    <title>.: Registrasi :.</title>
</head>
<?php include('../../configuration/koneksi.php'); 
if(isset($_POST['daftar'])){
    @session_start();
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];

    $u = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username'");
    $r = mysqli_num_rows($u);
    if($r == 1){
        ?> 
            <div class="alert alert-danger" role="alert">
                Username Telah Digunakan ! Coba Gunakan Username Lainnya
            </div>
        <?php
    }else{
        $q = mysqli_query($con, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) VALUES ('$nik', '$nama', '$username', '$password', '$telp');");
    ?> 
        <div class="alert alert-success" role="alert">
            Anda Telah Berhasil Mendaftar, Silahkan Tunggu Verifikasi dari Petugas !
        </div>
    <?php
    }
    
}
?>
<?php include('../../assets/head.php') ?>

<body class="bg-secondary">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card w-100" style="margin-top: 15%">
                    <div class="card-header pt-3 text-white text-center" style="background-color: darkcyan;">
                        <p class="fs-5 fw-bold">.: REGISTRASI :.</p>
                    </div>
                    <div class="card-body mt-4">
                        <form action="" method="POST">
                            <div class="row mb-3">
                                <label for="nik" class="col-3 form-label">NIK</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK sesuai KTP" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-3 form-label">Nama</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama sesuai KTP" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-3 form-label">Username</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username..." required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-3 form label">Password</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telp" class="col-3 form-label">Nomor Telpon</label>
                                <div class="col-9">
                                    <input type="number" class="col-3 form-control" id="telp" name="telp" placeholder="Masukan Nomor Telpon" required>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                <button type="submit" class="btn w-100 text-white" name="daftar" id="daftar" style="background-color: darkcyan;">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center">Sudah punya akun? silahkan Masuk <a href="index.php" class="text-decoration-none">disini</a>!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../../assets/body.php') ?>
</body>