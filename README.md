# Cabinet Nasera Auguste

## Création du `.htpasswd`

Dans le cas de la création
```
docker run -it --rm --name my-apache-app -v "$PWD":/data httpd:2.4 htpasswd -c /data/nginx/.htpasswd <nom d'utilisateur>
```

Dans le cas de l'ajout d'un utilisateur
```
docker run -it --rm --name my-apache-app -v "$PWD":/data httpd:2.4 htpasswd /data/nginx/.htpasswd <nom d'utilisateur>
```

## Plugins : CabinetKhalouiAuguste

- Suppression de la réinitialisation du mot de passe
- Suppression du message d'erreur lors du login
- Suppression de la version de wordress
- Suppression de la page des auteurs

## Autorisations

### Dossiers
```bash
chmod 755 -R wp-content
chmod 755 -R wp-includes
chmod 755 -R wp-admin
```

### Fichiers

```bash
chmod 644 *.php
chmod 400 wp-config.php
chmod 400 .htaccess
chmod 444 index.php
```

## Docker

```bash
docker-compose up -d
```

### Services

| Name      | Service         | Image                       | Descrption                   |
| -         | -               | -                           | -                            |
| nginx     | Serveur HTTP    | nginx                       | Contacte PHP FPM par fastcgi |
| wordpress | PHP FPM         | wordpress:php7.4-fpm-alpine | Wordpress                    |
| db        | Base de données | percona                     | Fork de mysql                |


### Réseau 

| Service   | Frontend           | Backend            |
| -         | -                  | -                  |
| NGINX     | :heavy_check_mark: |                    |
| PHP       | :heavy_check_mark: | :heavy_check_mark: |
| WORDPRESS |                    | :heavy_check_mark: |


### Génération du certificat

```bash
docker run -it --rm --name certbot -v "/etc/letsencrypt:/etc/letsencrypt" -v "/var/lib/letsencrypt:/var/lib/letsencrypt" -v "/var/www/letsencrypt:/var/www/letsencrypt" certbot/certbot certonly --webroot -w /var/www/letsencrypt
```