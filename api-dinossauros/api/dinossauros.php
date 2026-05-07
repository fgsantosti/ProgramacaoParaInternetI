<?php
/**
 * API REST de Dinossauros
 *
 * Endpoints suportados (GET):
 * - /api/dinossauros.php                      -> lista todos
 * - /api/dinossauros.php?id=1                 -> busca por id
 * - /api/dinossauros.php?nome=raptor          -> busca parcial por nome
 * - /api/dinossauros.php?periodo=Jurássico    -> filtro por período
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Responde preflight CORS sem processar mais nada.
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/**
 * Envia resposta JSON padronizada e encerra o script.
 */
function responder(bool $sucesso, array $dados = [], ?array $filtro = null, string $mensagem = '', int $statusCode = 200): void
{
    http_response_code($statusCode);

    echo json_encode([
        'sucesso' => $sucesso,
        'total' => count($dados),
        'dados' => $dados,
        'filtro' => $filtro,
        'mensagem' => $mensagem,
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    exit;
}

/**
 * Lê e decodifica o JSON de dinossauros.
 */
function lerDinossauros(string $caminhoArquivo): array
{
    if (!file_exists($caminhoArquivo)) {
        responder(false, [], null, 'Arquivo de dados não encontrado.', 500);
    }

    $conteudo = file_get_contents($caminhoArquivo);

    if ($conteudo === false) {
        responder(false, [], null, 'Não foi possível ler o arquivo de dados.', 500);
    }

    $dados = json_decode($conteudo, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($dados)) {
        responder(false, [], null, 'JSON inválido: ' . json_last_error_msg(), 500);
    }

    return $dados;
}

/**
 * Converte texto para minúsculas com fallback quando mbstring não estiver habilitada.
 */
function paraMinusculo(string $texto): string
{
    return function_exists('mb_strtolower')
        ? mb_strtolower($texto, 'UTF-8')
        : strtolower($texto);
}

/**
 * Verifica se uma string contém outra (case-insensitive).
 */
function contemTexto(string $texto, string $busca): bool
{
    if (function_exists('mb_strpos')) {
        return mb_strpos($texto, $busca) !== false;
    }

    return strpos($texto, $busca) !== false;
}

// A API deste exemplo é somente GET.
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    responder(false, [], null, 'Método não permitido. Use apenas GET.', 405);
}

$arquivoDados = __DIR__ . '/../data/dinossauros.json';
$dinossauros = lerDinossauros($arquivoDados);

$id = isset($_GET['id']) ? trim((string)$_GET['id']) : null;
$nome = isset($_GET['nome']) ? trim((string)$_GET['nome']) : null;
$periodo = isset($_GET['periodo']) ? trim((string)$_GET['periodo']) : null;

try {
    // Prioridade 1: busca por ID (valor único).
    if ($id !== null && $id !== '') {
        if (!ctype_digit($id)) {
            responder(false, [], ['id' => $id], 'Parâmetro id inválido. Informe um número inteiro positivo.', 400);
        }

        $idBuscado = (int)$id;
        $resultado = array_values(array_filter(
            $dinossauros,
            static fn(array $dino): bool => isset($dino['id']) && (int)$dino['id'] === $idBuscado
        ));

        if (count($resultado) === 0) {
            responder(false, [], ['id' => $idBuscado], 'Dinossauro não encontrado.', 404);
        }

        responder(true, $resultado, ['id' => $idBuscado], 'Dinossauro encontrado com sucesso.');
    }

    // Prioridade 2: busca parcial por nome (case-insensitive).
    if ($nome !== null && $nome !== '') {
        $nomeBusca = paraMinusculo($nome);

        $resultado = array_values(array_filter(
            $dinossauros,
            static function (array $dino) use ($nomeBusca): bool {
                $nomeDino = paraMinusculo((string)($dino['nome'] ?? ''));
                return contemTexto($nomeDino, $nomeBusca);
            }
        ));

        responder(
            true,
            $resultado,
            ['nome' => $nome],
            count($resultado) > 0
                ? 'Busca por nome realizada com sucesso.'
                : 'Nenhum dinossauro encontrado para o nome informado.'
        );
    }

    // Prioridade 3: filtro por período (exato, case-insensitive).
    if ($periodo !== null && $periodo !== '') {
        $periodoBusca = paraMinusculo($periodo);

        $resultado = array_values(array_filter(
            $dinossauros,
            static fn(array $dino): bool => paraMinusculo((string)($dino['periodo'] ?? '')) === $periodoBusca
        ));

        responder(
            true,
            $resultado,
            ['periodo' => $periodo],
            count($resultado) > 0
                ? 'Filtro por período realizado com sucesso.'
                : 'Nenhum dinossauro encontrado para o período informado.'
        );
    }

    // Sem filtros: retorna todos.
    responder(true, $dinossauros, null, 'Lista completa de dinossauros retornada com sucesso.');
} catch (Throwable $e) {
    responder(false, [], null, 'Erro interno inesperado: ' . $e->getMessage(), 500);
}