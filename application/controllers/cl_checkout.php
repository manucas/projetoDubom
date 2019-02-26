<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_checkout extends CI_Controller{

//            echo "<pre>"; print_r($inputs); echo "</pre>";
//            echo "<pre>"; print_r($pedido); echo "</pre>";die;

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
            for ($i=0; $i < 9; $i++) { 
                $final .= substr($chars, rand(0,strlen($chars)),1); 
            }
            return $final;
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index($dados_ret = null){
            $this->controle();
            
            if(!$this->session->has_userdata('itens_marcados')){
                redirect('cl_encomendas');
            }

            if(count ($_SESSION['itens_marcados']) == 0){
                redirect('cl_encomendas');
            }

            // ++++++ Monta a grade de produtos selecionados ++++++++
            // Array que vai receber atributos da tabela
            $produto = array(
                'produto_id'      => "",
                'descricao'       => "",
                'espec'           => "",
                'un_med'          => "",
                'qtde_encomenda'  => 0,
                'sub_total'       => 0,
            );

            $dados = array();

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');

            // Produz array com os produtos selecionados tendo marcados com indice e qtde
            foreach($_SESSION['itens_marcados'] as $prod_id => $qtde){
                // Busca o produto
                $resultado = $this->produtos->dados($prod_id);
                // Produz array com dados do registro mais a qtde encomendada mais o sub_total 
                $produto['produto_id']     = $resultado['id'];
                $produto['descricao']      = $resultado['descricao'];
                $produto['espec']          = $resultado['espec'];
                $produto['un_med']         = $resultado['un_med'];
                $produto['qtde_encomenda'] = (float) $qtde;
                $produto['sub_total']      = (float) $resultado['valor_unitario']*$qtde;

                // Transfere o array produto para o array dados
                array_push($dados, $produto);
            }
            // Array com produtos selecionados utilizando como indice marcados(indice e qtde)
            // ++++++ Monta a grade de produtos selecionados ++++++++

            // Prepara dados para a view
            $dados_ret['marcados'] = $dados;

            // --------------------------------------------------
            // Alimenta o combox Clientes ordenado por nome
            $this->load->model("mdl_clientes", "clientes");
            
            $dados_ret['clientes'] = $this->clientes->listar();
             
            $dados_ret['telativa'] = "CheckOut";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Apresenta View
            $this->load->view('encomendas/checkout/view_checkout', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }

        // ==================================================
        public function checkOutGravar(){
            $this->controle();

            $inputs = $this->input->post();

            // Trata os inputs
            if(!isset($inputs['combo_clientes'])){
                $dados_ret['mensagem'] = "Campo Cliente é obrigatório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->index($dados_ret);
                return;
            }
            if(!isset($inputs['combo_enderecos'])){
                $dados_ret['mensagem'] = "Campo Endereço é obrigtório.";
                $dados_ret['msg_tipo'] = "alert-warning";
                $this->index($dados_ret);
                return;
            }

            $dados_ret['inputs'] = $inputs;

            // ++++++ Monta a grade de itens de encomenda ++++++++
            // Array que vai receber atributos da tabela
            $dados = array(
                'encomenda_id' => "",
                'produto_id'   => "",
                'qtde'         => 0,
                'sub_total'    => 0,
                'status'       => 1,
                'data'         => date('Y-m-d H:i:s'),
            );

            $itens_encomenda = array();
            $valor_encomenda = 0;

            // Carrega model
            $this->load->model('mdl_produtos', 'produtos');

            // Produz array com os produtos selecionados via marcados com indice e qtde
            foreach($_SESSION['itens_marcados'] as $prod_id => $qtde){
                // Busca o produto
                $resultado = $this->produtos->dados($prod_id);
                // Produz array com dados do registro mais a qtde encomendada mais o sub_total 
                $dados['produto_id'] = $resultado['id'];
                $dados['qtde']       = (float) $qtde;
                $dados['sub_total']  = (float) $resultado['valor_unitario']*$qtde;
                
                // Transfere o array dados para o array itens_encomenda
                array_push($itens_encomenda, $dados);

                $valor_encomenda += $dados['sub_total'];
            }

            // Array com produtos selecionados utilizando como indice marcados(indice e qtde)
            // ++++++ Monta a grade de itens de encomenda ++++++++

            // ++++++ Monta a grade de encomenda ++++++++

            $temp = $this->session->userdata('logged_in');

            $dados_reg = array(
                'codigo'          => $this->obterCodigo(),
                'cliente_id'      => $inputs['combo_clientes'],
                'endereco_id'     => $inputs['combo_enderecos'],
                'valor_encomenda' => $valor_encomenda,
                'valor_remessa'   => 0,
                'tipo_pagto'      => $inputs['radio_tipo_pagto'],
                'usuario_id'      => $temp['idUser'],
                'status_id'       => 1,
                'data'            => date('Y-m-d H:i:s'),
            );

            // Gravar encomenda e recupera o ultimo id registrado ++++
            // Carregar Model
            $this->load->model('mdl_encomendas', 'encomenda');

            // Evoca a query
            $resultado = $this->encomenda->incluir($dados_reg);
            // Trata o retorno NOK retorna a view checkout
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $this->index($dados_ret);
            };
            // Gravar encomenda e recupera o ultimo id registrado ++++
            
            $encomendas_id = $resultado['ultimo_id'];

            // Gravar itens de encomenda ++++++++++++++++++++++++++++
            // Prepara dados

            foreach($itens_encomenda as $indice => $linha){
                $itens_encomenda[$indice]['encomenda_id'] = $encomendas_id;
            };
            // Prepara ultimo indice do array
            $itens_encomenda[$indice]['encomenda_id'] = $encomendas_id;


            // Carregar Model
            $this->load->model('mdl_encomendas', 'itens_encomenda');

            // Evoca a query
            $resultado = $this->itens_encomenda->incluirItens($itens_encomenda);
            // Trata o retorno NOK retorna a view novo
            if(!$resultado['retorno']){
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $this->index($dados_ret);
            }

            // Registro do historico
            $dados_reg = Array(
                'encomendas_id' =>  $encomendas_id,
                'obs'           => 'Registro da encomenda no sistema',
                'data'          => date('Y-m-d H:i:s'),
            );

            // Carregar Model
            $this->load->model('mdl_encomendas', 'historico');

            // Evoca a query
            $resultado = $this->historico->incluirHistorico($dados_reg);
            // Trata o retorno
            if(!$resultado['retorno']){
                // NOK
                $dados_ret['mensagem'] = $resultado['mensagem'];
                $dados_ret['msg_tipo'] = $resultado['msg_tipo'];
                $this->index($dados_ret);
            }
            // Mostra comprovante da encomenda
            $this->comprovante($encomendas_id);
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function comprovante($encomendas_id = null){
            $this->controle();
            
            // ++++++ Monta a grade de produtos encomendados ++++++++

            // Carrega model
            $this->load->model('mdl_encomendas', 'encomendas');

            // Busca encomendados
            $dados_ret['dados'] = $this->encomendas->comprovante($encomendas_id);

            $dados_ret['telativa'] = "Comprovante";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Apresenta View
            $this->load->view('encomendas/view_comprovante', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');

        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    }
?>