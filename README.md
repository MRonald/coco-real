# Projeto Laravel com PHP 8.3 e MySQL

Este guia irá ajudá-lo a configurar e executar o projeto Laravel em seu ambiente local.

## Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- **PHP 8.3** ou superior
- **Composer** (gerenciador de dependências PHP)
- **MySQL** 5.7 ou superior
- **Node.js** e **NPM** (para assets frontend)
- **Git**

## Instalação

Siga os passos abaixo para configurar o projeto:

### 1. Clonar o repositório

```bash
git clone [URL_DO_REPOSITORIO]
cd nome-do-projeto
```

### 2. Instalar dependências PHP

```bash
composer install
```

### 3. Configurar variáveis de ambiente

Copie o arquivo de exemplo de environment:
```bash
cp .env.example .env
```

Edite o arquivo `.env` com suas configurações de banco de dados:

```env
APP_NAME=SeuProjeto
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 5. Configurar o banco de dados

Crie um banco de dados MySQL com o nome especificado no arquivo `.env` e execute as migrações:

```bash
php artisan migrate
```

### 6. Configurar permissões de diretórios

```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 7. Executar o servidor de desenvolvimento

```bash
php artisan serve
```

O projeto estará disponível em: `http://localhost:8000`

## Comandos úteis

### Limpar cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Configurações adicionais

### Configuração do Virtual Host (Apache) - Opcional

Se preferir usar Apache em vez do servidor built-in:

```apache
<VirtualHost *:80>
    ServerName seu-projeto.test
    DocumentRoot "/caminho/para/projeto/public"
    <Directory "/caminho/para/projeto/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Configuração do Nginx - Opcional

```nginx
server {
    listen 80;
    server_name seu-projeto.test;
    root /caminho/para/projeto/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
