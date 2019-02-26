<?php
    defined('BASEPATH') OR exit('URL inválida.');
    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;
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
                <!-- ./ Titulo -->
                <form  action="<?php echo site_url('cl_encomendas/clientesGravar'); ?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post">
                    <!-- linha 0 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <h5 class="mb-2">Incluir Registro</h5>
                        </div>
                    </div>
                    <!-- ./linha 0 -->
                    <hr class="mb-2">

                    <!-- Linha 1 -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="nome">Nome </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_nome" 
                                id="nome" 
                                placeholder="Nome"
                                maxlength="50"
                                pattern=".{2,50}"
                                title="Entre 2 e 50 caracteres."
                                value="<?php echo $values ? $inputs['text_nome'] : ''?>"
                                required
                                autofocus
                            >
                            <div class="invalid-feedback">
                                Por favor, nome de 2 até 50 caracteres.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="email">Email 
                                <small class="text-muted">&nbsp;&nbsp;(Nunca compartilhamos seu e-mail com ninguém.)</small>
                            </label>
                            <input type="email" 
                                class="form-control" 
                                name="text_email" 
                                id="email" 
                                placeholder="Email" 
                                maxlength="100"
                                pattern=".{9,100}"
                                title="Entre 9 e 100 caracteres."
                                value="<?php echo $values ? $inputs['text_email'] : ''?>"
                                required>
                            <div class="invalid-feedback">
                                Por favor, email de 9 até 100 caracteres.
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="telefone">Telefone 
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_telefone" 
                                id="telefone" 
                                placeholder="Telefone" 
                                maxlength="16"
                                pattern="{16}"
                                title="Com até 16 caracteres."
                                value="<?php echo $values ? $inputs['text_telefone'] : ''?>"
                            >
                        </div>
                
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="cpf">CPF ou CNPJ 
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_cpf" 
                                id="cpf" 
                                placeholder="CPF ou CNPJ" 
                                maxlength="14"
                                pattern="{14}"
                                title="Com até 14 caracteres."
                                value="<?php echo $values ? $inputs['text_cpf'] : ''?>"
                            >
                        </div>
                    </div>
                    <!-- ./ Linha 1 -->

                    <!-- Exibe mensagens -->
                    <?php if(isset($mensagem)): ?>
                        <div class="alert <?php echo $msg_tipo ?> text-center">
                            <?php echo $mensagem ?>
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
                            <a href="<?php echo site_url('cl_checkout'); ?>" 
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
        <hr class="mb-4">
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
