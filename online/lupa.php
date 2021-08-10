<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAINTEK Online | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="system/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><img src="system/saintek-logo.png"></img></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Lupa Password</p>
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "notregistered") {
                ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>ERROR!</strong> Email tidak terdaftar
                        </div>
                    <?php
                    } else if ($_GET['pesan'] == "antibot") {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>ERROR! </strong> penjumlahan salah
                        </div>
                <?php
                    }
                }
                ?>
                <form action="lupa-cek.php" method="post">
                    <label>E-Mail</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="E-Mail terdaftar di sistem" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!--<input type="checkbox" onclick="myFunction()"> Tampilkan Password-->
                    <?php
                    $angka1 = rand(1, 5);
                    $angka2 = rand(1, 5);
                    $kunci = $angka1 + $angka2;
                    ?>
                    <div class="input-group mb-3">
                        Berapakah <b><?= $angka1; ?> ditambah <?= $angka2; ?> </b> ?
                        <input type="hidden" name="kunci" value="<?= $kunci; ?>">
                        <input type="number" id="myInput" class="form-control" placeholder="" name="jawaban" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-question"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <br />
                <p class="mb-0" align="center">
                    <small><a href="index.php" class="text-center" target="_blank">Kembali ke Halaman Login</a></small>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="system/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="system/dist/js/adminlte.min.js"></script>
    <!-- auto close alert -->
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 1000);
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>