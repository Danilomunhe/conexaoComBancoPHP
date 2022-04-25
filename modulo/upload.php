<?php
   
        /****************************************************
         * Objetivo: Arquivo responsável pelo upload de imagens
         * Autor:Danilo
         * Data:25/04
         * Versão:1.0
         ****************************************************/

         //import do arquivo de configurações
         require_once('modulo/config.php');

         //função para realizar upload de imagem
        function uploadFile ($arrayFile){
           
            $arquivo = $arrayFile;
            $sizeFile = (int) 0;
            $typeFile = (string) null;
            $nameFile = (string) null;
            $tempFile = (string) null;
           //validação para identificar se existe um arquivo válido (Maior que 0 e que tenha uma extensão)
           if($arquivo['size'] > 0 && $arquivo['type'] != ""){

            //recupera o arquivo em bytes e converte para kb
            $sizeFile = $arquivo['size'] / 1024;

              //recupera o tipo, nome e o diretório temporário que o arquivo estáS
            $typeFile = $arquivo['type'];
            $nameFile = $arquivo['name'];
            $tempFile = $arquivo['tmp_name'];

            //VALIDAÇÃO PARA PERMITIR O UPLOAD DE ARQUIVOS DE NO MAXIMO 5MB
                if($sizeFile <= MAX_FILE_UPLOAD){
                        if(in_array($typeFile, EXT_FILE_UPLOAD)){
                            //SEPARA SOMENTE O NOME DO ARQUIVO SEM A SUA EXTENSÃO
                            $nome = pathinfo($nameFile, PATHINFO_FILENAME);

                            //SEPARA SOMENTE A EXTENSÃO DO ARQUIVO SEM O SEU NOME
                            $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                            //EXISTEM DIVERSOS ALGORITMOS DE CRIPTOGRAFIA DE DADOS
                            //md5()
                            //sha1()
                            //hash()

                            //uniqid gerando uma sequência numérica difetente tendo como base, configurações da máquina
                            $nomeCripty = md5($nome.uniqid(time()));

                            //montamos novamente o nome do arquivo com a extensão
                            $foto = $nomeCripty.".".$extensao;

                            if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto)){
                                return $foto;
                            }else{
                                return array('idErro' => 13, 
                                'message' => 'Não foi possível mover o arquivo para o servidor');
                            }
                        }else{
                            return array('idErro' => 12, 
                            'message' => 'A extensão do arquivo selecionado não é permitida no upload ');
                        }
                }else{
                    return array('idErro' => 10, 
                    'message' => 'Tamanho de arquivo inválido no upload');
                }
           }else {
                    return array('idErro' => 11, 
                    'message' => 'Não é possível realizar o upload sem um arquivo selecionado');
           }
        }
?>