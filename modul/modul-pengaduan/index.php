<head>
    <title>.: Pengaduan :.</title>
</head>
<?php include('../../assets/head.php') ?>
<?php include('../../assets/navbar.php') ?>
<?php @session_start();
include('../../configuration/koneksi.php');

    if(isset($_SESSION['username'])){
        true;
    }else{
        @header('location:../modul-auth/');
    }

    if (isset($_POST['tambahPengaduan'])) {
        $nik = $_POST['nik'];
        $isi_laporan = $_POST['pengaduan'];
        $tgl = $_POST['tgl'];
        //upload
        $ekstensi_diperbolehkan = array('jpg', 'png');
        $foto = $_FILES['foto']['name'];
        // print_r($foto);
        $x = explode(".", $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto']['tmp_name'];
        if (!empty($foto)) {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
                $r = mysqli_query($con, $q);
                if ($r) {
                    move_uploaded_file($file_tmp, '../../assets/img/masyarakat/' . $foto);
                }
            }
        } else {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
            $r = mysqli_query($con, $q);
        }
    }

    if(isset($_POST['buat'])){
        $tgl = $_POST['tgl'];
        $nik = $_POST['nik'];
        $pengaduan = $_POST['pengaduan'];
        $foto = $_POST['foto'];

        $q = mysqli_query($con, "INSERT INTO pengaduan (`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`) VALUES ('$tgl', '$nik', '$pengaduan', '$foto')");
    }

    if(isset($_POST['tanggap'])){
        $id_pengaduan = $_POST['id_pengaduan'];
        $tgl_tanggap = $_POST['tgl'];
        $tanggapan = $_POST['tanggapan'];
        $id_petugas = $_POST['idPetugas'];
        $status = $_POST['status'];

        $s = mysqli_query($con, "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
        $q = mysqli_query($con, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('$id_pengaduan', '$tgl_tanggap', '$tanggapan', '$id_petugas')");
    }
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">.: Pengaduan :.</p>
            </div>
            <div class="card-body">
                <table id="dataTablesNya" class="table table-success table-striped table-hover mt-3">
                    <thead>
                    <tr>
                        <th scope="col">ID Pengaduan</th>
                        <th scope="col">Tnggl Pengaduan</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Pengaduan</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Status</th>
                        <?php 
                            if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                                ?> 
                                    <th scope="col">Tindakan</th>
                                <?php
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    include('../../configuration/koneksi.php');
                    $no = 1;
                    $q = mysqli_query($con, "SELECT * FROM pengaduan");
                    while($p = mysqli_fetch_object($q)){
                        ?> 
                            <tr>
                                <td><?= $p -> id_pengaduan ?></td>
                                <td><?= $p -> tgl_pengaduan ?></td>
                                <td><?= $p -> nik ?></td>
                                <td><?= $p -> isi_laporan ?></td>
                                    <?php 
                                        if(!empty($p -> foto)){
                                            ?> 
                                                <td><img src="../../assets/img/masyarakat/<?= $p -> foto ?>" style="max-height: 100px;"></td>
                                            <?php
                                        }else{
                                            ?> 
                                                <td><img src="../../assets/img/noimg.png" style="width: 100px;"></td>
                                            <?php
                                        }
                                    ?>
                                <td><?= $p -> status ?></td>
                                <td>
                                <button type="button" class="btn text-white" style="background-color: darkcyan;" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $p -> id_pengaduan ?>">
                                    <i class="fas fa-reply"></i> Tanggapi
                                </button>

                                <div class="modal fade" id="exampleModal<?= $p -> id_pengaduan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> Perbarui data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <input type="hidden" name="id_pengaduan" value="<?= $p -> id_pengaduan ?>">
                                                    <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="idPetugas" id="idPetugas" value="<?= $_SESSION['id_petugas'] ?>">
                                                    </div>
                                                            <div class="mb-3">
                                                                <div class="form-group"><label for="tgl">Tanggal Tanggapan</label>
                                                                    <input class="form-control" type="date" name="tgl">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                                                    <option value="proses">Diproses</option>
                                                                    <option value="selesai">Selesai</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3"></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="button" class="btn w-100 btn-secondary" data-bs-dismiss="modal">tutup</button>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn w-100 text-white" name="tanggap" id="tanggap" style="background-color: darkcyan;">Kirim Tanggapan</button>
                                                            </div>
                                                    </div>
                                                </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <?php 
            @session_start();
            if($_SESSION['level'] == 'masyarakat'){
                ?> 
                    <div class="card-footer">
                    <h5 class="fw-bold mb-5">.: Buat Pengaduan :.</h5>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Pengaduan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK (terisi otomatis)</label>
                                <input type="text" readonly class="form-control-plaintext" id="nik" name="nik" value="<?= $_SESSION['nik'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="pengaduan" class="form-label">Hal yang ingin Dilaporkan</label>
                                <textarea class="form-control" id="pengaduan" name="pengaduan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="tambahPengaduan" id="buat" style="background-color: darkcyan;">Buat Laporan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }
                ?> 
                    <!-- <div class="card-footer" id="beri-tanggapan">
                        <h5 class="fw-bold mb-5">.: Beri Tanggapan :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="id_pengaduan" class="mb-3">Pilih ID Pengaduan yang Ingin ditanggapi</label>
                                <select name="id_pengaduan" class="form-select" aria-label="Default select example">
                                    
                                        include('../../configuration/koneksi.php'); 
                                        $q = mysqli_query($con, "SELECT * FROM pengaduan");
                                        while($o = mysqli_fetch_object($q)){
                                            ?> 
                                                <option value="<?= $o -> id_pengaduan ?>"><?= $o -> id_pengaduan ?></option>
                                            
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Tanggapan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                    <option value="proses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="idPetugas" id="idPetugas" value="<?= $_SESSION['id_petugas'] ?>">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="tanggap" id="tanggap" style="background-color: darkcyan;">Kirim Tanggapan</button>
                                </div>
                            </div>
                        </form> -->
                    </div>
                <!-- 
            }
            ?> -->
        </div>
    </div>

    <?php include('../../assets/body.php') ?>
</body>