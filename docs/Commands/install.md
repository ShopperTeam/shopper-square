# app:install

## description

Cette commande permet de faire les choses suivante successivement:

### **verifier si le fichier .env.local exist:**
    
-   si le fichier n'existe pas, on vous aide a le créer en lancant la commande suivante pour vous:
        
    ```bash
        symfony console app:config-env 
    ```
    
    et par la suite vous invite a relancer l'installation avec cette fois la bonne configuration.
    


### **si le fichier .env.local existe alors on continue avec:**  


* Installation des dépendances npm

    ```bash
        npm install
    ```
* Installation des dépendances composer

    ```bash
        composer install
    ```
* Creation de la base de donnée

    ```bash
        doctrine:database:create
    
    ```
* insallation des migrations

    ```bash
        doctrine:migrations:migrate
    
    ```

* insallation des fixtures
    ```bash
        doctrine:fixtures:load
    
    ```