### 🦖 INTRODUÇÃO

Bem-vindo(a)! Neste guia, vamos construir **do zero** um projeto chamado **API de Dinossauros** usando PHP + JSON + HTML/CSS/JS.

Você vai aprender, na prática, como:

- organizar um projeto web em pastas;
- criar uma “base de dados” em JSON;
- desenvolver uma API REST em PHP;
- testar endpoints no navegador;
- consumir a API com JavaScript (Fetch API);
- montar uma interface moderna com filtros e modal de detalhes.

> ✅ **Objetivo final:** ter uma API funcional e um cliente web bonito para listar e filtrar dinossauros.

#### O que vamos criar

- `data/dinossauros.json` → dados dos dinossauros
- `api/dinossauros.php` → endpoint REST (backend)
- `client/index.html` → interface visual (frontend)
- `imagens/` → imagens dos dinossauros

#### Requisitos

- **PHP 8+** instalado (recomendado)
- **Navegador** (Chrome, Firefox, Edge)
- **Editor de código** (VS Code, Cursor, Sublime etc.)
- Terminal (Prompt/PowerShell/Bash)

> 💡 Dica: para verificar o PHP, rode `php -v` no terminal.

---

### PASSO 1: CRIANDO A ESTRUTURA DE PASTAS

#### 1.1 Criar a pasta principal

Crie uma pasta chamada:

```text
api-dinossauros/
```

#### 1.2 Criar as subpastas

Dentro de `api-dinossauros/`, crie:

- `data/`
- `api/`
- `client/`
- `imagens/`

#### 1.3 Função de cada pasta

