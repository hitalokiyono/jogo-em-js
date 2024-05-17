<?php
$serverName = "localhost"; // Nome do servidor SQL Server
$connectionOptions = array(
    "Database" => "agendaie", // Nome do banco de dados
    "Uid" => "", // Deixe o nome de usuário em branco para autenticação do Windows
    "PWD" => "" // Deixe a senha em branco para autenticação do Windows
);
try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=" . $connectionOptions['Database'], null, null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro na conexão: " . $e->getMessage());
}
?>
