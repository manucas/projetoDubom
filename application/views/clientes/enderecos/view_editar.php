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

                <form  action="<?php echo site_url('cl_enderecos/editarGravar/'.$dados['id']); ?>/<?php echo $cliente['id'];?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post">

                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5>Editar Registro</h5>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 text-right">
                            <h5 class="text-muted">Cliente: &nbsp;&nbsp;<?php echo $cliente ? $cliente['nome'] : ''; ?></h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->

                    <hr class="mb-2">

                    <!-- Linha 1 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="tipo">Tipo de endereço
                            <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                id="tipo"
                                name="text_tipo" 
                                placeholder="Residência, Trabalho, Empresa, Vizinho, etc..."
                                maxlength="50"
                                pattern="{50}"
                                title="Máximo 50 caracteres."
                                value="<?php echo $dados['tipo']; ?>"
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="contato">Contato
                            <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                id="contato"
                                name="text_contato" 
                                placeholder="Nome do Contato"
                                maxlength="50"
                                pattern="{50}"
                                title="Máximos 50 caracteres."
                                value="<?php echo $dados['contato']; ?>"
                                >
                        </div>
                    </div>
                    <!-- ./Linha 1 -->

                    <!-- Linha 2 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="cep">CEP
                            <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                id="cep"
                                name="text_cep" 
                                placeholder="Código Postal"
                                maxlength="20"
                                pattern="{20}"
                                title="Máximo 20 caracteres."
                                value="<?php echo $dados['cep']; ?>"
                                >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="localidade">Localidade</label>
                            <input type="text" 
                                class="form-control" 
                                id="localidade"
                                name="text_localidade" 
                                placeholder="Cidade e Estado"
                                maxlength="100"
                                pattern=".{1,100}"
                                title="Entre 1 e 100 caracteres."
                                value="<?php echo $dados['localidade']; ?>"
                                required>
                            <div class="invalid-feedback">
                                Por favor, localidade de 1 até 100 caracteres.
                            </div>
                        </div>
                    </div>
                    <!-- ./Linha 2 -->
                    
                    <!-- Linha 3 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="bairro">Bairro</label>
                            <input type="text" 
                                class="form-control" 
                                id="bairro"
                                name="text_bairro"
                                placeholder="Nome do Bairro"
                                maxlength="100"
                                pattern=".{1,100}"
                                title="Entre 1 e 100 caracteres."
                                value="<?php echo $dados['bairro']; ?>"
                                required>
                            <div class="invalid-feedback">
                                Por favor, bairro de 1 até 100 caracteres.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="rua">Rua</label>
                            <input type="text" 
                                class="form-control" 
                                id="rua"
                                name="text_rua" 
                                placeholder="Nome da Rua"
                                maxlength="100"
                                pattern=".{1,100}"
                                title="Entre 1 e 100 caracteres."
                                value="<?php echo $dados['rua']; ?>"
                                required>
                            <div class="invalid-feedback">
                                Por favor, rua de 1 até 100 caracteres.
                            </div>
                        </div>
                    </div>
                    <!-- ./ Linha 3-->

                    <!-- Linha 4 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="numero">Número</label>
                            <input type="text"
                                class="form-control" 
                                id="numero" 
                                name="text_numero"
                                placeholder="Número da residência"
                                maxlength="10"
                                pattern=".{1,10}"
                                title="Entre 1 e 10 caracteres."
                                value="<?php echo $dados['numero']; ?>"
                                required>
                            <div class="invalid-feedback">
                                Por favor, número de 1 até 10 caracteres.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="complemento">Complemento
                            <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                id="complemento"
                                name="text_complemento" 
                                placeholder="Quadra; Bloco; Apto; Casa; Referência."
                                maxlength="100"
                                pattern="{100}"
                                title="Com até 100 caracteres."
                                value="<?php echo $dados['complemento']; ?>"
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
                            <button type="submit"
                                class="btn btn-sm btn-primary btn-lg btn-block">
                                Gravar
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_enderecos/enderecos/'.$cliente['id']); ?>" 
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
