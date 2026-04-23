<?php
// -------------------------------------------------------
// isset() → verifica se a variável existe na URL
// Se o formulário não foi enviado, redireciona
// -------------------------------------------------------
if (!isset($_GET['nome'])) {
    header("Location: form_get.html");
    exit;
}

// Captura e limpa os dados recebidos
$nome  = trim($_GET['nome']);
$idade = trim($_GET['idade']);
$curso = trim($_GET['curso']);

// -------------------------------------------------------
// VALIDAÇÃO com empty() e isset()
// empty() → verifica se está vazio
// isset()  → verifica se existe/foi enviado
// -------------------------------------------------------
$erros = [];

if (empty($nome)) {
    $erros[] = "O campo <strong>Nome</strong> é obrigatório.";
}

if (empty($idade)) {
    $erros[] = "O campo <strong>Idade</strong> é obrigatório.";
} elseif (!is_numeric($idade) || $idade < 1) {
    $erros[] = "A <strong>Idade</strong> deve ser um número válido.";
}

if (empty($curso)) {
    $erros[] = "Selecione um <strong>Curso</strong>.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        .resultado { padding: 15px; border-radius: 6px; background: #e9f7ef; border-left: 5px solid #28a745; }
        .resultado h3 { margin-top: 0; color: #28a745; }
        .resultado p { margin: 5px 0; }
        .erro { padding: 15px; border-radius: 6px; background: #fdecea; border-left: 5px solid #dc3545; }
        .erro h3 { margin-top: 0; color: #dc3545; }
        .erro ul { margin: 5px 0; padding-left: 20px; }
        .url-box { margin-top: 20px; padding: 10px; background: #fff3cd; border-left: 5px solid #ffc107; border-radius: 4px; font-size: 13px; word-break: break-all; }
        a.voltar { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
        a.voltar:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <a href="form_get.html" class="voltar">&larr; Voltar ao formulário</a>
    <h2>📋 Resultado</h2>

    <?php if (!empty($erros)): ?>

        <div class="erro">
            <h3>⚠️ Corrija os erros abaixo:</h3>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= $erro ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php else: ?>

        <div class="resultado">
            <h3>✅ Dados recebidos com sucesso!</h3>
            <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
            <p><strong>Idade:</strong> <?= htmlspecialchars($idade) ?> anos</p>
            <p><strong>Curso:</strong> <?= htmlspecialchars($curso) ?></p>
        </div>

        <!-- Bloco didático: mostra a URL gerada pelo GET -->
        <div class="url-box">
            <strong>🔗 URL gerada pelo GET:</strong><br>
            <?= htmlspecialchars("processa_get.php?nome=$nome&idade=$idade&curso=$curso") ?>
        </div>

    <?php endif; ?>

</div>
</body>
</html>