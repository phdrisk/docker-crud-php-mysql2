# docker-crud-php-mysql
Projeto CRUD - utilizando Docker, Php e MySql

# 1) ETAPAS PARA INSTALAÇÃO
## 1.1) VERIFIQUE SE O docker-compose esta instalado no seu (linux)
```
docker-compose version 
```
> caso não esteja vá ate o site https://docs.docker.com/compose/install/ e siga os passos:
```
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

```
## 1.2) BAIXAR O ARQUIVO DO GITHUB
| crie uma pasta: ex. mkdir suaPasta

| clone o arquivo do github dentro desta pasta

```
git clone git@github.com:phdrisk/docker-crud-php-mysql.git
```

Caso necessário modifique a porta de utilização do app Docker

```
php:
  build: .
  ports:
   - "8888:80"
   - "8443:443"
  volumes:
   - ./www:/var/www/html
  links:
   - db2
db2:
  image: mysql:5.7
  volumes:
   - /var/lib/mysql
  environment:
   - MYSQL_ROOT_PASSWORD=phprs
   - MYSQL_DATABASE=phprs
```
## 3) EXECUTE O DOCKER COMPOSE
***Através do comando:*** docker-compose up -d

## 4) ABRA SEU NAVEGADOR PREFERIDO E DIGITE
```
0.0.0.0:8888
```
| CASO DE UM ERRO OU NÃO SEJA MOSTRADO UMA LISTA, DIGITE A URL ABAIXO 

| PARA CRIAR O BANCO DE DADOS
```
0.0.0.0:8888/config/criarBanco.php
e depois retorne para:
0.0.0.0:8888
```
# 2) UTILIZAÇÃO

# OUTROS
## Instalação phpunit
```
apt-get --upgradable
apt-get update
apt-get upgrade
apt-get install wget

wget -O phpunit https://phar.phpunit.de/phpunit-x.phar x= [5-9]
chmod +x phpunit

./phpunit --version

```

