<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_encomendas extends CI_Controller{
        
        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        private function obterCodigo(){
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $final = "";
            for ($i=0; $i < 10; $i++) { 
                $final .= substr($chars, renad(0,strlen($chars)),1); 
            }
            return $final;
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index($dados_ret=null){
            $this->controle();

            $dados_ret['telativa'] = "Emcomendas";
            $dados_ret['qtdeItensCar'] = 0;

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Carrega model
            $this->load->model('mdl_produtos');
            // Carrega dados da tabela
            $dados_ret['produtosG'] = $this->mdl_produtos->dadosEncomenda(0);
            $dados_ret['produtosE'] = $this->mdl_produtos->dadosEncomenda(1);

            // Apresenta View
            $this->load->view('encomendas/view_inicio', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function listar(){
            $this->controle();

            // ++++++ Monta a grade de produtos encomendados ++++++++
            // Carrega model
            $this->load->model('mdl_encomendas', 'encomendas');

            // Busca encomendados
            $dados_ret['dados'] = $this->encomendas->listar();

            $dados_ret['telativa'] = "encomendas";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('encomendas/view_lista', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++
        public function selecionarProduto($prod_id = null){
            $this->controle();

            // $array[1] = 10; (produto 1 recebe valor 10)
            // $array[2] = 30; (produto 2 recebe valor 30)
            // ou
            // $array = array(1 => 10, 2 => 30);

            // Artificio para preservar o id do produto selecinado
            $prod_id = intval($prod_id); // para aceitar somente numeros

            if(!$this->session->has_userdata('itens_marcados')){
                $this->session->set_userdata('itens_marcados',array());
            }

            $marcados = $_SESSION['itens_marcados'];

            // Trata qtde para o produto selecionado
            if(isset($marcados[$prod_id])){
                $marcados[$prod_id] += 1;
            }else{
                $marcados[$prod_id] = 1;
            }

            // Grava na ssession o id e qtde de cada produto selecionado
            $this->session->set_userdata('itens_marcados', $marcados);

            redirect('cl_carrinho/adicionarProduto');
        }
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function clientes($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "clientes";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
   
            $this->load->view('encomendas/clientes/view_novo', $dados_ret);
                
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function clientesGravar(){
            $this->controle();

            $inputs = $this->input->post();

            // Trata os inputs
            if($inputs['text_nome'] == ''){
                $dados_ret['mensagem'] = "Campo Nome é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->clientes($dados_ret);
                return;
            }
            if($inputs['text_email'] == ''){
                $dados_ret['mensagem'] = "Campo Email é obrigtório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->clientes($dados_ret);
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
            $this->load->model('mdl_clientes', 'clientes');

            // Evoca a query
            $resultado = $this->clientes->incluir($dados_reg);
            // Trata o retorno NOK retorna a view novo
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $dados_ret['telativa'] = "clientes";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
            
                $this->load->view('encomendas/clientes/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');                
            }else{
                // Caso OK 
                redirect('cl_checkout'); //  retorna para view checkout
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function enderecos($cli_id = null){
            $this->controle();

            $cli_id = intval($cli_id)*1;

            if($cli_id > 0){

                // Carrega model
                $this->load->model('mdl_clientes', 'cliente');
                // Carrega dados da tabela

                $dados_ret['cliente'] = $this->cliente->dados($cli_id);

                $dados_ret['telativa'] = "enderecos";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);
    
                $this->load->view('encomendas/enderecos/view_novo', $dados_ret);
                    
                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            }else{
                redirect('cl_checkout'); // Retonar para o checkout 
            }
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function enderecosGravar(){
            $this->controle();

            $inputs = $this->input->post();

            $dados_ret['inputs'] = $inputs;

            // Trata os inputs
            if($inputs['text_localidade'] == '' || $inputs['text_bairro'] == '' ||
                $inputs['text_rua'] == '' || $inputs['text_numero'] == ''){
                $dados_ret['mensagem'] = "Dados de endereço imcompletos.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->enderecos($cli_id, $dados_ret);
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
                $dados_ret['dados_cli'] = $this->dadosCliente($cli_id);
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];

                $dados_ret['telativa'] = "encomendas";
                $this->load->view('template/_header');
                $this->load->view('template/topbar', $dados_ret);

                $this->load->view('encomendas/enderecos/view_novo', $dados_ret);

                $this->load->view('template/rodape');
                $this->load->view('template/_footer');
            } else {
                // Caso OK
                redirect('cl_checkout'); //  retorna para view checkout
            }
        }

//            echo "<pre>"; print_r($inputs); echo "</pre>";
//            echo "<pre>"; print_r($pedido); echo "</pre>";die;

    }

?>
