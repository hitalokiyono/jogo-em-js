<?php

require_once("../conexao/conexao.php");

try {
    $nome = $_GET['nome_receita'];
    $comandoSQL = "SELECT * FROM cdsreceita WHERE nome_receita = :nome";
    // Prepara a declaração SQL
    $stmt = $conexao->prepare($comandoSQL);
    // Vincula o parâmetro nome à declaração SQL
    $stmt->bindParam(':nome', $nome);
    // Executa a declaração SQL
    if ($stmt->execute()) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);  
    } else {
        echo "Erro ao excluir registro.";
    }

} catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
}
?>