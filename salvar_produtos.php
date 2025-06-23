<?php

require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $unidadade = trim($_POST['unidadade'] ?? '');
    $quantidade = intval($_POST['quantidade'] ?? 0);
    $minimo = intval($_POST['minimo'] ?? 0);
    $compra = floatval($_POST['compra'] ?? 0);
    $venda = floatval($_POST['venda'] ?? 0);

    if ($descricao === '' || $categoria === '' || $unidadade === '' || $quantidade < 0 || $minimo < 0 || $compra < 0 || $venda < 0) {
        die('Erro: Preencha todos os campos corretamente.');
    }

    $stmt = $conn->prepare("INSERT INTO produtos (descricao, categoria, unidadade, quantidade, minimo, compra, venda) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Erro na preparação da query: ' . $conn->error);
    }

    $stmt->bind_param("sssii dd", $descricao, $categoria, $unidadade, $quantidade, $minimo, $compra, $venda);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao salvar produto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die("Método inválido.");
}
?>