- **data/** → guarda nosso arquivo JSON (simula banco de dados)
- **api/** → contém o arquivo PHP com os endpoints
- **client/** → contém o frontend que consome a API
- **imagens/** → imagens usadas nos cards dos dinossauros

#### 1.4 Diagrama visual (ASCII)

```text
api-dinossauros/
├── api/
│   └── dinossauros.php
├── client/
│   └── index.html
├── data/
│   └── dinossauros.json
└── imagens/
```

> 📌 **Importante:** o nome dos arquivos e pastas deve ser exatamente igual ao tutorial para evitar erros de caminho.

---

### PASSO 2: CRIANDO A BASE DE DADOS (JSON)

#### Criando o arquivo `dinossauros.json`

**O que é JSON?**

JSON (JavaScript Object Notation) é um formato leve e muito usado para troca de dados entre sistemas e APIs.

**Por que usamos aqui?**

- é simples de ler e editar;
- não precisa configurar banco SQL para começar;
- perfeito para aprendizado inicial de API REST.

#### 2.1 Instrução

Crie o arquivo:

```text
data/dinossauros.json
```

#### 2.2 Código COMPLETO para copiar e colar

```json
[
  {
    "id": 1,
    "nome": "Coelophysis",
    "periodo": "Triássico",
    "imagem": "imagens/coelophysis.jpg",
    "descricao": "Dinossauro carnívoro de pequeno porte, ágil e com corpo leve. Viveu em grupos e é um dos terópodes mais conhecidos do Triássico final.",
    "altura": "1 m",
    "comprimento": "3 m",
    "peso": "20 kg",
    "dieta": "Carnívoro"
  },
  {
    "id": 2,
    "nome": "Plateosaurus",
    "periodo": "Triássico",
    "imagem": "imagens/plateosaurus.jpg",
    "descricao": "Grande herbívoro do fim do Triássico, com pescoço alongado e dentes adaptados para vegetação. Considerado um dos primeiros dinossauros de grande porte.",
    "altura": "3,5 m",
    "comprimento": "8 m",
    "peso": "4 t",
    "dieta": "Herbívoro"
  },
  {
    "id": 3,
    "nome": "Herrerasaurus",
    "periodo": "Triássico",
    "imagem": "imagens/herrerasaurus.jpg",
    "descricao": "Predador bípede primitivo da América do Sul, com mandíbula forte e garras afiadas. Foi um dos primeiros grandes carnívoros entre os dinossauros.",
    "altura": "1,5 m",
    "comprimento": "6 m",
    "peso": "350 kg",
    "dieta": "Carnívoro"
  },
  {
    "id": 4,
    "nome": "Eoraptor",
    "periodo": "Triássico",
    "imagem": "imagens/eoraptor.jpg",
    "descricao": "Pequeno dinossauro considerado muito próximo das formas mais antigas do grupo. Provavelmente tinha dieta variada e locomoção rápida.",
    "altura": "0,8 m",
    "comprimento": "1 m",
    "peso": "10 kg",
    "dieta": "Onívoro"
  },
  {
    "id": 5,
    "nome": "Stegosaurus",
    "periodo": "Jurássico",
    "imagem": "imagens/stegosaurus.jpg",
    "descricao": "Herbívoro famoso pelas placas ósseas nas costas e espinhos na cauda. Usava a cauda para defesa contra predadores.",
    "altura": "4 m",
    "comprimento": "9 m",
    "peso": "5 t",
    "dieta": "Herbívoro"
  },
  {
    "id": 6,
    "nome": "Allosaurus",
    "periodo": "Jurássico",
    "imagem": "imagens/allosaurus.jpg",
    "descricao": "Grande terópode predador do Jurássico superior. Possuía dentes serrilhados e era um dos principais caçadores do seu ecossistema.",
    "altura": "5 m",
    "comprimento": "12 m",
    "peso": "2 t",
    "dieta": "Carnívoro"
  },
  {
    "id": 7,
    "nome": "Brachiosaurus",
    "periodo": "Jurássico",
    "imagem": "imagens/brachiosaurus.jpg",
    "descricao": "Sauropode gigante com membros dianteiros mais longos, pescoço elevado e alimentação em copas altas de árvores.",
    "altura": "12 m",
    "comprimento": "25 m",
    "peso": "35 t",
    "dieta": "Herbívoro"
  },
  {
    "id": 8,
    "nome": "Diplodocus",
    "periodo": "Jurássico",
    "imagem": "imagens/diplodocus.jpg",
    "descricao": "Dinossauro de pescoço e cauda muito longos, corpo relativamente leve para seu tamanho. Provavelmente vivia em grupos.",
    "altura": "4,5 m",
    "comprimento": "27 m",
    "peso": "15 t",
    "dieta": "Herbívoro"
  },
  {
    "id": 9,
    "nome": "Tyrannosaurus rex",
    "periodo": "Cretáceo",
    "imagem": "imagens/trex.jpg",
    "descricao": "Um dos carnívoros mais famosos de todos os tempos, com mordida extremamente poderosa e excelente olfato.",
    "altura": "6 m",
    "comprimento": "12,5 m",
    "peso": "8 t",
    "dieta": "Carnívoro"
  },
  {
    "id": 10,
    "nome": "Triceratops",
    "periodo": "Cretáceo",
    "imagem": "imagens/triceratops.jpg",
    "descricao": "Herbívoro robusto com três chifres e grande gola óssea. Utilizava essas estruturas para defesa e possivelmente exibição social.",
    "altura": "3 m",
    "comprimento": "9 m",
    "peso": "7 t",
    "dieta": "Herbívoro"
  },
  {
    "id": 11,
    "nome": "Velociraptor",
    "periodo": "Cretáceo",
    "imagem": "imagens/velociraptor.jpg",
    "descricao": "Terópode pequeno e inteligente, com garra curvada característica nos pés. Evidências sugerem presença de penas.",
    "altura": "0,7 m",
    "comprimento": "2 m",
    "peso": "15 kg",
    "dieta": "Carnívoro"
  },
  {
    "id": 12,
    "nome": "Ankylosaurus",
    "periodo": "Cretáceo",
    "imagem": "imagens/ankylosaurus.jpg",
    "descricao": "Dinossauro blindado com placas ósseas e uma clava na ponta da cauda. Era um herbívoro bem protegido contra ataques.",
    "altura": "1,7 m",
    "comprimento": "8 m",
    "peso": "6 t",
    "dieta": "Herbívoro"
  }
]
```

#### 2.3 Explicação dos campos

- `id`: identificador único numérico
- `nome`: nome do dinossauro
- `periodo`: Triássico, Jurássico ou Cretáceo
- `imagem`: caminho da imagem (relativo ao projeto)
- `descricao`: texto descritivo
- `altura`: altura aproximada
- `comprimento`: tamanho total
- `peso`: peso estimado
- `dieta`: Herbívoro, Carnívoro ou Onívoro

#### 2.4 Dica: validar JSON

Ferramentas úteis:

- https://jsonlint.com
- extensão “JSON Viewer” no navegador
- no VS Code: salvar o arquivo e usar a formatação automática

> ⚠️ **Erro comum:** esquecer vírgula entre objetos ou deixar vírgula no final do último item.

---

### PASSO 3: CRIANDO A API (BACKEND)

#### Criando o endpoint da API

**O que é uma API REST?**

É uma interface que recebe requisições HTTP (como GET) e devolve dados em formato JSON.

Neste projeto, nossa API vai permitir:

- listar todos os dinossauros;
- buscar por `id`;
- buscar por `nome`;
- filtrar por `periodo`.

#### 3.1 Instrução

Crie o arquivo:

```text
api/dinossauros.php
```

#### 3.2 Código COMPLETO da API para copiar (comentado)

```php
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
```

#### 3.3 Explicação detalhada seção por seção

#### a) Configuração de headers

- `Content-Type: application/json` → garante que resposta será JSON.
- `Access-Control-Allow-Origin: *` → libera requisições de outras origens (útil em testes).
- `Access-Control-Allow-Methods` → informa métodos permitidos.

#### b) Funções auxiliares

- `responder(...)` → padroniza saída da API (sucesso, total, dados, filtro, mensagem).
- `lerDinossauros(...)` → lê e valida o arquivo JSON.
- `paraMinusculo(...)` e `contemTexto(...)` → ajudam na busca case-insensitive.

#### c) Leitura do JSON

A linha abaixo localiza o arquivo:

```php
$arquivoDados = __DIR__ . '/../data/dinossauros.json';
```

Depois a API usa `lerDinossauros` para carregar e validar os dados.

#### d) Implementação dos filtros

A API tem prioridade:

1. `id`
2. `nome`
3. `periodo`
4. sem parâmetros → todos

Isso evita conflito de filtros e deixa a lógica previsível.

#### e) Retorno da resposta

A API sempre retorna um JSON com formato padrão:

```json
{
  "sucesso": true,
  "total": 12,
  "dados": [],
  "filtro": null,
  "mensagem": "..."
}
```

#### 3.4 Tabela de endpoints (com exemplos)

| Método | Endpoint | Exemplo de URL |
|---|---|---|
| GET | Listar todos | `/api/dinossauros.php` |
| GET | Buscar por ID | `/api/dinossauros.php?id=6` |
| GET | Buscar por nome | `/api/dinossauros.php?nome=raptor` |
| GET | Filtrar por período | `/api/dinossauros.php?periodo=Jurássico` |

---

### PASSO 4: TESTANDO A API

#### 4.1 Como testar no navegador

Com o servidor rodando (vamos iniciar no Passo 6), abra no navegador:

- `http://localhost:8000/api/dinossauros.php`
- `http://localhost:8000/api/dinossauros.php?id=1`
- `http://localhost:8000/api/dinossauros.php?nome=saurus`
- `http://localhost:8000/api/dinossauros.php?periodo=Cretáceo`

#### 4.2 O que esperar de resposta

Exemplo (listar todos):

```json
{
  "sucesso": true,
  "total": 12,
  "dados": [
    {
      "id": 1,
      "nome": "Coelophysis",
      "periodo": "Triássico"
    }
  ],
  "filtro": null,
  "mensagem": "Lista completa de dinossauros retornada com sucesso."
}
```

Exemplo (ID não encontrado):

```json
{
  "sucesso": false,
  "total": 0,
  "dados": [],
  "filtro": {
    "id": 999
  },
  "mensagem": "Dinossauro não encontrado."
}
```

#### 4.3 Dicas de ferramentas

- Extensão de navegador: **JSON Viewer**
- VS Code: extensão **Thunder Client**
- App externo: **Postman** / **Insomnia**

> 💡 Dica: se tiver acentos na URL (`Jurássico`, `Cretáceo`), o navegador já codifica automaticamente.

---

### PASSO 5: CRIANDO O CLIENTE WEB (FRONTEND)

#### Criando a interface visual

Agora vamos criar uma página que consome a API com JavaScript e mostra os dinossauros em cards.

#### 5.1 Instrução

Crie o arquivo:

```text
client/index.html
```

#### 5.2 Código COMPLETO do HTML para copiar

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catálogo de Dinossauros | Cliente da API REST</title>
  <style>
    :root {
      --bg: #0b1020;
      --card: #141a2e;
      --text: #e6e9f2;
      --muted: #aeb7d1;
      --accent: #5eead4;
      --danger: #f87171;
      --triassico: #f59e0b;
      --jurassico: #3b82f6;
      --cretaceo: #10b981;
      --shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Inter, Segoe UI, Roboto, Arial, sans-serif;
      background: radial-gradient(circle at top, #17203c 0%, var(--bg) 55%);
      color: var(--text);
      min-height: 100vh;
    }

    .container {
      width: min(1120px, 92%);
      margin: 32px auto 64px;
    }

    .hero {
      margin-bottom: 24px;
    }

    .hero h1 {
      margin: 0 0 8px;
      font-size: clamp(1.6rem, 3vw, 2.2rem);
    }

    .hero p {
      margin: 0;
      color: var(--muted);
    }

    .panel {
      background: rgba(20, 26, 46, 0.85);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 18px;
    }

    form {
      display: grid;
      grid-template-columns: 1fr 220px auto auto;
      gap: 12px;
      align-items: end;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    label {
      font-size: 0.9rem;
      color: var(--muted);
    }

    input,
    select,
    button {
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      padding: 11px 12px;
      font-size: 0.95rem;
      color: var(--text);
      background: #0f1529;
      outline: none;
    }

    input:focus,
    select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(94, 234, 212, 0.2);
    }

    button {
      cursor: pointer;
      font-weight: 600;
      transition: transform 0.15s ease, opacity 0.15s ease;
    }

    .btn-primary {
      background: linear-gradient(135deg, #0ea5e9, #14b8a6);
      border: none;
    }

    .btn-secondary {
      background: #1f2a48;
    }

    button:hover {
      transform: translateY(-1px);
    }

    .status {
      margin: 16px 0 6px;
      min-height: 22px;
      color: var(--muted);
    }

    .status.error {
      color: var(--danger);
      font-weight: 600;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 14px;
      margin-top: 12px;
    }

    .card {
      background: var(--card);
      border-radius: 14px;
      border: 2px solid transparent;
      overflow: hidden;
      box-shadow: var(--shadow);
      cursor: pointer;
      transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .card:hover {
      transform: translateY(-4px);
    }

    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      display: block;
      background: #0d1326;
    }

    .card-body {
      padding: 12px;
    }

    .card h3 {
      margin: 0 0 8px;
      font-size: 1.05rem;
    }

    .chip {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 999px;
      font-size: 0.78rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-bottom: 8px;
    }

    .triassico {
      border-color: rgba(245, 158, 11, 0.8);
    }

    .triassico .chip {
      background: rgba(245, 158, 11, 0.25);
      color: #fcd34d;
    }

    .jurassico {
      border-color: rgba(59, 130, 246, 0.8);
    }

    .jurassico .chip {
      background: rgba(59, 130, 246, 0.25);
      color: #93c5fd;
    }

    .cretaceo {
      border-color: rgba(16, 185, 129, 0.8);
    }

    .cretaceo .chip {
      background: rgba(16, 185, 129, 0.25);
      color: #6ee7b7;
    }

    .empty {
      padding: 22px;
      text-align: center;
      border: 1px dashed rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: var(--muted);
      margin-top: 12px;
    }

    .modal {
      position: fixed;
      inset: 0;
      background: rgba(8, 11, 22, 0.72);
      display: none;
      align-items: center;
      justify-content: center;
      padding: 18px;
      z-index: 99;
    }

    .modal.open {
      display: flex;
    }

    .modal-card {
      width: min(760px, 100%);
      background: #11182d;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: var(--shadow);
    }

    .modal-media {
      width: 100%;
      height: 240px;
      object-fit: cover;
      background: #0b1020;
    }

    .modal-content {
      padding: 16px;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      align-items: center;
    }

    .modal h2 {
      margin: 0;
      font-size: 1.4rem;
    }

    .close {
      border: none;
      background: #253256;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      color: #fff;
      font-size: 1.2rem;
      line-height: 1;
      cursor: pointer;
    }

    .specs {
      margin-top: 12px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
      gap: 8px;
    }

    .spec {
      background: #0f1529;
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 10px;
      padding: 8px;
    }

    .spec strong {
      display: block;
      color: #93c5fd;
      margin-bottom: 4px;
      font-size: 0.82rem;
    }

    @media (max-width: 860px) {
      form {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 560px) {
      form {
        grid-template-columns: 1fr;
      }

      .container {
        width: 94%;
      }

      .modal-media {
        height: 180px;
      }
    }
  </style>
</head>
<body>
  <main class="container">
    <header class="hero">
      <h1>🦖 API REST de Dinossauros</h1>
      <p>Cliente web para consumir endpoints em PHP e renderizar dados de forma dinâmica com Fetch API.</p>
    </header>

    <section class="panel">
      <form id="form-busca">
        <div class="field">
          <label for="nome">Buscar por nome</label>
          <input id="nome" name="nome" type="text" placeholder="Ex.: raptor" />
        </div>

        <div class="field">
          <label for="periodo">Filtrar por período</label>
          <select id="periodo" name="periodo">
            <option value="">Todos</option>
            <option value="Triássico">Triássico</option>
            <option value="Jurássico">Jurássico</option>
            <option value="Cretáceo">Cretáceo</option>
          </select>
        </div>

        <button class="btn-primary" type="submit">Pesquisar</button>
        <button class="btn-secondary" type="button" id="limpar">Limpar</button>
      </form>

      <p class="status" id="status">Carregando dinossauros...</p>
      <section id="resultados" class="grid" aria-live="polite"></section>
    </section>
  </main>

  <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modal-titulo">
    <article class="modal-card">
      <img class="modal-media" id="modal-imagem" src="" alt="Imagem do dinossauro" />
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="modal-titulo"></h2>
          <button class="close" id="fechar-modal" aria-label="Fechar">×</button>
        </div>

        <p id="modal-descricao"></p>
        <div class="specs" id="modal-specs"></div>
      </div>
    </article>
  </div>

  <script>
    // Endereço da API relativo ao arquivo client/index.html.
    const API_URL = '../api/dinossauros.php';

    const formBusca = document.getElementById('form-busca');
    const campoNome = document.getElementById('nome');
    const campoPeriodo = document.getElementById('periodo');
    const btnLimpar = document.getElementById('limpar');
    const statusEl = document.getElementById('status');
    const resultadosEl = document.getElementById('resultados');

    const modal = document.getElementById('modal');
    const fecharModalBtn = document.getElementById('fechar-modal');
    const modalImagem = document.getElementById('modal-imagem');
    const modalTitulo = document.getElementById('modal-titulo');
    const modalDescricao = document.getElementById('modal-descricao');
    const modalSpecs = document.getElementById('modal-specs');

    /**
     * Monta URL da API com base nos filtros preenchidos.
     */
    function montarURL() {
      const params = new URLSearchParams();
      const nome = campoNome.value.trim();
      const periodo = campoPeriodo.value.trim();

      // Regra de negócio simples: se nome for informado, ele tem prioridade.
      if (nome) {
        params.set('nome', nome);
      } else if (periodo) {
        params.set('periodo', periodo);
      }

      const query = params.toString();
      return query ? `${API_URL}?${query}` : API_URL;
    }

    /**
     * Define classe de cor conforme período.
     */
    function classePeriodo(periodo) {
      const p = (periodo || '').toLowerCase();
      if (p === 'triássico' || p === 'triassico') return 'triassico';
      if (p === 'jurássico' || p === 'jurassico') return 'jurassico';
      return 'cretaceo';
    }

    /**
     * Escapa texto para evitar injeção ao montar HTML.
     */
    function escapeHtml(texto) {
      const div = document.createElement('div');
      div.textContent = String(texto ?? '');
      return div.innerHTML;
    }

    /**
     * Renderiza cards com os resultados retornados pela API.
     */
    function renderizarCards(lista) {
      resultadosEl.innerHTML = '';

      if (!lista.length) {
        resultadosEl.innerHTML = '<div class="empty">Nenhum dinossauro encontrado para este filtro.</div>';
        return;
      }

      const fragment = document.createDocumentFragment();

      lista.forEach((dino) => {
        const card = document.createElement('article');
        card.className = `card ${classePeriodo(dino.periodo)}`;
        card.innerHTML = `
          <img src="../${escapeHtml(dino.imagem)}" alt="${escapeHtml(dino.nome)}"
               onerror="this.src='https://placehold.co/600x360/0f172a/94a3b8?text=Sem+Imagem'" />
          <div class="card-body">
            <span class="chip">${escapeHtml(dino.periodo)}</span>
            <h3>${escapeHtml(dino.nome)}</h3>
            <p>${escapeHtml((dino.descricao || '').slice(0, 110))}...</p>
          </div>
        `;

        card.addEventListener('click', () => abrirModal(dino));
        fragment.appendChild(card);
      });

      resultadosEl.appendChild(fragment);
    }

    /**
     * Exibe modal com detalhes do dinossauro selecionado.
     */
    function abrirModal(dino) {
      modalImagem.src = `../${dino.imagem}`;
      modalImagem.alt = dino.nome;
      modalTitulo.textContent = `${dino.nome} (#${dino.id})`;
      modalDescricao.textContent = dino.descricao || 'Sem descrição disponível.';

      const specs = [
        ['Período', dino.periodo],
        ['Altura', dino.altura],
        ['Comprimento', dino.comprimento],
        ['Peso', dino.peso],
        ['Dieta', dino.dieta],
      ].filter(([, valor]) => valor);

      modalSpecs.innerHTML = specs.map(([titulo, valor]) => `
        <div class="spec">
          <strong>${escapeHtml(titulo)}</strong>
          <span>${escapeHtml(valor)}</span>
        </div>
      `).join('');

      modal.classList.add('open');
    }

    function fecharModal() {
      modal.classList.remove('open');
    }

    /**
     * Consome a API e atualiza tela com loading e erros amigáveis.
     */
    async function carregarDinossauros() {
      const url = montarURL();
      statusEl.className = 'status';
      statusEl.textContent = 'Carregando...';

      try {
        const resposta = await fetch(url, { headers: { Accept: 'application/json' } });

        if (!resposta.ok) {
          throw new Error(`Falha HTTP ${resposta.status}`);
        }

        const payload = await resposta.json();

        if (!payload.sucesso) {
          throw new Error(payload.mensagem || 'A API retornou erro.');
        }

        renderizarCards(payload.dados || []);
        statusEl.textContent = `${payload.total} resultado(s) encontrado(s).`;
      } catch (erro) {
        resultadosEl.innerHTML = '';
        statusEl.className = 'status error';
        statusEl.textContent = `Erro ao carregar dados: ${erro.message}`;
      }
    }

    formBusca.addEventListener('submit', (evento) => {
      evento.preventDefault();
      carregarDinossauros();
    });

    btnLimpar.addEventListener('click', () => {
      campoNome.value = '';
      campoPeriodo.value = '';
      carregarDinossauros();
    });

    fecharModalBtn.addEventListener('click', fecharModal);
    modal.addEventListener('click', (evento) => {
      if (evento.target === modal) fecharModal();
    });
    document.addEventListener('keydown', (evento) => {
      if (evento.key === 'Escape') fecharModal();
    });

    // Carregamento inicial.
    carregarDinossauros();
  </script>
