<?php
        /****************************************************
         * Objetivo: Arquivo responsável pela manipulação de dados de contatos
         * Obs: Esse arquivo fará a ponte entre a View e a model
         * Todos os tratamentos de erros devem ser realizados nesse arquivo
         * Autor:Danilo
         * Data:04/03
         * Versão:1.0
         ****************************************************/

        require_once('modulo/config.php');

        function listarEstado(){

            //import do arquivo que vai buscar os dados
            require_once('model/bd/estado.php');
    
            //Chama a função que vai buscar os dados no banco de dados
            $dados = selectAllEstado();
    
            if(!empty($dados))
                return $dados;
            else 
                return false;    
         }
?>