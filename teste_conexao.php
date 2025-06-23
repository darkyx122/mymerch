<?php
require_once 'conexao.php';

try {
    // Consulta simples para testar
    $stmt = $pdo->query("SELECT 1");

    if ($stmt) {
        echo "<h3 style='color: green;'>Conexão com o banco de dados bem-sucedida!</h3>";
    } else {
        echo "<h3 style='color: red;'>Consulta falhou, mas conexão foi feita.</h3>";
    }
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Erro: " . $e->getMessage() . "</h3>";
}
?>