</body>
</html>
```

#### 5.3 Explicação das partes

#### a) Estrutura HTML

- formulário com campos de busca (`nome`, `periodo`)
- área de resultados (`#resultados`)
- modal para detalhes (`#modal`)

#### b) Estilos CSS (design moderno)

- tema escuro com gradiente
- cards responsivos em grid
- cores por período geológico
- modal com layout limpo

#### c) JavaScript (Fetch API + DOM)

- usa `fetch()` para chamar `../api/dinossauros.php`
- monta query string dinamicamente
- renderiza cards com `createElement`
- trata erros com `try/catch`

#### d) Sistema de filtros

Regra aplicada no frontend:

- se `nome` foi preenchido, ele tem prioridade;
- senão, usa `periodo`;
- se nenhum filtro, lista todos.

#### e) Modal de detalhes

Ao clicar no card:

- abre modal;
- preenche imagem, título e descrição;
- exibe especificações (altura, peso etc.).

---

### PASSO 6: EXECUTANDO O PROJETO

#### 6.1 Iniciar servidor PHP

No terminal, dentro da pasta raiz do projeto:

```bash
cd api-dinossauros
php -S localhost:8000
```

Se aparecer algo como `PHP Development Server started`, está funcionando ✅

#### 6.2 Acessar no navegador

