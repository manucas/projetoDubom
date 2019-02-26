<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- Container -->
<div class="container mt-3 mb-3">
    <!-- Barra de Ação -->
    <div class="row">
        <div class="col-md-5 mb-3"><h4>Cadastro de Encomendas</h4></div>
        
        <div class="col-md-4"><h5 class="text-muted">( Lista de Registros )</h5></div>

        <div class="col-md-3">
            <a href="<?php echo site_url('cl_encomendas') ?>" 
            class="btn btn-sm btn-info btn-lg btn-block">
            Sair
            </a>
        </div>
    </div>
    <!-- Barra de Ação -->

    <!-- Row -->
    <div class="row">
        <!-- Tabela responsiva-->
        <div class="table-responsive col-md-12 mt-2 mb-2">
            <table id="tabela" class="table display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Código</th>
                        <th scope="col" class="text-right" title="Valor Encomenda em BRL.">Valor Encomenda BRL</th>
                        <th scope="col" class="text-right" title="Valor Remessa em BRL.">Valor da Remessa BRL</th>
                        <th scope="col">Forma de Pagto</th>
                        <th scope="col">Status</th>                        
                    </tr>
                </thead>
                <!-- ./Thead -->
                <!-- Body -->
                <tbody>
                    <?php if(count($dados)==0) : ?>
                        <tr><td colspan="8"><h5 class="text-center">Nenhum registro encontrado.</h5></td></tr>
                    <?php else : ?>
                        <?php foreach ($dados as $linha) : ?>
                            <tr>                    
                                <td><?php echo $linha['nome'] ?></td>                                
                                <td><?php echo $linha['codigo'] ?></td>
                                <td class="text-right"><?php echo number_format($linha['valor_encomenda'], 2, ',', '.') ?></td>                                
                                <td class="text-right"><?php echo number_format($linha['valor_remessa'], 2, ',', '.') ?></td>                                
                                <td>
                                    <?php 
                                        if($dados[0]['tipo_pagto'] == 1){
                                            echo 'Dinheiro';
                                        }; 
                                        if($dados[0]['tipo_pagto'] == 2){
                                            echo 'Cartão de Débito';
                                        }; 
                                        if($dados[0]['tipo_pagto'] == 3){
                                            echo 'Cartão de Crédito';
                                        }; 
                                        if($dados[0]['tipo_pagto'] == 4){
                                            echo 'PayPal';
                                        }; 
                                    ?>
                                </td>

                                <td><?php echo $linha['descricao'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Código</th>
                        <th scope="col" class="text-right" title="Valor Encomenda em BRL.">Valor Encomenda BRL</th>
                        <th scope="col" class="text-right" title="Valor Remessa em BRL.">Valor da Remessa BRL</th>
                        <th scope="col">Forma de Pagto</th>
                        <th scope="col">Status</th>                        
                    </tr>
                </tfoot>


            </table>
        </div>
        <!-- ./ Tabela responsiva-->
    </div>
    <!-- ./ Row -->
</div>
<!-- ./Container -->
