# Symfony

Pour installer le projet :

1. Créer le fichier .env.local
2. Importer les dépendances PHP :
    ```shell
    composer install
    ```
3. Créer la base de données et insérer les données de test :
    ```shell
    php bin/console doctrine:database:drop --force
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    php bin/console doctrine:fixtures:load
    ```
4. Démarrer le serveur PHP (optionel) :
    ```shell
    php bin/console server:run

## Installation

```shell
composer create-project symfony/skeleton symfony
```

OU (plus complet)

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

Créer un fichier .env.local et ajouter une ligne pour la variable d'environnement `DATABASE_URL`

Créer la base de données (vide) :

```shell
php bin/console doctrine:database:create
```

Pour la supprimer :

```shell
php bin/console doctrine:database:drop --force
```

## Création des Entités


Créer une entité Doctrine avec Maker :

```shell
php bin/console make:entity EntityName
```

Exécuter le/les fichier(s) de migration :

```shell
php bin/console doctrine:migrations:migrate
```

## Insérer des données de test (fixtures)


Installation du bundle :
```shell
composer require --dev orm-fixtures
```

Création d'un fichier de fixtures :
```shell
php bin/console make:fixtures
```

puis...
```shell
php bin/console doctrine:fixtures:load
```