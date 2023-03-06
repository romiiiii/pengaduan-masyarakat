<head>
    <title>.: Masyarakat :.</title>
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
        $q = mysqli_query($con, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`, verif) VALUES ('$nik', '$nama', '$username', '$password', '$telp', 1);");
    ?> 
        <div class="alert alert-success" role="alert">
            Anda Telah Berhasil Mendaftar Mendaftarkan Warga !
        </div>
    <?php
    }
    
}

if(isset($_POST['edit'])){
    $nik = $_POST['nik'];
    $status = $_POST['status'];
    if($status == '1'){
        $q = mysqli_query($con, "UPDATE masyarakat SET verif = '1' WHERE nik = '$nik'");
    }else{
        $q = mysqli_query($con, "UPDATE masyarakat SET verif = '0' WHERE nik = '$nik'");
    }
}

if(isset($_POST['hapus'])){
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "DELETE FROM masyarakat WHERE nik = '$nik'");
}

if(isset($_POST['perbarui'])){
    $nik = $_POST['nik-update'];
    $nama = $_POST['nama-update'];
    $username = $_POST['username-update'];
    $password = $_POST['password-update'];
    $telp = $_POST['telp-update'];

    $u = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username'");
    $r = mysqli_num_rows($u);
    if($r == 1){
        ?> 
            <div class="alert alert-danger" role="alert">
                Username Telah Digunakan ! Coba Gunakan Username Lainnya
            </div>
        <?php
    }else{
        $q = mysqli_query($con, "UPDATE masyarakat SET nama = '$nama', username = '$username', password = '$password', telp = '$telp' WHERE nik = '$nik'");
    ?> 
        <div class="alert alert-success" role="alert">
            Anda Telah Berhasil Memperbarui Data !
        </div>
    <?php
    }


    


}
?>


<?php include('../../assets/head.php') ?>
<?php include('../../assets/navbar.php') ?>
<?php @session_start(); 
    if(isset($_SESSION['username'])){
        true;
    }else{
        @header('location:../modul-auth/');
    }
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">.: Daftar Masyarakat :.</p>
            </div>
            <div class="card-body">
                <table id="" class="table table-success table-striped table-hover mt-3">
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">No. Telpon</th>
                        <?php 
                            if($_SESSION['level'] == 'masyarakat'){
                                true;
                            }else{
                                ?> 
                                    <th scope="col">Status</th>
                                    <th>Hapus</th>
                                <?php
                            }
                        ?>
                    </tr>
                    
                    <?php 
                    include('../../configuration/koneksi.php');
                    $q = mysqli_query($con, "SELECT * FROM masyarakat");
                    while($m = mysqli_fetch_object($q)){
                        ?>
                            <tr>
                                <td><?= $m -> nik ?></td>
                                <td><?= $m -> nama ?></td>
                                <td><?= $m -> username ?></td>
                                <td><?= $m -> telp ?></td>
                                <?php 
                                    if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                                        ?> 
                                            <td><?php if ($m->verif == 0) {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $m->nik . '"><input name="status" type="hidden" value="1"><button name="edit" type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                                    } else {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $m->nik . '"><input name="status" type="hidden" value="0"><button name="edit" type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></form>';
                                                    } ?>
                                            </td>
                                            <td>
                                                <form action="" method="post"><input type="hidden" name="nik" value="<?= $m->nik ?>"><button name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                            </td>
                                        <?php
                                    }
                                ?>
                                
                            </tr> 
                        <?php
                    }
                    ?>
                </table>
            </div>
            
            <?php 
            @session_start();
            if($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin'){
                ?> 
                    <div class="card-footer">
                        <h5 class="fw-bold mb-5">.: Tambahkan Warga :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Pilih Username yang Belum Digunakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Pilih Password yang Aman" required>
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control" id="telp" name="telp" placeholder="Nomor HP Aktif">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="daftar" id="daftar" style="background-color: darkcyan;">Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <h5 class="fw-bold mb-5" id="update">.: Perbarui Data Warga :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nik-update" class="form-label">Pilih data yang ingin dirubah berdasarkan NIK</label>
                                <select name="nik-update" class="form-select" aria-label="Default select example">
                                    <?php
                                        include('../../configuration/koneksi.php'); 
                                        $q = mysqli_query($con, "SELECT * FROM masyarakat");
                                        while($o = mysqli_fetch_object($q)){
                                            ?> 
                                                <option value="<?= $o -> nik ?>"><?= $o -> nik ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama-update" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama-update" name="nama-update" placeholder="Nama Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="username-update" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username-update" name="username-update" placeholder="Pilih Username yang Belum Digunakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="password-update" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password-update" name="password-update" placeholder="Pilih Password yang Aman" required>
                            </div>
                            <div class="mb-3">
                                <label for="telp-update" class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control" id="telp-update" name="telp-update" placeholder="Nomor HP Aktif">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="perbarui" id="perbarui" style="background-color: darkcyan;">Perbarui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php include('../../assets/body.php') ?>
</body>