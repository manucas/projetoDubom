<?php
    defined('BASEPATH') OR exit('URL inválida.');
    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;
?>


<body class="bg-light">
    <!-- Container -->
    <div class="container">
        <!-- Titulo -->
        <div class="text-center">
            <!-- <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="72"> -->
            <h3 class="mb-3">Formulário de checkout</h3>
        </div>
        <!-- ./ Titulo -->
        
        <!-- Row -->
        <div class="row">
            
            <!-- Segunda Coluna -->
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Seu carrinho</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($encomendas); ?></span>
                </h4>
                
                <?php $valor_encomenda = 0; ?>
                
                <ul class="list-group mb-3">
                    <?php foreach ($encomendas as $linha) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div class="col-12">
                                <h6 class="my-0"><?php echo $linha['descricao']; ?></h6>
                                <small class="text-muted"><?php echo $linha['espec']; ?></small>
                            </div>
                            <span class="text-muted">R$ <?php echo number_format($linha['valor_total'], 2, ',', '.'); ?></span>
                        </li>
                        <?php $valor_encomenda = $valor_encomenda + $linha['valor_total']; ?> 
                    <?php endforeach; ?>                    

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BRL)</span>
                        <strong>R$ <?php echo number_format($valor_encomenda, 2, ',', '.'); ?></strong>
                    </li>
                </ul>
                
            </div>
            <!-- ./ Segunda Coluna -->
        
            <!-- Primeira coluna -->
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Dados para entrega</h4>
                
                <!-- Form Principal -->
                <form action="<?php echo site_url('cl_gelo/checkOutGravar'); ?>"
                    class="needs-validation"
                    novalidate
                    method="post">
                    
                    <!-- Linha com 2 colunas -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome">Nome</label>
                            <input type="text" 
                                class="form-control" 
                                id="nome"
                                name="text_nome" 
                                placeholder="Insira o nome do cliente" 
                                maxlength="50"
                                pattern=".{5,50}"
                                title="Entre 5 e 50 caracteres."
                                value=""
                                required
                                autofocus>
                            <div class="invalid-feedback">
                                Por favor, insira o nome do cliente.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" 
                                class="form-control"
                                id="email" 
                                name="text_email" 
                                placeholder="fulano@exemplo.com"
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value=""
                                required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Por favor, insira um endereço de e-mail válido.
                            </div>
                        </div>
                    </div>
                    <!-- ./Linha com 2 colunas -->
                    
                    <!-- Linha com 2 colunas -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefone">Telefone 
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_telefone" 
                                id="telefone" 
                                placeholder="Telefone" 
                                maxlength="16"
                                pattern="[0-16]{16}"
                                title="Com até 16 caracteres."
                                value="">
                        </div>
                
                        <div class="col-md-6 mb-3">
                            <label for="cpf">CPF ou CNPJ 
                                <span class="text-muted">&nbsp;&nbsp;(Opcional)</span>
                            </label>
                            <input type="text" 
                                class="form-control" 
                                name="text_cpf" 
                                id="cpf" 
                                placeholder="CPF ou CNPJ" 
                                maxlength="14"
                                pattern="[0-14]{14}"
                                title="Com até 14 caracteres."
                                value="">
                        </div>
                    </div>
                    <!-- ./ Linha com 2 colunas -->
                    
                    <!-- Linha com 2 colunas -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="localidade">Localidade</label>
                            <input type="text" 
                                class="form-control" 
                                id="localidade"
                                name="text_localidade" 
                                placeholder="Cidade e Estado"
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value=""
                                required>
                            <div class="invalid-feedback">
                                Por favor, insira o nome da localidade.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cep">CEP</label>
                            <input type="text" 
                                class="form-control"
                                name="text_cep" 
                                id="cep" 
                                placeholder="Código Postal"
                                maxlength="20"
                                pattern=".{5,50}"
                                title="Entre 5 e 50 caracteres."
                                value=""
                                required>
                            <div class="invalid-feedback">
                                Por favor, insira o Código Postal.
                            </div>
                        </div>
                    </div>
                    <!-- ./Linha com 2 colunas -->
                    
                    <!-- Linha com 2 campos -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bairro">Bairro</label>
                            <input type="text" 
                                class="form-control"
                                name="text_bairro" 
                                id="bairro" 
                                placeholder="Nome do Bairro"
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value=""
                                required>
                            <div class="invalid-feedback">
                                Por favor, insira o nome do bairro.
                            </div>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rua">Rua</label>
                            <input type="text" 
                                class="form-control" 
                                name="text_rua" 
                                id="rua"
                                placeholder="Nome da Rua"
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value=""
                                required>
                            <div class="invalid-feedback">
                                Por favor, insira o nome da rua.
                            </div>

                        </div>
                    </div>
                    <!-- ./ Linha com 2 Campos -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="numero">Número</label>
                            <input type="number"
                                class="form-control" 
                                id="numero" 
                                name="text_numero"
                                placeholder="Número da moradia"
                                value="" 
                                required>
                            <div class="invalid-feedback">
                                Por favor, insira o número da moradia.
                            </div>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="complemento">Complemento</label>
                            <input type="text" 
                                class="form-control" 
                                id="complemento"
                                name="text_complemento" 
                                placeholder="Quadra; Bloco; Apto; Casa; Referência."
                                maxlength="100"
                                pattern=".{5,100}"
                                title="Entre 5 e 100 caracteres."
                                value="">
                        </div>
                    </div>                    
                    <!-- ./Linha com 2 colunas -->
                    <hr class="mb-4">
                    
                    <!-- Hum input na vertival -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" 
                        class="custom-control-input" 
                        id="tipo-endereco"
                        name="check_tipo_endereco"
                        value="1">
                        <label class="custom-control-label" for="tipo-endereco">Endereço de entrega é o mesmo que o de cobrança.</label>
                    </div>
                    <!-- ./ Hum input na vertival -->    
                    
                    <hr class="mb-4">

                    <h4 class="mb-3">Pagamento</h4>
                    
                    <!-- Radio Bottom -->
                    <div class="d-block my-3">
                        <div class="row">
                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                class="custom-control-input" 
                                id="cash" 
                                name="radio_tipo_pagto"
                                value="0"
                                checked 
                                required>
                                <label class="custom-control-label" 
                                    for="cash">
                                    Dinheiro
                                </label>
                            </div>

                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                    id="debito" 
                                    name="radio_tipo_pagto"
                                    class="custom-control-input" 
                                    value="1"
                                    required>
                                <label class="custom-control-label" 
                                    for="debito">
                                    Cartão de débito
                                </label>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                class="custom-control-input" 
                                id="credito" 
                                name="radio_tipo_pagto"
                                value="2"
                                required>
                                <label class="custom-control-label" 
                                    for="tipo-pagto">
                                    Cartão de crédito
                                </label>
                            </div>

                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                class="custom-control-input" 
                                id="paypal" 
                                name="radio_tipo_pagto"
                                value="3"
                                required>
                                <label class="custom-control-label" 
                                    for="paypal">
                                    PayPal
                                </label>
                            </div>
                        </div>

                    </div>
                    <!-- ./ Radio Bottom -->
                        
                    <hr class="mb-4">
                        
                    <button class="btn btn-primary btn-lg btn-block" 
                        type="submit">Continue o checkout
                    </button>

                </form>
                <!-- Form Principal -->
            </div>
            <!-- ./ Primeira Coluna -->
        </div>
        <!-- Row -->
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
</body>

