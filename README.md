# Guest

Guestbook criado para testar o framework [SPA](https://github.com/phpspa/spa)

## Instalação

### 1) Dependências

#### 1.1) Composer, Make, Node 10 & NPM (arquivos estáticos)

```
wget https://getcomposer.org/download/latest-stable/composer.phar
sudo mv composer.phar /usr/bin/composer && sudo chmod +x /usr/bin/
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo purge nodejs -y
sudo apt-get install -y nodejs build-essential npm -y
sudo npm -g install clean-css less terser
```

#### 1.2) Configurações (.env)

```
cp .env.example .env && nano .env
```

### 3) Composer e migrations

```bash
composer install && make mig
```

### 4) Arquivos estáticos (SPA)

```
make static
```

### 5) Rodar localmente

```
make run
```