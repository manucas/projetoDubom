<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- Container -->
<div class="container col-md-10 mt-3 mb-3">
    <!-- Barra de Ação -->
    <div class="row">
        <div class="col-md-5 mb-3"><h4>Cadastro de Usuários</h4></div>
        
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
            <table class="table table-striped" id="tabela">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Data Cadastro</th>
                    <th scope="col">Último acesso</th>
                    <th scope="col" class="text-center">Status</th>
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
                                <td><?php echo $linha['email'] ?></td>
                                <td><?php echo $linha['descricao'] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($linha['data'])); ?></td>
                                <td><?php echo $linha['data_ultimo_acesso'] ? date('d/m/Y H:i:s', strtotime($linha['data_ultimo_acesso'])) : ''?></td>
                                <!-- <td><?php echo date('d/m/Y H:i:s', strtotime($linha['data_ultimo_acesso'])); ?></td> -->

                                <td class="text-center">
                                    <span class="badge 
                                        <?php if($linha['ativo'] == 1){
                                            echo 'badge-success';
                                        }else{
                                            echo 'badge-danger';
                                        } ?>    
                                    ">
                                        &nbsp;&nbsp;&nbsp;
                                    </span>
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

