<?php

require_once("../conexao/conexao.php");

try {
    $nome = $_GET['nome_receita'];

    // SQL para excluir o registro com o nome da receita fornecido
    $comandoSQL = "DELETE FROM cdsreceita WHERE nome_receita = :nome";

    // Prepara a declaração SQL
    $stmt = $conexao->prepare($comandoSQL);

    // Vincula o parâmetro nome à declaração SQL
    $stmt->bindParam(':nome', $nome);

    // Executa a declaração SQL
    if ($stmt->execute()) {
        echo "Registro excluído com sucesso.";
        header("Location: ./visualizacao.php");
        exit;
    } else {
        echo "Erro ao excluir registro.";
    }

} catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
}
?>
