<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_usuarios extends CI_Controller{

        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "users";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Carrega model
            $this->load->model('mdl_usuarios');
            // Busca dados da tabela usuarios
            $dados_ret['dados'] = $this->mdl_usuarios->listar();

            $this->load->view('usuarios/view_inicio', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function listar(){
            $this->controle();

            $dados['telativa'] = "users";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados);
            // Carrega model
            $this->load->model('mdl_usuarios', 'usuarios');
            // Busca dados da tabela usuarios
            $dados['dados'] = $this->usuarios->listar();
            $this->load->view('usuarios/view_lista', $dados);

           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novo($dados = null){
            $this->controle();

            $dados['telativa'] = "users";
            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Carrega dados da tabela
            $dados['perfil'] = $this->perfil->listar();

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados);
   
            $this->load->view('usuarios/view_novo', $dados);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novoGravar(){
            $this->controle();
            $inputs = $this->input->post();
            // Trata os inputs

            $dados_ret['inputs'] = $inputs;

            if($inputs['text_nome'] == ''){
                $dados_ret['mensagem'] = "Campo Nome é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }
            if($inputs['text_email'] == ''){
                $dados_ret['mensagem'] = "Campo Email é obrigtório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }
            if($inputs['text_senha'] == ''){
                $dados_ret['mensagem'] = "Campo Senha é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            // Trata checkbox
            if(!isset($inputs['check_ativo'])){
                $inputs['check_ativo'] = '0';
            };

            if(!isset($inputs['combo_perfil'])){
                $inputs['combo_perfil'] = '8';
            };

            // Carrega os inputs
            $dados_reg = array(
                'email'             => Trim($this->input->post('text_email')),
                'senha'             => md5(Trim($this->input->post('text_senha'))),
                'nome'               => $this->input->post('text_nome'),
                'cpf'                => $this->input->post('text_cpf'),
                'perfil_id'          => (int) $this->input->post('combo_perfil'),
                'ativo'              => (int) $this->input->post('check_ativo'),
                'data'               => date('Y-m-d H:i:s'),
                'data_ultimo_acesso' => date('Y-m-d H:i:s')
            );

            // Carregar Model
            $this->load->model('mdl_usuarios');
            // Chama query
            $resultado = $this->mdl_usuarios->incluir($dados_reg);
            // Trata o retorno NOK retorna a view novo
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = "users";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);

                $this->load->view('usuarios/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');                
            } else {
                // Caso retorno OK evoca index
                // $this->index();
                redirect('cl_usuarios');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function editar($id, $dados_ret=null){
            $this->controle();

            $dados_ret['telativa'] = "users";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            // Carrega model
            $this->load->model('mdl_usuarios', 'usuario');
            // Carrega dados da tabela
            $dados_ret['dados'] = $this->usuario->dados($id);
            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Carrega dados da tabela
            $dados_ret['perfil'] = $this->perfil->listar();

            $this->load->view('usuarios/view_editar', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function editarGravar($id){
            $this->controle();

            $inputs = $this->input->post();
            // Trata os inputs

            $dados_ret['inputs'] = $inputs;

            if($inputs['text_nome'] == ''){
                $dados_ret['mensagem'] = "Campo Nome é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }
            if($inputs['text_email'] == ''){
                $dados_ret['mensagem'] = "Campo Email é obrigtório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }

            // Trata checkbox
            if(!isset($inputs['check_ativo'])){
                $inputs['check_ativo'] = '0';
            };

            if(!isset($inputs['combo_perfil'])){
                $inputs['combo_perfil'] = '8';
            };

            // Carrega os inputs
            $dados_reg = array(
                'email'     => Trim($inputs['text_email']),
                'nome'      => $inputs['text_nome'],
                'cpf'       => $inputs['text_cpf'],
                'perfil_id' => $inputs['combo_perfil'],
                'ativo'     => (int) $inputs['check_ativo']
            );

           // Carrega Model
           $this->load->model('mdl_usuarios');
           // Executa query
           $resultado = $this->mdl_usuarios->atualizar($id, $dados_reg);

           // Trata retorno NOK retorna a view editar
           if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = "users";

                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                // Carrega Model
                $this->load->model('mdl_usuarios', 'usuario');
                // Executa query
                $dados_ret['usuario'] = $this->usuario->dados($id);
                
                // Apresenta a View Editar
                $this->load->view('usuarios/view_editar', $dados_ret);
      
                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso contrario evoca Metodo index
                // $this->index();
                redirect('cl_usuarios');
            }
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id, $confirma = false){
            $this->controle();

            // Carrega o Model
            $this->load->model('mdl_usuarios');
            // Trata confirmação NOK retorna a view excluir
            if(!$confirma){

                $dados_ret['telativa'] = "users";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
                // Prepara dados
                $dados_ret['usuario'] = $this->mdl_usuarios->dados($id);

                $this->load->view('usuarios/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // OK executa query
                $this->mdl_usuarios->excluir($id);
                // Retorna ao metodo index
                // $this->index();
                redirect('cl_usuarios');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 
    }

?>
