<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
    
    class Mdl_enderecos extends CI_Model{
    
         /*
        id, cliente_id, contato, tipo, cep, localidade, bairro, rua, numero, complemento, data
        */
        // ==================================================
        public function lista_dados($cli_id = null){
            // Buscar Dados da tabela no DB
            $resultado = $this->db->select('cliAddr.*')
            ->from('clientes_enderecos as cliAddr')
            ->where('cliente_id', $cli_id)
            ->get();
            return $resultado->result_array();
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            //Buscar registro pelo id na tabela
            return  $this->db->from('clientes_enderecos')->where('id', $id)->get()->result_array()[0];
            // [0] pelo fato de retornar apenas um registro
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dadosClienteEnderecos($cli_id){
            //Buscar registro pelo id na tabela
            return  $this->db->from('clientes_enderecos')->where('cliente_id', $cli_id)->get()->result_array();
        }

        // ==================================================
        public function atualizar($id, $dados_reg = null){

            // Atualiza os dados da tabela
            $resultado = $this->db->set('tipo', $dados_reg['tipo'])
               ->set('contato', $dados_reg['contato'])
               ->set('localidade', $dados_reg['localidade'])
               ->set('cep', $dados_reg['cep'])
               ->set('bairro', $dados_reg['bairro'])
               ->set('rua', $dados_reg['rua'])
               ->set('numero', $dados_reg['numero'])
               ->set('complemento', $dados_reg['complemento'])
               ->set('data', $dados_reg['data'])
               ->where('id', $id)
               ->update('clientes_enderecos');

               // Trata retorno 
            if(!$resultado){
                // NOK retorna false
                return array(
                   'retorno'  => false,
                   'mensagem' => 'Erro na Atualização de registro',
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
        public function incluir($dados_reg = null){

            // Verifica se existe cliente com mesmo nome
            $resultado = $this->db->from('clientes_enderecos')
                              ->where('cliente_id', $dados_reg['cliente_id'])
                              ->where('localidade', $dados_reg['localidade'])
                              ->where('bairro', $dados_reg['bairro'])
                              ->where('rua', $dados_reg['rua'])
                              ->where('numero', $dados_reg['numero'])
                              ->where('complemento', $dados_reg['complemento'])
                              ->get();
            // Caso já exista retorna para view novo com mensagem
            if($resultado->num_rows()!=0){
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe endereço cadastrado para este cliente.',
                    'msg_tipo' => 'alert-warning',
                );

            }

            // Executa query
            $resultado = $this->db->insert('clientes_enderecos', $dados_reg);
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
                   ->where('endereco_id', $id)
                   ->get();
            
            if($query->num_rows()!=0){
                // Caso exista retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Exclusão truncada. Já existe encomenda para este endereço.'
                );
            };

            $this->db->delete('clientes_enderecos', array('id' => $id));            

            return array(
                'retorno'  => true,
            );
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function retorna_enderecos_by_cliente($cli_id) {
            $resultados = $this->db
                               ->select('id, bairro, rua, numero, complemento')
                               ->from('clientes_enderecos')
                               ->where('cliente_id', $cli_id)
                               ->get();
            return $resultados->result_array();
        }
    }
?>