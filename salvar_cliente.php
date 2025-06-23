<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpfCnpj = $_POST['cpfCnpj'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $email = $_POST['email'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';

    $stmt = $conn->prepare("INSERT INTO cliente (cpfCnpj, celular, email, endereco, nascimento) 
                            VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("<h3 style='color:red;'>Erro ao preparar: " . $conn->error . "</h3>");
    }

    $stmt->bind_param("sssss", $cpfCnpj, $celular, $email, $endereco, $nascimento);

    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Cliente cadastrado com sucesso!</h3>";
    } else {
        echo "<h3 style='color:red;'>Erro ao cadastrar cliente: " . $stmt->error . "</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acesso inválido.";
}
?>
