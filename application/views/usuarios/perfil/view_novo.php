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
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Perfil</h4></div>
                </div>
                <!-- ./ Titulo -->

                <form  action="<?php echo site_url('cl_perfil/novoGravar'); ?>" 
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
                            <label for="nome">Descrição </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_descricao" 
                                id="descricao" 
                                placeholder="Descrição"
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value="<?php echo $values ? $inputs['descricao'] : ''?>"
                                required
                                autofocus
                            >
                            <div class="invalid-feedback">
                                Por favor, insira uma descrição.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="check_status">Ativo
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <div class="checkbox">
                                <input type="checkbox" 
                                    name="check_status"
                                    value="1"
                                    <?php if($values && $inputs['status'] == 1) echo 'checked'; ?>
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
                            <button type="submit"
                                class="btn btn-sm btn-primary btn-lg btn-block">
                                Gravar
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-3">
                            <a href="<?php echo site_url('cl_perfil'); ?>" 
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
