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
    <title>Inserir Produto</title>
</head>
<body class="bg-secondary p-5">
    <main class="container-fluid bg-dark text-white p-5 rounded">
        <h1 class="h1 border-bottom mb-5">Inserir Produto</h1>
        <form class="mx-auto" action="action.php?action=insert" method="POST">
            <div class="row">
                <div class="form-group col-6">
                    <label for="fornecedor">Fornecedor</label>
                    <?php
                        include_once('../includes/conn.php');

                        $sql = "SELECT * FROM tbl_fornecedor";
                        $resultado = mysqli_query($conn, $sql);

                        echo "<select class='form-control' name='fornecedor' required>";
                        echo    "<option value='' selected disabled>Selecione</opntion>";
                        while($registro = mysqli_fetch_array($resultado)) {
                            $valor = $registro['CodFornecedor'];
                            $legenda = $registro['NomeFornecedor'];
                            echo "<option value='$valor'>$legenda</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="form-group col-6">
                    <label for="barras">Cod. Barras</label>
                    <input class="form-control" type="text" name="barras" pattern=".{13}" maxlength="13" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-5">
                    <label for="nome">Nome do Produto</label>
                    <input class="form-control" type="text" name="nome" maxlength="20" required>
                </div>
                <div class="form-group col-5">
                    <label for="preco">Preço do Produto</label>
                    <input class="form-control" type="text" name="preco" required>
                </div>
                <div class="form-group col-2">
                    <label for="estoque">Qtde Estoque</label>
                    <input class="form-control" type="number" name="estoque" min="1" max="999" value="1" required>
                </div>
            </div>
            <div class="form-group text-center mt-5">
                <input type="submit" class="btn btn-danger rounded p-2 mr-4" value="Salvar">
                <a class="btn btn-secondary rounded p-2" href="../index.php">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>