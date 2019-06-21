# Symfony

## Installation

```shell
composer create-project symfony/skeleton symfony
```

OU

```shell
composer create-project symfony/website-skeleton symfony
```

### Activer le plugin Symfony dans PHPStorm (auto configuration)

``` shell
php bin/console 
```

http://localhost/public (rajouter /check.php)

```shell 
composer remove requirements-checker 
```

### installer serveur PHP… ne pas utiliser en environnement de production, uniquement en interne

```shell
composer require symfony/web-server-bundle --dev
```

Pour démarrer le serveur

```shell
php bin/console server:run
```

OU

```shell
php bin/console server:start
php bin/console server:stop
```

### Installer Maker Bundle

```shell
composer require maker --dev
```
##

## Doctrine

```shell
composer require orm
```