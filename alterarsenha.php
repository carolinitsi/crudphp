<form action="logica_usuario.php" method="post"> 
    <h1>Alterar senha:</h1>  
    <p>Senha atual: </p>
    <input class="" type="text" name="senha_atual" id="senha_atual" placeholder="">
    <p>Nova senha: </p>
    <input class="" type="text" name="nova_senha" id="nova_senha" placeholder="">
    <input type="submit" id='login' name='alterar' value="Alterar">           
    </form>
    <h4> <font color="red">  <?php 
       		session_start();
            if (isset($_SESSION['msg']))
            {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }


             ?> </font></h4>
