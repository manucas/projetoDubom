<?php
    defined('BASEPATH') OR exit('URL inválida.');
    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;

// echo "<pre>"; print_r($marcados); echo "</pre>";
    
?>

    <!-- Container -->
    <div class="w-auto container">
        <!-- Titulo -->
        <div class="text-center">
            <h3 class="mb-3">Checkout</h3>
        </div>
        <!-- ./ Titulo -->

        <!-- Form Principal -->
        <form action="<?php echo site_url('cl_checkout/checkoutGravar'); ?>"
            class="needs-validation"
            novalidate
            method="post">

            <!-- Row -->
            <div class="row">

                <!-- Segunda Coluna -->
                <div class="col-md-6 order-md-2 mb-4">
    
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span>Carrinho </span>
                        <span class="badge badge-secondary badge-pill"><?php echo count($marcados); ?></span>
                    </h4>

                    <div class="table-responsive">
                        <!-- Table -->
                        <table class="table">
                            <!-- Thead -->
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col" class="text-right">Quantidade</th>
                                    <th scope="col" class="text-right">Preço (R$)</th>
                                </tr>
                            </thead>
                            <!-- ./Thead -->
            
                            <!-- tbody -->
                            <tbody>
            
                            <?php $valor_encomenda = 0 ?> 
            
                            <?php foreach ($marcados as $linha) : ?>
                                <tr>                    
                                    <td>
                                        <?php echo $linha['descricao'] ?><br>
                                        <small class="text-muted">
                                            <?php echo $linha['espec']; ?>
                                        </small>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $linha['qtde_encomenda']; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo number_format( $linha['sub_total'], 2, ',', '.') ?>
                                    </td>
                                </tr>
                
                                <?php $valor_encomenda += $linha['sub_total']; ?> 
                            <?php endforeach; ?>
    
                                <tr class="text-success">
                                    <td>
                                        <h6 class="my-0">Código promocional</h6>
                                    </td>
                                    <td>
                                        <small>CODIGOEXEMPLO</small>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-success">-0,00</span>
                                    </td>
                                </tr>
                                    
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <span>Total</span>
                                        <strong><?php echo number_format($valor_encomenda, 2, ',', '.'); ?></strong>
                                    </td>
                                </tr>

                                    <!-- Form -->
                                    <form class="card p-2">
                                <tr>
                                    <td colspan="3">
                                    <div class="input-group">
                                        <input type="text" 
                                            class="form-control"
                                            name="text_cod_promo" 
                                            placeholder="Código promocional">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary">Resgatar</button>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                    </form>
                                    <!-- ./ Form -->

                             </tbody>
                            <!-- ./ tbody -->
                        </table>
                        <!-- ./ Table -->
                    </div>
                </div>
                <!-- ./ Segunda Coluna -->
        
                <!-- Primeira coluna -->
                <div class="col-md-6 order-md-1">
                    <h4 class="mb-3">Dados para entrega</h4>
                     
                    <!-- Linha 1 -->
                    <div class="col-md-12 mb-3">
                        <!-- Linha 1.1 -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="combo_clientes">Cliente </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo site_url('cl_encomendas/clientes'); ?>" 
                                    class="btn btn-sm btn-info btn-lg btn-block">
                                    Cadastrar Cliente
                                </a>
                            </div>
                        </div>
                        <!-- ./ Linha 1.1 -->
                        <select class="form-control"
                            id="combo_clientes"
                            name="combo_clientes"
                            onchange='enderecos_by_clientes($(this).val())'
                        >
                        
                            <option value='0' disabled selected>Selecione um Cliente ...</option>
                            <?php 
                                if(isset($clientes)){
                                    foreach ($clientes as $linha){
                                    echo '<option value="'.$linha['id'].'">'.$linha['nome'].'</option>';
                                    }
                                }
                            ?>

                        </select>
                    </div>
                    <!-- ./ Linha 1 -->
                    
                    <!-- Linha 2 -->
                    <div class="col-md-12 mb-3">
                        <!-- Linha 2.1 -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="combo_enderecos">Endereço de Entrega </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="" 
                                    onclick="this.href='<?php echo site_url('cl_encomendas/enderecos/'); ?>'+document.getElementById('combo_clientes').value"
                                    class="btn btn-sm btn-info btn-lg btn-block">
                                    Cadastrar Endereço
                                </a>
                            </div>
                        </div>
                        <!-- ./ Linha 2.1 -->
                        <!-- Este combo é montado qdo se esclhe um cliente -->
                        <select class="form-control"
                            id="combo_enderecos"
                            name="combo_enderecos"
                        >
                        <option value='0' disabled selected>Selecione um endereço ...</option>

                        </select>
                    </div>
                    <!-- ./Linha 2 -->
                                    
                    <!-- Radio Bottom -->
                    <div class="col-md-12 d-block my-3">
                        <hr class="mb-4">
                    
                        <h4 class="mb-3">Pagamento</h4>

                        <div class="row">
                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                class="custom-control-input" 
                                id="cash" 
                                name="radio_tipo_pagto"
                                value="1"
                                checked 
                                required>
                                <label class="custom-control-label" 
                                    for="cash">
                                    Dinheiro
                                </label>
                            </div>

                            <div class="col-md-6 custom-control custom-radio">
                                <input type="radio" 
                                class="custom-control-input" 
                                id="debito" 
                                name="radio_tipo_pagto"
                                value="2"
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
                                    value="3"
                                    required>
                                    <label class="custom-control-label" 
                                        for="credito">
                                        Cartão de crédito
                                    </label>
                                </div>

                                <div class="col-md-6 custom-control custom-radio">
                                    <input type="radio" 
                                    class="custom-control-input" 
                                    id="paypal" 
                                    name="radio_tipo_pagto"
                                    value="4"
                                    required>
                                    <label class="custom-control-label" 
                                        for="paypal">
                                        PayPal
                                    </label>
                                </div>
                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- ./row -->
                    </div>
                    <!-- ./ Radio Bottom -->
                </div>
                <!-- ./ Primeira Coluna -->

                <div class="col-md-12">
                    <!-- Exibe mensagens -->
                    <?php if(isset($mensagem)): ?>
                        <div class="alert <?php echo $msg_tipo ?> text-center">
                            <?php echo $mensagem ?>
                        </div>
                    <?php endif; ?>
                    <!-- ./Mensagens -->
            </div>
    
            <!-- Botoes -->
            <div class="col-md-12 mb-3 mt-3">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-4 mb-3 mt-3">
                        <a href="<?php echo site_url('cl_encomendas'); ?>" 
                            class="btn btn-sm btn-info btn-lg btn-block">
                            Continuar Selecionando Produtos
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 mt-3">
                        <a href="<?php echo site_url('cl_carrinho/adicionarProduto'); ?>" 
                            class="btn btn-sm btn-info btn-lg btn-block">
                            Retornar ao Carrinho
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 mt-3">
                        <button type="submit"
                            class="btn btn-sm btn-primary btn-lg btn-block">
                            Concluir Encomenda
                        </button>
                    </div>
                </div>
                <!-- ./ row -->
            </div>
            <!-- ./ botoes -->
    
        </form>
        <!-- Form Principal -->
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

    <script>
        function enderecos_by_clientes(combo_clientes){
            // Busca o valor do combo
            let index_combo = $("#combo_clientes").val();
        
            if( index_combo == '0' ) return resetaCombo('combo_enderecos');

            // Definir um path para a função Ajax
            let chama_metodo = '<?php echo site_url("cl_enderecos/busca_enderecos_by_cliente/"); ?>' + index_combo;
        
            // Call do Ajax (Função do Jquery)
            $.ajax({
                url: chama_metodo,
                type: 'post',
                success: function(result){
                     if(result !== ''){
                        $('#combo_enderecos').html(result);
                    } 
                },
                error: function(){
                    console.log('ERRO de ligação a base de dados...!');
                }
            });
        }

    </script>
