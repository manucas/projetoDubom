<?php
  defined('BASEPATH') OR exit('URL inválida.');

  $sessionDados = $this->session->userdata('logged_in');
  $perfilUser   = $sessionDados['perfilUser'];
  $ativoUser    = $sessionDados['ativoUser'];
?>

<!-- Container -->
<div class="container">
  <!-- Row -->
  <div class="row">
    <!-- Primeira coluna -->
    <div class="col-md-10 offset-1 order-md-1">
      <!-- Titulo -->
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-12 mb-4 text-center">
          <h4>Cliente: &nbsp;&nbsp;<?php echo $cliente ? $cliente['nome'] : ''; ?></h4>
        </div>
      </div>
      <!-- ./ Titulo -->

      <!-- Barra de Ação -->
      <div class="row">
          <div class="col-md-8 mb-4"><h4>Cadastro de Endereços</h4></div>
          <div class="col-md-2">
            <a href="<?php echo site_url('cl_enderecos/novo') ?>/<?php echo $cliente['id'];?>" 
              class="btn btn-sm btn-primary btn-lg btn-block">
              Novo Endereço
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?php echo site_url('cl_clientes') ?>" 
              class="btn btn-sm btn-info btn-lg btn-block">
              Retornar
            </a>
          </div>
      </div>
      <!-- Barra de Ação -->

      <!-- Tabela responsiva -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Tipo</th>
              <th scope="col">Contato</th>
              <th scope="col">CEP</th>
              <th scope="col">Localidade</th>
              <th scope="col">Bairro</th>
              <th scope="col">Rua</th>
              <th scope="col">Número</th>
              <th scope="col" class="text-center">Ações</th>
            </tr>
          </thead>
          <!-- ./Thead -->
          <!-- Body -->
          <tbody>
            <?php if(count($dados)==0) : ?>
              <tr><td colspan="8"><h5 class="text-center">Não existem endereços cadastrados para este cliente.</h5></td></tr>
            <?php else : ?>
              <?php foreach ($dados as $linha) : ?>
                <tr>                    
                  <td><?php echo $linha['tipo']; ?></td>
                  <td><?php echo $linha['contato']; ?></td>
                  <td><?php echo $linha['cep']; ?></td>
                  <td><?php echo $linha['localidade']; ?></td>
                  <td><?php echo $linha['bairro'] ?></td>
                  <td><?php echo $linha['rua'] ?></td>
                  <td><?php echo $linha['numero'] ?></td>
                      
                  <td class="text-center">
                    <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1) echo site_url('cl_enderecos/excluir/'.$linha['id']);?>/<?php echo $cliente['id'];?>" 
                      class="p-2" 
                      title="Excluir Registro.">
                      <i class="fa fa-trash-o fa-lg"></i>
                    </a>
                    <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1) echo site_url('cl_enderecos/editar/'.$linha['id']);?>/<?php echo $cliente['id'];?>" 
                      class="p-2"
                      title="Editar Registro.">
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
    <!-- ./ Primeira Coluna -->
  </div>
  <!-- ./ Row -->
</div>
<!-- ./Container -->
