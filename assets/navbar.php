<?php 
@session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawe/fontawesome-free-6.3.0-web/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: darkcyan;">
        <div class="container-fluid">
            <a href="" class="navbar-brand fw-bold text-white"><i class="fas fa-users"></i> APENMAS</a>
            <ul class="navbar-nav me-auto">
                <?php
                if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                    ?>
                    <li class="nav-item">
                        <a href="../modul-masyarakat/" class="nav-link disabled text-secondary"><i class="fas fa-users"></i> Masyarakat</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item">
                        <a href="../modul-masyarakat/" class="nav-link text-white"><i class="fas fa-users"></i> Masyarakat</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a href="../modul-pengaduan/" class="nav-link text-white"><i class="fas fa-exclamation"></i> Pengaduan</a>
                </li>
                <?php
                if($_SESSION['level'] == 'masyarakat'){
                    ?>
                    <li class="nav-item">
                        <a href="../modul-petugas/" class="nav-link disabled text-secondary"><i class="fas fa-user-tie"></i> Petugas</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item">
                        <a href="../modul-petugas/" class="nav-link text-white"><i class="fas fa-user-tie"></i> Petugas</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a href="../modul-tanggapan/" class="nav-link text-white"><i class="fas fa-reply"></i> tanggapan</a>
                </li>
                <li class="nav-item">
                    <a href="../modul-auth/logout.php" class="nav-link text-white"><i class="fas fa-lock"></i> Logout</a>
                </li>
            </ul>
        </div>    
    </nav>

    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <script src="assets/fontawe/fontawesome-free-6.3.0-web/js/all.min.js"></script>
</body>