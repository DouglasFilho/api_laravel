![Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)


# API Laravel

Esse projeto é uma simples API Laravel que possui um CRUD de usuários e despesas, com autenticação de login, controle de acesso e desparo de emails.
## Instalação/Configuração
Para fazer a instalação primeiramente clone o projeto.
```bash
  git clone git@github.com:DouglasFilho/api_laravel.git
  cd api_laravel
  composer install
```
Dentro do projeto copie .env.example para .env e faça as seguintes configurações:
- Preencha os dados de conexão com o banco.
```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=seu_data_base
  DB_USERNAME=root
  DB_PASSWORD=sua_senha
```
- Preencha os dados para testar o disparo de emails, caso não tenha preferencial por nenhum serviço recomendo o uso do [Mailtrap](https://mailtrap.io/).
```env
  MAIL_MAILER=smtp
  MAIL_HOST=sandbox.smtp.mailtrap.io
  MAIL_PORT=2525
  MAIL_USERNAME=seu_user
  MAIL_PASSWORD=sua_senha
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS="hello@example.com"
  MAIL_FROM_NAME="${APP_NAME}"
```
- Após a configuração da conexão com o banco, roda as migrations.
```bash
  php artisan migrate
```
- Tudo pronto para iniciar a aplicação.
```bash
  php artisan serve
```