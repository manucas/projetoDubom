<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>
 
<!-- Container -->
<div class="container col-md-6 mt-3 mb-3">
    <!-- Row 1 -->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 mb-4">
            <legend>Cadastro de Perfil</legend>
        </div>

        <div class="col-xs-6 col-md-4 text-right">
            <a href="<?php echo site_url('cl_perfil/novo'); ?>" 
                class="btn btn-sm btn-primary btn-flat">
                Novo Perfil
            </a>

            <a href="<?php echo site_url('cl_encomendas'); ?>" 
                class="btn btn-sm btn-info btn-flat">
                Sair
            </a>
        </div>
    </div>
    <!-- ./Row 1 -->

    <!-- Row 2 -->
    <div class="row">
        <!-- Tabela responsiva -->
        <div class="table-responsive col-md-12 mt-2 mb-2">
            <table id="tabela0" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Descrição</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <!-- Body -->
                <tbody>
                    <?php if(count($dados)==0) : ?>
                        <tr><td colspan="2"><h5 class="text-center">Nenhum registro encontrado.</h5></td></tr>
                    <?php else : ?>
                        <?php foreach ($dados as $linha) : ?>
                            <tr>                    
                                <td><?php echo $linha['descricao'] ?></td>
                                <td class="text-center">
                                    <span class="badge 
                                        <?php if($linha['status'] == 1){
                                            echo ' badge-success';
                                        }else{
                                            echo ' badge-danger';
                                        }; ?>    
                                    " >&nbsp;&nbsp;&nbsp;
                                    </span>
                                </td>
                          
                                <td class="text-center">
                                    <a href="<?php echo site_url('cl_perfil/excluir/'.$linha['id']) ?>" title="Excluir Registro." class="p-2">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>
                                    <a href="<?php echo site_url('cl_perfil/editar/'.$linha['id']) ?>" title="editar Registro." class="p-2">
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
    <!-- ./Row 2 -->
</div>
<!-- ./Container -->