- API: `http://localhost:8000/api/dinossauros.php`
- Cliente web: `http://localhost:8000/client/index.html`

#### 6.3 O que você deve ver

- uma tela com título “API REST de Dinossauros”
- cards carregados automaticamente
- busca por nome e filtro por período
- modal ao clicar no card

#### 6.4 Troubleshooting (problemas comuns)

- **Erro 404**
  - Verifique se os arquivos estão no caminho correto.
- **Tela em branco no PHP**
  - Ative erros temporariamente ou veja o terminal do servidor.
- **JSON inválido**
  - Valide `data/dinossauros.json` no JSONLint.
- **Imagens não aparecem**
  - Confira nomes dos arquivos dentro de `imagens/`.
- **Porta ocupada**
  - Tente: `php -S localhost:8080`

> 🔒 **Nota importante sobre localhost em ambiente de agente:**
>
> "This localhost refers to localhost of the Abacus AI Agent computer that I'm using to run the application, not your local machine. To access it locally or remotely, you'll need to deploy the application on your own system and run it locally."

---

### PASSO 7: TESTANDO AS FUNCIONALIDADES

#### 7.1 Busca por nome

- Digite `raptor` no campo de nome
- Clique em **Pesquisar**
- Esperado: retornar `Velociraptor`

#### 7.2 Filtro por período

