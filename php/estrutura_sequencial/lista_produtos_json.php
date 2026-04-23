<?php
$arquivo = 'produtos.json';

// 1. Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    die("<p style='color:red'>Arquivo '$arquivo' não encontrado.</p>");
}

// 2. Lê o conteúdo do arquivo
$conteudo = file_get_contents($arquivo);

// 3. Converte o JSON em array PHP
$produtos = json_decode($conteudo, true);

// 4. Verifica se o JSON é válido
if (json_last_error() !== JSON_ERROR_NONE) {
    die("<p style='color:red'>Erro ao ler o JSON: " . json_last_error_msg() . "<​/p>");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Leitura de JSON</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2    { text-align: center; color: #333; }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse; background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th    { background-color: #007bff; color: #fff; padding: 12px; text-align: center; }
        td    { padding: 10px 14px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background-color: #f1f1f1; }
        .preco        { color: #28a745; font-weight: bold; }
        .baixo-estoque { color: #dc3545; font-weight: bold; }
        .total { text-align: right; max-width: 800px; margin: 10px auto; font-size: 14px; color: #555; }
    </style>
</head>
<body>

<h2>📦 Produtos — Lidos do arquivo <code>produtos.json</code></h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td class="<​?= $p['estoque'] < 100 ? 'baixo-estoque' : '' ?>">
                <?= $p['estoque'] ?> <?= $p['estoque'] < 100 ? '⚠️' : '' ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="total">Total de produtos: <strong><?= count($produtos) ?></strong></p>

</body>
</html>