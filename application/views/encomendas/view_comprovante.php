<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');

//    echo "<pre>"; print_r($dados[0]); echo "</pre>";

?>

<!-- Container -->
<div class="w-auto container">

    <!-- Titulo -->
    <div class="col-md-8 offset-2 text-center mb-4">
        <h4 class="mb-3">
            Dados da Encomenda:
            <small class="text-muted">
                &nbsp;
                <?php echo $dados[0]['codigo'] ? $dados[0]['codigo'] : '' ?>
                &nbsp;
            </small>
        </h4>
    </div>
    <!-- ./ Titulo -->

    <!-- Container -->
    <div class="w-auto container">
        <!-- Linha 1 -->
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2 mb-2">
                <h5 class="">
                    <span>Cliente:</span>
                    <small class="text-muted">&nbsp;&nbsp;
                        <?php echo $dados[0]['nome'] ? $dados[0]['nome'] : '' ?>
                        &nbsp;/&nbsp; Telefone:&nbsp; 
                        <?php echo $dados[0]['telefone'] ? $dados[0]['telefone'] : '' ?>
                        &nbsp;/&nbsp; Email:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['email'] : '' ?>
                    </small>
                </h5>
            </div>
        </div>
        <!-- ./ linha 1 -->

        <!-- Linha 2 -->
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2">
                <h5 class="">
                    <span>Dados para entrega : </span>
                    <small class="text-muted">&nbsp;&nbsp;
                        CEP: &nbsp;
                        <?php echo $dados[0] ? $dados[0]['cep'] : '' ?>
                        &nbsp;/&nbsp; Telefone:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['telefone'] : '' ?>
                        &nbsp;/&nbsp; Contato:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['contato'] : '' ?>
                    </small>
                </h5>
            </div>
        </div>
        <!-- ./ linha 2 -->

        <!-- Linha 3 -->
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2 mb-2">
                <h5 class="">
                    <small class="text-muted">&nbsp;&nbsp;
                        Localidade: &nbsp;
                        <?php echo $dados[0] ? $dados[0]['localidade'] : '' ?>
                        &nbsp;/&nbsp; Bairro:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['bairro'] : '' ?>
                        &nbsp;/&nbsp; Rua:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['rua'] : '' ?>
                        &nbsp;/&nbsp; Num.:&nbsp; 
                        <?php echo $dados[0] ? $dados[0]['numero'] : '' ?>
                        &nbsp;/&nbsp;
                        <?php echo $dados[0] ? $dados[0]['complemento'] : '' ?>
                    </small>
                </h5>
            </div>
        </div>
        <!-- ./ linha 2 -->

        <!-- Linha 4 -->
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2 mb-4">
                <h5 class="">
                    <span>Forma de pagamento : </span>
                        <small class="text-muted">&nbsp;&nbsp;
                        <?php 
                            if($dados[0]['tipo_pagto'] == 1){
                                echo 'Pagamento em Dinheiro';
                            }; 
                            if($dados[0]['tipo_pagto'] == 2){
                                echo 'Pagamento com cartão de Débito';
                            }; 
                            if($dados[0]['tipo_pagto'] == 3){
                                echo 'Pagamento com cartão de Crédito';
                            }; 
                            if($dados[0]['tipo_pagto'] == 4){
                                echo 'Pagamento com PayPal';
                            }; 
                        ?>
                        </small>
                </h5>
            </div>
        </div>
        <!-- ./ linha 2 -->

    </div>
    <!-- ./ container -->

    <!-- Container -->
    <div class="w-auto container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2">
                <!-- Tabela responsiva-->
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Un Med</th>
                        <th scope="col" class="text-right">Qtde</th>
                        <th scope="col" class="text-right">Valor (R$)</th>
                        </tr>
                    </thead>
                    <!-- ./Thead -->
                    <!-- Body -->
                    <tbody>
                        <?php if(count($dados) == 0) : ?>
                        <tr><td colspan="8"><h5 class="text-center">Não existem itens desta encomenda.</h5></td></tr>
                        <?php else : ?>
                        <?php foreach ($dados as $linha) : ?>
                            <tr style="color:navy">                    
                            </tr>
                            <tr>                    
                                <td><?php echo $linha['descricao'] ?></td>
                                <td><?php echo $linha['un_med'] ?></td>
                                <td class="text-right"><?php echo $linha['qtde'] ?></td>
                                <td class="text-right">
                                    <?php echo number_format($linha['sub_total'], 2, ',', '.'); ?>
                                </td>
                            </tr>
                            <tr>                    
                                <td colspan="4" style="color:navy;">
                                    <?php echo $linha['espec'] ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="3">Total da encomenda </td>
                            <td class="text-right">
                                <?php echo number_format($linha['valor_encomenda'], 2, ',', '.'); ?>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- ./ Tabela responsiva-->
            </div>
            <!-- ./ coluna -->
        </div>
        <!-- ./ row -->
    </div>
    <!-- ./ container -->

    <!-- Container -->
    <div class="w-auto container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 offset-2">
                <a href="<?php echo site_url('cl_encomendas'); ?>" 
                    class="btn btn-sm btn-info btn-lg btn-block">
                    Retornar a Seleção de Produtos
                </a>
            </div>
        </div>
        <!-- ./ row -->
    </div>
    <!-- ./ container -->

</div>
<!-- Container -->
