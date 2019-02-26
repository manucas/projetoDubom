<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_perfil extends CI_Controller{

        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index($dados_ret = null){
            $this->controle();
            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Chamar query
            $dados_ret['dados'] = $this->perfil->listar();

            $dados_ret['telativa'] = 'perfil';
            $this->load->view('template/_header');
            $this->load->view('template/topbar',$dados_ret);

            $this->load->view('usuarios/perfil/view_inicio', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function listar(){
            $this->controle();

            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Executa query
            $dados_ret['dados'] = $this->perfil->listar();
      
            $dados_ret['telativa'] = "users";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            $this->load->view('usuarios/perfil/view_lista', $dados_ret);
        
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novo($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = 'perfil';
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('usuarios/perfil/view_novo', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novoGravar(){
            $this->controle();

            $inputs = $this->input->post();

            // Trata checkbox
            if(!isset($inputs['check_status'])){
                $inputs['check_status'] = '0';
            };

            $dados_ret['inputs'] = $this->input->post();

            // Trata os inputs obrigatórios
            if($inputs['text_descricao'] == ''){
                $dados_ret['mensagem'] = "Campo Descrição é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            // Carrega os inputs
            $dados_reg = array(
                'descricao' => $inputs['text_descricao'],
                'status'    => $inputs['check_status'],
                'data'      => date('Y-m-d H:i:s'),
            );

            // Carregar Model
            $this->load->model('mdl_perfil', 'perfil');
            // Chamar query 
            $resultado = $this->perfil->incluir($dados_reg);

            // Trata retorno NOK retorna a view novo 
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = 'perfil';
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('usuarios/perfil/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');                
            } else {
                // Caso Ok evoca view inicio
                // $this->perfil();
                redirect('cl_perfil');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function editar($id, $dados_ret = null){
            $this->controle();
            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Chamar query
            $dados_ret['dados'] = $this->perfil->dados($id);
            
            $dados_ret['telativa'] = 'perfil';

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            $this->load->view('usuarios/perfil/view_editar', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function editarGravar($id){
            $this->controle();

            $inputs = $this->input->post();
            
            // Trata checkbox
            if(!isset($inputs['check_status'])){
                $inputs['check_status'] = '0';
            };

            $dados_ret['inputs'] = $this->input->post();

            // Trata os inputs obrigatórios
            if($inputs['text_descricao'] == ''){
                $dados_ret['mensagem'] = "Campo Descrição é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            // Carrega os inputs
            $dados_reg = array(
                'descricao' => $inputs['text_descricao'],
                'status'    => (int) $inputs['check_status'],
                'data'      => date('Y-m-d H:i:s'),
            );

            // Carrega Model
           $this->load->model('mdl_perfil', 'perfil');
           // Chamar query
           $resultado = $this->perfil->atualizar($id, $dados_reg);
        
           // Trata retorno NOK retorna a view editar
           if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = 'perfil';

                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
                
                // Chama query
                $dados_ret['dados'] = $this->perfil->dados($id);
                
                $this->load->view('usuarios/perfil/view_editar', $dados_ret);
      
                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso OK evoca Metodo index
                // $this->perfil();
                redirect('cl_perfil');
            }
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id, $confirma = false){
            $this->controle();
            // Carregar Model
            $this->load->model('mdl_perfil', 'perfil');

            // Caso confirma NOK retorna a view excluir
            if(!$confirma){
                $dados_ret['telativa'] = 'perfil';
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);

                $dados_ret['dados'] = $this->perfil->dados($id);

                $this->load->view('usuarios/perfil/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            }else{
                $resultado = $this->perfil->excluir($id);
               // Trata retorno NOK retorna a view editar
               if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = 'perfil';

                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
        
                $dados_ret['dados'] = $this->perfil->dados($id);
        
                $this->load->view('usuarios/perfil/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
                }else{
                    // Caso OK evoca Metodo index
                    redirect('cl_perfil');
                }
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++++
        public function ajax_info_perfil($id){
            // Carrega model
            $this->load->model('mdl_perfil', 'perfil');
            // Carrega registro
            $dados_ret = $this->perfil->dados($id);
            // Retorna via JSON
            echo json_encode($dados_ret);
        }
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++

        
    
    }
?>