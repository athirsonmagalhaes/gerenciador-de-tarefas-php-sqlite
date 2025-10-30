# 📋 Gerenciador de Tarefas Simples

Este é um projeto simples de gerenciamento de tarefas (To-Do List) desenvolvido em PHP puro, utilizando SQLite para o banco de dados. Toda a funcionalidade (CRUD: Create, Read, Update, Delete) está contida em um único arquivo PHP (`index.php`), tornando a configuração rápida e fácil.

## ✨ Funcionalidades

* **Adicionar Tarefas:** Insira a descrição e uma data de vencimento.
* **Listar Tarefas:** Exibe as tarefas pendentes e concluídas separadamente.
* **Marcar como Concluída:** Altera o status da tarefa.
* **Excluir Tarefas:** Remove permanentemente a tarefa do banco de dados.
* **Banco de Dados Integrado:** Utiliza SQLite, que é leve e não requer um servidor de banco de dados externo.

## 🛠️ Tecnologias Utilizadas

* **Linguagem:** PHP (Versão 7.4+ recomendada, mas deve funcionar em versões mais antigas).
* **Banco de Dados:** SQLite (PDO - PHP Data Objects).
* **Interface:** HTML puro.

## 🚀 Como Executar o Projeto

Para executar este projeto, você precisa de um ambiente de servidor web que suporte PHP. **XAMPP**, **WAMP**, **MAMP** ou um servidor Apache/Nginx com PHP instalado são ideais.

### 1. Requisitos

Certifique-se de que a extensão **`pdo_sqlite`** do PHP esteja habilitada no seu arquivo `php.ini`. (Geralmente vem habilitada por padrão no XAMPP/WAMP).

### 2. Configuração

1.  **Clone o Repositório:**
    ```bash
    git clone https://github.com/athirsonmagalhaes/gerenciador-de-tarefas-php-sqlite.git
    cd gerenciador-de-tarefas-php-sqlite
    ```

2.  **Posicione o Arquivo:**
    * Mova o arquivo `index.php` (e qualquer outro arquivo do projeto) para o diretório raiz de documentos do seu servidor web (por exemplo, a pasta `htdocs` do XAMPP).

3.  **Acesse no Navegador:**
    * Inicie seu servidor web.
    * Abra o navegador e acesse o projeto através da URL:
        ```
        http://localhost/gerenciador-de-tarefas-php-sqlite/index.php
        ```

### 3. Sobre o Banco de Dados

* O arquivo `index.php` é configurado para criar e se conectar automaticamente ao banco de dados chamado **`gerenciadorDeTarefas.db`**.
* Se o arquivo `gerenciadorDeTarefas.db` não existir, ele será criado automaticamente na primeira vez que você acessar a página.
