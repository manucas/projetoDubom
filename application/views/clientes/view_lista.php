<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- Container -->
<div class="container mt-3 mb-3">
    <!-- Barra de Ação -->
    <div class="row">
        <div class="col-md-5 mb-3"><h4>Cadastro de Clientes</h4></div>
        
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
            <table id="tabela" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF ou CNPJ</th>
                        <th scope="col">Data Cadastro</th>
                    </tr>
                </thead>
                <!-- ./Thead -->
                <!-- Body -->
                <tbody>
                    <?php if(count($dados)==0) : ?>
                        <tr><td colspan="8"><h5 class="text-center">Não existem registros.</h5></td></tr>
                    <?php else : ?>
                        <?php foreach ($dados as $linha) : ?>
                            <tr>                    
                                <td><?php echo $linha['nome'] ?></td>
                                <td><?php echo $linha['email'] ?></td>
                                <td><?php echo $linha['telefone'] ?></td>
                                <td><?php echo $linha['cpf'] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($linha['data'])); ?></td>
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

