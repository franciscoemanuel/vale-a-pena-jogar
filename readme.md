## Vale a pena jogar? ##
Projeto criado para a disciplina de projeto integrador I.

### Instalação ###

* `git clone https://github.com/franciscoemanuel/vale-a-pena-jogar.git nomeprojeto`
* `cd nomeprojeto`
* `composer install`
* `php artisan key:generate`
*  Criar banco de dados e informar detalhes de conexão no arquivo .env
* `php artisan serve` to start the app on http://localhost:8000/

Obs.: Se o arquivo .env não for criado após a execução do comando composer install, deve se criar o arquivo manualmente tendo como exemplo o arquivo .env.example.