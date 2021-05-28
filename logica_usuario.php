<?php
 include_once("funcoes.php");
 session_start();

#LOGIN

if (isset($_POST['login']))
{
   session_start();
   $email = addslashes($_REQUEST['email']);//impede que o sql seja alterado
   $senha = $_REQUEST['senha'];
   $senhaEncriptada = base64_encode($senha);
   $query = "select * from usuarios where email=? and senha=?";
   $array = array($email, $senhaEncriptada);
   $usuario = fazConsulta($query,'fetch',$array);
   if($usuario){
       $_SESSION['logado'] = 'logado';
       $_SESSION['id'] = $usuario['id_usuario'];
       $_SESSION['email'] = $usuario['email'];
       $data=date("d/m/Y h:i:s");
       $mensagem.="Olá,você acaba de logar em Atividade 5! Login foi realizado em ".$data;
       $assunto="checkin Sistema";
       $retorno= enviaEmail($email,$mensagem,$assunto);	
       header('location:inicio.php');
   }
   else{
       $_SESSION['msg'] = "Usuário ou Senha Inválidos";
       header('location:ops.html');
   }
}

#POSTAR

 if(isset($_POST['postar'])){
    $titulo     = $_POST['titulo'];
    $post       = $_POST['post'];
    $id_usuario = '1';
    
    $query = "insert into post (id_usuario,titulo, post) values (?,?,?)";
    $array = array($id_usuario,$titulo, $post);
    $usuario=fazConsulta($query,'query',$array);
    if($usuario)
    {
        header('location:inicio.php');

    }
    else
    {
        echo("Erro ao inserir");
        
    }
}

#CADASTRAR

if(isset($_REQUEST['cadastrar'])){
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];    
    $senhaEncriptada = base64_encode($senha);
    
    $query = "insert into usuarios (email, senha) values (?,?)";
    $array = array($email, $senhaEncriptada);
    $usuario=fazConsulta($query,'query',$array);
    if($usuario)
    {
        
        $link="<a href='localhost/atividade3/valida_email.php?h=".$email."'> Clique aqui para confirmar seu cadastro </a>";
        $mensagem ="Email de Confirmação".$link;
        $assunto="Confirme seu cadastro";
        $usuario= enviaEmail($email,$mensagem,$assunto);
        header('location:sucesso.html');
    }
    else
    {
        header('location:ops.php');    }
}

#SAIR
if(isset($_REQUEST['sair'])){
    session_destroy();
    header('location:index.html');
}

#ENVIAR Email para ADM

if (isset($_POST['enviar'])) 
{
    //AQUI DEFINI O ADM DO "SITE", QUEM RECEBE O EMAIL.
    $email_destinatario = "caroline.oliveira1800@gmail.com";
    $email_remetente    = $_POST['email_remetente'];
    $mensagem = $_POST['mensagem'];
    $assunto = [''];

    enviacontato($email_destinatario, $email_remetente, $mensagem, $assunto);
}

#DELETAR

if(isset($_REQUEST['deletar'])){

    $id_post= $_POST['id_post'];

    $query="delete from post where cod_post = 6";


    $array = array($id_post);

	$resultado=fazConsulta($query,$array);
	
	if($resultado)
	{
	   echo("Exclusão Efetuada com sucesso");
	}
	else
	{
        echo("Erro");	}

}

#ALTERAR SENHA

if (isset($_POST['alterar']))
{
   $nova_senha =  base64_encode($_REQUEST['nova_senha']);
   $senha_atual = base64_encode($_REQUEST['senha_atual']);
   $email       = $_SESSION['email'];
   $query = "select * from  usuarios where email = ?";
   $array = array($email);
   $usuario=fazConsulta($query,'query',$array);
   foreach($usuario as $usuario){          
        
       if($usuario['senha'] === $senha_atual){
           $query = " UPDATE usuarios SET senha = '$nova_senha' WHERE email = ?";
           $array = array($email);
           $usuario=fazConsulta($query,'query',$array);
           $_SESSION['msg']= "Senha alterada com sucesso!";
           header('location:alterarsenha.php');
       }   
       else{
           $_SESSION['msg']= "Senha atual não confere!";
           header('location:alterarsenha.php');
       }                                                 
   }
}
?>