- Limpe o nome
- Selecione `Jurássico`
- Clique em **Pesquisar**
- Esperado: mostrar 4 dinossauros jurássicos

#### 7.3 Visualização de detalhes

- Clique em qualquer card
- Esperado: modal com descrição e especificações
- Pressione `Esc` para fechar

#### 7.4 Testes extras recomendados

- buscar por termo inexistente (`abcxyz`)
- testar `id` inválido (`?id=abc`)
- testar `id` inexistente (`?id=999`)

---

### RESUMO FINAL

Parabéns! 🎉 Você criou do zero:

- estrutura de pastas de projeto web;
- base de dados JSON com 12 dinossauros;
- API REST em PHP com filtros;
- frontend moderno consumindo API com Fetch;
- modal de detalhes e interface responsiva.

#### Estrutura final criada

```text
api-dinossauros/
├── api/
│   └── dinossauros.php
├── client/
│   └── index.html
├── data/
│   └── dinossauros.json
└── imagens/
```

#### Endpoints disponíveis

- `GET /api/dinossauros.php`
- `GET /api/dinossauros.php?id=ID`
- `GET /api/dinossauros.php?nome=texto`
- `GET /api/dinossauros.php?periodo=Periodo`

#### Próximos passos (evolução do projeto)

- adicionar filtro por `dieta`
- criar paginação (`page`, `limit`)
- ordenar resultados (`nome_asc`, `nome_desc`)
- migrar JSON para banco MySQL/PostgreSQL
- implementar POST/PUT/DELETE

