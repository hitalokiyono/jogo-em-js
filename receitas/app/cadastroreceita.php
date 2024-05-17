<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo.css">
    <title>receitas do tio ronnie</title>
</head>
<body>
    <?php require_once("./menu.php"); ?>
    <div class="titulo">
        <h1>cadastrar receitas </h1>
    </div>
    <div class="cad">
        <div class="container">
            <form id="form-receita" method="post" enctype="multipart/form-data" action="./cadastroreceitabd.php">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome da Receita</label>
                        <input type="text" name="nome" id="nome" value="<?php echo isset($_GET['nome_receita']) ? $_GET['nome_receita'] : ''; ?>">
                        <input type="hidden" name="id_receita" value="<?php echo isset($_GET['id_receita']) ? $_GET['id_receita'] : ''; ?>">
                        <input type="hidden" name="tipo_operacao" value="<?php echo isset($_GET['nome_receita']) ? 'atualizar' : 'cadastrar'; ?>">
                    </div>
                </div>
            
                <div class="row">
                    <div class="col">
                        <label for="video">Link do Vídeo (Demonstração de Preparo)</label>
                        <input type="text" name="video" id="video" value="<?php echo isset($_GET['video']) ? $_GET['video'] : ''; ?>">
                    </div>
                </div>


                <div class="row">
    <div class="col">
        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagemInput" accept="image/*" onchange="previewImage(event)">
        <?php
            $placeholder = isset($_GET['imagem']) ? $_GET['imagem'] : 'escolher arquivo';
        ?>
        <?php if(isset($_GET['imagem'])): ?>
            <img id="imagemPreview" src="../imgdereceitas/<?php echo $_GET['imagem']; ?>" alt="Imagem" style="display: block; max-width: 650px; max-height: 450px;">
        <?php else: ?>
            <img id="imagemPreview" src=""  style="display: none; max-width: 650px; max-height: 450px;">
        <?php endif; ?>
    </div>
</div>


                <div class="row">
                    <div class="col">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao"><?php echo isset($_GET['descricao']) ? $_GET['descricao'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="reset" value="Limpar">
                        <input type="submit" value="SALVAR">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

function previewImage(event) {
        var imagemPreview = document.getElementById('imagemPreview');
        var imagemInput = event.target.files[0];
        var reader = new FileReader();
        imagemPreview.src = '';
    imagemPreview.style.display = 'none';
        reader.onload = function() {
            imagemPreview.src = reader.result;
            imagemPreview.style.display = 'block';
        };

        if (imagemInput) {
            reader.readAsDataURL(imagemInput);
        }
    }
    document.getElementById('form-receita').addEventListener('submit', function(event) {
    const tipoOperacao = document.querySelector('input[name="tipo_operacao"]').value;
    const nomeReceita = document.getElementById('nome').value.trim();
    const video = document.getElementById('video').value.trim();
    const imagem = document.getElementById('imagemInput').value.trim();
    const descricao = document.getElementById('descricao').value.trim();

    if (tipoOperacao === 'atualizar' && (nomeReceita === '' || video === '' || imagem === '' || descricao === '')) {
        alert('Por favor, preencha todos os campos');
        event.preventDefault(); // Impede o envio do formulário
        return;
    }

    // Se o tipo de operação for atualizar, atualize a ação do formulário
    if (tipoOperacao === 'atualizar') {
        this.action = './editarbd.php';
    }

    // Verificar se os campos obrigatórios estão preenchidos antes de enviar o formulário
    if (nomeReceita === '' || video === '' || imagem === '' || descricao === '') {
        alert('Por favor, preencha todos os campos');
        event.preventDefault(); // Impede o envio do formulário
        return;
    }
});


    </script>
</body>
</html>

