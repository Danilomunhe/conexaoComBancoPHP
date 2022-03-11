<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:11/03/2022
     * Versão:1.0
     ****************************************************/
    
     //import do arquivo que estabelece a conexão com o banco de dados
     require_once('conexaoMysql.php');

    //função para realizar o insert no banco de dados
    function insertContato($dadosContato){

        //Abre a conexão com o BD
        $conexao = conexaoMySql();

        //Monta o script para enviar para o banco de dados
        $sql = "insert into tblcontatos(nome, 
                                        telefone, 
                                        celular, 
                                        email, 
                                        obs)
                                    values('".$dadosContato['nome']."', 
                                    '".$dadosContato['telefone']."', 
                                    '".$dadosContato['celular']."', 
                                    '".$dadosContato['email']."', 
                                    '".$dadosContato['observacao']."');";
        mysqli_query($conexao, $sql);
    }

    //função para realizar o update no banco de dados
    function updateContato(){
         
    }

    //função para realizar o delete no banco de dados
    function deleteContato(){
         
    }

    //função para realizar o select no banco de dados
    function selectAllContato(){
         
    }

?>