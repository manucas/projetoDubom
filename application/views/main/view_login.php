<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 col-10">
            <div class="text-center">
                <h4><a href="<?php echo site_url('geral/login'); ?>"><b>Trade </b>Dubom</a>
                </h4>
            </div>
            <!-- /.login-logo -->
            <div class="col-md-8 offset-md-3 col-10">
                <div class="card border-info mb-3" style="max-width: 20rem;">
                    <div class="card-header text-center">Entrar para iniciar uma sessão</div>
                    <div class="card-body">
                        <form action="<?php echo site_url('geral/login'); ?>" method="post">

                            <div class="form-group">
                                <input type="text"
                                    name="text_usuario"
                                    class="form-control"
                                    placeholder="Usuário"
                                    required
                                    autofocus
                                >
                            </div>
                            
                            <div class="form-group">
                                <input type="password"
                                    name="text_senha"
                                    class="form-control"
                                    placeholder="Senha"
                                    required
                                >
                            </div>
 
                            <div class="text-right">            
                                <button class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                        <!-- ./form -->
                    </div>
                    <!-- ./car-body -->

                    <!-- Exibe mensagens -->
                    <?php if(isset($mensagem)): ?>
                        <div class="alert <?php echo $msg_tipo ?> text-center">
                            <?php echo $mensagem ?>
                        </div>
                    <?php endif; ?>
                    <!-- ./Mensagens -->

                </div>
                <!-- ./card -->
            </div>
            <!-- ./content -->
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>
<!-- ./container -->
