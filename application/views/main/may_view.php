<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<!-- <div id="fundo-externo">
    <div id="fundo">
        <img src="<?php echo base_url('assets/img/fundo.jpg'); ?>"
        alt="" />
    </div>
</div>
<div id="site">
    <h1>Site Exemplo</h1>
    <p>
        Lorem ipsum...
    </p>
</div>
 -->

<h3>Navbar</h3>

<nav class="navbar navbar-light bg-light navbar-expand-sm">
  <!-- / Titulo -->
  <a class="navbar-brand">Grupo DuBom</a>

  <button class="navbar-toggler" 
      type="button" 
      data-toggle="collapse" 
      data-target=".navbar-collapse">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">

    <ul class="navbar-nav mr-auto">
        <!-- Coluna 1 -->
        <li class="nav-item dropdown">
            <!-- Tilulo Coluna 1 -->
            <a class="nav-link dropdown-toggle" tabindex="0" data-toggle="dropdown" data-submenu>
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
                        <button class="dropdown-item" type="button">Cli Cadastro</button>
                        <button class="dropdown-item" type="button">Cli Lista</button>
                        <button class="dropdown-item" type="button">Cli Relatórios</button>
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
                        <button class="dropdown-item" type="button">Prod Cadastro</button>
                        <button class="dropdown-item" type="button">Prod Lista</button>
                        <button class="dropdown-item" type="button">Prod Relatórios</button>
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
                        <button class="dropdown-item" type="button">Perf Cadastro</button>
                        <button class="dropdown-item" type="button">Perf Lista</button>
                        <button class="dropdown-item" type="button">Perf Relatórios</button>
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
                        <button class="dropdown-item" type="button">Usr Cadastro</button>
                        <button class="dropdown-item" type="button">Usr Lista</button>
                        <button class="dropdown-item" type="button">Usr Relatórios</button>
                    </div>
                </div>

            </div>
        </li>
        <!-- Coluna  1 -->

        <!-- Coluna 2 -->
        <li class="nav-item dropdown">
            <!-- Tilulo Coluna 2 -->
            <a class="nav-link dropdown-toggle" tabindex="0" data-toggle="dropdown" data-submenu>
                Encomendas
            </a>
            <!-- Coluna 2 Menu -->
            <div class="dropdown-menu">
                <!-- Coluna 2 Menu Linha 1 -->
                <button class="dropdown-item" 
                    type="button">
                    Encomendar
                </button>
                <!-- Coluna 2 Menu Linha 2 Item 1 -->
                <button class="dropdown-item" 
                    type="button">
                    Logística de Produtos
                </button>
                <!-- Coluna 2 Menu Linha 3 Item 1 -->
                <button class="dropdown-item" 
                    type="button">
                    Aviso ao Cliente
                </button>
                <!-- Coluna 2 Menu Linha 4 Item 1 -->
                <button class="dropdown-item" 
                    type="button" 
                    disabled>
                    Tratar Remessas
                </button>

                <!-- Coluna 2 Menu Linha 4 Submenu -->
                <div class="dropdown dropright dropdown-submenu">
                    <button class="dropdown-item dropdown-toggle" 
                        type="button">
                        Gestão de Encomendas
                    </button>
                    <!-- Coluna 2 Menu Linha 4 Submenu Itens -->
                    <div class="dropdown-menu">
                        <button class="dropdown-item" type="button">Enco Ajustar</button>
                        <button class="dropdown-item" type="button">Enco Listar</button>
                        <button class="dropdown-item" type="button">Enco Relatórios</button>
                    </div>
                </div>

                <!-- Coluna 2 Menu Linha 5 Submenu -->
                <div class="dropdown dropright dropdown-submenu">
                    <button class="dropdown-item dropdown-toggle" 
                        type="button">
                        Administrar Estoque
                    </button>
                    <!-- Coluna 2 Menu Linha 5 Submenu Itens -->
                    <div class="dropdown-menu">
                        <button class="dropdown-item" type="button">Stock Ajustar</button>
                        <button class="dropdown-item" type="button">Stock Listar</button>
                        <button class="dropdown-item" type="button">Stock Relatórios</button>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <!-- Coluna 3 -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" 
          tabindex="0" 
          data-toggle="dropdown" 
          data-submenu>
          Ferramentas Auxiliares
        </a>

        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown dropleft dropdown-submenu">
            <button class="dropdown-item dropdown-toggle" 
              type="button" 
              data-toggle="dropdown">
              Tabelas Básicas
            </button>

            <div class="dropdown-menu">
              <button class="dropdown-item" type="button">Estágios</button>

              <div class="dropdown dropleft dropdown-submenu">
                <button class="dropdown-item dropdown-toggle" 
                  type="button">
                  Descontos
                </button>

                <div class="dropdown-menu">
                  <button class="dropdown-item" type="button">Cadastrar</button>
                  <button class="dropdown-item" type="button">Listar</button>
                  <button class="dropdown-item" type="button">Relatórios</button>
                </div>
              </div>

              <button class="dropdown-item" type="button">Histórico de Compras</button>
              <button class="dropdown-item" type="button" disabled>Ação Desabilitada</button>

              <div class="dropdown dropleft dropdown-submenu">
                <button class="dropdown-item dropdown-toggle" type="button">Cascata</button>

                <div class="dropdown-menu">
                  <button class="dropdown-item" type="button">Cascata 1</button>
                  <button class="dropdown-item" type="button">Cascata 2</button>
                  <button class="dropdown-item" type="button">Cascata 3</button>
              </div>
            </div>
          </div>
        </div>

        <div class="dropdown-header">Cabeçalho de Dropdown</div>

        <div class="dropdown dropleft dropdown-submenu">
          <button class="dropdown-item dropdown-toggle" type="button">Varrer Chão</button>
          <div class="dropdown-menu">
            <button class="dropdown-item" type="button">Vr Chão 1</button>
            <button class="dropdown-item" type="button">Vr Chão 2</button>
            <button class="dropdown-item" type="button">Vr Chão 3</button>
          </div>
        </div>

        <button class="dropdown-item" type="button">Torrar paciência</button>
        <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button">Encher o Saco</button>
        </div>
      </li>
    </ul>
  </div>
</nav>

  <a class="js-scroll-top scroll-top btn btn-primary btn-sm hidden" href="#container" hidden>
    <span class="fas fa-caret-up fa-2x"></span>
  </a>
