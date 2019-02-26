<?php
    defined('BASEPATH') OR exit('URL inválida.');

    class Mdl_produtos extends CI_Model{

        /*
        id, descricao, espec, un_med, valor_unitario, qtde_estoque, grupo, foto, data
        */
 
        // ==================================================
        public function listar(){
            // Buscar Dados da tabela no DB
            return $this->db->order_by('grupo ASC', 'descricao ASC')
                            ->get('produtos')
                            ->result_array();
        }
  
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            //Buscar registro pelo id na tabela
            return $this->db->from('produtos')
                            ->where('id', $id)
                            ->get()
                            ->result_array()[0];
            // [0] pelo fato de retornar apenas um registro
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dadosEncomenda($grupo=null){
            //Buscar registro pelo id na tabela
            return $this->db->from('produtos')
                            ->where('grupo', $grupo)
                            ->order_by('descricao ASC')
                            ->get()
                            ->result_array();
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function atualizar($id, $dados_reg=null){
             // Captura input
            $descricao = $dados_reg['descricao'];
            // Monta query de pesquisa
            $resultado = $this->db->from('produtos')
                              ->where('id<>', $id)
                              ->where('descricao', $descricao)
                              ->get();            

            // Executa query e questiona o resultado
            if($resultado->num_rows()!=0){
                // Caso já exista retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe produto com esta descrição.',
                    'msg_tipo' => 'alert-warning'
                );
            }

            // Preara dados
            $espec           = $dados_reg['espec'];
            $un_med          = $dados_reg['un_med'];
            $valor_unitario  = $dados_reg['valor_unitario'];
            $qtde_estoque    = $dados_reg['qtde_estoque'];
            $grupo           = $dados_reg['grupo'];
            $foto            = $dados_reg['foto'];

            // Atualiza os dados da tabela
            $resultado = $this->db->set('descricao', $descricao)
                ->set('espec', $espec)
                ->set('un_med', $un_med)
                ->set('valor_unitario', $valor_unitario)
                ->set('qtde_estoque', $qtde_estoque)
                ->set('grupo', $grupo)
                ->set('foto', $foto)
                ->set('data', date('Y-m-d H:m:s'))
                ->where('id', $id)
                ->update('produtos');

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

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function incluir($dados_reg=null){
            $descricao = $dados_reg['descricao'];
            // Verifica se já existe
            $resultado = $this->db->from('produtos')
                              ->where('descricao', $descricao)
                              ->get();
            // Trata resultado
            if($resultado->num_rows()!=0){
                // Caso já exista retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Já existe produto com mesma descrição.',
                    'msg_tipo' => "alert-warning",
                );
            }

            // Executa query
            $resultado = $this->db->insert('produtos', $dados_reg);
            // Trata retorno 
            if(!$resultado){
                // NOK retorna false
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Erro na inclusão de registro',
                    'msg_tipo' => 'alert-danger',
                    'produto'  => $dados_reg,
                    'inputs'   => $dados_reg
                );
            }else{
                // OK retorna true
                return array(
                    'retorno'  => true,
                    'mensagem' => 'Registrado com sucesso.',
                    'msg_tipo' => 'alert-success',
                    'produto'  => $dados_reg,
                    'inputs'   => $dados_reg
                );
            }            
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function excluir($id){
            // Monta a query de pesquisa de encomenda registrada para este produto
            $query = $this->db->from('encomendas_itens')
                   ->where('produto_id', $id)
                   ->get();
            // Executa e questiona o resultado
            if($query->num_rows()!=0){
                // Caso exista encomenda para este produto retorna
                return array(
                    'retorno'  => false,
                    'mensagem' => 'Exclusão truncada. Já existe encomenda deste produto.',
                    'msg_tipo' => 'alert-warning'
                );
            };
            // Caso contrario exclui produto da tabela
            $this->db->delete('produtos', array('id' => $id));            
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function lista_pedidos($id){
            //retorna pedidos para este produto
            $resultados = $this->db->select('peds.*, prod.descricao descricao, prod.valor_unitario vlr_unit')
                                   ->from('pedidos as peds')
                                   ->join('produtos as prod', 'peds.produto_id = prod.id', 'left')
                                   ->get();
            return $resultados->result_array();
        }

    }

?>