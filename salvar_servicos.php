<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = $_POST['nome'] ?? '';
    $tipo       = $_POST['tipo'] ?? '';
    $valorHora  = $_POST['valorHora'] ?? '';
    $valorMin   = $_POST['valorMinimo'] ?? '';

    if (empty($nome) || empty($tipo) || empty($valorHora) || empty($valorMin)) {
        die("<h3 style='color:red;'>Por favor, preencha todos os campos obrigatórios.</h3>");
    }

    $stmt = $conn->prepare("INSERT INTO servicos (nome, tipo, hora, minimo) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("<h3 style='color:red;'>Erro ao preparar: " . $conn->error . "</h3>");
    }

    $stmt->bind_param("ssdd", $nome, $tipo, $valorHora, $valorMin);

    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>✅ Serviço cadastrado com sucesso!</h3>";
    } else {
        echo "<h3 style='color:red;'>❌ Erro ao cadastrar serviço: " . $stmt->error . "</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3 style='color:orange;'>Acesso inválido. Use o método POST.</h3>";
}
?>
