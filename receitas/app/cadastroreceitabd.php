<?php

require_once("../conexao/conexao.php");


// Verifica se o formulário foi submetidoc
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["imagem"])  && $_POST['tipo_operacao'] === 'cadastrar') {
    // Inclui o arquivo de conexão com o banco de dados

    // Define o diretório de destino para salvar as imagens
    $diretorio_destino = "../imgdereceitas/";

    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $video = $_POST["video"];
    $descricao = $_POST["descricao"];

    // Captura o nome do arquivo de imagem
    $imagem = $_FILES["imagem"]["name"];

    // Diretório onde as imagens serão armazenadas
    $diretorio = "../imgdereceitas/";

    // Caminho completo do arquivo de imagem
    $caminho_imagem = $diretorio . basename($imagem);

    // Move o arquivo de imagem para o diretório de imagens
    if ($_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        // Verifica se o arquivo é uma imagem válida
        $tipo_arquivo = $_FILES["imagem"]["type"];
        $tipos_permitidos = ["image/jpeg", "image/png", "image/gif"];
        if (in_array($tipo_arquivo, $tipos_permitidos)) {
            // Move o arquivo temporário para o diretório de destino
            $caminho_temporario = $_FILES["imagem"]["tmp_name"];
            $caminho_destino = $diretorio_destino . $imagem;
            
            if (move_uploaded_file($caminho_temporario, $caminho_destino)) {

                $sql = "INSERT INTO cdsreceita (nome_receita, imagem, video, descricao) VALUES (:nome, :imagem, :video, :descricao)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':imagem', $imagem);
                $stmt->bindParam(':video', $video);
                $stmt->bindParam(':descricao', $descricao);

                if ($stmt->execute()) {
                    header("Location: ./visualizacao.php");
                     exit;
                   
                } else {
                    echo "Erro ao salvar dados.";
                }
            } else {
                echo "Erro ao salvar a imagem.";
            }
        } else {
            echo "Somente arquivos de imagem são permitidos (JPEG, PNG, GIF).";
        }
    } else {
        echo "Erro durante o upload do arquivo.";
    }
}



?>








