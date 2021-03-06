<?php

        // $id         = (string) null;
        // $nome       = (string) null;
        // $telefone   = (string) null;
        // $celular    = (string) null;
        // $email      = (string) null;
        // $obs        = (string) null;

        //Essa variavel foi criada para diferenciar no acion do formulário qual ação deveria ser levada para a router
        //Nas condições abaixo mudamos o action dessa variavel para ação editar

        //import do arquivo de configurações do projeto
        require_once('modulo/config.php');
        
        $idestado= (string) null;
        $form = (string) "router.php?component=contatos&action=inserir";

        //Variavel para carregar o nome da foto
        $foto = (string) null;
    //valida se a utilização de variaveis de sessao esta ativa no servidor
    if(session_status()){
        //valida se a variável de sessão dados contatos não está vazia
        if(!empty($_SESSION['dadosContato'])){
            $id         = $_SESSION['dadosContato']['id'];
            $nome       = $_SESSION['dadosContato']['nome'];
            $telefone   = $_SESSION['dadosContato']['telefone'];
            $celular    = $_SESSION['dadosContato']['celular'];
            $email      = $_SESSION['dadosContato']['email'];
            $obs        = $_SESSION['dadosContato']['obs'];
            $foto        = $_SESSION['dadosContato']['foto'];
            $idestado        = $_SESSION['dadosContato']['idestado'];

            //Mudamos a ação para editar
            $form = "router.php?component=contatos&action=editar&id=".$id."&foto=".$foto;

            //Destrói uma variável
            unset($_SESSION['dadosContato']);
        }
    }
 

?>

<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
       
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
                
            </div>
            <div id="cadastroInformacoes">
                <!-- enctype="multipart/form-data". Essa opção é obrigatória para enviar arquivos do formulário em html para o servidor-->
                <form  action="<?=$form?>" name="frmCadastro" method="post" enctype="multipart/form-data" >
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=isset($nome)?$nome:null?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>

                     <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstado" id="">
                                <option value="">Selecione um item</option>
                                <?php
                                    require_once('controller/controllerEstados.php');
                                    if($listEstados = listarEstado())
                                    {

                                    
                                    foreach($listEstados as $item){
                                        ?>
                                            <option <?=$idestado==$item['id']?'selected':null ?> value="<?=$item['id']?>"><?=$item['nome']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>         
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=isset($telefone)?$telefone:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=isset($celular)?$celular:null?>">
                        </div>
                    </div>
    

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=isset($email)?$email:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Escolha um arquivo</label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                           <input type="file" name="fleFoto" id="" accept=".jpg, .png, .jpeg, .gif">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=isset($obs)?$obs:null?></textarea>
                        </div>
                    </div>
                    <div> <img src = "<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto"></div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
               
                <?php
                    //import do arquivo da controller para solicitar a listagem dos dados
                    require_once('controller/controllerContatos.php');
                    if($listContato = listarContato()){

                    

                    //Estrutura de repetição para retirar os dados da array
                    foreach($listContato as $item){        
                        //variavel para carregar a foto dentro do banco de dados
                        $foto = $item['foto']        
                ?>

                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$item['nome']?></td>
                    <td class="tblColunas registros"><?=$item['celular']?></td>
                    <td class="tblColunas registros"><?=$item['email']?></td>
                    <td class="tblColunas registros"><img src = "<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto"></td>
                   
                    <td class="tblColunas registros">
                            <a href="router.php?component=contatos&action=buscar&id=<?=$item['id']?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>
                            
                            <a onclick="return confirm('Deseja realmente excluir este item?');" href="router.php?component=contatos&action=deletar&id=<?=$item['id']?>&foto=<?=$foto?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                            </a>
                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>
            <?php    
             }
            }
            ?>
            </table>
        </div>
    </body>
</html>