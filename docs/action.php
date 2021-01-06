<?php
    include_once('../includes/conn.php');

    if(isset($_REQUEST['id']))
        $CodProduto = $_REQUEST['id'];
    
    $action = $_REQUEST['action'];
    if($action == 'insert' || $action == 'update') {
        $CodFornecedor = $_POST['fornecedor'];
        $CodBarras = $_POST['barras'];
        $NomeProduto = $_POST['nome'];
        $Preco = $_POST['preco'];
        $QtdeEstoque = $_POST['estoque'];
    }

    switch($action) {
        case 'insert':
            $sql = "INSERT INTO tbl_produto (CodFornecedor, CodBarras, NomeProduto, Preco, QtdeEstoque)
            VALUES ('$CodFornecedor', '$CodBarras', '$NomeProduto', '$Preco', '$QtdeEstoque');";
            $message = "Registro inserido com sucesso!";
            break;
        case 'delete':
            $sql = "DELETE FROM tbl_produto
            WHERE CodProduto = $CodProduto;";
            $message = "Registro deletado com sucesso!";
            break;
        case 'update':
            $sql = "UPDATE tbl_produto 
            SET CodFornecedor = '$CodFornecedor',
                CodBarras = '$CodBarras',
                NomeProduto = '$NomeProduto',
                Preco = '$Preco',
                QtdeEstoque = '$QtdeEstoque'
            WHERE CodProduto = $CodProduto;";
            $message = "Registro atualizado com sucesso!";
            break;
        default:
            $message = "Operação desconhecida!";
    }

    mysqli_query($conn, $sql) or
    die("Erro!");
    mysqli_close($conn);
    header("location:../index.php?message=$message");
?>