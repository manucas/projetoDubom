<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_enderecos extends CI_Controller{

        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function enderecos($cli_id, $dados_ret = null){
            $this->controle();
            
            $dados_ret['cliente'] = $this->dadosCliente($cli_id);

            // Carrega model
            $this->load->model('mdl_enderecos', 'enderecos');
            // Carrega dados da tabela
            $dados_ret['dados'] = $this->enderecos->dadosClienteEnderecos($cli_id);

            
            // Busca registros
            $resultado = $this->enderecos->retorna_enderecos_by_cliente($cli_id);
            
            $option = "";
            foreach($resultado as $indice => $linha) {
                $id          = $linha['id'];
                $bairro      = $linha['bairro'];
                $rua         = $linha['rua'];
                $numero      = $linha['numero'];
                $complemento = $linha['complemento'];

                $option .= "<option value='$indice'>$rua-$numero/$bairro/$complemento</option>"; 
            }
  
            $dados_ret['telativa'] = "enderecos)";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            // Apresenta View
            $this->load->view('clientes/enderecos/view_inicio', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novo($cli_id, $dados_ret = null){
            $this->controle();

            $dados_ret['cliente'] = $this->dadosCliente($cli_id);

            $dados_ret['telativa'] = "enderecos";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('clientes/enderecos/view_novo', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }
 
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function novoGravar($cli_id){
            $this->controle();

            $inputs = $this->input->post();

            $dados_ret['inputs'] = $inputs;

            // Trata os inputs
            if($inputs['text_localidade'] == '' || $inputs['text_bairro'] == '' ||
                $inputs['text_rua'] == '' || $inputs['text_numero'] == ''){
                $dados_ret['mensagem'] = "Dados de endereço imcompletos.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->novo($cli_id, $dados_ret);
                return;
            }

            // Prepara dados
            $dados_reg = array(
                'cliente_id'  => $cli_id,
                'tipo'        => $inputs['check_tipo'],
                'contato'     => $inputs['text_contato'],
                'localidade'  => $inputs['text_localidade'],
                'cep'         => $inputs['text_cep'],
                'bairro'      => $inputs['text_bairro'],
                'rua'         => $inputs['text_rua'],
                'numero'      => $inputs['text_numero'],
                'complemento' => $inputs['text_complemento'],
                'data'        => date('Y-m-d H:i:s'),
            );

            if($dados_reg['tipo'] == "") $dados_reg['tipo'] = "Residência";

            // Carrega Model
            $this->load->model('mdl_enderecos', 'endereco');
            // Executa query
            $resultado = $this->endereco->incluir($dados_reg);
            
            // Trata retorno NOK retorna para a view novo
            if(!$resultado['retorno']){

                $dados_ret['cliente'] = $this->dadosCliente($cli_id);

                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];

                $dados_ret['telativa'] = "enderecos";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('clientes/enderecos/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
        } else {
                // Caso OK
                $this->enderecos($cli_id); //  retorna para view inicio de enderecos
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function editar($id, $cli_id){
            $this->controle();
                
            $dados_ret['cliente'] = $this->dadosCliente($cli_id);

            $dados_ret['telativa'] = "enderecos";
            
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            $this->load->model('mdl_enderecos', 'endereco');
            $dados_ret['dados'] = $this->endereco->dados($id);

            $this->load->view('clientes/enderecos/view_editar', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function editarGravar($id, $cli_id){
            $this->controle();
            
            $inputs = $this->input->post();

            $dados_ret['inputs'] = $this->input->post();

            // Trata os inputs
            if($inputs['text_localidade'] == '' || $inputs['text_bairro'] == '' ||
                $inputs['text_rua'] == '' || $inputs['text_numero'] == ''){
                $dados_ret['mensagem'] = "Dados de endereço imcompletos.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->editar($id, $dados_ret);
                return;
            }

            // Carrega os inputs
            $dados_reg = array(
                'tipo'        => $inputs['text_tipo'],
                'contato'     => $inputs['text_contato'],
                'localidade'  => $inputs['text_localidade'],
                'cep'         => $inputs['text_cep'],
                'bairro'      => $inputs['text_bairro'],
                'rua'         => $inputs['text_rua'],
                'numero'      => $inputs['text_numero'],
                'complemento' => $inputs['text_complemento'],
                'data'        => date('Y-m-d H:i:s'),
            );
            
            // Carrega Model
            $this->load->model('mdl_enderecos', 'endereco');
            // Executa query
            $resultado = $this->endereco->atualizar($id, $dados_reg);
            
            // Trata retorno NOK retorna para a view novo
            if(!$resultado['retorno']){
                $dados_ret['cliente'] = $this->dadosCliente($cli_id);
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];

                $dados_ret['telativa'] = "enderecos";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('clientes/enderecos/view_editar', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso OK retorna para view inicio
                $this->enderecos($cli_id);
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id, $cli_id, $resposta = false){
            $this->controle();

            // Carrega o Model
            $this->load->model('mdl_enderecos', 'endereco');
            $dados_ret['dados'] = $this->endereco->dados($id);

            // Caso resposta NOK retorna a view excluir
            if(!$resposta){

                // Carrega o Model
                $this->load->model('mdl_clientes', 'cliente');
                $dados_ret['cliente'] = $this->cliente->dados($cli_id);

                // Retorna a View Excluir para confirmar a Exclusao
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);

                $this->load->view('clientes/enderecos/view_excluir', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {

                // Caso contrario, Excluir registro
                $this->endereco->excluir($id);
                // Retorna aview inicial
                $this->enderecos($cli_id);
            
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        // ++++++++++++++++++++++++++++++++++++++++++++++++++

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dadosCliente($cli_id){
            $this->controle();

            // Carrega model
            $this->load->model('mdl_clientes', 'cliente');
            // Carrega dados da tabela
            return $this->cliente->dados($cli_id);
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function busca_enderecos_by_cliente($cli_id = null){
            $this->controle();
            // Carrega Model
            $this->load->model("mdl_enderecos", "enderecos");
            // Busca registros
            $resultado = $this->enderecos->retorna_enderecos_by_cliente($cli_id);
            
            $option = "<option value='0' disabled selected>Selecione um endereço ...</option>";
            foreach($resultado as $linha) {
                $id          = $linha['id'];
                $bairro      = $linha['bairro'];
                $rua         = $linha['rua'];
                $numero      = $linha['numero'];
                $complemento = $linha['complemento'];

                $option .= "<option value='$id'>$rua-$numero/$bairro/$complemento</option>"; 
            }
            echo $option;
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    }
?>