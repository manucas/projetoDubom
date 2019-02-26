<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Geral extends CI_Controller{
    
        // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function __construct(){
            parent::__construct();
            date_default_timezone_set('America/Sao_Paulo');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index()
        {
            // Caso exista seção iniciada evoca menu inicial
            if($this->session->has_userdata('logged_in')){
                $this->menuInicial();
            }else{
                // Caso contrario evoca quadro login
                $this->quadroLogin();
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++
        public function menuInicial(){
            // Caso não exista uma sessão iniciada evoca o quadro login
            if(!$this->session->has_userdata('logged_in')){
                $this->quadroLogin();
            }else{
                // Caso contrario, Redireciona para Splash
                redirect('cl_splash');
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++
        public function quadroLogin(){
            // Caso exista uma sessão iniciada evoca o menu inicial
            if($this->session->has_userdata('logged_in')){
                $this->menuInicial();
            }
            // Caso contrario Apresenta View login
            $this->load->view('template/_header');

            $this->load->view('main/view_login');

            $this->load->view('template/_footer');
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++==++
        public function login(){
            // Caso exista uma sessão iniciada evoca o menu inicial
            if($this->session->has_userdata('logged_in')){
                $this->menuInicial();
            }else{
                // Caso contrario, carrega o model usuarios
                $this->load->model('mdl_usuarios', 'usuario');
                // Tenta logar o usuario
                if($this->usuario->logar()){
                    // Sucesso evoca menu inicial
                    $this->menuInicial();
                }else{
                    // Caso contrario evoca login invalido
                    $this->loginInvalido();
                }
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++++
        public function loginInvalido(){
            // Caso exista uma sessão iniciada evoca o menu inicial
            if($this->session->has_userdata('logged_in')){
                $this->menuInicial();
            }else{

                // Array associativo com 3 itens
                $dados_ret = [
                    'mensagem' => 'Email inválido ou usuário desativado.',
                    'msg_tipo' => 'alert-info',
                    'link'	   => 'geral'
                ];

                // Apresenta View login
                $this->load->view('template/_header');

                $this->load->view('main/view_login', $dados_ret);

                $this->load->view('template/_footer');
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++=
        public function logout(){
            // Caso exista uma sessão 'logged_in' inicializada, elimina a mesma
            if($this->session->has_userdata('logged_in')){
                $this->session->unset_userdata('logged_in');
                session_destroy();
            }
            // Inicializa o quadro login
            $this->index();
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++=
    }
?>