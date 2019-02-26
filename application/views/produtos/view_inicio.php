<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- Container -->
<div class="container mt-3 mb-3">

    <!-- Barra de Ação -->
    <div class="row">
        <div class="col-md-8 mb-4"><h4>Cadastro de Produtos</h4></div>
        <div class="col-md-2">
            <a href="<?php echo site_url('cl_produtos/novo') ?>" 
            class="btn btn-sm btn-primary btn-lg btn-block">
            Novo Produto
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo site_url('cl_encomendas') ?>" 
            class="btn btn-sm btn-info btn-lg btn-block">
            Sair
            </a>
        </div>
    </div>
    <!-- Barra de Ação -->

    <!-- Row -->
    <div class="row">
        <!-- Tabela responsiva -->
        <div class="table-responsive col-md-12 mt-2 mb-2">
            <table id="tabela0" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col">Grupo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" title="Unidade de Medida.">Un Med</th>
                    <th scope="col" class="text-right" title="Valor Unitário em RBL .">Vlr Un (R$)</th>
                    <th scope="col" class="text-right">Qtde Estoque</th>
                    <th scope="col" class="text-center">Foto</th>
                    <th scope="col" class="text-center">Ações</th>
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
                                <td><?php echo +$linha['grupo'] ? 'Empório' : 'Gelo' ?></td>
                                <td><?php echo $linha['descricao'] ?></td>

                                <td><?php echo $linha['un_med'] ?></td>
                                <td class="text-right"><?php echo number_format($linha['valor_unitario'], 2, ',', '.') ?></td>
                                <td class="text-right"><?php echo number_format($linha['qtde_estoque'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <div class="w-25 container text-center">
                                    <img src="
                                        <?php if($linha['foto'] !== ""){
                                            echo base_url('assets/fotos/'.$linha['foto']);
                                        }else{ 
                                            echo base_url('assets/fotos/sem_imagem.jpg');
                                        }
                                        ?>
                                        " 
                                        class="img-thumbnail" 
                                    > 
                                    </div>
                                </td> 
                                
                                <td class="text-center">
                                    <a href="<?php echo site_url('cl_produtos/excluir/'.$linha['id']) ?>" title="Excluir registro." class="p-2">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>

                                    <a href="<?php echo site_url('cl_produtos/editar/'.$linha['id']); ?>" title="editar Registro." class="p-2">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- ./ Tabela responsiva-->
    </div>
    <!-- ./ Row -->
</div>
<!-- ./Container -->

