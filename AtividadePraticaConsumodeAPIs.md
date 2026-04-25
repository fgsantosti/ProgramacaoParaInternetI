# 📡 Atividade Prática — Consumo de APIs com PHP

**Curso:** Tecnologia em Análise e Desenvolvimento de Sistemas  
**Disciplina:** Programação para Internet I  
**Tipo:** Atividade Prática Individual ou em Dupla  
**Valor:** 10 pontos  

---

## 🎯 Objetivo

Desenvolver uma aplicação web utilizando **HTML, CSS, JavaScript e PHP** capaz de consumir uma API pública, exibir os dados retornados (incluindo imagens) de forma organizada e responsiva, aplicando os conceitos de requisições HTTP, manipulação de JSON e integração front-end/back-end.

---

## 📋 Descrição da Atividade

O aluno deverá escolher **uma das APIs listadas abaixo** e criar uma página web funcional que:

1. Realize o consumo da API via **PHP** (back-end)
2. Exiba os dados retornados de forma visual e organizada
3. Permita ao usuário **interagir** com a aplicação (botão de busca, campo de pesquisa, etc.)
4. Seja **responsiva** e com estilização adequada via CSS

---

## 🌐 APIs Disponíveis para Escolha

### Grupo 1 — Sem necessidade de cadastro (chave de API)

| API | Descrição | URL Base |
|-----|-----------|----------|
| **Dog API** 🐶 | Fotos aleatórias de cachorros por raça | `https://dog.ceo/api/` |
| **Cat API** 🐱 | Fotos e dados de gatos | `https://api.thecatapi.com/v1/` |
| **PokeAPI** ⚡ | Dados completos de Pokémon com sprites | `https://pokeapi.co/api/v2/` |
| **Random User** 👤 | Usuários fictícios com nome, e-mail e foto | `https://randomuser.me/api/` |

### Grupo 2 — Requer cadastro gratuito

| API | Descrição | Limite Gratuito |
|-----|-----------|-----------------|
| **NASA API** 🚀 | Foto astronômica do dia, imagens de Marte | Chave gratuita, uso amplo |
| **Unsplash API** 📷 | Banco de fotos profissionais em alta qualidade | 50 req/hora |
| **Pixabay API** 🖼️ | Fotos, ilustrações e vetores | 5.000 req/hora |
| **Open Library** 📚 | Capas e dados de livros | Totalmente aberto |

---

## ✅ Requisitos Técnicos

### Obrigatórios

- [ ] Arquivo `index.html` como página principal
- [ ] Arquivo `style.css` com estilização própria (não usar frameworks CSS prontos como Bootstrap)
- [ ] Arquivo `api.php` responsável por consumir a API e retornar os dados em JSON
- [ ] Exibição de **pelo menos uma imagem** retornada pela API
- [ ] Exibição de **pelo menos dois campos de texto** (nome, descrição, URL, etc.)
- [ ] Tratamento de **erro** caso a API não responda corretamente
- [ ] Layout **responsivo** (funcionar em telas de celular e desktop)

### Diferenciais (bônus)

- [ ] Campo de busca/filtro funcional (ex: buscar Pokémon por nome, raça de cachorro, etc.)
- [ ] Paginação ou botão "Carregar mais"
- [ ] Animação CSS ou transição ao carregar os dados
- [ ] Exibição de múltiplos resultados em formato de cards/grid

---

## 🗂️ Estrutura de Arquivos Esperada

```
projeto-api/
│
├── index.html        # Página principal
├── style.css         # Estilos da aplicação
├── api.php           # Consumo da API via PHP
└── README.md         # Este arquivo
```

---

## 💡 Exemplos de Código Inicial

### `api.php` — Consumindo a Dog API

```php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$url = "https://dog.ceo/api/breeds/image/random";
$response = file_get_contents($url);
$dados = json_decode($response, true);

if ($dados && $dados['status'] == 'success') {
    echo json_encode([
        'success' => true,
        'imagem'  => $dados['message']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'mensagem' => 'Erro ao buscar dados da API.'
    ]);
}
?>
```

### `script.js` — Chamada ao back-end PHP

```javascript
async function buscarDados() {
    try {
        const resposta = await fetch('api.php');
        const dados = await resposta.json();

        if (dados.success) {
            document.getElementById('imagem').src = dados.imagem;
        } else {
            alert(dados.mensagem);
        }
    } catch (erro) {
        console.error('Erro na requisição:', erro);
    }
}
```

### `index.html` — Estrutura básica

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo de API</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>🐶 Dog API</h1>
    <button onclick="buscarDados()">Buscar Imagem</button>
    <div id="resultado">
        <img id="imagem" src="" alt="Imagem do cachorro">
    </div>
    <script src="script.js"></script>
</body>
</html>
```

---

## 📊 Critérios de Avaliação

| Critério | Peso |
|----------|------|
| Funcionamento correto do consumo da API via PHP | 3,0 pts |
| Exibição correta dos dados no front-end (HTML/JS) | 2,0 pts |
| Estilização e responsividade (CSS) | 2,0 pts |
| Tratamento de erros | 1,0 pt |
| Organização do código e boas práticas | 1,0 pt |
| Diferenciais implementados | até 1,0 pt (bônus) |
| **Total** | **10,0 pts** |

---

## 📅 Prazo de Entrega

| Etapa | Data |
|-------|------|
| Entrega do link do repositório no Github | A definir pelo professor |
| Apresentação (opcional) | A definir pelo professor |

---

## 📦 Forma de Entrega

1. Criar um repositório no GitHub e enviar o link do repositório no Google Sala de Aula.
2. Incluir no arquivo `README.md` qual API foi escolhida e uma breve descrição do projeto

---

## 🔗 Links Úteis

- [Dog API — Documentação](https://dog.ceo/dog-api/)
- [The Cat API — Documentação](https://thecatapi.com)
- [PokeAPI — Documentação](https://pokeapi.co)
- [Random User API — Documentação](https://randomuser.me)
- [NASA API — Cadastro e Docs](https://api.nasa.gov)
- [Unsplash API — Documentação](https://unsplash.com/developers)
- [Pixabay API — Documentação](https://pixabay.com/api/docs/)
- [Open Library API — Documentação](https://openlibrary.org/developers/api)
- [MDN — Fetch API](https://developer.mozilla.org/pt-BR/docs/Web/API/Fetch_API)
- [PHP — file_get_contents](https://www.php.net/manual/pt_BR/function.file-get-contents.php)
- [PHP — json_decode](https://www.php.net/manual/pt_BR/function.json-decode.php)

---

## ❓ Dúvidas Frequentes

**Posso usar jQuery ou outra biblioteca JS?**  
Sim, desde que o consumo da API seja feito via PHP no back-end.

**Posso usar Bootstrap no CSS?**  
Não para esta atividade. O objetivo é praticar CSS puro.

**A API escolhida saiu do ar. O que faço?**  
Escolha outra API da lista e informe o professor.

**Posso usar `curl` no PHP em vez de `file_get_contents`?**  
Sim! O uso de `curl` é inclusive recomendado para APIs que exigem cabeçalhos customizados (como chave de API).

---

