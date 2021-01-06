<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <title>Lista de Produtos</title>
</head>
<body class="bg-secondary p-5">
    <main class="container-fluid bg-dark text-white p-5 rounded">
        <h1 class="h1 border-bottom">Lista de Produtos</h1>
        <table class="table table-dark table-stripped my-5"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fornecedor</th>
                    <th>CodBarras</th>
                    <th>NomeProduto</th>
                    <th>Preco (R$)</th>
                    <th>Qtde Estoque</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('includes/conn.php');
                    include_once('includes/functions.php');

                    if(isset($_REQUEST['message'])) {
                        $message = $_REQUEST['message'];
                        echo "<div class='msg-box w-25 fixed-top bg-success text-light text-center my-3 mx-auto p-3 rounded'>";
                        echo    "<i class='close-msg fas fa-times float-right' onclick='closeMsg()'></i>";
                        echo    "<h5 class='h5'>Aviso</h5>";
                        echo    "<p>$message</p>";
                        echo "</div>";
                    }

                    $busca = "SELECT * FROM tbl_produto";
                    $total_reg = 10; // Registros por página

                    if(!isset($_GET['pagina']))
                        $pAtual = 1; // Página atual
                    else 
                        $pAtual = $_GET['pagina'];
                    $inicio = $pAtual - 1; 
                    $inicio = $inicio * $total_reg; // Primeiro registro da página atual

                    $limite = mysqli_query($conn, "$busca LIMIT $inicio, $total_reg"); // Busca os $total_reg primeiros registros a partir de $inicio
                    $todos = mysqli_query($conn, "$busca"); // Busca todos os registros

                    $tr = mysqli_num_rows($todos); // Número de registros total
                    $tp = ceil($tr / $total_reg); // Número de páginas

                    while($registro = mysqli_fetch_array($limite)) {
                        $CodProduto = $registro['CodProduto'];
                        $NomeFornecedor = obterNomeFornecedor($conn, $registro['CodFornecedor']);
                        $CodBarras = $registro['CodBarras'];
                        $NomeProduto = $registro['NomeProduto'];
                        $Preco = $registro['Preco'];
                        $QtdeEstoque = $registro['QtdeEstoque'];
                        echo "<tr>";
                        echo    "<td>$CodProduto</td>";
                        echo    "<td>$NomeFornecedor</td>";
                        echo    "<td>$CodBarras</td>";
                        echo    "<td>$NomeProduto</td>";
                        echo    "<td>" . formataPreco($Preco) ."</td>";
                        echo    "<td>$QtdeEstoque</td>";
                        echo    "<td><a href='docs/update.php?id=$CodProduto'><i class='fas fa-edit mr-2 text-light'></i></a>
                                    <a href='docs/action.php?id=$CodProduto&action=delete'><i class='fas fa-trash-alt ml-2 text-danger'></i></a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            $anterior = $pAtual - 1;
            $proximo = $pAtual + 1;
            echo "<div class='text-center'>";
            if ($pAtual > 1)
                echo "<a class='bg-danger text-light btn-anterior mx-4 p-2 rounded' href='?pagina=$anterior'><i class='fas fa-chevron-left'></i></a>";
            echo "$pAtual / $tp";
            if ($pAtual < $tp)
                echo "<a class='bg-danger text-light btn-proximo mx-4 p-2 rounded' href='?pagina=$proximo'><i class='fas fa-chevron-right'></i></a>";
            echo "</div>";
        ?>
        <a class="btn-danger rounded p-2 mr-2" href="docs/create.php">Registrar Produto</a>
    </main>
    <script>
        function closeMsg() {
            document.querySelector('.msg-box').style.display = 'none'
        }
    </script>
</body>
</html>