# Cabinet Nasera Auguste

## Création du `.htpasswd`

```
docker run -it --rm --name my-apache-app -v D:\Ludwig\Dev\silvain.eu\NaseraWodpress:/data httpd:2.4 htpasswd /data/nginx/.htpasswd <nom d'utilisateur>
```

## Fichier `wp-includes/functions.php`

```php
function remove_wp_version_rss() {
 return'';
 }

add_filter('the_generator','remove_wp_version_rss');
add_filter('login_errors',create_function('$a', "return null;"));
```

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
| wordpress | PHP FPM | wordpress:php7.4-fpm-alpine | Coeur de docker              |
| db        | Base de données | percona                     | Fork de mysql                |

<br>

### Réseau 

| Service   | Frontend           | Backend            |
| -         | -                  | -                  |
| NGINX     | :heavy_check_mark: |                    |
| PHP       | :heavy_check_mark: | :heavy_check_mark: |
| WORDPRESS |                    | :heavy_check_mark: |