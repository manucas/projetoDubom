<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Mdl_encomendas extends CI_Model{

        // ==================================================
        public function listar(){
            $resultado = $this->db->query(
            "SELECT enco.id, enco.codigo, enco.valor_encomenda, enco.valor_remessa, enco.tipo_pagto,
            status.descricao,
            cli.nome, cli.email
            FROM encomendas AS enco
            Inner Join encomendas_status AS status ON enco.status_id = status.id
            Inner Join clientes AS cli ON enco.cliente_id = cli.id
            "
            )->result_array();

            return $resultado;
        }

        // ++++++++++++++++++++++++++++++++++++++++++++++++++
        public function dados($id){
            //Buscar um registro pelo id na tabela
            return $this->db->from('produtos')->where('id', $id)->get()->result_array();
        }

        // ==================================================
        public function incluir($dados_reg = null){

            // Executa query
            $resultado = $this->db->insert('encomendas', $dados_reg);

            // Trata retorno 
            if(!$resultado){
                // NOK retorna false
                return array(
                    'retorno'    => false,
                    'mensagem'   => 'Erro na inclusão de registro',
                    'msg_tipo'   => 'alert-danger',
                );
            }
            // OK retorna true

            // Artificio para recuperar o ultimo id registrado
            $temp = $this->db->from('encomendas')
                             ->select_max('id')
                             ->get()->result_array()[0]['id'];
            // Artificio para recuperar o ultimo id registrado

            return array(
                'retorno'   => true, 
                'ultimo_id' => $temp
            );
        }
    
        // ==================================================
        public function incluirItens($itens_encomenda){
            $temp = array();
            foreach($itens_encomenda as $indice => $valor){
                $temp = $itens_encomenda[$indice];
                // Inclusão de item a item no cadastro de itens de encomenda
                $resultado = $this->db->insert('encomendas_itens', $temp);
            };

            // Trata retorno 
            if(!$resultado){
                // NOK
                return array(
                    'retorno'    => false,
                    'mensagem'   => 'Erro na inclusão de registro de itens',
                    'msg_tipo'   => 'alert-danger',
                    'inputs'     => $dados_reg
                );
            }else{
                // OK
                return array( 'retorno' => true  );
            }
        }

        // ==================================================
        public function incluirHistorico($dados_reg){

            $resultado = $this->db->insert('encomendas_historico', $dados_reg);
            
            // Trata retorno 
            if(!$resultado){
                // NOK retorna false
                return array(
                    'retorno'    => false,
                    'mensagem'   => 'Erro na inclusão de registro de histórico',
                    'msg_tipo'   => 'alert-danger',
                );
            }else{
                // OK retorna true
                return array( 'retorno' => true  );
            }
        }
            
        // ==================================================
        public function comprovante($encomendas_id){

            // SELECT
            // enco.codigo,
            // enco.valor_encomenda,
            // enco.tipo_pagto,
            // enco.`data`,
            // itens_enco.qtde,
            // itens_enco.sub_total,
            // produtos.descricao,
            // cli.nome,
            // cli.email,
            // cli.telefone,
            // endco.contato,
            // endco.cep,
            // endco.localidade,
            // endco.bairro,
            // endco.rua,
            // endco.numero,
            // endco.complemento
            // FROM
            // encomendas AS enco
            // Inner Join encomendas_itens AS itens_enco ON enco.id = itens_enco.encomenda_id
            // Inner Join produtos ON itens_enco.produto_id = produtos.id
            // Inner Join clientes AS cli ON enco.cliente_id = cli.id
            // Inner Join clientes_enderecos AS endco ON enco.endereco_id = endco.id
            // WHERE
            // enco.id =  '23'
            
            $resultado = $this->db
            ->select('enco.codigo, enco.valor_encomenda, enco.tipo_pagto, enco.data,
                        itens_enco.qtde, itens_enco.sub_total,
                        produtos.descricao, produtos.espec, produtos.un_med,
                        cli.nome, cli.email, cli.telefone,
                        endco.contato, endco.cep, endco.localidade, endco.bairro, 
                        endco.rua, endco.numero, endco.complemento')
            ->from('encomendas as enco')
            ->where('enco.id', $encomendas_id)
            ->join('encomendas_itens as itens_enco', 'enco.id = itens_enco.encomenda_id', 'inner')
            ->join('produtos', 'itens_enco.produto_id = produtos.id', 'inner')
            ->join('clientes as cli', 'enco.cliente_id = cli.id', 'inner')
            ->join('clientes_enderecos as endco', 'enco.endereco_id = endco.id', 'inner')
            ->get();
            return $resultado->result_array();

        }
    }
?>