<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Cl_splash extends CI_Controller{
    
        // ==================================================
        public function controle(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('geral/quadrologin');
            }
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function index(){
            $this->controle();
            // RESETA ITENS MARCADOS
            if($this->session->has_userdata('itens_marcados')){
                $this->session->unset_userdata('itens_marcados');
            }

            $dados_ret['telativa'] = "splash";

            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados_ret);

            // Apresenta View
            $this->load->view('main/view_splash', $dados_ret);
               
           $this->load->view('template/rodape');
           $this->load->view('template/_footer');
        }
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
    }
?>