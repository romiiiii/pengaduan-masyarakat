<head>
    <title>.: Tanggapan :.</title>
</head>
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
<div class="content">
            <!-- Main content -->
                    <div class="container">
                        <div class="card">
                        <div class="card-header">
                        <p class="fs-4 fw-bold">.: Tanggapan :.</p>
                    </div>
                            <div class="card-body">
                                <table id="dataTablesNya" class="table table-success table-striped table-hover mt-3">
                                <thead>
                                <tr>
                                    <th scope="col">ID Tanggapan</th>
                                    <th scope="col">ID Pengaduan</th>
                                    <th scope="col">Tgl Tanggapan</th>
                                    <th scope="col">Tanggapan</th>
                                    <th scope="col">ID Petugas</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                include('../../configuration/koneksi.php');
                                $no = 1;
                                $q = mysqli_query($con, "SELECT * FROM tanggapan");
                                while($t = mysqli_fetch_object($q)){
                                    ?>  
                                        <tr>
                                            <td><?= $t -> id_tanggapan ?></td>
                                            <td><?= $t -> id_pengaduan ?></td>
                                            <td><?= $t -> tgl_tanggapan ?></td>
                                            <td><?= $t -> tanggapan ?></td>
                                            <td><?= $t -> id_petugas ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
    <?php include('../../assets/body.php') ?>


</body>