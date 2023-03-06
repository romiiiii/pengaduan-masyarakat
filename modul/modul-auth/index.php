<head>
    <title>.: Login :.</title>
</head>
<?php include('../../configuration/koneksi.php'); 
if(isset($_POST['masuk'])){
    $pilihan = $_POST['role'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if($pilihan == 'masyarakat'){
        $q = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username' AND password='$password' AND verif = '1'");
        $r = mysqli_num_rows($q);
        if($r == 1){
            $o = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $o -> username;
            $_SESSION['password'] = $o -> password;
            $_SESSION['nik'] = $o -> nik;
            $_SESSION['nama'] = $o -> nama;
            $_SESSION['telp'] = $o -> telp;
            $_SESSION['level'] = $o -> level;
            @header('location:../modul-masyarakat/');
        }else{ ?>
            <div class="alert alert-danger" role="alert">
                Data Salah atau belum diverifikasi !
            </div>
            <?php
        }
    }elseif($pilihan == 'petugas'){
        $q = mysqli_query($con, "SELECT * from petugas WHERE username='$username' AND password='$password'");
        $r = mysqli_num_rows($q);
        @session_start();
        if($r == 1){
            $o = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $o -> username;
            $_SESSION['password'] = $o -> password;
            $_SESSION['id_petugas'] = $o -> id_petugas;
            $_SESSION['nama_petugas'] = $o -> nama_petugas;
            $_SESSION['telp'] = $o -> telp;
            $_SESSION['level'] = $o -> level;
            @header('location:../modul-petugas/');
        }else{ ?> 
            <div class="alert alert-danger" role="alert">
                Pastikan Data yang Anda Masukan Benar !
            </div>
            <?php
        }
    }
}
?>

<?php include('../../assets/head.php') ?>

<body class="bg-secondary">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card w-100" style="margin-top: 35%;">
                    <div class="card-header pt-3 text-white text-center" style="background-color: darkcyan;">
                        <p class="fs-5 fw-bold">.: <i class="fas fa-users"></i>  APENMAS :.</p>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row mb-3">
                                <label for="username" class="col-sm-3 col-form-label ">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control  " name="username" id="username" placeholder="Masukan Username Anda">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control " name="password" id="password" placeholder="Masukan Password Anda">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="" class="mb-3">Masuk Sebagai</label>
                                </div>
                                <div class="col-8">
                                    <select name="role" class="form-select mb-3 " aria-label="Default select example">
                                        <option value="masyarakat">Masyarakat</option>
                                        <option value="petugas">Petugas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                <button type="submit" class="btn w-100 text-white" id="masuk" name="masuk" style="background-color: darkcyan;">Masuk</button>
                                </div>
                            </div>
                        </form>
                    <p class="text-center">Belum punya akun? silahkan Daftar <a href="../modul-auth/registrasi.php" class="text-decoration-none">disini</a>!</p>
                </div>
            </div>
        </div>
    </div>

    <?php include('../../assets/body.php') ?>     
</body>