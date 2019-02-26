<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_Gelo extends CI_Controller{
    
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
        public function index($dados_ret = null){
            $this->controle();
             
            $dados_ret['telativa'] = "Gelo)";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Carrega model
            $this->load->model('mdl_produtos');
            // Carrega dados da tabela
            $dados_ret['produtos'] = $this->mdl_produtos->dadosEncomenda(0);

            // Apresenta View
            $this->load->view('gelo/view_inicio', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }

        // ==================================================
        public function checkOut(){
            $dados_reg = $this->input->post();
            $dados_ret['inputs'] = $dados_reg;

            $dados_ret['encomendas'] = array();

            // Prepara dados de retorno
            $temp = array(
                'id' => "",
                'descricao' => "",
                'espec' => "",
                'un_med' => "",
                'valor_unitario' => 0,
                'valor_total' => 0,
            );

            foreach($dados_reg as $key=>$linha){
                // Artificio para selecionar somente os inputs com qtde validas
                $s = substr($key,0,20);
                if($s == "text_qtde_encomenda_" && $linha > 0){
                    $n = substr(strrchr($key, "_"), 1);
                    // tratamento para dados_reg com mais de 9 inputs
                    if(strlen($key) > 21){ $n = substr(strrchr($key, "_"), 2);};
                    // Calcula valor total
                    $valor_total = $dados_reg['text_valor_unitario_'.$n] * $dados_reg['text_qtde_encomenda_'.$n];
                    // Monta array com os dados validos
                    $temp['id'] = $dados_reg['text_produto_id_'.$n];
                    $temp['descricao'] = $dados_reg['text_descricao_'.$n];
                    $temp['espec'] = $dados_reg['text_espec_'.$n];
                    $temp['un_med'] = $dados_reg['text_un_med_'.$n];
                    $temp['valor_unitario'] = $dados_reg['text_valor_unitario_'.$n];
                    $temp['valor_total'] = $valor_total;

                    array_push($dados_ret['encomendas'], $temp);
                }
            }

            // Nenhuma quatidade informada
            if($dados_ret['encomendas'] == null){
                return $this->index($dados_ret);
            }

            $dados_ret['telativa'] = "CheckOut";
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);
            // Apresenta View
            $this->load->view('gelo/view_checkout', $dados_ret);
               
            $this->load->view('template/rodape');
            $this->load->view('template/_footer');

        }

        // ==================================================
        public function CheckOutGravar($id, $dados_ret=null){
            $this->controle();

            $dados_reg = $this->input->post();
            $dados_ret['inputs'] = $dados_reg;

        }
    }

//          echo "<pre>"; print_r($dados_ret);
//            echo "<br/><br/>";
?>