<?php include __DIR__ . '/../inicio-html.php'; ?>
<?php include __DIR__ . '/../header.php'; ?>

<body class="authentication-bg">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Fazer login</h4>
                        </div>

                        <form action="/realiza-login" method="post">

                            <!-- Verifica se a sessão existe, e monta o tipo do alert e a mensagem, depois destroi -->
                            <?php if (isset($_SESSION['mensagem'])): ?>
                                <div class="alert alert-<?= $_SESSION['tipo_mensagem']; ?>">
                                    <?= $_SESSION['mensagem']; ?>
                                </div>
                                <?php
                                unset($_SESSION['mensagem']);
                                unset($_SESSION['tipo_mensagem']);
                            endif;
                            ?>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In</button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>
</html>

