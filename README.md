# Laravel Spatie Permissions 🔐

Este projeto é um exemplo de aplicação **Laravel 12** com autenticação e controle de acesso completo, utilizando o pacote [spatie/laravel-permission](https://github.com/spatie/laravel-permission).

---

## ⚙️ Funcionalidades

- Login com e-mail e senha
- Controle de usuários com permissões e papéis
- Proteção de rotas com middleware `can:`
- CRUD completo para Usuários, Papéis e Permissões
- Arquitetura de controllers por namespace (Admin/Common)

---

## 🧪 Rotas da API

> Todas as rotas (exceto login) exigem autenticação com token e validação de permissões via `can:<permission>`.

### 🔐 Autenticação

| Método | Rota     | Descrição                      |
|--------|----------|--------------------------------|
| POST   | `/login` | Autenticação com e-mail/senha  |

---

### 👤 Usuários

| Método | Rota             | Permissão necessária | Ação                |
|--------|------------------|----------------------|---------------------|
| POST   | `/users`         | `create-user`        | Criar usuário       |
| PUT    | `/users/{id}`    | `update-user`        | Atualizar usuário   |
| DELETE | `/users/{id}`    | `delete-user`        | Deletar usuário     |
| GET    | `/users`         | `read-user`          | Listar usuários     |
| GET    | `/users/{id}`    | `read-user`          | Ver usuário         |

---

### 🛡️ Papéis

| Método | Rota             | Permissão necessária | Ação                |
|--------|------------------|----------------------|---------------------|
| POST   | `/roles`         | `create-role`        | Criar papel         |
| PUT    | `/roles/{id}`    | `update-role`        | Atualizar papel     |
| DELETE | `/roles/{id}`    | `delete-role`        | Deletar papel       |
| GET    | `/roles`         | `read-role`          | Listar papéis       |
| GET    | `/roles/{id}`    | `read-role`          | Ver papel           |

---

### ✅ Permissões

| Método | Rota             | Permissão necessária | Ação                |
|--------|------------------|----------------------|---------------------|
| GET    | `/permissions`   | `read-permission`    | Listar permissões   |

---

## 🛠️ Instalação Local

```bash
git clone https://github.com/CaioCLDias/laravel-spatie-permissions.git
cd laravel-spatie-permissions
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 🐳 Executando com Docker

O projeto já está configurado com **Docker** e **PostgreSQL** via Docker Compose.

### Pré-requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Subir o ambiente

```bash
docker-compose up --build
```

Acesse a aplicação em: [http://localhost:8000](http://localhost:8000)

---

### Variáveis de Ambiente

No `.env`, configure os dados do PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

> Essas variáveis são utilizadas automaticamente pelo `docker-compose`.

---

### Comandos Úteis com Docker

```bash
docker-compose exec project php artisan migrate --seed
docker-compose exec project composer install
docker-compose exec project bash
```

---

## 🔑 Usuários de Exemplo

| Papel   | E-mail              | Senha     |
|---------|---------------------|-----------|
| Admin   | admin@example.com   | password  |
| Editor  | editor@example.com  | password  |
| Usuário | user@example.com    | password  |

---

## 📚 Referências

- [Spatie Laravel Permission Docs](https://spatie.be/docs/laravel-permission)
- [Laravel Documentation](https://laravel.com/docs)

---

## 👨‍💻 Autor

Desenvolvido por [Caio Dias](https://github.com/CaioCLDias)

[![LinkedIn](https://img.shields.io/badge/LinkedIn-CaioDias-blue?logo=linkedin)](https://www.linkedin.com/in/caiocldias)

---

## 📝 Licença

Distribuído sob a licença [MIT](LICENSE).
