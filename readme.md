# Petite API de Test pour Admin E-shop (API Platform)

Ce projet est une petite API de test pour une interface d'administration d'une boutique en ligne. Elle a été développée en utilisant le framework Symfony et API Platform.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

*   **Docker** : Pour la base de données MySQL.
*   **PHP** : Version 8.1 ou supérieure.
*   **Composer** : Pour la gestion des dépendances PHP.
*   **Symfony CLI** : Pour démarrer facilement le serveur.

## Installation

1.  **Cloner le dépôt**

    ```bash
    git clone https://github.com/misterjj/nextsy-API.git
    cd nextsy-API
    ```

2.  **Installer les dépendances**

    ```bash
    composer install
    ```

3.  **Créer une base de données MySQL avec Docker**

    Exécutez la commande suivante pour démarrer un conteneur Docker MySQL :

    ```bash
    docker run -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root --name mysql-container mysql:8
    ```

    Cela démarrera un conteneur MySQL avec le mot de passe root défini sur `root`.

4. **Configurer le fichier `.env.local`**

   Assurez-vous que votre fichier `.env.local` contient la configuration de base de données suivante :

    ```dotenv
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/nextsy?serverVersion=8.4.32&charset=utf8mb4"
    ```
   **Note:** Assurez vous que la base de donnée nextsy existe bien.
    ```sql
    symfony console doctrine:database:create
    symfony console doctrine:schema:create
    ```

   Assurez-vous que le nom d'utilisateur et le mot de passe correspondent à ceux utilisés dans votre conteneur Docker MySQL.

5.  **Mettre à jour la base de données**

    ```bash
    symfony console doctrine:migrations:migrate
    ```

    Cette commande créera les tables nécessaires dans votre base de données.

6. **Générer les fixtures**

    ```bash
    symfony console doctrine:fixtures:load --no-interaction
    ```

7. **Créer un utilisateur admin**

   Utilisez la commande suivante pour créer un utilisateur admin :

    ```bash
    php bin/console app:create-user-direct admin@nextsy.com admin --admin
    ```

   Cette commande ajoute de fausse données dans la base de donnée.

## Démarrage du serveur

1. **Arrêtez tout serveur symfony qui pourrait être en cours d'execution**

    ```bash
    symfony serve:stop
    ```

2. **Démarrer le serveur Symfony**

    Utilisez la commande suivante pour démarrer le serveur de développement :

    ```bash
    symfony serve
    ```

    L'API sera accessible à l'adresse indiquée dans la console (généralement `https://127.0.0.1:8000`).

## Si les assets sont manquants

    ```bash
    symfony console asset:install
    ```
    