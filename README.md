# Projeto-de-Desenvolvimento-2

# Projeto de Gerenciamento de Produtos - Ferraço Sul

Este projeto foi desenvolvido para a empresa Ferraço Sul, especializada em produtos de ferro, aço, vidro e alumínio. O sistema permite gerenciar produtos, usuários e realizar operações básicas de CRUD (Create, Read, Update, Delete).

## Tecnologias Utilizadas

### Front-end
- **HTML:** Utilizado para estruturar as páginas do sistema.
- **CSS:** Utilizado para estilizar e tornar as páginas mais atraentes.
- **JavaScript:** Utilizado para interações dinâmicas no front-end.
- **PHP:** Utilizado para gerar dinamicamente as páginas HTML e manipular os dados no lado do servidor.

### Back-end
- **PHP:** Utilizado para a lógica de negócios, manipulação de dados e comunicação com o banco de dados.
- **MySQL:** Utilizado para armazenar e gerenciar os dados do sistema, com a interface do phpMyAdmin para administração do banco de dados.
- **XAMPP:** Usado como ambiente de desenvolvimento local, incluindo Apache, MySQL e PHP.
- **phpMyAdmin:** Utilizado para administração do banco de dados de forma gráfica.

## Funcionalidades

### Requisitos Funcionais

- **Autenticação de Usuário:**
  - Login
  - Logout
  - Registro de novos usuários

- **Gestão de Produtos:**
  - Adicionar novos produtos
  - Visualizar lista de produtos
  - Editar produtos existentes
  - Remover produtos

- **Gestão de Usuários:**
  - Editar perfil do usuário
  - Gerenciar permissões de acesso

## Estrutura do Projeto

- **auth.php:** Página de autenticação do usuário.
- **auth_process.php:** Script para processar a autenticação.
- **css/styles.css:** Arquivo de estilos CSS.
- **dao/ProdutoDAO.php:** Data Access Object para manipulação dos dados de produtos.
- **dao/UserDAO.php:** Data Access Object para manipulação dos dados de usuários.
- **dashboard.php:** Página principal do sistema após login.
- **db.php:** Script de conexão com o banco de dados.
- **editproduto.php:** Página para editar produtos.
- **editprofile.php:** Página para editar perfil do usuário.
- **globals.php:** Configurações globais do sistema.
- **img/**: Pasta com imagens usadas no sistema.
- **index.php:** Página inicial do sistema.
- **logout.php:** Script para realizar logout do usuário.
- **models/**: Pasta contendo os modelos de dados (Produto, User, Message).
- **newproduto.php:** Página para adicionar novos produtos.
- **produto.php:** Página para visualização dos detalhes do produto.
- **produto_process.php:** Script para processar ações relacionadas aos produtos.
- **templates/**: Pasta com templates para o cabeçalho, rodapé e cards de produtos.
- **user_process.php:** Script para processar ações relacionadas aos usuários.
