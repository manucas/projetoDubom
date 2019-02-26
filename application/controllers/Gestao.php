<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Gestao extends CI_Controller{
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++=
        public function home(){
            // Caso NÂO exista seção iniciada evoca menu inicial
            if(!$this->session->has_userdata('logged_in')){
                // Redireciona para quadro login
                redirect('geral/quadrologin');
            }
            $dados['telativa'] = "encomendas";

            // Caso contrario apresenta View inico
            $this->load->view('template/_header');
            $this->load->view('template/topbar', $dados);
            
            $this->load->view('encomendas/view_inicio');

            $this->load->view('template/rodape');
            $this->load->view('template/_footer');
        }
    }
?>
