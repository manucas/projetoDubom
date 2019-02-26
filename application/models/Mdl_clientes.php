<?php
    defined('BASEPATH') OR exit('URL inválida.');

    class Mdl_clientes extends CI_Model{

        /*
        id, nome, email, telefone, cpf, data
        */

        // +++++++++++++++++++++++++++++++++++++++++++++++++
        function __construct(){
            parent::__construct();
        }

        // ==================================================
        public function listar(){
            // Buscar Dados da tabela no DB
            $resultado = $this->db->order_by("nome", "asc")
                                  ->get("clientes")
                                  ->result_array();
            return $resultado;

        }
     
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            //Buscar registro pelo id na tabela
            $resultado = $this->db->from('clientes')->where('id', $id)->get()->result_array()[0];
            return $resultado;
            // [0] pelo fato de retornar apenas um registro
        }
 
        // ==================================================
        public function atualizar($id){
            // Captura inputs
            $inputs = $this->input->post();

            $nome     = $inputs['text_nome'];
            $email    = Trim($inputs['text_email']);
            $telefone = $inputs['text_telefone'];
            $cpf      = $inputs['text_cpf'];

            // Executa query
            $resultado = $this->db->from('clientes')
                              ->where('id<>', $id)
                              ->where('nome', $nome)
                              ->get();            
            // Trata o retorno NOK retorna false
            if($resultado->num_rows()!=0){
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe cliente com este nome.'
                );
            }

            // Atualiza os dados na tabela
            $this->db->set('nome', $nome)
                     ->set('email', $email)
                     ->set('telefone', $telefone)
                     ->set('cpf', $cpf)
                     ->set('data', date('Y-m-d H:m:s'))
                     ->where('id', $id)
                     ->update('clientes');
            // Retorna true
            return array(
                'retorno' => true,
            );
        }

        // ==================================================
        public function incluir($dados_reg = null){

            $nome = $dados_reg['nome'];

            //            echo "<pre>"; print_r($dados_cliente);
            //            echo "<br/><br/>";
            //            die;

            // Verifica se existe cliente com mesmo nome
            $resultado = $this->db->from('clientes')
                              ->where('nome', $nome)
                              ->get();
            // Caso já exista retorna para view novo com mensagem
            if($resultado->num_rows()!=0){
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe cliente com este nome.',
                    'msg_tipo' => 'alert-warning',
                );

            }

            // Executa query
            $resultado = $this->db->insert('clientes', $dados_reg);
            // Trata retorno
            if(!$resultado){
                // NOK retorna false
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Erro na inclusão de registro',
                    'msg_tipo' => 'alert-danger',
                );
            }else{
                // OK retorna true
                return array(
                    'retorno'  => true,
                );
            }            
        }
 
        // ==================================================
        public function excluir($id){
            $query = $this->db->from('encomendas')
                   ->where('cliente_id', $id)
                   ->get();
            
            if($query->num_rows()!=0){
                // Caso já exista retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Exclusão truncada. Já existe encomenda deste cliente.'
                );
            };

            $this->db->delete('clientes_enderecos', array('cliente_id' => $id));            
            $this->db->delete('clientes', array('id' => $id));            

            return array(
                'retorno'  => true,
            );

        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function retorna_clientes(){
            $resultado = $this->db->order_by("nome", "asc")
                                  ->get("clientes");
            return $resultado;
        }

    }


?>