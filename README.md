

*****************************************************
********* Requirements  ****
*****************************************************

PHP >= 8.1

MySql

npm

composer
https://getcomposer.org/download/

Symfony Cli
https://scoop.sh/
https://symfony.com/download






*****************************************************
********* installation de l'application de Base  ****
*****************************************************

cd /PATH_TO_MY_PROJECT/PROJECT_NAME


composer install
npm install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load





**********************************************
********* Mise en route de l'application  ****
**********************************************

cd /PATH_TO_MY_PROJECT/PROJECT_NAME
symfony serve

cd /PATH_TO_MY_PROJECT/PROJECT_NAME
npm run watch

cd /PATH_TO_MY_PROJECT/PROJECT_NAME
npm run dev-server

cd /PATH_TO_MY_PROJECT/PROJECT_NAME
npm run build



ROUTES
*************************************************
http://127.0.0.1:8000/
http://127.0.0.1:8000/login
http://127.0.0.1:8000/user/homepage
http://127.0.0.1:8000/admin/homepage
http://127.0.0.1:8000/product/



user:   user1   pass
admin:  admin1  pass














*********************************************************************
*********  Création from SCRATH   **********************************
*********************************************************************

symfony new m2i_shop_square --version="6.3.*" --webapp



*************************************
.env.local

DATABASE_URL="mysql://root:@127.0.0.1:3306/m2i_shop_square?serverVersion=8.0.32&charset=utf8mb4"
php bin/console doctrine:database:create 



*************************************
php bin/console make:controller
PublicHomepage



*************************************
composer require symfony/webpack-encore-bundle

npm install
npm run build
npm run dev-server





*************************************
\assets\scripts\script.js

app.js :
import './scripts/script.js';



*************************************
.enableSassLoader()
npm install sass-loader@^13.0.0 sass --save-dev



*************************************
npm install bootstrap --save-dev

// assets/styles/app.scss
@import "~bootstrap/scss/bootstrap";

app.js :
import './styles/app.scss';

// Il faut ajouter ça pour permettre les fonctionnalités de javascript de bootstrap.css fonctionnent !
require('bootstrap');





*************************************
npm install jquery --save-dev

script.js :
import $ from 'jquery';

$('body').prepend('<h1>'+'Titi'+'</h1>');

webpack.config.js :
.autoProvidejQuery()

npm run build





*************************************
Requiring JavaScript Modules :

// assets/scripts/greet.js
export default function(name) {
    return `Yo yo ${name} - welcome to Encore!`;
};

import greet from './greet';

alert(greet('Les Gens'))






*************************************
composer require symfony/ux-vue

.enableVueLoader()

npm install -D vue-loader --force


// assets/app.js
import { registerVueControllerComponents } from '@symfony/ux-vue';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));




// assets/vue/controllers/MyComponent.vue
<template>
    <div>Hello {{ name }}!</div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>



{# templates/home.html.twig #}
<div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
    <div class="card-body">
        <div {{ vue_component('MyComponent', { 'name': 'Zizoo' }) }}></div>
    </div>
</div>



npm run build
npm run watch







*************************************
npm i bootswatch --save-dev

app.scss :
@import "~bootswatch/dist/zephyr/_variables";







*************************************
npm i @fortawesome/fontawesome-free

app.js :
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

<i class="fa-solid fa-house"></i>






*************************************
php bin/console make:user

php bin/console make:migration
php bin/console doctrine:migrations:migrate





*************************************

// add this in the security.yaml file :

    role_hierarchy:
        ROLE_ADMIN: [ROLE_USER]





*************************************
composer require --dev orm-fixtures

UserFixtures.php

php bin/console doctrine:fixtures:load






*************************************
login :
https://symfony.com/doc/current/security.html#form-login

php bin/console make:controller Login




*************************************
logout :
https://symfony.com/doc/current/security.html#logging-out


    logout:
        path: app_logout
        target: app_public_homepage







*************************************
php bin/console make:controller UserHomepage
php bin/console make:controller AdminHomepage

navbar




*************************************
access_control





*************************************
php bin/console make:entity Product

name            string
description     text
price           float
photo           string

php bin/console make:migration
php bin/console doctrine:migration:migrate





*************************************
composer require --dev fakerphp/faker

https://github.com/FakerPHP/Faker

docs :
https://github.com/fzaninotto/Faker






*************************************
ProductFixtures.php

php bin/console doctrine:fixtures:load





*************************************
composer require annotations




*************************************
php bin/console make:crud Product




*************************************
Product in navbar + photo




*************************************
php bin/console make:entity Commande

createdAt   datetime
user        User

php bin/console make:migration
php bin/console doctrine:migration:migrate






*************************************
php bin/console make:entity CommandeProduct

quantity    integer
product     Product
commande    Commande

php bin/console make:migration
php bin/console doctrine:migration:migrate






*************************************
Commande Fixtures

php bin/console doctrine:fixtures:load




*************************************
php bin/console make:crud Commande




*************************************
CommandeType : User


















*************************************************************************************************
*********           TRAVAIL EN EQUIPE            ************************************************
*************************************************************************************************


Récupérer le projet depuis le dépot git:
****************************************
git clone https://github.com/ShopperTeam/shopper-square.git


installer les composants du back :
********************************
composer install


installer les composants du front :
***********************************
npm install



dans le fichier .env.local :
**************************************
DATABASE_URL="mysql://root:@127.0.0.1:3306/m2i_shopper_square?serverVersion=8.0.32&charset=utf8mb4"




créer notre nouvelle base de données :
***************************************
php bin/console doctrine:database:create



migrer la structure de nos données:
************************************
php bin/console doctrine:migrations:migrate



charger nos données de test:
****************************
php bin/console doctrine:fixtures:load
Farnoosh










