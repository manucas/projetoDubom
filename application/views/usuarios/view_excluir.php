<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>
  
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Primeira coluna -->
            <div class="col-md-8 offset-2 order-md-1">
                <!-- Titulo -->
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Usuários</h4></div>
                </div>
                <!-- Titulo -->

                <form class="needs-validation" novalidate>

                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5 class="mb-2">Excluir Registro</h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->

                    <hr class="mb-2">

                    <!-- Linha 1 -->
                    <div class="row">

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Nome </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_nome" 
                                value="<?php echo $usuario['nome']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Email 
                                <small class="text-muted">&nbsp;&nbsp;(Nunca compartilhamos seu e-mail com ninguém.)</small>
                            </label>
                            <input type="email" 
                                class="form-control" 
                                name="text_email" 
                                value="<?php echo $usuario['email']; ?>"
                                disabled

                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>CPF </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_cpf" 
                                value="<?php echo $usuario['cpf']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Perfil </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_perfil" 
                                value="<?php echo $usuario['descricao']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Ativo </label>
                            <div class="checkbox">
                                <input type="checkbox" 
                                    name="check_ativo"
                                    value="1"
                                    <?php if($usuario['ativo'] == 1) echo 'checked'; ?>
                                    disabled
                                >
                            </div>
                        </div>
                    </div>
                    <!-- ./ Linha 1 -->

                    <!-- Mensagens -->
                    <?php if(isset($mensagem)): ?>
                        <div class="row">
                            <div class="col-md-12 alert <?php echo $msg_tipo ?> text-center">
                                <?php echo $mensagem ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- ./Mensagens -->
                    <hr class="mb-2">

                    <!-- Botoes -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_usuarios/excluir/'.$usuario['id'].'/true') ?>" 
                                class="btn btn-sm btn-danger btn-lg btn-block">
                                Excluir
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_usuarios'); ?>" 
                                class="btn btn-sm btn-info btn-lg btn-block">
                                Cancelar
                            </a>
                        </div>
                    </div>
                    <!-- ./ Botoes -->
                </form>
                <!-- ./ Form -->
            </div>
            <!-- ./ Primeira coluna -->
        </div>
        <!-- ./ Row -->
    </div>
    <!-- Container -->
