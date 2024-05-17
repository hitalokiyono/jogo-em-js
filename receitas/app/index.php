<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas Deliciosas</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
<div class="contaiiner">

<?php require_once("./menu.php"); ?>
<div class="titulo">
<h1 >receitas cadastradas </h1>
</div>

       <div class="containerreceita">
<img id="snakepng"src="../img/snake.jpg" alt="" srcset="">
    <div class="row1">
        <?php
        require_once("./visualizacaobd.php");

        if ($totalRegistros > 0) {
            foreach ($dados as $linha) {
                echo '<div class="col1">';
                echo '<div class="receita" onclick="updateVideo(\'' . $linha['video'] . '\')">';
                echo '<img src="../imgdereceitas/' . $linha['imagem'] . '" alt="' . $linha['nome_receita'] . '">';
                echo '<h3>' . $linha['nome_receita'] . '</h3>';
                echo '<h3 style="font-size: smaller;">Descrição resumida: </h3>';

                // Limitando a descrição a um certo número de caracteres
                $max_chars = 100; // Número máximo de caracteres a serem exibidos
                $descricao = $linha['descricao']; // Supondo que $linha['descricao'] contém a descrição

                if (strlen($descricao) > $max_chars) {
                    $descricao = substr($descricao, 0, $max_chars) . '...'; // Truncar a descrição se for maior que $max_chars
                }

                echo '<h3 id="descricao" style="font-size: smaller;">' . $descricao . '</h3>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="col">';
            echo "Nenhuma receita encontrada.";
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="video-container">
<iframe id="videoFrame" width="500" height="300" src="" frameborder="0" allowfullscreen autoplay></iframe>
</div>

<script>
    function updateVideo(videoLink) {
        var videoFrame = document.getElementById('videoFrame');
        videoFrame.src = 'https://www.youtube.com/embed/' + extractVideoId(videoLink);
    }

    function extractVideoId(youtubeLink) {
        var videoId = '';
        // Verifica se o link do YouTube é válido
        if (youtubeLink.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/)) {
            // Retorna o ID do vídeo se encontrado
            videoId = youtubeLink.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/)[1];
        }
        return videoId;
    }
</script>

</div>

</body>
</html>
