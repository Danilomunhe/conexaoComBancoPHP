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
    if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
        
        //recebendo dados via URl para saber quem está solicitando e qual ação será realizada
        $component = strtoupper($_GET['component']);
        $action = strtoupper($_GET['action']); 


        //Estrutura condicional para validar quem está solicitando algo para o router
        switch($component){

            case 'CONTATOS': 
                //Import da controller contatos
                require_once('controller/controllerContatos.php');
                
                //Validação para identificar o tipo de ação que será realizada
               if($action=='INSERIR')
               {
                   if(isset($_FILES) && !empty($_FILES)){
                       //chama a função de inserir na controller
                        $resposta = inserirContato($_POST, $_FILES);
                    }else{
                        $resposta = inserirContato($_POST, null);
                    }
                    

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
                elseif($action == 'DELETAR'){
                    
                    //Recebe o id do registro que deverá ser excluído, 
                    //que foi enviado pela url no link da imagem do excluir
                    //que foi acionado na index 
                    $idContato = $_GET['id'];
                    $foto = $_GET['foto'];

                    //Criamos um array para enviar dados
                    $arrayDados = array(
                      "id"    => $idContato,
                      "foto"  => $foto  
                    );

                    $resposta = excluirContato($arrayDados);

                    if(is_bool($resposta)){
                        //verificar se o retorno foi verdadeiro
                        if($resposta){
                            echo("<script>alert('Registro excluído com sucesso');
                            window.location.href='index.php'</script>"); 
                        }
                    }elseif(is_array($resposta)){
                        echo("<script> alert('".$resposta['message']."');
                        window.history.back(); </script>");
                    }
                }elseif($action == 'BUSCAR'){

                    //Recebe o id do registro que deverá ser editado, 
                    //que foi enviado pela url no link da imagem do editar
                    //que foi acionado na index 
                    $idContato = $_GET['id'];

                    $dados = buscarContato($idContato);
                    
                    //Ativa a utilização de variáveis de sessao no servidor
                    session_start();

                    //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
                    //OBS: essa variável de sessão será utilizada na index.php, para colocar os dados
                    //nas caixas de texto.
                    $_SESSION['dadosContato'] = $dados;

                    //Utilizando o require apenas iremos importar a tela da index,
                    //assim não ocorrerá um novo carregamento 
                    require_once('index.php');
                    
                    //Utilizando o header podemos chamar a index.php,
                    //porém haverá uma ação de carregamento no navegador
                    //piscando a tela novamente
                    //header('location: index.php')
                }elseif($action == "EDITAR"){
                    
                     //Recebe o id que foi enviado via action do form pela url
                    $idContato = $_GET['id'];
                    //Chama a função de inserir na controller
                    $resposta = atualizarContato($_POST, $idContato);

                    //Valida o tipo de retorno para ver se foi booleano
                      if(is_bool($resposta)){
                          //verificar se o retorno foi verdadeiro
                          if($resposta)
                              echo("<script>alert('Registro Atualizado com sucesso');
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

