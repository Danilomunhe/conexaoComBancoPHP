<?php

    /*************************************************
     * Objetivo: arquivo de rota, para segmentar as ações encaminhadas pela View
     *  (dados de um form, listagem de dados, ação de excluir ou atualizar)
     *  Esse arquivo será responsável por encaminhar a solicitações para a Controller
     * 
     * Autor: Danilo
     * Data: 04/03/2022
     * versão: 1.0
     */

    $action = (string) null;
    $component = (string) null;

    //Validação para verificar se a requisição é um post de um formulário
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //recebendo dados via URl para saber quem está solicitando e qual ação será realizada
        $component = strtoupper($_GET['component']);
        $action = strtoupper($_GET['action']); 

        //Estrutura condicional para validar quem está solicitando algo para o router
        switch($component){

            case 'CONTATOS': 
                //Import da controller contatos
                require_once('controller/controllerContatos.php');
                
                //Validação para identificar o tipo de ação que será realizada
               if($action=='INSERIR'){
                    //Chama a função de inserir na controller
                    $resposta = inserirContato($_POST);

                    //Valida o tipo de retorno para ver se foi booleano
                    if(is_bool($resposta)){
                        //verificar se o retorno foi verdadeiro
                        if($resposta)
                            echo("<script>alert('Registro Inserido com sucesso');
                            window.location.href='index.php'</script>"); 

                    //Se o retorno for um array significa que houve um erro mo processo de inserção
                    }elseif(is_array($resposta))
                        echo("<script> alert('".$resposta['message']."');
                        window.history.back(); </script>");
                } 
            break;
        }
    }


?>