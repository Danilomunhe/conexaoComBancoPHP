<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:11/03/2022
     * Versão:1.0
     ****************************************************/

     //import da conexao do banco 
     require_once('conexaoMysql.php');

    function selectAllEstado(){
         
        //Abre a conexão com o banco de dados
        $conexao = conexaoMySql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblestados order by nome asc ";

 
        //Quando mandamos um script para o banco do tipo insert, update e delete. Eles não devolvem resultados do banco, apenas se deu certo ou não
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
            $arrayDados = null;
            while($rsDados = mysqli_fetch_assoc($result)){
               
                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id"       => $rsDados['idestado'],
                    "nome"     => $rsDados['nome'],
                    "sigla" => $rsDados['sigla']
                );
                $cont++;
            }

            //solicita o fechamento da conexao com o banco de dados
            fecharConexao($conexao);

            return $arrayDados;
        }
     }

?>