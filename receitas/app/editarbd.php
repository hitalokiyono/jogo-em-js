<?php

require_once("../conexao/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['tipo_operacao']) && $_POST['tipo_operacao'] === 'atualizar') {
    $nome = $_POST["nome"];
    $video = $_POST["video"];
    $descricao = $_POST["descricao"];
     $id= $_POST["id_receita"];
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        $imagem = $_FILES["imagem"]["name"];
        $diretorio_destino = "../imgdereceitas/";
        $caminho_destino = $diretorio_destino . $imagem;
        $tipo_arquivo = $_FILES["imagem"]["type"];
        $tipos_permitidos = ["image/jpeg", "image/png", "image/gif"];

        if (in_array($tipo_arquivo, $tipos_permitidos)) {
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_destino)) {
                $sql = "UPDATE cdsreceita 
                        SET video = :video, 
                            descricao = :descricao,
                            imagem = :imagem,
                            nome_receita = :nome
                        WHERE id_receita = :id";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':video', $video);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':imagem', $imagem);
                $stmt->bindParam(':id', $id);
                if ($stmt->execute()) {
                    echo "Dados atualizados com sucesso.";
                    header("Location: ./visualizacao.php");
                    exit;
                  
                } else {
                    echo "Erro ao salvar dados.";
                }
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Tipo de arquivo não suportado.";
        }
    } else {
        $sql = "UPDATE cdsreceita 
                SET video = :video, 
                    descricao = :descricao,
                    nome_receita = :nome
                WHERE id_receita = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':video', $video);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo "Dados atualizados com sucesso.";
            header("Location: ./visualizacao.php");
            exit;
          
        } else {
            echo "Erro ao salvar dados.";
        }
    }
} else {
    echo "Requisição inválida.";
}
?>
