<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- Container -->
<div class="container col-md-6 mt-3 mb-3">
    <!-- Barra de navegação -->
    <div class="row">
        <div class="col-md-6">
            <legend>Cadastro de Perfil</legend>
        </div>

        <div class="col-md-4">
            <h5 class="text-muted">( Lista de Registros )</h5>
        </div>

        <div class="col-md-2 text-right">
            <a href="<?php echo site_url('cl_encomendas') ?>" 
                class="btn btn-sm btn-info btn-lg btn-block">
                Sair
            </a>
        </div>
    </div>
    <!-- ./Barra de navegação -->

    <div class="row">
        <!-- Tabela responsiva-->
        <div class="table-responsive col-md-12 mt-2 mb-2">
            <table class="table table-striped" id="tabela">
                <thead>
                    <tr>
                        <th scope="col">Descrição</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <!-- ./Thead -->

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

