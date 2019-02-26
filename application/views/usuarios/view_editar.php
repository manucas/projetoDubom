<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');

?>
   
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Primeira coluna -->
            <div class="col-md-8 offset-2 order-md-1">
                <!-- Titulo -->
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 mb-3"><h4>Cadastro de Usuário</h4></div>
                </div>
                <!-- ./ Titulo -->

                <form  action="<?php echo site_url('cl_usuarios/editarGravar/'.$dados['id']); ?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post">
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
                            <label for="nome">Nome </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_nome" 
                                id="nome" 
                                placeholder="Nome"
                                maxlength="50"
                                pattern=".{5,50}"
                                title="Entre 5 e 50 caracteres."
                                value="<?php echo $dados['nome']; ?>"
                                required
                                autofocus
                            >
                            <div class="invalid-feedback">
                                Por favor, insira um nome.
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
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value="<?php echo $dados['email']; ?>"
                                required
                            >
                            <div class="invalid-feedback">
                                É obrigatório inserir um email válido.
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="senha">Senha </label>
                            <input type="password" 
                                class="form-control" 
                                name="text_senha" 
                                id="senha" 
                                placeholder="Senha" 
                                maxlength="8"
                                pattern="{4,8}"
                                title="Entre 4 e 8 caracteres."
                                value=""
                            >
                        </div>
                
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="cpf">CPF 
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_cpf" 
                                id="cpf" 
                                placeholder="CPF" 
                                maxlength="14"
                                pattern=".{5,14}"
                                title="14 caracteres."
                                value="<?php echo $dados['cpf']; ?>"
                            >
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="combo_perfil">Perfil
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <select class="form-control"
                                name="combo_perfil"
                                id="combo_perfil"  
                                value="<?php echo $dados['perfil_id']; ?>"
                                >
                                <option value="<?php echo $dados['perfil_id']; ?> selected">
                                    <?php echo $dados['descricao']; ?>
                                </option>
                                <?php 
                                    if(isset($perfil)){
                                        foreach ($perfil as $linha){
                                            echo '<option value="'.$linha['id'].'">'.$linha['descricao'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
 
                        <div class="col-xs-12 col-sm-8 col-md-6 mb-2">
                            <label for="check_ativo">Ativo
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <div class="checkbox">
                                <input type="checkbox" 
                                    name="check_ativo"
                                    value="1"
                                    <?php if($dados['ativo'] == 1) echo 'checked'; ?>
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

    <!-- Exemplo de script com jQuery e ajax -->
    <script>
        function detalhes_perfil(){
            // Busca o valor do combo
            let index_combo = $("#combo_perfil").val();
        
            // Definir um path para a função Ajax
            let chama_metodo = '<?php echo site_url("cl_perfil/ajax_info_perfil/"); ?>' + index_combo;
        
            // Call do Ajax (Função do Jquery)
            $.ajax({
                url: chama_metodo,
                type: 'post',
                success: function(result){
                    let dados     = JSON.parse(result);
                    let descricao = dados['descricao'];
                    let status    = dados['status'];
                    // Remeter o resultado para o textarea
                    $('#text_resultado').html("Perfil: " + descricao + "  Status: " + status);
                },
                error: function(){
                    console.log('ERRO de ligação a base de dados...!');
                }
            })
        }
    </script>

