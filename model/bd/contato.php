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
        
        //Executa o script no BD
            //Valiação para verificar se o script sql está correto
       if (mysqli_query($conexao, $sql)){
            //Validação para verificar se uma linha foi acescentado no BD
            if(mysqli_affected_rows($conexao))
                return true;
            else
                return false;
        }else 
            return false; 
    }

    //função para realizar o update no banco de dados
    function updateContato(){
         
    }

    //função para realizar o delete no banco de dados
    function deleteContato(){
         
    }

    //função para realizar o select no banco de dados
    function selectAllContato(){
         
        //Abre a conexão com o banco de dados
        $conexao = conexaoMySql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblcontatos";

 
        //Quando mandamos um script para o bando do tipo insert, update e delete. Eles não devolvem resultados do banco, apenas se deu certo ou não
        //No select o banco deve retornar uma lista de dados;

        //Executa um script no banco de dados e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result){

            //mysqli_fetch_assoc() - permite converter os dados do BD
            //em um array para manipulação no PHP
            //Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de
            //o próprio while conseguir a quantidade de vezes que deveria ser feita a repetição
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)){
               
                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "nome"  => $rsDados['nome'],
                    "telefone" => $rsDados['telefone'],
                    "celular"  => $rsDados['celular'],
                    "email"  => $rsDados['email'],
                    "obs"  => $rsDados['obs']
                );
                $cont++;
            }
            return $arrayDados;
        }
    }

?>