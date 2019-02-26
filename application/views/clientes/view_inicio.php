<?php
  defined('BASEPATH') OR exit('URL inválida.');

  $sessionDados = $this->session->userdata('logged_in');
  $perfilUser   = $sessionDados['perfilUser'];
  $ativoUser    = $sessionDados['ativoUser'];
?>
 
<!-- Container -->
<div class="container">
  <!-- Barra de Ação -->
  <div class="row">
      <div class="col-md-8 mb-4"><h4>Cadastro de Clientes</h4></div>
      <div class="col-md-2">
        <a href="<?php echo site_url('cl_clientes/novo') ?>" 
          class="btn btn-sm btn-primary btn-lg btn-block">
          Novo Cliente
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
      <!-- Tabela responsiva-->
      <div class="table-responsive col-md-12 mt-2 mb-2">
        <table id="tabela0" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Telefone</th>
              <th scope="col">CPF ou CNPJ</th>
              <th scope="col">Data Cadastro</th>
              <th scope="col-12" class="text-center">Ações</th>
            </tr>
          </thead>
          <!-- ./Thead -->
          <!-- Body -->
          <tbody>
            <?php if(count($dados)==0) : ?>
              <tr><td colspan="8"><h5 class="text-center">Não existem clientes cadastrados.</h5></td></tr>
            <?php else : ?>
              <?php foreach ($dados as $linha) : ?>
                <tr>                    
                  <td><?php echo $linha['nome'] ?></td>
                  <td><?php echo $linha['email'] ?></td>
                  <td><?php echo $linha['telefone'] ?></td>
                  <td><?php echo $linha['cpf'] ?></td>
                  <td><?php echo date('d/m/Y', strtotime($linha['data'])); ?></td>
                  <td class="text-center">
                    <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1){echo site_url('cl_clientes/excluir/'.$linha['id']);} ?>" title="Excluir registro." class="p-2">
                      <i class="fa fa-trash-o fa-lg"></i>
                    </a>
                    <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1){echo site_url('cl_clientes/editar/'.$linha['id']);} ?>" title="Editar registro." class="p-2">
                      <i class="fa fa-pencil-square-o fa-lg"></i>
                    </a>
                    <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1){echo site_url('cl_enderecos/enderecos/'.$linha['id']);} ?>" title="Cadastro de Endereços." class="p-2">
                      <i class="fa fa-id-card-o fa-lg"></i>
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
    <!-- ./ Primeira Coluna -->
  </div>
  <!-- ./ Row -->
</div>
<!-- ./Container -->