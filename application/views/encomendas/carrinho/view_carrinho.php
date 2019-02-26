<?php
    defined('BASEPATH') OR exit('URL inválida.');
    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;

//  echo "<pre>"; print_r($_SESSION['carrinho']); echo "</pre>";
    
//    $carrinho = $_SESSION['carrinho'];
    
?>


<!-- Container -->
<div class="container mt-3 mb-3 col-md-8">
  <!-- Content 1 -->
  <div class="content">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-8">
        <legend>Carrinho de Encomendas</legend>
      </div>
    </div> 
  </div>
  <!-- ./Content 1     -->
  <!-- Content 2 -->
  <div class="content">

    <div class="table-responsive">
        <!-- Table -->
        <table class="table">
            <!-- Thead -->
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col" class="text-right">Quantidade</th>
                    <th scope="col" class="text-right">Preço</th>
                    <th scope="col" class="text-right">SubTotal</th>
                    <th scope="col" class="text-center">Remover</th>
                </tr>
            </thead>
            <!-- ./Thead -->
            
                <!-- Form -->
                <form action="<?php echo site_url('cl_carrinho/recalcularCarrinho'); ?>" method="POST">
        
            <!-- Foot -->
            <tfoot>
                <tr>
                    <td>
                        <a href="<?php echo site_url('cl_encomendas'); ?>" 
                            class="btn btn-sm btn-info btn-lg btn-block">
                            Continuar Selecionando Produtos
                        </a>
                    </td>
                    <td colspan="2">
                        <button type="submit" 
                            class="btn btn-sm btn-secondary btn-lg btn-block">
                            Recalcular
                        </button>
                    </td>
                    <td colspan="2">
                        <a href="<?php echo site_url('cl_checkout'); ?>" 
                            class="btn btn-sm btn-primary btn-lg btn-block">
                            CheckOut
                        </a>
                    </td>
                </tr>
            </tfoot>
            <!-- ./ Foot -->

            <!-- tbody -->
            <tbody>
            
            <?php if(count($dados)==0) : ?>
                <tr><td colspan="5"><td class="text-center"><strong>Não há produto no carrinho.</strong></td>
            <?php else : ?>
                <?php $valor_encomenda = 0 ?> 
            
                <?php foreach ($dados as $linha) : ?>
                
                <tr>                    
                    <td><?php echo $linha['descricao'] ?></td>
                    <td class="text-right">
                        <input type="text" 
                            class="text-right"
                            size=5
                            name="<?php echo $linha['produto_id']; ?>"
                            placeholder = "Quantidade"
                            title="Máximo 7 inteiros ou (4 inteiros + pto-decimal + 3 decimais)"
                            step="0.0010"
                            min="1.000"
                            max="99999999.999"


                            value="<?php echo $linha['qtde_encomenda']; ?>"
                        >
                    <td class="text-right">R$&nbsp;&nbsp;<?php echo number_format($linha['valor_unitario'], 2, ',', '.') ?></td>
                    <td class="text-right">R$&nbsp;&nbsp;<?php echo number_format( $linha['sub_total'], 2, ',', '.') ?></td>
                    <td class="text-center">
                        <a href="<?php echo site_url('cl_carrinho/removerProduto/'.$linha['produto_id']); ?>" 
                            class="btn btn-sm btn-danger btn-lg btn-block">Remover
                        </a>
                    </td>
                </tr>
                
                    <?php $valor_encomenda += $linha['sub_total']; ?> 
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-right">
                        <span>Total (BRL)</span>
                        <strong>R$&nbsp;&nbsp;&nbsp; <?php echo number_format($valor_encomenda, 2, ',', '.'); ?></strong>
                    </td>
                </tr>
            </tbody>
            <!-- ./ tbody -->

                </form>
                <!-- ./ Form -->
        </table>
        <!-- ./ Table -->
      </div>
    <?php endif; ?>
  </div>
  <!-- ./Content 2 -->
</div>
<!-- ./Container -->

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