#### Exercícios de desafio 🧠

1. Adicione endpoint `?dieta=Herbívoro`
2. Crie botão “Ordenar A-Z” no frontend
3. Mostre contadores por período geológico
4. Troque placeholder por imagens reais na pasta `imagens/`

---

### TABELA DE REFERÊNCIA RÁPIDA DOS ENDPOINTS

| Método | Endpoint | Parâmetros | Exemplo de URL | Exemplo de resposta |
|---|---|---|---|---|
| GET | `/api/dinossauros.php` | Nenhum | `http://localhost:8000/api/dinossauros.php` | `{ "sucesso": true, "total": 12, "dados": [ ... ] }` |
| GET | `/api/dinossauros.php` | `id` (inteiro) | `http://localhost:8000/api/dinossauros.php?id=6` | `{ "sucesso": true, "total": 1, "dados": [{ "id": 6, "nome": "Allosaurus" }] }` |
| GET | `/api/dinossauros.php` | `nome` (texto parcial) | `http://localhost:8000/api/dinossauros.php?nome=raptor` | `{ "sucesso": true, "total": 1, "dados": [{ "nome": "Velociraptor" }] }` |
| GET | `/api/dinossauros.php` | `periodo` (texto exato, case-insensitive) | `http://localhost:8000/api/dinossauros.php?periodo=Jurássico` | `{ "sucesso": true, "total": 4, "dados": [ ... ] }` |
| GET | `/api/dinossauros.php` | `id` inválido | `http://localhost:8000/api/dinossauros.php?id=abc` | `{ "sucesso": false, "mensagem": "Parâmetro id inválido..." }` |
| GET | `/api/dinossauros.php` | `id` inexistente | `http://localhost:8000/api/dinossauros.php?id=999` | `{ "sucesso": false, "mensagem": "Dinossauro não encontrado." }` |

> 🚀 Agora é com você: copie, rode, teste, quebre e melhore. Esse é o caminho para dominar APIs!