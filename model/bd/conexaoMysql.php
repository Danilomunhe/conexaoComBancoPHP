<?php
        /************************************************ 
        Arquivo para criar a conexao com o banco de dados MySQL
        autor:Danilo 
        Data:25/02/2022
        Versão: 1.0
        ***************************************************/

        //Constantes para estabelecer a conexão com o banco de dados(Local do BD, Usuário, Senha e Database)
        const SERVER = 'localhost';
        const USER = 'root';
        const PASSWORD = 'bcd127';
        const DATABASE = 'dbcontatos';

        $resultado = conexaoMySql();
        echo('<pre>');       
        var_dump($resultado);
        echo('</pre>');
        //abre a conexão com o banco de dados MySql
        function conexaoMySql(){
           $conexao = array();

           //Se a conexão for estabelicida com o BD, teremos um array de dados sobre a conexão
           $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
            
           //Validação para verificar se a conexão oi realizada com sucesso
           if($conexao)
                return $conexao;
           else 
                return false; 

        }
        /*Existem 3 formas de criar a conexão com o banco de dados MySql:
            mysql_connect() - versão antiga de fazer uma conexão com o BD (não oferece performance e segurança)

            mysqli_connect() - versão mais atualizadde de fazer uma conexão com o BD 
            (oferece uma performance melhor e mais segurança).
            Ela permite ser utilizada para programação estruturada e POO(Programção Orientada à Objeto)

            PDO()- versão mais completa e eficiente para conexão com o bd (é indicada pela segurança e POO)*/
?>      