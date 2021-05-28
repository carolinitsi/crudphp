<?php
include_once("funcoes.php");
session_start();

if(!$_SESSION['logado'])
{
	header('location:index.html');
}
?>
        <h3> Bem Vindo <?php echo $_SESSION['email']?></h3>          
        <form action="logica_usuario.php" method="POST" >
            <input type="submit" id="sair" name="sair" value="Logout">
        </form> 
        <form action="alterarsenha.php" method="POST" >
            <input type="submit" id='alterar_senha' name='alterar_senha' value="Alterar Senha"> 
        </form> 

        <h1>Postar</h1>
            <form action="logica_usuario.php" method="POST">
                <p> De um titulo para seu post:</p>
                <input type="text" class="" name="titulo"><br>
                <p> Texto:</p>
                <input type="text" class="caixa_post" name="post" width="100px"><br>
                <input type="submit" name="postar" value="Postar">
            </form>
        <section class="formulario">
            <div class="mensagem">
                <form action="logica_usuario.php" method="post"> 
                <h1>Enviar email para admin do site:</h1>
                <p>Email: </p>
                <input class="email_remetente" type="text" name="email_remetente" id="email_remetente" placeholder="email">
                <p>Mensagem: </p>
                <input class="caixa_mensagem" type="text" name="mensagem" id="mensagem" placeholder="Insira sua mensagem">
                <input type="submit" id='enviar' name='enviar' value="Enviar">           
                </form>
            </div>    
        </section>
        <h1> Lista de Posts</h1>
            <?php
                $query = "SELECT * FROM post ";
                $usuarios = fazConsulta($query,'fetchAll');
                foreach($usuarios as $usuario){          
                ?>  
                    <h3><?php echo $usuario['titulo']; ?></h3>
                    <p class=""><?php echo $usuario['post']; ?></p>
                       <form action="logica_usuario.php" method="post">
                            <button class="bt_chama_modal_editar" type="submit" name="editar" value="<?php echo $usuario['id_post']; ?>"> Editar </button>
                            <button id="bt_lateral" type="submit" name="deletar" value="<?php echo $usuario['id_post']; ?>"> Excluir </button> (Editar e excluir ainda não foram feitos)
                       </form>                                                          
                <?php
            }
            ?> 

       