<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>

<body class="bg-light">
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
                <!-- ./ Titulo -->

                <form  action="<?php echo site_url('cl_produtos/editargravar/'.$dados['id']); ?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post"
                    enctype="multipart/form-data"
                    >
                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5 class="mb-2">Editar Registro</h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->
                    <hr class="mb-2">

                    <!-- Linha 1 -->
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

                    </div>
                    <!-- ./ linha 1 -->

                    <!-- Linha 2 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="descricao">Descrição </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_descricao" 
                                id="descricao" 
                                placeholder="Descrição"
                                maxlength="150"
                                pattern=".{5,150}"
                                title="Entre 5 e 150 caracteres."
                                value="<?php echo $dados['descricao']; ?>"
                                required
                            >
                            <div class="invalid-feedback">
                                Por favor, insira uma descrição.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="espec">Especificação </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_espec" 
                                id="espec" 
                                placeholder="Especificação"
                                maxlength="250"
                                pattern=".{5,250}"
                                title="Entre 5 e 250 caracteres."
                                value="<?php echo $dados['espec']; ?>"
                                required
                                autofocus
                            >
                            <div class="invalid-feedback">
                                Por favor, insira uma especificação.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Unidade Medida</label>
                            <input type="text"
                                   name="text_un_med"
                                class="form-control"
                                placeholder = "Unidade de Medida"
                                value="<?php echo $dados['un_med']; ?>"
                                required
                                >
                        </div>
                        
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Valor Unitário</label>
                            <input type="number"
                                name="text_valor_unitario"
                                class="form-control"
                                placeholder="Valor Unitário"
                                title="Máximo 9 inteiros ou (9 inteiros + pto-decimal + 2 decimais)"
                                step="0.010"
                                min="1.00"
                                max="999999999.99"
                                value="<?php echo $dados['valor_unitario']; ?>"
                                required
                            >
                            <div class="invalid-feedback">
                                Por favor, Máximo 9 inteiros ou (9 inteiros + pto decimal + 2 decimais).
                            </div>
                        </div>
                         
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label>Qtde Estoque</label>
                            <input type="number"
                                name="text_qtde_estoque"
                                class="form-control"
                                placeholder = "Quantidade em Estoque"
                                title="Máximo 8 inteiros ou (8 inteiros + pto-decimal + 3 decimais)"
                                step="0.0010"
                                min="1.000"
                                max="99999999.999"
                                value="<?php echo $dados['qtde_estoque']; ?>"
                            >
                            <div class="invalid-feedback">
                                Por favor, Máximo 8 inteiros ou (8 inteiros + pto decimal + 3 decimais).
                            </div>

                        </div>  
                        
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="arqFoto">Foto<span class="text-muted">&nbsp;&nbsp;(Clique abaixo para adicionar ou alterar foto)</span></label>
                            <div class="row">
                                <div class="w-25 col-md-3">
                                    <input type="hidden" 
                                        name="foto_anterior"
                                        value="<?php echo $dados['foto']; ?>"
                                    >
                                    <img src="
                                            <?php if($dados['foto'] !== ""){
                                                echo base_url('assets/fotos/'.$dados['foto']);
                                            }else{ 
                                                echo base_url('assets/fotos/sem_imagem.jpg');
                                            }
                                            ?>
                                            " 
                                        class="img-thumbnail" 
                                    > 
                                </div>
                                <div class="col-md-9 mt-3">
                                    <input type="file" 
                                        class="form-control-file" 
                                        id="arqFoto" 
                                        name="arqFoto" 
                                        accept="image/jpeg|mage/png"
                                    >
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- ./ Linha 2 -->

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
                            <button type="submit"
                                class="btn btn-sm btn-primary btn-lg btn-block">
                                Gravar
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_produtos'); ?>" 
                                class="btn btn-sm btn-info btn-lg btn-block">
                                Retornar
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

    <script>
    // JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
    (function() {
        'use strict';

        window.addEventListener('load', function() {
        // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
        var forms = document.getElementsByClassName('needs-validation');

        // Faz um loop neles e previne envio
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
    
    <!-- Tratamento de input numérico com jQuery -->
    <script>
        $("text_valor_unitario").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        });

        $("text_qtde_estoque").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        });

    </script>
</body>
