<?php
    /****************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de contatos
     * Obs: Esse arquivo fará a ponte entre a View e a model
     * Todos os tartamentos de erros devem ser realizados nesse arquivo
     * Autor:Danilo
     * Data:04/03
     * Versão:1.0
     ****************************************************/

    //Função para recber dados da View e encaminhar para o Model(inserir)
     function inserirContato($dadosContato){
        
        //Validação para verificar se o objeto está vázio
        if(!empty($dadosContato)){
            //Validação de caixa vazia dos elementos nome, celular e email pois são obrigatórios no BD
            if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtCelular'] && !empty($dadosContato['txtEmail']))){
                
                //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior

                $arrayDados = array(
                    "nome" => $dadosContato['txtNome'],
                    "telefone" => $dadosContato['txtTelefone'],
                    "celular" => $dadosContato['txtCelular'],
                    "email" => $dadosContato['txtEmail'],
                    "observacao" => $dadosContato['txtObs']
                );

                //Import do arquivo de modelagem para manipular o BD
                require_once('model/bd/contato.php');
                //Chama a função que fará o insert no BD (etstá função está na model)
                if(insertContato($arrayDados))
                    return true;
                else 
                    return array('idErro' => 1, 
                                 'message' => 'Não foi possíve inserir os dados no Banco de Dados');

            }else{
                return array('idErro' => 2,
                             'message' => 'Existem campos obrigatórios que não foram preenchidos');
            }
        }
     }

      //Função para recber dados da View e encaminhar para o Model(atualizar)
     function atualizarContato(){

     }
      //Função para realizar a exclusão de um dado
     function excluirContato(){

     }
    //Função para solicitar os dados da model e encaminhar a lista de contatos para a View
     function listarContato(){

        //import do arquivo que vai buscar os dados
        require_once('model/bd/contato.php');

        //Chama a função que vai buscar os dados no banco de dados
        $dados = selectAllContato();

        if(!empty($dados))
            return $dados;
        else 
            return false;    
     }
?>