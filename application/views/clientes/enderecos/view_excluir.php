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
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Endereços</h4></div>
                </div>
                <!-- Titulo -->
 
                <form class="needs-validation" novalidate>
                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5 class="mb-2">Excluir Registro</h5>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 text-right">
                            <h5 class="text-muted">Cliente: &nbsp;&nbsp;<?php echo $cliente ? $cliente['nome'] : ''; ?></h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->

                    <hr class="mb-2">

                    <!-- Linhas 1 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="tipo">Tipo de endereço
                            </label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['tipo']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="contato">Contato</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['contato']; ?>"
                                disabled
                            >
                        </div>
                    </div>
                    <!-- ./Linha 1 -->

                    <!-- Linha 2 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="cep">CEP</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['cep']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="localidade">Localidade</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['localidade']; ?>"
                                disabled
                            >
                        </div>
                    </div>
                    <!-- ./Linha 2 -->
                    
                    <!-- Linha 3 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="bairro">Bairro</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['bairro']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="rua">Rua</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['rua']; ?>"
                                disabled
                            >
                        </div>
                    </div>
                    <!-- ./ Linha 3-->

                    <!-- Linha 4 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="numero">Número</label>
                            <input type="text"
                                class="form-control" 
                                value="<?php echo $dados['numero']; ?>"
                                disabled
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="complemento">Complemento</label>
                            <input type="text" 
                                class="form-control" 
                                value="<?php echo $dados['complemento']; ?>"
                                disabled
                            >
                        </div>
                    </div>                    
                    <!-- ./Linha 4 -->

                    <!-- Exibe mensagens -->
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
                            <a href="<?php echo site_url('cl_enderecos/excluir/'.$dados['id']) ?>/<?php echo $cliente['id'].'/true' ?>"
                                class="btn btn-sm btn-danger btn-lg btn-block">
                                Excluir
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_enderecos/enderecos/'.$cliente['id']); ?>" 
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