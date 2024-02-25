<?php
    include_once('./conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Carteira </title>
</head>
<body>
    <h1> Como gerar PDF com PHP</h1>

    <?php 
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    ?>
    <?php
        $texto_pesquisar = "";
        if(isset($dados['texto_pesquisar'])) {
            $texto_pesquisar = $dados['texto_pesquisar'];
        }

        echo "<a href='gerar_pdf.php?texto_pesquisar=$texto_pesquisar'>Gerar PDF</a><br><br>";
        ?>

    

    <form method="POST" action="">       
        <label>Pesquisar</label>
        <input type="text" name="texto_pesquisar" placeholder="Pesquisar pelo termo?" value="<?php echo $texto_pesquisar; ?>"><br><br>

        <input type="submit" value="Pesquisar" name="PesqUsuario"><br><br>

    </form>

    <?php
    if(!empty($dados['PesqUsuario'])){
        $nome = "%" . $dados['texto_pesquisar'] . "%";
        $query_usuarios = "SELECT id, nome, email 
                           FROM usuarios    
                           WHERE nome LIKE :nome 
                           ORDER BY id DESC";
        $result_usuarios = $conn->prepare($query_usuarios);
        $result_usuarios->bindParam(':nome', $nome);
        $result_usuarios->execute();

        if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){
            while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
               extract($row_usuario);
               echo "ID: $id <br>";
               echo "Nome: $nome <br>";
               echo "E-mail: $email <br>";
               echo "<hr>";
            }
        }else{
            echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
        }
    }
    ?>
</body>
</html>