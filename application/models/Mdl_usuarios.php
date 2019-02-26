<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Mdl_usuarios extends CI_Model{
    
        // ==================================================
        public function logar(){
            //Metodo com utilizando passagem de parametros
            // Monta parametros
            $parametros = [
                Trim($this->input->post('text_usuario')),
                md5(Trim($this->input->post('text_senha'))),
                1,
            ];
            // Executa query
            $resultado = $this->db->query('SELECT * FROM usuarios 
                WHERE email = ? 
                  AND senha = ? 
                  AND ativo = ?',
                $parametros
            );
            // Estabelece qtde de registros para retorno  
            $this->db->limit(1);
            //--------------------------------------------

            //--------------------------------------------
            // Metodo sem utilização de parametros
            // Prepara o select
            // $this->db->select('*');
            // $this->db->from('usuarios');
            // $this->db->where('usuario', $this->input->post('text_usuario'));
            // $this->db->where('senha', md5($this->input->post('text_senha')));            
            // Monta a query
            // $query = $this->db->get();
             
            // ou monta a query desta forma
            // $query = $this->db->from('usuarios')
            //                      ->where('usuario', $this->input->post('text_usuario'))
            //                      ->where('senha', md5($this->input->post('text_senha')))
            //                      ->get();            
            // --------------------------------------------

            // Questiona o retorno, Nenhum registro retorna false
            if($resultado->num_rows()==0){
                // login inválido
                return false;
            } else {
                // login válido

                // qdo a query resultar mais de uma linha informar [numero da linha]
                // pois result_array() é o query transformado num array associativo
                // $dados_usuario = $query->result_array()[0];
                // obten-se os dados assim:
                // $dados_usuario['id']
                // $dados_usuario['usuario']

                // qdo resultar apenas uma linha
                $dados = $resultado->row();

                // Cria array de dados
                $dados_user = array(
                    'idUser'     => $dados->id,
                    'nomeUser'   => $dados->nome,
                    'emailUser'  => $dados->email,
                    'cpfUser'    => $dados->cpf,
                    'perfilUser' => $dados->perfil_id,
                    'ativoUser'  => $dados->ativo,
                    'dataUser'   => $dados->data,
                    'dtuaUser'   => $dados->data_ultimo_acesso
                );
                // Grava sessão do usuario
                $this->session->set_userdata('logged_in', $dados_user);
                return true;
            }
        }
         
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function listar(){
            $resultado = $this->db->select('users.*, perf.descricao descricao, perf.status status')
                              ->from('usuarios as users')
                              ->join('usuarios_perfil as perf', 'users.perfil_id = perf.id', 'left')
                              ->get();
            return $resultado->result_array();
        }
 
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            $resultado = $this->db->select('users.*, perf.descricao descricao, perf.status status')
                              ->from('usuarios as users')
                              ->where('users.id', $id)
                              ->join('usuarios_perfil as perf', 'users.perfil_id = perf.id', 'left')
                              ->get();
            return $resultado->result_array()[0];
            // [0] pelo fato de retornar apenas um registro
        }
          
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dadosViaPerfil($id){
            // Busca registro pelo perfil_id de usuarios
            $resultado = $this->db->select('users.*, perf.descricao descricao, perf.status status')
                              ->from('usuarios as users')
                              ->where('users.perfil_id', $id)
                              ->join('perfil as perf', 'users.perfil_id = perf.id', 'left')
                              ->get();
            return $resultado->result_array();

        }

        // ==================================================
        public function atualizar($id, $dados_reg=null){

            // Verifica se existe outro usuario com este email
            $resultado = $this->db->from('usuarios')
                              ->where('id<>', $id)
                              ->where('email', $dados_reg['email'])
                              ->get();            
            
            // Questiona o resultado
            if($resultado->num_rows()!=0){
                // Já existe usuario com o mesmo email Retorna false
                return array(
                   'retorno'  => false,
                   'mensagem' => 'Já existe usuário com este email.',
                   'msg_tipo' => 'alert-warning'
                );
            }

            if($dados_reg['perfil_id'] == 0) $dados_reg['perfil_id'] = 8;
            
            // Atualiza registro na tabela
            $this->db->set('nome', $dados_reg['nome'])
                    ->set('email', $dados_reg['email'])
                    ->set('cpf', $dados_reg['cpf'])
                     ->set('ativo', $dados_reg['ativo'])
                     ->set('perfil_id', $dados_reg['perfil_id'])
                     ->where('id', $id)
                     ->update('usuarios');
            // Retorna true
            return array(
                'retorno'  => true,
                'mensagem' => 'Atualizado com sucesso.',
                'msg_tipo' => 'alert-success'

            );
        }
        
        // ==================================================
        public function incluir($dados_reg=null){

            // Executa query
            $resultado = $this->db->from('usuarios')
                              ->where('email', $dados_reg['email'])
                              ->get();
            // Trata retorno
            if($resultado->num_rows() > 0){
                // Caso existe usuario com este email
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe usuário com o mesmo email.',
                    'msg_tipo' => "alert-warning",
                );
            }

            if($dados_reg['perfil_id'] == 0) $dados_reg['perfil_id'] = 8;

            // Executa query
            $resultado = $this->db->insert('usuarios', $dados_reg);
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
            // Eliminar registro pelo id
            $this->db->delete('usuarios', array('id' => $id));            
            // Retorna true
            return array(
                'retorno'  => true,
                'mensagem' => 'Registro excluido com sucesso!',
                'msg_tipo' => 'alert-success'
            );            
 
        }
    }
?>