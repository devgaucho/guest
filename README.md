# Guest

Guestbook criado para testar o framework [Gaucho](https://github.com/devgaucho/gaucho)

## Instalação

### Dependências

#### Composer, Make, Node 10 & NPM (arquivos estáticos)

```
wget https://getcomposer.org/download/latest-stable/composer.phar
sudo mv composer.phar /usr/bin/composer && sudo chmod +x /usr/bin/
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install -y nodejs build-essential npm -y
sudo npm -g install clean-css less terser
```

### Arquivos base

```bash
composer create-project gaucho/gaucho <nome do projeto>
```

### Arquivos estáticos (SPA)

```
make static
```