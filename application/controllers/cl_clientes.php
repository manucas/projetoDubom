<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_clientes extends CI_Controller{
    
//            echo "<pre>"; print_r($inputs); echo "</pre>";
//            echo "<pre>"; print_r($dados_ret['cliente']); echo "</pre>";die;

        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
               redirect('geral/quadrologin');
           }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index(){
            $this->controle();

            $dados_ret['telativa'] = "clientes";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Carrega model
            $this->load->model('mdl_clientes', 'clientes');
            // Carrega dados da tabela clientes
            $dados_ret['dados'] = $this->clientes->listar();
            // Apresenta View
            $this->load->view('clientes/view_inicio', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function listar(){
            $this->controle();

            // Carrega model
            $this->load->model('mdl_clientes', 'clientes');
            // Busca dados da tabela usuarios
            $dados_ret['dados'] = $this->clientes->listar();
        
            $dados_ret['telativa'] = "clientes";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
        
            $this->load->view('clientes/view_lista', $dados_ret);
                   
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            // Carrega model
            $this->load->model('mdl_clientes', 'cliente');
            // Carrega dados da tabela
            return $this->cliente->dados($id);
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novo($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "clientes";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('clientes/view_novo', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novoGravar(){
            $this->controle();

            $inputs = $this->input->post();

            // Trata os inputs
            if(empty($inputs['text_nome'])){
                $dados_ret['mensagem'] = "Campo Nome é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }
            if(empty($inputs['text_email'])){
                $dados_ret['mensagem'] = "Campo Email é obrigtório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            $dados_ret['inputs'] = $inputs;

            // Carrega os atributos da tabela
            $dados_reg = array(
                'nome'     => $inputs['text_nome'],
                'email'    => Trim($inputs['text_email']),
                'telefone' => Trim($inputs['text_telefone']),
                'cpf'      => $inputs['text_cpf'],
                'data'     => date('Y-m-d H:i:s'),
            );

            // Carregar Model
            $this->load->model('mdl_clientes', 'cliente');
            // Evoca a query
            $resultado = $this->cliente->incluir($dados_reg);
            // Trata o retorno NOK retorna a view novo
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = "clientes";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('clientes/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');                
            }else{
                // Caso OK evoca index
                // $this->index();
                redirect('cl_clientes');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function editar($id, $dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "clientes";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            $this->load->model('mdl_clientes', 'cliente');
            $dados_ret['dados'] = $this->cliente->dados($id);
            $this->load->view('clientes/view_editar', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function editarGravar($id){
            $this->controle();

            // Carrega Model
           $this->load->model('mdl_clientes', 'cliente');
            // Atualiza registro
           $resultado = $this->cliente->atualizar($id);
        
           // Caso operação NOK retorna a view editar
           if(!$resultado['retorno']){
                $dados['telativa'] = "clientes";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados);
                 
                // Busca dados na tabela
                $dados['cliente'] = $this->cliente->dados($id);
                $dados['mensagem'] = $resultado['mensagem'];
                
                // Apresenta a View Editar
                $this->load->view('clientes/view_editar', $dados);
      
                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso contrario evoca Metodo Home
                // $this->index();
                redirect('cl_clientes');
            }
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id, $confirma = false){
            $this->controle();

            // Carrega o model
            $this->load->model('mdl_clientes', 'cliente');
            // Questiona resposta
            if(!$confirma){
                // Caso FALSE 
                $dados_ret['telativa'] = "clientes";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
                // Carrega o registro
                $dados_ret['dados'] = $this->cliente->dados($id);

                $this->load->view('clientes/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');

            } else {
                // Caso TRUE Excluir registro da tabela
                $this->clientes->excluir($id);

                // Evoca metodo home
                // $this->index();
                redirect('cl_clientes');
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++++
        public function ajax_enderecosCliente($cli_id){
            // Carrega model
            $this->load->model('mdl_enderecos', 'enderecos');
            // Carrega registro
            $resultado = $this->enderecos->enderecosCliente($cli_id);

            foreach($resultado as $linha) {
                $id = $linha['id'];
                $bairro = $linha['bairro'];
                $rua = $linha['rua'];
                $numero = $linha['numero'];
                $complemento = $linha['complemento'];

                $option .= "<option value='$id'>$rua-$numero/$bairro/$complemento</option>"; 
            }
            echo $option;
        }
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        
    }

?>
