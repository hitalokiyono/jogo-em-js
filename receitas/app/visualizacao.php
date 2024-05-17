<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de receitas</title>
    <link rel="stylesheet" href="css\estilo.css">
</head>
<body>
    <?php require_once("./menu.php"); ?>
    <div class="titulo">
        <h1>Visualização de receitas</h1>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th width="70">NOME da receita</th>
                    <th width="70">descricao</th>
                    <th width="70">imagem</th>
                    <th width="70">videoURL</th>
                    <th width="20px">excluir</th>
                    <th width="20px">atualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("./visualizacaobd.php");
                    if($totalRegistros > 0){
                       foreach($dados as $linha){
                ?>
                <tr>
                    <td align="center"><?= $linha["nome_receita"]; ?></td>
                    <td class="descricao"><?= substr($linha["descricao"], 0, 30); ?>...</td>
                    <td align="center"><?= $linha["imagem"]; ?></td>
                    <td class="video"><?= substr($linha["video"], 0, 70); ?>...</td>
                    <td align="center">
                    <img src="../img/excluir.png" alt="Excluir" onclick="exc(<?= htmlspecialchars(json_encode($linha)); ?>)">
                    </td>
                    <td align="center">
                    <img src="../img/atualizar.png" alt="editar" onclick="att(<?= htmlspecialchars(json_encode($linha)); ?>)">
                    </td>
                </tr>
                <?php
                       }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../script/script.js"></script>
</body>
</html>

