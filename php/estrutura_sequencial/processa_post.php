<?php
// -------------------------------------------------------
// Com POST, verificamos $_SERVER["REQUEST_METHOD"]
// para saber se o formulário foi enviado
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formulario_post.html");
    exit;
}

// Captura e limpa os dados recebidos
$nome  = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);
$idade = trim($_POST['idade']);
$curso = trim($_POST['curso']);

// -------------------------------------------------------
// VALIDAÇÃO com empty() e isset()
// -------------------------------------------------------
$erros = [];

if (empty($nome)) {
    $erros[] = "O campo <strong>Nome</strong> é obrigatório.";
}

if (empty($email)) {
    $erros[] = "O campo <strong>E-mail</strong> é obrigatório.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "O <strong>E-mail</strong> informado é inválido.";
}

if (empty($senha)) {
    $erros[] = "O campo <strong>Senha</strong> é obrigatório.";
} elseif (strlen($senha) < 6) {
    $erros[] = "A <strong>Senha</strong> deve ter no mínimo 6 caracteres.";
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
    <title>Resultado POST</title>
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
        .info-box { margin-top: 20px; padding: 10px; background: #d1ecf1; border-left: 5px solid #17a2b8; border-radius: 4px; font-size: 13px; }
        a.voltar { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
        a.voltar:hover { text-decoration: underline; }
        .senha-oculta { color: #888; font-style: italic; }
    </style>
</head>
<body>
<div class="container">
    <a href="formulario.html" class="voltar">&larr; Voltar ao formulário</a>
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
            <h3>✅ Cadastro realizado com sucesso!</h3>
            <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
            <p><strong>E-mail:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Senha:</strong> <span class="senha-oculta">••••••  (não exibida por segurança)</span></p>
            <p><strong>Idade:</strong> <?= htmlspecialchars($idade) ?> anos</p>
            <p><strong>Curso:</strong> <?= htmlspecialchars($curso) ?></p>
        </div>

        <!-- Bloco didático: mostra que a URL NÃO contém os dados -->
        <div class="info-box">
            <strong>🔒 Observe a URL do navegador:</strong><br>
            A URL mostra apenas <code>processa_post.php</code> — os dados
            <strong>não aparecem</strong> na URL, pois foram enviados
            via POST no corpo da requisição.
        </div>

    <?php endif; ?>

</div>
</body>
</html>