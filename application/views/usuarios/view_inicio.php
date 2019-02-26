<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    $sessionDados = $this->session->userdata('logged_in');
    $perfilUser   = $sessionDados['perfilUser'];
    $ativoUser    = $sessionDados['ativoUser'];
 
?>

<!-- Container -->
<div class="container">
  <!-- Barra de Ação -->
  <div class="row">
    <div class="col-md-8 mb-3"><h4>Cadastro de Usuários</h4></div>

    <div class="col-md-2">
      <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1) echo site_url('cl_usuarios/novo'); ?>" 
        class="btn btn-sm btn-primary btn-lg btn-block">
        Novo Usuário
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
            <th scope="col">Perfil</th>
            <th scope="col">Dt Cadastro</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Ações</th>
          </tr>
        </thead>
        <!-- ./Thead -->
        <!-- Body -->
        <tbody>
          <?php if(count($dados)==0) : ?>
            <tr><td colspan="8"><h5 class="text-center">Não existem usuários cadastrados.</h5></td></tr>
          <?php else : ?>
            <?php foreach ($dados as $linha) : ?>
              <tr>                    
                <td><?php echo $linha['nome'] ?></td>
                <td><?php echo $linha['email'] ?></td>
                <td><?php echo $linha['descricao'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($linha['data'])); ?></td>
                  
                <td class="text-center">
                  <span class="badge 
                    <?php if($linha['ativo'] == 1){
                      echo 'badge-success';
                    }else{
                      echo 'badge-danger';
                    } ?>    
                  ">&nbsp;&nbsp;&nbsp;
                  </span>
                </td>
                          
                <td class="text-center">
                  <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1){echo site_url('cl_usuarios/excluir/'.$linha['id']);} ?>" title="Excluir Registro.">
                    <i class="fa fa-trash-o fa-lg"></i>
                  </a>
                  <a href="<?php if(+$perfilUser < 3 && +$ativoUser == 1) echo site_url('cl_usuarios/editar/'.$linha['id']); ?>" title="Editar Registro." class="p-2" >
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
