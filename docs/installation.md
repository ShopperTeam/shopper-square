# Guide d'Installation

Bienvenue dans le guide d'installation du projet

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :

- **MySQL**: Assurez-vous d'avoir un serveur MySQL en cours d'exécution.
- **PHP**: Installez PHP avec une version 8.2.0 ou supérieure.
- **Composer**: Installez Composer.
- **Symfony-cli**: Installer également l'outil de developpement de Symfony de préférence.

## Étapes d'Installation

1. **Clonage du Projet** :
   - Clonez le projet à partir du référentiel GitHub vers votre répertoire local :

   ```bash
   git clone https://github.com/ShopperTeam/shopper-square.git
   ```

2.  **Installation des Dépendances** :

    -   Accédez au répertoire du projet et exécutez la commande suivante pour installer les dépendances PHP et JavaScript via Composer :
        ```bash
            cd shopper-square
            composer install
        ```
3.  **Configuration de l'Environnement** :

    -   Utilisez la commande suivante pour configurer l'environnement avant l'installation :
        ```bash
            symfony console app:config-env
        ```
4.  **Installation de l'Application** :

    -   Une fois la configuration terminée, exécutez la commande d'installation pour créer la base de données, installer les migrations et les données de test :
        ```bash
            symfony console app:install
        ```
5.  **Lancement du Serveur de Développement** :

    -   Pour lancer l'application avec les outils de développement, exécutez la commande suivante :
        ```bash
            symfony console app:start
        ```

    -   Cela lancera le serveur de développement Symfony, démarrera les processus npm et vous pourrez accéder à l'application via http://localhost:8000.

## Conclusion

Félicitations ! Vous avez installé avec succès l'application et vous êtes prêt à commencer le développement.
