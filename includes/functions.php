<?php
    function obterNomeFornecedor($conn, $CodFornecedor) {
        $sql = "SELECT * FROM tbl_fornecedor
        WHERE CodFornecedor = $CodFornecedor";
        $resultado = mysqli_query($conn, $sql);
        return mysqli_fetch_array($resultado)['NomeFornecedor'];
    }

    function formataPreco($valor) {
        $valor_str = strval($valor);
        return str_replace('.', ',', $valor_str);
    }
?>