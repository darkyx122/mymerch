<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = trim($_POST['idUsuario'] ?? '');
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $cargo    = trim($_POST['cargo'] ?? '');

    if (empty($idUsuario) || empty($nome) || empty($cpf) || empty($email) || empty($cargo)) {
        die("<h3 style='color:red;'>Por favor, preencha todos os campos obrigatórios.</h3>");
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (id, nome, cpf, email, cargo) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("<h3 style='color:red;'>Erro ao preparar a consulta: " . htmlspecialchars($conn->error) . "</h3>");
    }

    $stmt->bind_param("sssss", $idUsuario, $nome, $cpf, $email, $cargo);

    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Usuário cadastrado com sucesso!</h3>";
    } else {
        echo "<h3 style='color:red;'>Erro ao cadastrar usuário: " . htmlspecialchars($stmt->error) . "</h3>";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "<h3 style='color:orange;'>Acesso inválido. Use o método POST.</h3>";
}
?>
