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

        //iniciando varial de statusResposta
        $statusResposta = (boolean) false;
        
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
                $statusResposta = true;
        }

        //Solicita o fechamento da conexão com o bd
        fecharConexao($conexao);

        return $statusResposta;
    }

    //função para realizar o update no banco de dados
    function updateContato(){
         
    }

    //função para realizar o delete no banco de dados
    function deleteContato($id){
        
        //declaração da variável para utilizar no return dessa função
        $statusResposta = (boolean) false;
        
        //Abre a conexão com o banco de dados
        $conexao = conexaoMySql();

        //Script para deletar um registro no bd
        $sql = "delete from tblcontatos where idcontato=".$id;

        //valida se o script está correto, sem erro de sintaxe e executa no bd
        if(mysqli_query($conexao, $sql)){
           //valida se o bd teve sucesso na execução do script
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

            fecharConexao($conexao);
            return $statusResposta;

    }

    //função para realizar o select no banco de dados
    function selectAllContato(){
         
        //Abre a conexão com o banco de dados
        $conexao = conexaoMySql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblcontatos order by idcontato desc ";

 
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
                    "id"       => $rsDados['idcontato'],
                    "nome"     => $rsDados['nome'],
                    "telefone" => $rsDados['telefone'],
                    "celular"  => $rsDados['celular'],
                    "email"    => $rsDados['email'],
                    "obs"      => $rsDados['obs']
                );
                $cont++;
            }

            //solicita o fechamento da conexao com o banco de dados
            fecharConexao($conexao);

            return $arrayDados;
        }
    }

?>