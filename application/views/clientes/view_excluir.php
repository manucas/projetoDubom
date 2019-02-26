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
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Clientes</h4></div>
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
                                value="<?php echo $dados['nome']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Email </label>
                            <input type="email" 
                                class="form-control" 
                                value="<?php echo $dados['email']; ?>"
                                disabled
                            >
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Telefone </label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['telefone'] ? $dados['telefone'] : '' ?>"
                                disabled
                            >
                        </div>
                
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>CPF ou CNPJ </label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['cpf'] ? $dados['cpf'] : ''?>"
                                disabled
                            >
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
                            <a href="<?php echo site_url('cl_clientes/excluir/'.$dados['id'].'/true') ?>" 
                                class="btn btn-sm btn-danger btn-lg btn-block">
                                Excluir
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_clientes'); ?>" 
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