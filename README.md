## Vale a pena jogar? ##

### Instalação ###
* `git clone https://github.com/franciscoemanuel/vale-a-pena-jogar`
* `composer install`
* `php artisan key:generate`
* `Criar banco de dados e informar .env`
* `php artisan serve para iniciar o servidor em: http://localhost:8000/`

Obs.: Se o arquivo .env não for criado após o comando: composer install, deve se criar o arquivo manualmente usando como exemplo o arquivo .env.example, e então gerar a key da aplicação.
Antes de rodar o comando composer install, é necessário verificar se a extensão php_fileinfo.dll está habilitada dentro do arquivo php.ini, essa extensão é necessária para a biblioteca de manipulação de imagens.
