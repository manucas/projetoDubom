<?php
  defined('BASEPATH') OR exit('No direct script access allowed.');
    
  $sessionDados = $this->session->userdata('logged_in');
  $nomeUser     = $sessionDados['nomeUser'];
  $perfilUser   = $sessionDados['perfilUser'];

?>

<body>

  <!-- Barra de navegação no topo da pagina   -->
  <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">

      <!-- Logomarca -->
      <a tilte="Home." href="<?php echo site_url('cl_encomendas'); ?>" class="navbar-brand">
        <img src="<?php echo base_url('assets/img/logo-db.png'); ?>" class="img-fluid">
      </a>
      <!-- ./Logomarca -->
      
      <!-- Alternância da barra de navegação -->
      <button class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarResponsive" 
        aria-controls="navbarResponsive" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- ./ Alternância da barra de navegação -->
      
      <!-- Menu Barra de navegação Responsiva -->
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav">


          <!-- Coluna 1 -->
          <li class="nav-item dropdown">
              <!-- Tilulo Coluna 1 -->
              <a class="nav-link dropdown-toggle" 
                tabindex="0" 
                data-toggle="dropdown" 
                data-submenu>
                Configurações
              </a>
              <!-- Coluna 1 Menu -->
              <div class="dropdown-menu">
                  <!-- Coluna 1 Submenu -->
                  <div class="dropdown dropright dropdown-submenu">
                      <!-- Coluna 1 Menu Linha 1 Item 1 -->
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Clientes
                      </button>
                      <!-- Coluna 1 Menu Linha 1 Submenu Itens -->
                      <div class="dropdown-menu">              
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_clientes'); ?>">Cadastro</a>
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_clientes/listar'); ?>">Lista</a>
                      </div>
                  </div>

                  <!-- Coluna 1 Menu Linha 2 Item 1 -->
                  <div class="dropdown dropright dropdown-submenu">
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Produtos
                      </button>
                      <!-- Coluna 1 Menu Linha 2 Submenu Itens -->
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?php if(+$perfilUser < 4) echo site_url('cl_produtos'); ?>">Cadastro</a>
                          <a class="dropdown-item" href="<?php if(+$perfilUser < 4) echo site_url('cl_produtos/listar'); ?>">Lista</a>
                      </div>
                  </div>

                  <!-- Coluna 1 Menu Linha 3 Item 1 -->
                  <div class="dropdown dropright dropdown-submenu">
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Perfil
                      </button>
                      <!-- Coluna 1 Menu Linha 3 Submenu Itens -->
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_perfil'); ?>">Cadastro</a>
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_perfil/listar'); ?>">Lista</a>
                      </div>
                  </div>

                  <!-- Coluna 1 Menu Linha 4 Item 1 -->
                  <div class="dropdown dropright dropdown-submenu">
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Usuários
                      </button>
                      <!-- Coluna 1 Menu Linha 4 Submenu Itens -->
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_usuarios'); ?>">Cadastro</a>
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_usuarios/listar'); ?>">Lista</a>
                      </div>
                  </div>

              </div>
          </li>
          <!-- Coluna  1 -->

          <!-- Coluna 2 -->
          <li class="nav-item dropdown">
              <!-- Tilulo Coluna 2 -->
              <a class="nav-link dropdown-toggle" 
                tabindex="0" 
                data-toggle="dropdown" 
                data-submenu>
                Empório
              </a>
              <!-- ./ Titulo -->

              <!-- Coluna 2 Menu -->
              <div class="dropdown-menu">
                  <div class="dropdown dropright dropdown-submenu">
                      <!-- Coluna 2 Menu Linha 1 Item 1 -->
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Encomendas
                      </button>
                      <!-- Coluna 2 Menu Linha 1 Submenu Itens -->
                      <div class="dropdown-menu">              
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_encomendas/listar'); ?>">Lista</a>
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_encomendas/ajustar'); ?>">Ajustes</a>
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_encomendas/aviso'); ?>">Aviso ao Cliente</a>
                      </div>
                  </div>

                  <div class="dropdown-divider"></div>

                  <div class="dropdown dropright dropdown-submenu">
                      <!-- Coluna 2 Menu Linha 2 Item 1 -->
                      <button 
                          class="dropdown-item dropdown-toggle" 
                          type="button" 
                          data-toggle="dropdown">
                          Produtos
                      </button>
                      <!-- Coluna 2 Menu Linha 2 Submenu Itens -->
                      <div class="dropdown-menu">              
                        <a class="dropdown-item" href="<?php if(+$perfilUser < 3) echo site_url('cl_produtos/ajustar'); ?>">Ajustes de Stock</a>
                      </div>
                  </div>
              </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
    
        </ul>

        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item">
            <span title="Usuário Logado." class="nav-link">&nbsp;<?php echo $nomeUser; ?></span>
          </li>

          <li class="nav-item">
            <a title="Sair do Aplicativo." class="nav-link" href="<?php echo site_url('geral/logout'); ?>" target="_blank">
              <span class="glyphicon glyphicon-shopping-car"></span>
              &nbsp;&nbsp;Logout...
            </a>
          </li>
        </ul>

      </div>
      <!-- ./Menu Barra de navegação Responsiva -->
    </div>
    <!-- ./container -->
  </div>
  <!-- ./barra de navegação -->
  
  <!-- Dispositivo auxiliar da mecanica de submenus da barra de menu -->
  <a class="js-scroll-top scroll-top btn btn-primary btn-sm hidden" href="#container" hidden>
    <span class="fas fa-caret-up fa-2x"></span>
  </a>
  <!-- Dispositivo auxiliar da mecanica de submenus da barra de menu -->
