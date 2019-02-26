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
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Produtos</h4></div>
                </div>
                <!-- Titulo -->

                <!-- Form -->
                <form class="needs-validation" novalidate>
                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5 class="mb-2">Excluir Registro</h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->
                    <hr class="mb-2">
                
                    <!-- linha 1 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <div class="form-check form-check-inline">
                                <label>Grupo: </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" 
                                        type="radio" 
                                        name="radio_grupo"
                                        <?php if($dados['grupo'] == 0) echo 'checked'; ?>
                                        value="0"
                                    >
                                    Gelo
                                </label>
                            </div>
                        
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" 
                                        type="radio" 
                                        name="radio_grupo" 
                                        <?php if($dados['grupo'] == 1) echo 'checked'; ?>
                                        value="1"
                                    >
                                    Empório
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 text-center">
                            <div class="col-md-12">
                                <img src="<?php echo base_url('assets/fotos/'.$dados['foto']); ?>" 
                                    class="img-thumbnail" 
                                    width="20%" 
                                    height="20%"
                                > 
                            </div>
                        </div>
                    </div>
                    <!-- ./ Linha 1 -->
                    
                    <!-- Linha 2 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="descricao">Descrição </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_descricao" 
                                id="descricao" 
                                value="<?php echo $dados['descricao']; ?>"
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="espec">Especificação </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_espec" 
                                id="espec" 
                                value="<?php echo $dados['espec']; ?>"
                            >
                        </div>
                    </div>
                    <!-- ./linha 2 -->
                    
                    <!-- linha 3 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="un_med">Unidade Medida</label>
                            <input type="text"
                                class="form-control"
                                id="un_med"
                                name="text_un_med"
                                value="<?php echo $dados['un_med']; ?>"
                            >
                        </div>
                        
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="vlr_unit">Valor Unitário</label>
                            <input type="text"
                                id="vlr_unit"
                                name="text_valor_unitario"
                                class="form-control"
                                value="<?php echo $dados['valor_unitario']; ?>"
                            >
                        </div>
                        
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="qtde_stock">Qtde Estoque</label>
                            <input type="number"
                                id="qtde_stock"
                                name="text_qtde_estoque"
                                class="form-control"
                                value="<?php echo $dados['qtde_estoque']; ?>"
                            >
                        </div>  
                    </div>
                    <!-- ./ linha 3 -->

                    <!-- Exibe mensagens -->
                    <?php if(isset($mensagem)): ?>
                        <hr class="mb-3">
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
                            <a href="<?php echo site_url('cl_produtos/excluir/'.$dados['id'].'/true') ?>" 
                                class="btn btn-sm btn-danger btn-lg btn-block">
                                Excluir
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_produtos'); ?>" 
                                class="btn btn-sm btn-info btn-lg btn-block">
                                Retornar
                            </a>
                        </div>
                    </div>
                    <!-- ./ linha 4 -->
                    <hr class="mb-4">
                </form>
                <!-- ./ Form -->
            </div>
            <!-- ./ Primeira coluna -->
        </div>
        <!-- ./ Row -->
    </div>
    <!-- Container -->