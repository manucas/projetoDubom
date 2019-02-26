<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_produtos extends CI_Controller{
        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }
  
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index(){
            $this->controle();

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');
            // Carrega dados da tabela
            $dados_ret['dados'] = $this->produtos->listar();

            $dados_ret['telativa'] = "produtos";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            $this->load->view('produtos/view_inicio', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function listar(){
            $this->controle();

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');
            // Busca dados da tabela usuarios
            $dados_ret['dados'] = $this->produtos->listar();
        
            $dados_ret['telativa'] = "produtos";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
        
            $this->load->view('produtos/view_lista', $dados_ret);
                   
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novo($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "produtos";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('produtos/view_novo', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }
 
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novoGravar(){
            $this->controle();

            $inputs = $this->input->post();

            // Trata os inputs
            if($inputs['radio_grupo'] == null){
                $dados_ret['mensagem'] = "Campo Grupo é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }
            if($inputs['text_descricao'] == ''){
                $dados_ret['mensagem'] = "Campo Descrição é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            if($inputs['text_valor_unitario'] == null){
                $dados_ret['mensagem'] = "Campo Valor Unitário é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($dados_ret);
                return;
            }

            // Carrega os inputs
            $dados_reg = array(
                'descricao'      => $inputs['text_descricao'],
                'espec'          => $inputs['text_espec'],
                'un_med'         => $inputs['text_un_med'],
                'valor_unitario' => $inputs['text_valor_unitario'],
                'qtde_estoque'   => $inputs['text_qtde_estoque'],
                'grupo'          => $inputs['radio_grupo'],
            );

            $foto = $_FILES['arqFoto'];
            $novo_nome = $inputs['foto_anterior'];

            if($foto['error'] == 0){
                $novo_nome = uniqid() . '_' . $foto['name'];
                move_uploaded_file($foto['tmp_name'], 'assets/fotos/' . $novo_nome);
            }
            
            // Prepara dados
            $dados_reg['foto'] = $novo_nome;
            $dados_ret['inputs'] = $dados_reg;
            

            // Carrega Model
            $this->load->model('mdl_produtos', 'produto');
            // Executa query
            $resultado = $this->produto->incluir($dados_reg);
            
            // Trata retorno NOK retorna para a view novo
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];

                $dados_ret['telativa'] = "produtos";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('produtos/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
        } else {
                // Caso OK evoca Metodo index
                $this->index();
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function editar($id = null, $dados_ret = null){
            $this->controle();
            // Carrega Model
            $this->load->model('mdl_produtos', 'produto');
            // Busca registro
            $dados_ret['dados'] = $this->produto->dados($id);
            
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('produtos/view_editar', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function editarGravar($id){
            $this->controle();
            
            $inputs = $this->input->post();

            // Trata os inputs
            if($inputs['radio_grupo'] == null){
                $dados_ret['mensagem'] = "Campo Grupo é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }
            if($inputs['text_descricao'] == ''){
                $dados_ret['mensagem'] = "Campo Descrição é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }

            if($inputs['text_valor_unitario'] == null){
                $dados_ret['mensagem'] = "Campo Valor Unitário é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }
            
            // Carrega os inputs
            $dados_reg = array(
                'descricao'      => $inputs['text_descricao'],
                'espec'          => $inputs['text_espec'],
                'un_med'         => $inputs['text_un_med'],
                'valor_unitario' => $inputs['text_valor_unitario'],
                'qtde_estoque'   => $inputs['text_qtde_estoque'],
                'grupo'          => $inputs['radio_grupo'],
            );

            // ---------------------------------------------------------
            // Tratar Arq de foto
            $foto = $_FILES['arqFoto'];

            $novo_nome = $inputs['foto_anterior'];

            if($foto['error'] == 0){
                $novo_nome = uniqid() . '_' . $foto['name'];
            };

            // Remove a foto anterior caso seja diferente da atual
            if($inputs['foto_anterior'] && $inputs['foto_anterior'] !== $novo_nome){
                $pFilename = $inputs['foto_anterior'];
                $old = getcwd(); // Save the current directory
                chdir('assets/fotos/');
                unlink($pFilename);
                chdir($old); // Restore the old working directory   
            }
            // Remove a foto anterior caso seja diferente da atual
            
            // Carrega foto atual na pasta assets/fotos
            move_uploaded_file($foto['tmp_name'], 'assets/fotos/' . $novo_nome);
            // Trata Arq de foto
            // -----------------------------------------------------------

            // Prepara dados
            $dados_reg['foto'] = $novo_nome;

            $dados_ret['inputs'] = $dados_reg;

           // Carrega Model
           $this->load->model('mdl_produtos', 'produto');

           // Executa query
           $resultado = $this->produto->atualizar($id, $dados_reg);

            // Trata Retorno NOK retorna a view editar
           if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = "produtos";

                // Busca dados na tabela
                $dados_ret['dados'] = $this->produto->dados($id);

                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
                // Apresenta a View Editar
                $this->load->view('produtos/view_editar', $dados_ret);
      
                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso OK evoca Metodo index
                $this->index();
            }
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id, $resposta = false){
            $this->controle();

            // Carrega o Model
            $this->load->model('mdl_produtos', 'produto');
            // Caso resposta NOK retorna a view excluir
            if(!$resposta){
                // Busca dados
                $dados_ret['dados'] = $this->produto->dados($id);
                // Retorna a View Excluir para confirmar a Exclusao
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);

                $this->load->view('produtos/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso contrario Excluir registro da tabel do DB
                $this->mdl_produtos->excluir($id);
                $this->index();
            }
        }
    
        // +++++++++++++++++++++++++++++++++++++++++++++++++++++
    }

?>
