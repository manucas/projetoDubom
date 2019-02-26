<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_carrinho extends CI_Controller{
    
        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index($dados_ret = null){
            $this->controle();

            $dados_ret['telativa'] = "carrinho";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Carrega model

            // Apresenta View
            $this->load->view('encomendas/carrinho/view_carrinho', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++
        public function adicionarProduto($prod_id = null){
            $this->controle();

            $marcados = $_SESSION['itens_marcados'];

            // Array que vai receber atributos da tabela
            $produto = array(
                'produto_id'     => "",
                'descricao'      => "",
                'espec'          => "",
                'un_med'         => "",
                'qtde_encomenda' => 0,
                'valor_unitario' => 0,
                'qtde_encomenda' => 0,
                'sub_total'      => 0,
            );

            $dados = array();

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');

            // Produz array com os produtos selecionados tendo marcados com indice e qtde
            foreach($marcados as $prod_id => $qtde){

                // Busca o produto
                $resultado = $this->produtos->dados($prod_id);
                // Produz array com dados do registro mais a qtde encomendada mais o sub_total 
                $produto['produto_id']     = $resultado['id'];
                $produto['descricao']      = $resultado['descricao'];
                $produto['espec']          = $resultado['espec'];
                $produto['un_med']         = $resultado['un_med'];
                $produto['valor_unitario'] = (float) $resultado['valor_unitario'];
                $produto['qtde_encomenda'] = (float) $qtde;
                $produto['sub_total']      = (float) $resultado['valor_unitario']*$qtde;

                // Transfere o array produto para o array dados
                array_push($dados, $produto);
            }
            // Produz array com os produtos selecionados tendo marcados com indice e qtde

            // Prepara dados para a view
            $dados_ret['dados'] = $dados;

            $this->index($dados_ret);

        }

        // ++++++++++++++++++++++++++++++++++++++++++++++
        public function removerProduto($prod_id = null){
            $this->controle();

            $prod_id = intval($prod_id); // para aceitar somente numeros

            $marcados = $_SESSION['itens_marcados'];

            // Trata qtde para o produto selecionado
            if(isset($marcados[$prod_id])){
                unset ($marcados[$prod_id]);
            }

            // Grava na ssession o id e qtde de cada produto selecionado
            $this->session->set_userdata('itens_marcados', $marcados);

            if(count ($marcados) == 0){
//                echo "<pre> NADA "; print_r($_SESSION['itens_marcados']); echo "</pre>";
                redirect('cl_encomendas');
            }else{
//                echo "<pre> TEM "; print_r($_SESSION['itens_marcados']); echo "</pre>";
                $this->adicionarProduto();
            }
        }

        // +++++++++++++++++++++++++++++++++++++++++++++++
        public function recalcularCarrinho(){
            $this->controle();

            $inputs = $this->input->post();

            // ++++++ Monta a grade de produtos selecionados ++++++++
            // Array que vai receber atributos da tabela
            $produto = array(
                'produto_id'     => "",
                'descricao'      => "",
                'espec'          => "",
                'un_med'         => "",
                'qtde_encomenda' => 0,
                'valor_unitario' => 0,
                'qtde_encomenda' => 0,
                'sub_total'      => 0,
            );
 
            $dados = array();

            // Carrega dados da session marcados
            $marcados = $_SESSION['itens_marcados'];

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');

            // Produz array com os produtos selecionados tendo marcados com indice e qtde
            foreach($inputs as $prod_id => $qtde){

                // Busca o produto
                $resultado = $this->produtos->dados($prod_id);
                // Produz array com dados do registro mais a qtde encomendada mais o sub_total 
                $produto['produto_id']     = $resultado['id'];
                $produto['descricao']      = $resultado['descricao'];
                $produto['espec']          = $resultado['espec'];
                $produto['un_med']         = $resultado['un_med'];
                $produto['valor_unitario'] = (float) $resultado['valor_unitario'];
                $produto['qtde_encomenda'] = (float) $qtde;
                $produto['sub_total']      = (float) $resultado['valor_unitario']*$qtde;

                // Transfere o array produto para o array dados
                array_push($dados, $produto);

                // Atualiza qtdes da session marcados
                $marcados[$prod_id] = $qtde;

            }
            // Array com produtos selecionados utilizando como indice marcados(indice e qtde)
            // ++++++ Monta a grade de produtos selecionados ++++++++

            // Prepara dados para a view
            $dados_ret['dados'] = $dados;

            // Atualiza a session marcados
            $this->session->set_userdata('itens_marcados', $marcados);
            
            $this->index($dados_ret);

        }

//            echo "<pre>"; print_r($dados_ret['produtos']); echo "</pre>";
//            die;

    }
?>