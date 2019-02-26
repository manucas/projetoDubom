<?php
    defined('BASEPATH') OR exit('URL inválida.');

    class Mdl_perfil extends CI_Model{

         /*
        id, descricao, status, data
        */
 
        // ==================================================
        public function listar(){
            //Buscar Dados da tabela no DB
            return $this->db->get('usuarios_perfil')->result_array();
        }
    
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            //Buscar um registro pelo id na tabela
            return $this->db->from('usuarios_perfil')->where('id', $id)->get()->result_array()[0];
            // [0] pelo fato de retornar apenas um registro
        }
 
         // ==================================================
         public function atualizar($id, $dados_reg = null){

            // Executa query
            $resultado = $this->db->from('usuarios_perfil')
                          ->where('id<>', $id)
                          ->where('descricao', $dados_reg['descricao'])
                          ->get();            
            // resultado NOK retorna a view editar com mensagem
            if($resultado->num_rows()!=0){
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe perfil com esta descrição.',
                    'msg_tipo' => 'alert-warning',
                );
            }

            //Executa query
            $resultado = $this->db->set('descricao', $dados_reg['descricao'])
                ->set('status', $dados_reg['status'])
                ->set('data', $dados_reg['data'])
                ->where('id', $id)
                ->update('usuarios_perfil');

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
                    'mensagem' => 'Dados Atualizados com sucesso.',
                    'msg_tipo' => 'alert-success',
                );
            };
        }

        // ==================================================
        public function incluir($dados_reg=null){

            //Executa query
            $query = $this->db->from('usuarios_perfil')
                              ->where('descricao', $dados_reg['descricao'])
                              ->get();
            // Trata retorno
            if($query->num_rows()!=0){
                // Já existe retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe perfil com esta descrição.',
                    'msg_tipo' => 'alert-warning',
                );
            }

            // Executa query
            $resultado = $this->db->insert('usuarios_perfil', $dados_reg);
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
                    'mensagem' => 'Registrado com sucesso.',
                    'msg_tipo' => 'alert-success',
                );
            }            
        }

        // ==================================================
        public function excluir($id){
            // Executa query para saber se tem relacionamento com usuario
            $query = $this->db->from('usuarios')
                   ->where('perfil_id', $id)
                   ->get();
            // Trata retorno
            if($query->num_rows()!=0){
                // Existe usuario com este perfil retorna false
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Exclusão truncada. Existe usuário com este perfil.',
                    'msg_tipo' => 'alert-warning',

                );
            };

            // Executa query
            $this->db->delete('usuarios_perfil', array('id' => $id));            
            return array(
                'retorno'  => true,
            );
        }
    }

?>