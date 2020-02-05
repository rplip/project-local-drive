## Présentation :


Nos villages possèdent tous leur lot de commerçants, boucher, boulanger, poissonnier, épicier, ect, mais également de l’agriculture locale.
Mais un problème persiste pour nous, citoyens pressés par le temps, nous n’avons absolument pas le temps de passer chez chacun de ces commerçants, discuter, attendre que mamie sorte toutes ses petites pièces de 1 et 2 centimes.
Et si je vous disais que nous pouvons réunir la proximité, la qualité et la rapidité ? Voici Local-Drive. 

## Objectifs :

1 – La mairie met en place Local-Drive dans son village
2 – Votre commerçant s’équipe ( appareil photo, lecteur de carte de bleu ), et aménage éventuellement son magasin ( file d’attente réservée par exemple )
3 – En tant que client, vous vous rendez sur le site local-drive.fr/mon-village, et passez commande, sur des produits frais, locaux et de saison.
4 – Votre commande est prise en compte, un récapitulatif est envoyé au commerçant qui prépare votre commande et la conserve 
5 – Enfin, vous choisissez un horaire de retrait, et vous procédez au paiement, exactement comme dans un drive classique.


## Concernant la partie Symfony
---
Bonjour, nous allons parler dans ce readme de l'utilisation de Symfony en association avec réact au cours de notre projet.

On partira du principe que le début du projet est codé en local et ensuite est exporté sur un serveur web.

Les installations des différents composant (type apache, composer, git etc...) est abordé à ce moment la.

Pour le developpement en local on suppose que apache, git et php sont déjà installés.

Gardez en tête que c'est une présentation pas à pas, que beaucoup de choses vont changer au cours du projet, certains élément sont amenés à disparaitre et d'autre à apparaitre !
Par exemple la table cart ne sera pas utilisée pour le moment, mais sa présence est liée à la sauvegarde de panier et à l'enregistrement de commande une fois l'achat effectué.


### Menu
---

- [1 - Installation de Symfony](#1---installation-de-symfony)
- [2 - Installation de Doctrine](#2---installation-de-doctrine)
- [3 - Création de la base de données](#3---création-de-la-base-de-données)
- [4 - Création des entités](#4---création-des-entités)
- [5 - Faire les migrations et créer la base de données](#5---faire-les-migrations-et-créer-la-base-de-données)
- [6 - Ajout datetime dans construct](#6---ajout-datetime-dans-construct)
- [7 - Installation des fixtures](#7---installation-des-fixtures)
- [8 - Modification de la BDD](#8---modification-de-la-BDD)
- [9 - Début de création de l’API](#9---début-de-création-de-l’API)
- [10 - API Méthode List ](#10---API-Méthode-List)
- [11 - API Méthode Show](#11---API-Méthode-Show)
- [12 - Modification BDD, MCD, MLD, API](#12---modification-BDD-MCD-MLD-API)
- [13 - Création Server AWS](#13---création-Server-AWS)
- [13bis - Mise en ligne de l’API](#13bis---mise-en-ligne-de-lapi)
- [14 - Ajout Job et modif shop/email](#14---ajout-Job-et-modif-shop/email)
- [15 - CORS policy et ouverture de l’API ](#15---cors-policy-et-ouverture-de-lapi)
- [16 - Création route pour la barre de recherche](#16---Création-route-pour-la-barre-de-recherche)
- [17 - Résolution problème interactions React/Symfo](#17---résolution-problème-interactions-reactsymfo)
- [18 - Création route pour la recherche par produit&catégorie](#18---création-route-pour-la-recherche-par-produitcatégorie)
- [19 - Sessions](#19---Sessions)
- [20 - Installation EasyAdminBundle](#20---installation-EasyAdminBundle)
- [21 - Couche de sécurité - User](#21---couche-de-sécurité---User)
- [22 - Couche de sécurité - Auth](#22---couche-de-sécurité---Auth)
- [23 - Contrôle des accès](#23---contrôle-des-accès)
- [24 - Création du LoginController](#24---création-du-LoginController)
- [25 - Création du RegisterController](#25---création-du-RegisterController)
- [26 - Modification du LoginController](#26---modification-du-LoginController)
- [27 - Update de Shop/UserControllery](#27---update-de-shopusercontroller)
- [28 - Modification méthode POST -> PUT](#28---modification-méthode-post---put)
- [29 -  Ajout de return en json dans les controller](#29---ajout-de-return-en-json-dans-les-controller)
- [30 - Ajout/Mise à jour des produits ](#30---ajoutmise-à-jour-des-produits)
- [31 - Mise en place des promotions](#31---mise-en-place-des-promotions)
- [32 - Ajout de ROLE_SHOP au magasin](#32---ajout-de-ROLE_SHOP-au-magasin)
- [33 - Ajout JWT coté Symfony](#33---ajout-JWT-coté-Symfony)
- [34 - Modification Route /update](#34---modification-route-update)
- [35 - Ajout données via insomnia](#35---ajout-données-via-insomnia)
- [36 - Mise en ligne des JWT](#36---mise-en-ligne-des-JWT)
- [37 - Configuration Firewalls de security.yaml](#37---configuration-firewalls-de-securityyaml)
- [38 - Modification password](#38---modification-password)
- [39 - Delete Product](#39---delete-product)
- [40 - Upload photo](#40---upload-photo)
- [41 - Mise en ligne de l'upload photo](#41---mise-en-ligne-de-lupload-photo)
- [42 - Mise en prod de l'api sur le serveur](#42---mise-en-prod-de-lapi-sur-le-serveur)
---

## 1 - Installation de Symfony


On commence par installé composer 
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

php composer-setup.php

php -r "unlink('composer-setup.php');"
```
Ensuite on lance composer avec :
`composer init`

On installe Symfony avec : 
`symfony new LocalDrive --full --no-git`

**--full** permet d’installer un projet complet (et non pas juste le skeleton)

**--no-git** permet d’inhiber la création d’un repo git

C’est dans le dossier vendor que s’installent toutes les ressources externes au projet, dont les bundles.

**Quelques petites commandes utiles** : 

 `bin/console` permet d’avoir une liste des commandes en symfony

 `symfony serve -d`  permet de démarrer un serveur

 `symfony server:stop` permet d'arrêter un serveur


## 2 - Installation de Doctrine
---

Doctrine est une librairie php qui permet de travailler facilement avec les bases de données.

On installe **Doctrine** avec :

 `composer require symfony/orm-pack`

Maker Bundle est utile pour créer des controllers, des formulaires, des entités (ex : avec les commandes bin/console make:controller)
On installe **Maker Bundle** avec :

 `composer require --dev symfony/maker-bundle`


## 3 - Création de la base de données
---

Création d’un **.env.local** à la racine du dossier (au niveau du .env)  qui permet de renseigner les infos concernant la base de données. Tel que : utilisateur, mot de passe et nom de ladite base.

On crée le **.env.local** :

`touch .env.local`

On renseigne ce **.env.local**. Pour cela il suffit de copier/coller la ligne du **.env** :

`DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7`

Puis de coller la ligne dans le **.env.local** et de changer les infos **db_user** (utilisateur) **db_password** (mot de passe) et **db_name** (nom de la bdd).

Le **.env.local** est propre à l’utilisateur, impossible de le modifier en liveshare et impossible a pull avec git. Il est nécessaire de le recréer à chaque fois qu’on clone un repo.

Ensuite il suffit de créer la base de donné, qui sera vide pour le moment avec :

 `bin/console doctrine:database:create`

(création de la base de données avec les infos du .env.local)

## 4 - Création des entités
---

On utilise la commande :

 `bin/console make:entity  `

(permet la création des 3 entités, product, user et category, les deux tables pivots sont créées parallèlement lors des migrations)

*Les tables seront modifiées plus tard, notamment les tables pivots qui vont disparaitrent*

Une entité correspond à une table, pour les créer on se réfère au dictionnaire de données.


Il y aura **Product** (les produits), **User** (les clients et/ou commerçants), **Category** (les catégories), user_product (table pivot de l’inventaire, appelé Inventory ), product_user (table pivot du panier, appelé Cart ).
Ne pas oublier de bien se placer dans le dossier racine, sinon les commandes ne fonctionneront pas.

Pour les prix on choisit le type decimal et non pas flottant

[Documentation](https://dev.mysql.com/doc/refman/5.7/en/numeric-types.html)

Pour mettre a 0 la valeur de défaut , se rendre dans le  dossier entitée crée ( Produit.php)
Compléter la variable en rajoutant la valeur exemple : 

```
 
    * @ORM\Column(type="decimal", precision=6, scale=2)
    */
   private $price = 0; /* valeur par défaut à 0 */
 
   /**
    * @ORM\Column(type="decimal", precision=6, scale=2)
    */
   private $sale;  /* valeur par défaut non définie*/

```
[Documentation](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/faq.html#how-can-i-add-default-values-to-a-column)

On ajoute une restriction au champ email, pour que les entrées soient uniques :

`@ORM\Column(type="string", length=128, unique=true)`

Le **unique=true**, indique que celui-ci doit etre unique dans la base de données

## 5 - Faire les migrations et créer la base de données
---

Les migrations sont des fichiers stockés dans **src/Migrations**, ils permettent la création des tables et colonnes dans la base de données et sont créés en même temps (et sur le modèle) des entités

 Création des migrations

 `bin/console make:migration`

Envoi des migrations vers la base de données et création des tables et colonnes, tables pivots

` bin/console doctrine:migrations:migrate `

On peut noter que les migrations convertissent un booléen en smallint(1) car pour SQL c’est la même chose.

[Documentation](https://stackoverflow.com/questions/3751853/boolean-vs-tinyint1-for-boolean-values-in-mysql) 

## 6 - Ajout datetime dans construct
---

L’ajout de : **$this->createdAt = new \DateTime();** dans le construct de chaque entitée permet à ce que le **createdAt** soit toujours fixé et non nul. À la date exacte de création de l’entrée

## 7 - Installation des fixtures
---

On installe Orm-fixtures

` composer require --dev orm-fixtures`

On installe NelmioAliceBundle

` composer require --dev nelmio/alice`

Voici un peu de documentations pour pouvoir utiliser des fixtures:

[Documentation Faker](https://github.com/fzaninotto/Faker#fakerproviderlorem )

[Documention Nelmio Alice](https://github.com/nelmio/alice/blob/master/doc/getting-started.md#basic-usage) 


Lors de l’installation de ces fixtures nous avons un nouveau dossier et d’un nouveau fichier qui se crée dans **/src**

Il s’agit de **/src/DataFixtures/AppFixtures.php**

Ensuite on crée un fichier qui se nomme **fixtures.yml**. C’est à partir de ce fichier que nous allons inventer des données factices pour la base de donnée.

En complément on crée un provider, cela nous permet de fixer certaines données factices, par exemple les unités au kilo ou à la pièce.

Ce provider est ensuite chargé sur le fichier **fixtures.yml** avec l’aide d’un loader.
Voici le chemin qu’effectue la donnée factice ‘au kilo’

**LocalDriveProvider.php** -> est chargé par **localDriveNativeLoader** -> est chargé par **AppFixtures.php** qui ensuite charge **fixtures.yml** et le fait persister en base de donnée.

Voici un exemple de fichier **fixtures.yml**

```
App\Entity\Product:
    product_{1..30}:
        name: '<fr_FR:word()>' /*charge un mot français*/
        price: '<numberBetween(0, 200)>' /* Un nombre entre 0 et 200)*/
        description: '<fr_FR:text(20)>' /* un texte de 20 mots*/
        unit: '<unitName()>' /*unitName fournit par le provider*/
        stock: '<numberBetween(0, 1000)>' /*nombre entre 0 et 1000*/
        createdAt: '<dateTimeBetween("-50 days", "now")>'
        category: '@category_*' /*id d’une catégorie existante*/

```


 Enfin pour terminer on envoi les fixtures sur la base de données afin d’alimenter celle-ci avec :

`bin/console doctrine:fixtures:load --group=AppFixtures`


## 8 - Modification de la BDD
---

Suite à la réunion du matin, on modifie la base de donnée pour ajouter un numéro de téléphone à la table User et rendre l’adresse facultative lors de l’inscription


Pour ajouter le numéro de téléphone on modifie l’entité avec

`bin/console make:entity`

Pour modifier l’adresse on ajoute **nullable=true** aux propriétés concernées (soit number, street, zip et city)
Ensuite on fait une migration avec 

`bin/console m:m` puis `bin/console d:m:m`

On ajoute ensuite des fixtures pour le numéro de téléphone puis on les envoies à la base de données avec 

` bin/console d:f:l --group=AppFixtures`

*--group=AppFixtures sert à préciser quel fichier de fixtures on souhaite utiliser, dans ce cas la bin/console d:f:l aurait suffit*

## 9 - Début de création de l’API
---

Pour créer l’API nous allons devoir créer des controllers pour chaque table que nous souhaitons récupérer. Dans ces controllers nous allons mettre en place des méthodes permettant de renvoyer la liste des informations, un élément unique, d’ajouter, de supprimer ou de modifier un élément. Pour commencer, nous allons simplement faire le renvoi de la liste et d’un élément unique.

Pour créer un controller
bin/console make:controller

 On choisit de créer les controllers propres à l’api, on les encapsules dans un dossier api/v1.
Le v1 est la pour spécifier que c’est la 1ere version de l’api, afin de la versionné et de pouvoir travailler sur une v2 plus tard sans intéragir avec la 1ere

La création de ce controller crée deux pages, le controller et une vue dans le dossier templates/api/v1/controller/index.html.twig

Après la creation des controllers, nous allons jongler entre les controllers de l’api et les entités 
Pour plus de simplicité nous allons considéré que le controller s’appelle UserController.
L’API renverra du Json.

## 10 - API Méthode List 
---

On commence par nommer la route dans les annotations *(au dessus de la classe)* afin que toute celle-ci ai la meme route de départ

```
/**                                         _ 
 * @Route("/api/v1/user", name="api_v1_user")
 */                                         _                                            
```
On crée une méthode intitulée **list**, en paramètre on appelle le **UserRepository** et le **Serializer**.

Le UserRepo afin de récupérer toutes les données de l’entité User

Le Serializer pour sérialiser !!

On ajoute également la route pour acceder a cette liste, dans ce cas la ce sera sur la racine donc **api/v1/user**, on ajoute egalement le nom de cette route et la méthode de récupération des données, ici en **GET** puisqu’on ne fait qu’afficher
```
/**                                                                      _
 * @Route("/", name="userList", methods={"GET"})                         _
 */                                                                      _
public function list(UserRepository $userRepository, SerializerInterface $serializer
```
Ensuite on va chercher toutes les données de User avec :

**$users = $userRepository->findAll();**

On serialize les données récupéré avec

**$data = $serializer->normalize($users, null, ['groups' => 'api_v1']);**

[Documentation Serializer](https://jmsyst.com/bundles/JMSSerializerBundle )

*(on verra les groupes juste en dessous)*

Pour terminer on retourne du json

**return $this->json($data);**

Ne pas oublier d’ajouter les deux “use”  au dessus de la classe
```
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
```

Ici on voit que l’on ajouté des groupes, cela permet de selectionner les propriété à afficher.

On nomme le groupe comme on le veut, il suffit de reporter ce nom dans l’entité concerné.
Ici **api_v1**

On ajoute une annotation au dessus de la propriété que l’on veut ajoutée. Par exemple ici on afficher le name donc dans 

**src/Entity/user.php** on ajoute **@Groups(“api_v1”)**
```
/**                                    _
* @ORM\Column(type="string", length=128)
 * @Groups("api_v1")                    _
 */                                     _
private $name;                         _
```
On ajoute le use au dessus de la classe

**use Symfony\Component\Serializer\Annotation\Groups;**

Le groupe peut être ajouter a autant de propriétés que l’on souhaite

## 11 - API Méthode Show
---

On crée maintenant une méthode show, qui pemettra de récupérer les infos concernant un seul et unique utilisateur avec son id
```
/**                                                                      
 * @Route("/{id}", name="userShow", methods={"GET"})                     
 */                                                                      
public function show(User $user, SerializerInterface $serializer)        
{                                                                        
$data = $serializer->normalize($user, null, ['groups' => ['api_v1', 'api_v1_toto']]);
return $this->json($data);                                               
}                                                                        
```
**Route** -> on ajoute une id dans la route, on nomme la route et on applique la méthode GET car il s’agit d’affichage

**Paramètre** -> User pour aller chercher les infos d’un utilisateur, Serializer pour sérialiser
On ajoute le use de User **use App\Entity\User;** 
On voit que l’on a deux groupes différent, ceci permet notamment d’ajouter plus d’infos lorsqu’on affiche un seul utilisateur

[Documentation](https://www.taniarascia.com/how-to-use-json-data-with-php-or-javascript/)

[Documentation](https://roadtodev.com/fr/blog/recuperer-objet-request-de-symfony) 


## 12 - Modification BDD, MCD, MLD, API
---

Suite à une réflexion avec l’équipe, on décide de modifier la base de données :

* Création d’une nouvelle branche de travail
* Suppression de la table inventaire
* Ajout de la table shop, qui scinde en deux la table user, on décide de séparer (pour la v1) les commerçants et les clients
* Modifications du dictionnaire de données
* Modification du MCD et du MLD
* Suppression des controllers, vue twig et entités non utilisé ou obsolète (inventory et cart)
* Suppression des clefs étrangères dans toutes les entités
* Suppression de la propriété rate dans user (on ne note que les commerçant)
* Création des entités Shop et Cart
* Création de toutes les relations entre entités.
* Création d’une nouvelle migration, envoi de cette nouvelle migration
* Rectification des fixtures, rapport aux nouvelles relations entre les tables et les propriétés ajoutées/supprimées
* Envoi de nouvelle fixtures à la base de données
* Ajout de nouveau controllers pour l’API (ShopController et CartController)
* Modification des controllers existants pour coller à la nouvelle base de données
API fonctionnelle

Après une pull request on merge la branche de travail

## 13 - Création Server AWS
---

* On se logue  à la console AWS et on démarre une machine virtuelle :
* On choisit Ubuntu server 18.04 LTS
* Etape 2 : t2 micro
* On valide les étapes jusqu’à l’étape 6
* Etape 6 : Ouvrir un serveur HTTP et HTTPS (port 80 et 443)
* Vérifier et démarrer le serveur.
* Se rendre sur l’adresse ip publique ou le DNS public pour accéder au site

Pour accéder au serveur web depuis le terminal on copie colle : 

`ssh -i /home/mint/.ssh/oclockwave.pem ubuntu@15.188.195.37`

Avec **/home/.../oclockwave.pem** la localisation de la clef permettant de se loguer au serveur
Et **15.188.195.37** l’ip publique du serveur

Sur le serveur on installe les différents composant :
```
sudo apt-get update
sudo apt-get install apache2
sudo apt-get install php
sudo apt install zip unzip
sudo apt-get install php-zip
sudo apt-get install git

sudo apt install mysql-server
```
Dans l’ordre on a mise a jour **linux, apache2, php, zip, git et mysql**.

On **evite d’installer** phpMyAdmin (faille de sécurité)

On crée un utilisateur pour acceder à **mysql** :

On se connecte a mysql 
```
sudo mysql
CREATE USER 'nomutilisateur'@'localhost' IDENTIFIED BY 'motdepasse';
GRANT ALL PRIVILEGES ON * . * TO 'nomutilisateur'@'127.0.0.1';
FLUSH PRIVILEGES;
exit;
```
On crée une clé SSH : 

pour pouvoir se connecter en direct avec git et github

`ssh-keygen -t rsa `

permet de  créer une clef qu’on copie/colle dans ses options github

On installe **composer** :
```
php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
Tester avec `composer --version`

## 13bis - Mise en ligne de l’API
---
On clone son repo :

Dans le *dossier/var/www/html* avec **git clone** et la **clé ssh**

On installe le dossier **vendor** :  **Attention** il faut se situer au niveau de la racine
```
composer install
composer update
composer dump-autoload
```
On change les droits d’apache  :
```
Sudo chown -R ubuntu.www-data /var/www
Sudo chmod -R ug+rwx /var/www
```
On ajoute l’environnement de production :

On crée le **.env.local** à la racine du dossier avec

`nano .env.local`

On ajoute
`APP_ENV=dev`
puis ctrl+o (sauvegarde) et ctrl+x (sortie)

On renseigne l’accès à la base de données :

`nano .env* ` (ouvre tout les .env)

Copier la ligne de la database du **.env** et le coller dans le **.env.local**

`DATABASE_URL=mysql://Nom:Mdp@15.188.195.37:3306/NomDB?serverVersion=5.7`

* **Nom** = Nom utilisateur de la DB
* **Mdp** = Mot de passe
* **15.188.195.37** = Adresse ip publique du serveur
* **NomDB** = Nom de la base de données

On installe apache-pack :

Cela va nous servir à réécrire nos urls proprement

`composer require symfony/apache-pack`

sélectionner l’option a, cela nous permet de créer le **.htaccess** dans le dossier public et ainsi pouvoir réécrire nos routes

SI on a une erreur lors de cette installation du type : **swap memory**

[Documentation Erreur](https://stackoverflow.com/questions/18116261/php-composer-update-cannot-allocate-memory-error-using-laravel-4 )

Ecrire ces trois lignes et relancer l’installation d’apache-pack :
```
sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024
sudo /sbin/mkswap /var/swap.1
sudo /sbin/swapon /var/swap.1
composer require symfony/apache-pack
```
On lance le **serveur** :

On renseigne les infos de config des routes et du dossier de départ (le point de départ du site)

On tape :

`sudo nano /etc/apache2/sites-available/000-default.conf`

 Voici à quoi doit ressembler ce fichier une fois terminer :
 ```
<VirtualHost *:80>
ServerName ec2-15-188-195-37.eu-west-3.compute.amazonaws.com
ServerAdmin webmaster@localhost
DocumentRoot /var/www/html/projet-local-drive/LocalDrive/public
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
   <Directory "/var/www/html">
            AllowOverride All
            Order Allow,Deny
            Allow from All
    </Directory>
</VirtualHost>
```
**DocumentRoot** est le point de départ du site

**Directory** correspond à la réécriture d’url

Installer le **lecteur de route** :

`Sudo a2enmod rewrite`

Redemarrer **Apache** :

`Sudo service apache2 restart`

Créer la base de données et les fixtures :
* `bin/console d:d:c` crée la base de données
* `bin/console d:m:m` met en place les migrations
* `bin/console d:f:l` migre les fixtures

Liens utiles :
* [Doc deploiement sur serveur AWS Ubuntu](https://github.com/O-clock-Alumni/fiches-recap/blob/master/symfony/themes/deploiement-aws-ubuntu.md)
* [Doc debug routing](https://symfony.com/doc/4.2/routing/debug.html) 
* [Doc error swap memory apache pack](https://stackoverflow.com/questions/18116261/php-composer-update-cannot-allocate-memory-error-using-laravel-4)
* [Doc si le.htaccess n'apparait pas après installation apache pack](https://github.com/symfony/apache-pack/issues/1#issuecomment-443883907)
* [Doc sur les logs apache](https://phoenixnap.com/kb/apache-access-log)
* [Doc création utilisteur Mysql](https://www.hostinger.fr/tutoriels/creer-un-utilisateur-mysql/)
* [Doc problème route avec AWS](https://github.com/o-clock-wave/projects/issues/30)

Commandes utiles :
* Effacer la base de données et la recrée:
  * `php bin/console doctrine:database:drop --force` ***A utiliser avec précaution***
  * `php bin/console doctrine:database:create`
* Afficher les routes disponibles :
  * `bin/console debug:router`
  * `bin/console router:match /nomderoute`
* Afficher les logs d’apache :
  * `sudo tail -20 /var/log/apache2/error.log`
  * `sudo tail -20 /var/log/apache2/access.log`


## 14 - Ajout Job et modif shop/email
---
Ajout de la propriété job à l’entité **Shop**, afin que les commerçant puissent avoir une catégorie métier.

 Voici les commandes utilisées pour ajouter Job, une string non null. 

`bin/console make:entity `

Ensuite on ajoute **unique=true** à la propriété **email** de shop, afin de rendre l’email d’inscription unique
```
/**
     * @ORM\Column(type="string", length=128, unique=true)
     * @Groups("api_v1")
     */
    private $email;
```
Puis on effectue les migrations
* `bin/console m:m`  (on crée une migration)
* `bin/console d:m:m` (on envoi la migration à la base de données)
* `bin/console d:f:l`  (on envoi les fixtures pour alimenter la propriété job)



## 15 - CORS policy et ouverture de l’API 
---
L’accès à l’API était bloqué car aucun accès n'était prévu dans le code.

Pour résoudre ce problème nous avon installé un bundle **Nelmio Cors Bundle**

`composer require nelmio/cors-bundle `

Le bundle crée :
* une page dans config/packages -> nelmo_cors.yaml
* Une entrée dans le .env ->
```
###> nelmio/cors-bundle ###
CORS_ALLOW_ORIGIN=^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$
###< nelmio/cors-bundle ###
```
Pour pouvoir ajouter des domaines qui ont accès a l’api on modifie :

`(localhost|127\.0\.0\.1)(:[0-9]+)?$`

On décide de rendre accessible l’api a tout le monde on remplace donc

`(localhost|127\.0\.0\.1)(:[0-9]+)?$`  par `.*?$`

[Repository du bundle](https://github.com/nelmio/NelmioCorsBundle)

[Documentation sur la modification du .env](https://codereviewvideos.com/course/beginners-guide-back-end-json-api-front-end-2018/video/symfony-4-cors-json-api)


## 16 - Création route pour la barre de recherche
---
Le but est de **récupérer l’input** de la barre de recherche côté react et de ne renvoyer que ce qui concerne ladite recherche.

Au départ nous récupérions toutes les infos puis on effectuait un tri dessus, ce qui occasionne des requêtes lourdes. 


On décide donc de récupérer l’input et d'**effectuer le tri dans le repository via le controller**.


En gros le repository récupère les infos en base de données,  trie ces infos, etc..

Le controller profite de l’action du repository, il récupère l’input de la barre de recherche,  passe cet input par le repository et ensuite renvoi une réponse en json.

On commence par les shops, on cherche a trouver la valeur de l’input dans les noms des magasins, la ville et le type de commerce.

On agit sur trois fichiers :
* src/Repository/ShopRepository.php
* src/Controller/Api/V1/ShopController.php
* src/Entity/Shop.php

Dans le repository on crée une méthode **searchSortShop**,

on lui passe en paramètre l’input récupéré de la barre de recherche qu’on appellera **$searchInput**.

Ensuite on crée une requête pour aller chercher les infos en base de données :
```
    public function searchSortShop($searchInput)
    {
        return $this->createQueryBuilder('s')
                    ->where("s.name LIKE :name")
                    ->orWhere("s.job LIKE :job")
                    ->orWhere("s.city LIKE :city")
                    ->setParameter('name', "%".$searchInput."%")
                    ->setParameter('job', "%".$searchInput."%")
                    ->setParameter('city', "%".$searchInput."%")
                    ->getQuery()
                    ->getResult();
    }
```
* Le premier **‘s’** est un alias qui fait référence à la **table shop**
* **Where** et **orwhere** permettent de sélectionner les colonnes qui nous intéresse
* Le **LIKE** permet de chercher sur la colonne selon un critère [Doc sur le Like](https://sql.sh/cours/where/like )
* Ce critère en noté en dessous dans setParameter [Doc Query Builder](https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/query-builder.html )
* Le paramètre **$searchInput** est entre % pour permettre de  rechercher tous les enregistrement qui utilisent le(s) caractère(s) présent dans **$searchInput** [Doc requete Doctrine](https://www.wanadev.fr/56-comment-realiser-de-belles-requetes-sql-avec-doctrine/ )


Dans le **controller**, on crée une méthode **search**, on lui passe en paramètre 
* **ShopRepository $shopRepository** -> Pour aller chercher les infos de la table shop
* **Request $request** -> Permet de récupérer l’input
* **SerializerInterface $serializer** -> Afin de pouvoir sérialiser la réponse
```
    /**
     * @Route("/search", name="shopSearch", methods={"POST"})
     */
    public function search(ShopRepository $shopRepository, Request $request, SerializerInterface $serializer)
    {
        $searchInput = $request->request->get('villeValue');
        $shopsSearch = $shopRepository->searchSortShop($searchInput);
$data = $serializer->normalize($shopsSearch, null, ['groups' => ['api_v1_search']]);
        return $this->json($data);
    }
```
On précise que la méthode est en **POST**, le lien sera donc **inaccessible en GET**

On va chercher la valeur de l’input, ici **villeValue**, cette valeur est issue de la barre de recherche coté React 

On utilise `$request->request` car la méthode est en post (`$request->query` pour une méthode en GET) [Doc sur Request](https://symfony.com/doc/current/components/http_foundation.html#request )

`$request->request` renvoi un tableau, afin de ne sélectionner que la valeur de l’input on utilise la méthode

 `get($nomDeLaValeurDeLinput)` -> **méthode fausse, voir partie 17 pour pouvoir récupérer l’input de la barre de recherche** 
 [Doc sur le parameterBag](https://github.com/symfony/symfony/blob/5.0/src/Symfony/Component/HttpFoundation/ParameterBag.php )

Ensuite on passe cet input par la méthode **searchSortShop** du repository

Puis on serialise la réponse et on renvoi du json

On crée un nouveau groups **api_v1_search** afin de ne renvoyer que les données name, job et city, afin de minimiser le poid de la requete

Dans l’entité, on ajoute le** @Groups(“api_v1_search”)** aux propriétés name, job et city
```
    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     */
    private $city;
```
Le reste des infos reste disponible sur la route **api/v1/shop** avec le groups **api_v1**



Afin de tester toutes ces requêtes sur l’api nous avons utilisé le logiciel [**Insomnia**](https://insomnia.rest/ ).

Ce logiciel permet de **simuler des requêtes** vers une API en y joignant ce que l’on veut (formulaire, json, xml) et selon la méthode que l’on souhaite (post, get, add, update)

Liens utiles :
* [Bases de données et l'ORM Doctrine](https://github.com/O-clock-Alumni/fiches-recap/blob/master/symfony/themes/S2J1-Doctrine.md)
* [Bases de données et l'ORM Doctrine 2](https://symfony.com/doc/current/doctrine.html#querying-for-objects-with-dql )

**Astuce** :

Dans le controller si on crée une nouvelle route du type **/bidule** et que l’on a déjà une route **/{id}** qui existe, il faut que la méthode avec la route **/bidule soit placée au dessus de la méthode avec la route en /{id}**, sinon symfony renverra une erreur **“object not found”**.

En effet l'**annotation /{id}** intercepte **/bidule** et on ne peux pas l’utiliser. [Documentation Officielle](https://symfony.com/doc/current/routing.html )
 

## 17 - Résolution problème interactions React/Symfo
---
Ce matin nous nous sommes rendu compte que la **requête ajax** du coté react passait bien **par le controller** symfo mais symfo ne recevait pas les infos et **renvoyait la totalité** des éléments du shop;

C’est le comportement par défaut voulu, avec un envoi vide le controller renvoi la totalité de la table.

Nous avons donc dû déterminer sous quelle forme le formulaire react envoyait sa requête et comment symfo pouvait la récupérer.

Après (quelques) recherches voici les infos :

**React envoi du json**

Symfony cherchait à **traiter un tableau** (donc un element vide). Il est donc nécessaire pour pouvoir interagir avec le repository que la **requête soit récupérée en json** et **transformer en tableau**. La **requête DQL** reste inchangée

* On crée un tableau vide
  * `$parametersAsArray = [];`
* On récupère la requête post en json
  * `$content = $request->getContent();`
* On remplit le tableau avec la requête décodée
  * `$parametersAsArray = json_decode($content, true);`
* On crée la variable **searchInput** ou on cherche la valeur pour la clé **‘villeValue’** *(value de l’input envoyé par réact)*.
  * searchInput est donc egale à ce qui a été tapé dans la barre de recherche
  * `$searchInput = $parametersAsArray['villeValue'];`
* On passe cette string par la méthode du repository qui va trier le tout
  * `$shopsSearch = $shopRepository->searchSortShop($searchInput);`
* On serialise la réponse
  * `$data = $serializer->normalize($shopsSearch, null, ['groups' => ['api_v1_search']]);`
* On renvoi du json
  * `return $this->json($data);`

Une fois cette méthode mise en place l’appel ajax effectué par react fonctionne parfaitement

## 18 - Création route pour la recherche par produit&catégorie
---
De la même façon, pour rechercher par produit on a quasiment les mêmes méthodes, à ceci près que la **requête DQL** est un peu plus complexe

**ProductController** : 
```
    /**
     * @Route("/search", name="productSearch", methods={"POST"})
     */
    public function search(ProductRepository $productRepository, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        //Récupère l'input de la barre de recherche qui s'appelle productValue
        $searchInput = $parametersAsArray['productValue'];
        //Passe cet input par la methode searchSortShop du ProductRepository
        $productsSearch = $productRepository->searchSortProduct($searchInput);
        //Serialise la réponse
        $data = $serializer->normalize($productsSearch, null, ['groups' => ['api_v1_search']]);
        //Renvoi du json
        return $this->json($data);
    }
```
**ProductRepository** :
```
public function searchSortProduct($searchInput)
    {
        return $this->createQueryBuilder('p')
                    ->join('p.shop', 's')
                    ->join('p.category', 'c')
                    ->where("p.name LIKE :name")
                    ->orWhere("s.name LIKE :shop")
                    ->orWhere("s.city LIKE :shop")
                    ->orWhere("s.job LIKE :shop")
                    ->orWhere("c.name LIKE :category")
                    ->setParameter('name', "%".$searchInput."%")
                    ->setParameter('shop', "%".$searchInput."%")
                    ->setParameter('category', "%".$searchInput."%")
                    ->getQuery()
                    ->getResult();
}
```
* Le premier **‘p’** est un alias qui fait référence à la table product
* **Join** permet d’effectuer une jointure via les clefs étrangères présente sur la table (ici shop et category), on leur donne ensuite un alias.
* **Where** et **orwhere** permettent de sélectionner les colonnes qui nous intéresse, si besoin, en passant par les alias, on peut accéder aux propriétés de shop et de catégorie

La méthode est la même pour les catégories

## 19 - Sessions 
---
Les sessions utilisateurs seront gérés du coté front

La sécurité coté serveur sera mise en place plus tard via les tokens

## 20 - Installation EasyAdminBundle
---
EasyAdminBundle permet d'accéder à une interface de gestion des utilisateurs et des bases de données pour l’installer il suffit de taper :

`composer require admin`

Ceci va, en plus completer le **composer.json**, ajouter deux fichier :
* **config/routes/easy_admin.yaml** -> crée en sus une route /admin à la racine du projet (facilement paramétrable dans ledit fichier)
* **config/packages/easy_admin.yaml** -> Ce fichier sera la base de la configuration de EasyAdmin

La partie admin d’EasyAdmin est complètement paramétrable, couleurs, police, informations affichées.

Par exemple notre fichier :
```
easy_admin:
    site_name: 'Local-drive'
    entities:
        Category:
                class: App\Entity\Category
        Product:
                class: App\Entity\Product
        Shop:
                class: App\Entity\Shop
                    list:
                fields:
                    - id
                    - name
                    - job
                    - email
                    - password
                    edit:
                fields:
                    - name
                    - job
                    - isShop
                    - email
                    - password
                    - phone
                    - number
                    - street
                    - zip
                    - city
                    - image
                    - description
                - ….
```
https://symfony.com/doc/master/bundles/EasyAdminBundle/book/edit-new-configuration.html 

Le fichier est en **yaml** donc l’indentation est importante ! 

On voit que l’on liste nos entitées, en tout cas celle qui nous intéresse et que dans chaque entité on peut spécifier certaines choses. Prenons l’entité Shop :

* **List** -> correspond aux champs que l’on souhaite afficher dans la liste de toutes les entrées de la table List

* **Edit** -> Les champs que l’on souhaite afficher lors de la modification d’une entrée
Il existe également form, new, label, etc …

Pour pouvoir accéder au aux entités dans la partie admin, il peut être nécessaire d’ajouter une méthode `__toString` à certaines entités (surtout si celle-ci sont lié par des de type ManyToOne, etc..).

Parce exemple pour user nous avons dû créer dans src/Entity/User.php :
```
    public function __toString()
    {
        return $this->email;
    }
```
Email étant la propriété qui a une valeur unique pour User


[Documentation EasyAdmin](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html) 

## 21 - Couche de sécurité - User
---
On peut créer à l’aide de symfony des users avec la commande :

`bin/console make:user`

[Documentation User Class](https://symfony.com/doc/current/security.html#a-create-your-user-class) 

Cette commande crée deux pages :
* src/Entity/Toto.php
* src/Repository/TotoRepository.php

Et modifie la page :
* config/packages/security.yaml

Comme nous souhaitons agir sur **User** qui existe déjà, on modifie à la main sans passer par le **make:user**

Pour cela on ajoute au **security.yaml**
```
    encoders:
        App\Entity\User:
            algorithm: auto
```
Dans **Entity/User.php** on implemente la classe **userInterface** et son **use**
```
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
```
Ensuite on ajoute les roles, qui vont jouer un role (!) important dans la sécurité *(finalement pas forcément utile)* 
```
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
```

## 22 - Couche de sécurité - Auth
---
On cherche à créer une authentification, login et logout que la partie React viendra checker en cas de connexion, savoir la personne est un utilisateur, un commerçant ou un admin par exemple.

**La couche sécurité sera amenée à évoluer, cette partie ne concerne finalement QUE la connexion a EasyAdmin, la connexion utilisateur sera gérée par un controller fait à la mano**

Pour cela on utilise une methode de de Symfony :

`bin/console make:auth`

Cette commande crée 3 pages :
* src/Security/Authenticator.php
* src/Controller/SecurityController.php
* templates/security/login.html.twig

Et met à jour :
* config/packages/security.yaml
```
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
```
On a désormais accès à une page /login à la racine.

La plupart des modifications suivantes vont se faire sur l’Authenticator, il faut modifier les méthodes :

* checkCredentials
```
    public function checkCredentials($credentials, UserInterface $user)
    {
        //Necessaire que si l'on souhaite verifier un password, on fera ça plus tard!
        return true;
    }
```
* onAuthenticationSuccess
```
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
```
* getLoginUrl
```
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('app_login');
    }
```
* [Documentation Gestion Users sans FosUser](https://blog.dev-web.io/2018/10/30/symfony-4-gestion-utilisateurs-sans-fosuserbundle-v2018-chapitre-2/ )
* [Documentation](https://openclassrooms.com/forum/sujet/symfony-4-probleme-login )
* [Documentation](https://symfonycasts.com/screencast/symfony-security/auth-errors#play )


##  23 - Contrôle des accès
---
Désormais pour pouvoir atteindre certaines routes, l’utilisateur devra être connecté et avoir les droits suffisant pour y accéder.

Pour cela il suffit d’ajouter des rôles aux utilisateurs et de déterminer quels rôles peut voir quelle routes :

**Création des rôles en local** :

A la main via phpmyadmin, on ajoute, par exemple, un **[“ROLE_ADMIN”]** à un utilisateur désigné.

Attention ici les crochets et les double guillemets sont important, la propriétés rôle étant en json

Création des rôles sur le serveur en ligne de commande :

* `sudo mysql` (pour accéder à  la base de données)
* `Use localdrive;` (acceder à la table localdrive, ne pas oublier le point-virgule)
*  ``` UPDATE `user` SET `roles` = '["ROLE_ADMIN"]' WHERE `user`.`id` = 94; ```
(mise à jour de la ligne d’id 94 dans la colonne roles de la table user)

[Documentation SQL](https://sql.sh/cours/update )

[Documentation SQL](https://tecfa.unige.ch/guides/tie/html/mysql-intro/mysql-intro-7.html )

Une fois les rôles mis en place, il suffit de modifier le **security.yaml** :
```
    access_control:
         - { path: ^/admin, roles: ROLE_ADMIN }
```
On autorise la route **/admin** seulement au utilisateur qui ont le rôle admin

On peut egalement determiner une hiérarchie des rôles avec :
```
    role_hierarchy:
        ROLE_ADMIN: ROLE_USER
```
## 24 - Création du LoginController
---
On décide de créer un **loginController**

Afin de récupérer, depuis réact, la demande de connexion au site et de renvoyer les informations attenantes (utilisateur, commerçant ou non inscrit).

Nous allons agir sur trois fichiers pour cela
* le LoginController
* le UserRepository
* le ShopRepository

On crée le loginController avec :

`bin/console make:controller`

Dans ce **loginController** on crée une méthode login qui aura en paramètre **Request** (pour récupérer la requete venant de react), le **serializer** (pour serialiser la réponse), les deux repository **shop** et **user** pour acceder à leur données et effecuer des **requetes SQL** via leurs biais.
```
public function login(Request $request, ShopRepository $shopRepository, SerializerInterface $serializer, UserRepository $userRepository)
```
Voici les étapes suivies :
* On crée un tableau vide
* On récupère la requête en json
* On alimente le tableau vide avec la requête décodée
* On cherche dans le tableau les entrées correspondant au email et password
* On passe ce mail et ce password en base de données pour vérifier qu’ils existent et savoir si ils correspondent à un utilisateur ou à un commerçant
* On renvoi une réponse en json en fonction :
```
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        $searchInputMail = $parametersAsArray['email'];
        $searchInputPassword = $parametersAsArray['password'];

        $searchMailInUser = $userRepository->searchIfMailIsHere($searchInputMail, $searchInputPassword);
        $searchMailInShop = $shopRepository->searchIfMailIsHere($searchInputMail, $searchInputPassword);

        if (!empty($searchMailInUser)) {

            $result = $serializer->normalize($searchMailInUser, null, ['groups' => ['login_search']]);

        }elseif (!empty($searchMailInShop)) {

            $result = $serializer->normalize($searchMailInShop, null, ['groups' => ['login_search']]);

        }else {

            $result = false;
        };

        return $this->json($result);
```
On utilise **empty** et pas isset car pour isset un tableau même vide renvoi true car il existe alors que pour empty ça sera false

[Documentation Empty](https://www.php.net/manual/fr/function.empty.php )

Les méthodes **searchIfMailIsHere** sont identiques dans les tables User et Shop *(à l’exception du nom des tables en elles-mêmes)* .

Ici **UserRepository** en exemple:
```
    public function searchIfMailIsHere($mailInput, $passwordInput)
    {
        return $this->createQueryBuilder('u')
        ->Where("u.email LIKE :email")
        ->andWhere("u.password LIKE :password")
        ->setParameter('email', "$mailInput")
        ->setParameter('password', "$passwordInput")
        ->getQuery()
        ->getResult();
    }
```
On peut noter que les requêtes dans le controller et les repo sont optimisables, mais ce sera pour plus tard

## 25 - Création du RegisterController 
---
On crée le **RegisterController** afin de récupérer les informations du formulaire d’inscription que Réact nous envoi.

Le formulaire reçu ne contient que l’email, le password, le nom, prénom et le fait de savoir si c’est un utilisateur ou pas (avec isShop)
```
 /**
    * @Route("/api/register", name="register", methods={"POST"})
    */
   public function register(Request $request, UserRepository $ur, ShopRepository $sr)
   {
       $parametersAsArray = [];
       $content = $request->getContent();
       $parametersAsArray = json_decode($content, true);
 
       $inputEmail = $parametersAsArray['email'];
       $inputPassword = $parametersAsArray['password'];
       $inputIsShop = $parametersAsArray['isShop'];
       $inputName = $parametersAsArray['nom'];
       $inputFirstName = $parametersAsArray['prenom'];
```
* On crée un tableau vide qui va recevoir le json décodé
* On récupère la requête en Json envoyé par Réact
* On remplit le tableau en décodant le json

Ensuite :
*On crée des variables qui vont accueillir les input du formulaire


Maintenant on vérifie que l’email n’est pas déjà existant avec la méthode **checkmail** présente dans **UserRepository** et **ShopRepository**
```
 $em = $this->getDoctrine()->getManager();
    
       $checkEmailUser = $ur->checkMail($inputEmail);
       $checkEmailShop = $sr->checkMail($inputEmail);
```
Dans **src/Repository/UserRepository.php** la Methode **checkMail** consiste simplement à regarder dans la table **User** si le mail existe ou pas.

Renvoi **true** si le mail existe déjà;

La méthode est identique dans le **ShopRepository**
```
   public function checkMail($inputMail)
   {
       $check = $this->createQueryBuilder('u')
       ->Where("u.email LIKE :email")
       ->setParameter('email', "$inputMail")
       ->getQuery()
       ->getResult();
 
       if (!empty($check)) {
           return true;
       } else {
           return false;
       }
 
   }
 ```
On doit maintenant déterminer si l’utilisateur est un commerçant ou un utilisateur, pour savoir dans quelle table le sauvegarder.

On commence par vérifier avec le premier **if()** si l’adresse mail n’existe pas déjà en base de données.

* Si c’est le cas le **if renvoi false**.
* Sinon on verifie la proriété **isShop**.
  * Si elle est à **true** -> commerçant, table **Shop**.
  * Si elle est à **false** -> user, table **User**.
  * Si elle est **manquante** -> **false**.
```
  if($checkEmailUser or $checkEmailShop){
           return false;
       } else {
  
           if($inputIsShop == "true") {
 
               $shop = new Shop;
               $shop->setEmail($inputEmail);
               $shop->setName($inputName);
               $shop->setIsShop(true);
               $shop->setJob('');
               $shop->setCreatedAt(new DateTime);
               $shop->setPassword(password_hash($inputPassword, PASSWORD_DEFAULT));
 
               $em->persist($shop);
               $em->flush();
 
 
           } elseif ($inputIsShop = "false") {
 
               $user = New User;
               $user->setEmail($inputEmail);
               $user->setFirstname($inputFirstName);
               $user->setLastname($inputName);
               $user->setIsShop(false);
               $user->setRoles(["ROLE_USER"]);
               $user->setCreatedAt(new Datetime);
               $user->setPassword(password_hash($inputPassword, PASSWORD_DEFAULT));
 
               $em->persist($user);
               $em->flush();
 
           } else {
               return false;
           }
       }
      
       return true;
   }
}
``` 
Pour pouvoir inscrire en base de données plusieurs étapes sont nécessaires :
* On va utiliser Doctrine pour ça 
  * `$em = $this->getDoctrine()->getManager();`


* Ensuite on ramene l’entité et son use ou l’on veut faire persister les données *(on prendra User pour l’exemple)*
 ```
Use App\Entity\User
            $user = New User;
```
* Ensuite on associe les données en utilisant les setters et getters de l’entité
```
            $user->setEmail($inputEmail);
            $user->setFirstname($inputFirstName);
```
**$inputFirstname** et **$inputEmail** correspondent au données récupérer du formulaire Réact

* Ensuite on persiste et on flush (c’est le flush qui inscrit en base de données)

            $em->persist($user);
            $em->flush();

[Documentation sur le Persist](https://symfony.com/doc/current/doctrine.html#persisting-objects-to-the-database) 

Pour le **password** plusieurs méthode existent pour le coder et le décoder.

Nous avons choisi une méthode simple de php avec **password_hash** et **password_verify**

On enregistre en base de données un mot de passe haché
**inputPassword** correspond au mot de passe reçu du formulaire de Réact.

**PASSWORD_DEFAULT** indique comment on souhaite coder ce password, dans ce cas on laisse php choisir la méthode la plus indiquée

`$user->setPassword(password_hash($inputPassword, PASSWORD_DEFAULT));`

[Documentation globale sur le hashing](https://www.php.net/manual/fr/faq.passwords.php#faq.passwords.hashing )

[Documentation sur password hash](https://www.php.net/manual/fr/function.password-hash.php )

[Documentation sur password verify](https://www.php.net/manual/fr/function.password-verify.php )

## 26 - Modification du LoginController
---
Le fait d’avoir d’avoir haché les mots passe nécessité de devoir le dehacher le LoginController, enfin pas le loginController en lui même mais la fonction **searchIfMailIsHere** du **UserRepository** et du **ShopRepository**

Voici la méthode modifiée :
```
$check = $this->createQueryBuilder('u')
        ->Where("u.email LIKE :email")
        ->setParameter('email', "$mailInput")
        ->getQuery()
        ->getResult();

        if(!empty($check)){
            $hash = $check[0]->getPassword();
            if (password_verify($passwordInput, $hash)) {
                return $check;
            } else {
                return false;
            }
        } else { 
            return false;
        }
```
* On récupère les infos dans la base de données qui correspondent à l’adresse email donnée.
* Ensuite on en sort le **password** qu’on intègre dans une variable
`$hash = $check[0]->getPassword();`
* On utilise **password_verify** en comparant $hash et le mot de passe du formulaire et on retourne le resultat trouvé si le mot de passe correspond, false si ce n’est pas le cas.



## 27 - Update de Shop/UserController
---
**Cette méthode sera modifié plus tard au point 3**

On cherche à coder une méthode pour mettre à jour les informations du compte d’un user ou d’un commerçant.

Le formulaire vient de react de la page mon compte pour les user et de la page admin pour les commerçant.

A la difference de la creation, cette fois-ci nous n’appellons pas l’entité mais on va chercher avec l’id a quelle entrée le formulaire correspond avec 
```
       $inputId = $parametersAsArray['id'];
       $user = $userRepository->find($inputId);
```
On utilise find() et pas findBy() car **find() retourne un objet** et **findBy() un tableau**

[Documentation Find et FindBy](https://openclassrooms.com/forum/sujet/symfony-difference-entre-find-et-findby-31092) 

Il suffit ensuite d’utiliser les **setters** et **getters** puis persister et flush un exemple ici avec le **ShopController** :
``` 
namespace App\Controller;
 
use App\Repository\ShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class ShopController extends AbstractController
{
   /**
    * @Route("/api/shop/update", name="shop", methods={"POST"})
    */
   public function update(Request $request, ShopRepository $sr)
   {
 
       $parametersAsArray = [];
       $content = $request->getContent();
       $parametersAsArray = json_decode($content, true);
 
       $inputId = $parametersAsArray['id'];
       $inputEmail = $parametersAsArray['email'];
       $inputJob = $parametersAsArray['job'];
       $inputName = $parametersAsArray['name'];
       $inputPassword = $parametersAsArray['password'];
       $inputPhone = $parametersAsArray['phone'];
       $inputDescription = $parametersAsArray['description'];
       $inputImage = $parametersAsArray['image'];
       $inputNumber = $parametersAsArray['number'];
       $inputStreet = $parametersAsArray['street'];
       $inputZip = $parametersAsArray['zip'];
       $inputCity = $parametersAsArray['city'];
       $inputRate = $parametersAsArray['rate'];
 
 
 
       $em = $this->getDoctrine()->getManager();
       $shop = $sr->find($inputId);
 
       if (!$shop) {
           throw $this->createNotFoundException(
               'No product found for email'.$inputEmail
         
           );
       }
 
       $shop->setName($inputName);
       $shop->setDescription($inputDescription);
       $shop->setImage($inputImage);
       $shop->setNumber($inputNumber);       
       $shop->setStreet($inputStreet);
       $shop->setZip($inputZip);
       $shop->setCity($inputCity);
       $shop->setPhone($inputPhone);
       $shop->setUpdatedAt(New \DateTime);
      
 
 
       $em->persist($shop);
       $em->flush();
 
       return $this->render('shop/index.html.twig', [
           'controller_name' => 'ShopController',
       ]);
   }
}
```

## 28 - Modification méthode POST -> PUT
---

Ajout d’un fichier `route.md` à la racine du projet, qui nous permet de nous repérer dans les routes disponibles pour l’API.

**Le document `route.md` a evolué**

Nous nous rendons compte que les controllers sont un peu éparpillés, on décide donc de tout réunir dans le dossier **API/V1** et d’uniformiser les noms de routes en conséquence.

[Documentation bonnes pratiques REST API](https://www.merixstudio.com/blog/best-practices-rest-api-development/ )


|Route|Méthode|Description|
|-|-|-|
/api/v1/register| *POST* | *Inscription en tant qu'utilisateur ou commerçant* |
/api/v1/login| *POST* | *Verification connexion utilisateur/commerçant* |
/api/v1/user/| *GET* | *Liste de tout les utilisateurs* |
/api/v1/user/{id} | *GET* | *Affichage d'un utilisateur avec son id* |
/api/v1/user/update | *PUT* | *Mise à jour d'un compte utilisateur* |
/api/v1/category/| *GET* | *Liste de toute les catégories* |
/api/v1/category/{id} | *GET* | *Affichage d'une catégorie* |
/api/v1/category/search | *POST* | *Méthode pour la barre de recherche catégorie* |
/api/v1/product/{id} | *GET* | *Affichage d'une catégorie* |
/api/v1/product/add | *POST* | *Ajout d'un produit* |
/api/v1/product/search | *POST* | *Méthode pour la barre de recherche produit* |
/api/v1/shop/ | *GET* | *Liste de tout les commerçants* |
/api/v1/shop/{id} | *GET* | *Affichage d'un commerçant* |
/api/v1/shop/update| *PUT* | *Mise à jour d'un compte commerçant* |
/api/v1/shop/search | *POST* | *Methode pour la barre de recherche commerçant* |
/api/v1/shop/{id}/sale | *GET* | *Affichage des soldes par magasin* |
/api/v1/shop//sale/update | *PUT* | *Ajout/Modification d'une promotion sur un produit* |
/api/v1/shop/sale/delete | *DELETE* | *Suppression d'une promotion* |


## 29 - Ajout de return en json dans les controller
---
Après quelques test certains retour de méthode se sont avéré renvoyer une erreur.
 
On décide donc de corriger ça partout.

Au lieu de renvoyer des

`return false`

On renvoi

`return $this->json(false);`

## 30 - Ajout/Mise à jour des produits 
---

On ajoute deux méthodes pour ajouter un nouveau produit et pour modifier un produit déjà existant.

On met de côté les promotions liées à ce produit, on s’en occupera juste après dans des méthodes différentes.

On crée dans le **ProductController** une méthode **Add**

Rien de particulier, il s’agit de la même procédure que dans :
*25 - Création du RegisterController*

Une petite spécificité. Les produits étant liés à une catégorie et un commerçant (shop).

Il nous faut sortir les infos d’un commerçant ou d’une catégorie. On utlise **find()** qui renvoi un objet
```
        $shopId = $sr->find($inputIdShop);
        $categoryId = $cr->find($inputIdCategory);

    public function add(CategoryRepository $cr, Request $request,SerializerInterface $serializer, ShopRepository $sr)
    {
 
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        $inputIdShop = $parametersAsArray['shopId'];
        $inputIdCategory = $parametersAsArray['categoryId'];
        $inputName = $parametersAsArray['name'];
        $inputImage = $parametersAsArray['image'];
        $inputPrice = $parametersAsArray['price'];
        $inputSale= $parametersAsArray['sale'];
        $inputDescription = $parametersAsArray['description'];
        $inputUnit= $parametersAsArray['unit'];
        $inpuStock= $parametersAsArray['stock'];
 
        // On cherche le shop et la catégorie correspondant à l'id reçue
        $shopId = $sr->find($inputIdShop);
        $categoryId = $cr->find($inputIdCategory);
 
        $em = $this->getDoctrine()->getManager();
 
        $product = new Product;
        $product->setShop($shopId);
        $product->setCategory($categoryId);
        $product->setName($inputName);
        $product->setImage($inputImage);
        $product->setPrice($inputPrice);
        $product->setSale($inputSale);
        $product->setDescription($inputDescription);
        $product->setUnit($inputUnit);
        $product->setStock($inpuStock);
        $product->setCreatedAt(new \DateTime);
 
        $em->persist($product);
        $em->flush();
 
        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);
 
        return $this->json($data);
    }
```

De la même manière on crée une méthode **Update** afin de mettre à jours les produits.

On ne permet pas de changer le commerçant ou de mettre une promotion.

## 31 - Mise en place des promotions
---
Suite à une discussion avec l’équipe on décide de mettre en place 3 nouvelles méthodes pour traiter les promotions.

* Une liste des promotions du magasin en cours
* Un ajout/Mise à jour des promotions
* Une suppression des promotions

On choisit de les mettres en place dans le **ShopController** car il est plus simple de récupérer l’**id du commerçant** en méthode **GET** dans l’url.
```
     * @Route("/{id}/sale", name="shopSaleList", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function saleList(int $id, ProductRepository $pr, SerializerInterface $serializer)
    { $productOnSale = $pr->productOnSale($id);
        $data = $serializer->normalize($productOnSale, null, [
'groups' => 'api_v1_product'
]);
        return $this->json($data);
    }
```
En effet il suffit de récupérer en paramètre **$id** et le type hint en int et il correspondra au **slug de l’url {id}**.

[Documentation sur les parametres de route](https://symfony.com/doc/current/routing.html#route-parameters) 

On passe ensuite cette **$id** dans une méthode **productOnSale** présente dans le **ProductRepository**.
```
 public function productOnSale ($shopId)
 {
     return $this->createQueryBuilder('p')
     ->join ('p.shop', 's')
     ->where("p.sale NOT LIKE :sale")
     ->andWhere("s.id LIKE :id")
     ->setParameter('sale', "null")
     ->setParameter('id', $shopId)
     ->getQuery()
     ->getResult();
 }
```
* On cherche dans l’entitité product.
* On joint les shops
* On cherche les entrées ou `sale` n’est pas null et ou l’id du shop correspond.
* On retourne le tout ensuite

On met ensuite en place la méthode **update**, afin de mettre à jour une nouvelle promotion.
```
 public function saleUpdate(ProductRepository $pr, Request $request, SerializerInterface $serializer)
 {
     $parametersAsArray = [];
     $content = $request->getContent();
     $parametersAsArray = json_decode($content, true);
 
     $inputIdProduct = $parametersAsArray['productId'];
     $inputSale = $parametersAsArray['sale'];
 
     $product = $pr->find($inputIdProduct);
 
     $em = $this->getDoctrine()->getManager();
 
     $product->setSale($inputSale);
     $product->setupdatedAt(new \DateTime);
 
     $em->persist($product);
     $em->flush();
 
     $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);
 
     return $this->json($data);
 }
```

Ensuite on met en place une méthode de **suppression**.

Pour cela on utilise la méthode **DELETE** et pour effacer une promotion, on la passe en `“null”`
```
 public function saleDelete(ProductRepository $pr, Request $request, SerializerInterface $serializer)
 {
     $parametersAsArray = [];
     $content = $request->getContent();
     $parametersAsArray = json_decode($content, true);
 
     $inputIdProduct = $parametersAsArray['productId'];
     $product = $pr->find($inputIdProduct);
 
     $em = $this->getDoctrine()->getManager();
     $product->setSale("null");
     $product->setupdatedAt(new \DateTime);
     $em->persist($product);
     $em->flush();
 
     $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);
     return $this->json($data);
 }
```

## 32 - Ajout de ROLE_SHOP au magasin
---
Avant de s’attaquer à la sécurité, on décide d’ajouter des rôles au commerçant, afin de sécuriser les routes de l’api auxquels ils auront accès!

* On ajoute une propriété $roles à l’entité shop
```
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
```
* On implemente la classe **UserInterface** a la classe shop
  * `class Shop implements UserInterface`

* On ajoute les méthodes **getSalt()**, **eraseCredentials()** et **getUsername()**
  * public function getSalt()
  * public function eraseCredentials()
  * public function getUsername()
* On crée des setters/getters pour roles
* On modifie le RegisterController on ajoutant un setRoles :
  * `$shop->setRoles(["ROLE_SHOP"]);`

* On modifie le security.yaml en ajoutant le role_shop
```
    role_hierarchy:
        ROLE_ADMIN: ROLE_USER, ROLE_SHOP
        ROLE_SHOP: ROLE_USER
```
 
## 33 - Ajout JWT coté Symfony
---
On ajoute une sécurité au demande de requêtes venant du côté react.

Cela comprend authentication et autorisation
* **Authentication** -> Qui es-tu ?
* **Autorisation** -> As-tu le droit d'accéder à cette route ?

[Documentation sur JWT](https://www.whatzeweb.com/cours/creer-une-api-rest-avec-symfony/lauthentification-avec-jwt )

* On commence par installer **LexikJWTAuthenticationBundle**
  * `composer require lexik/jwt-authentication-bundle`

* Première chose à faire ensuite, la création de clés publique et privée pour signer et valider les jetons !
  * On crée un dossier **jwt** dans config qui va contenir les **clefs**
  * Puis on crée les clefs. Lors de la création on nous demande une **Passphrase**, pour l’exemple cette passphrase sera : `alélouya`
```
 mkdir config/jwt
 openssl genrsa -out config/jwt/private.pem -aes256 4096
 openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
* Il faut ensuite ajouter cette **passphrase** dans le **.env** :
```
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=alélouya
```

* Il faut ensuite configurer le **security.yaml**. On ajoute dans la partie **firewalls** le login et l’api. On configure nos route sur **api/v1/…**
On retire le main qui était présent et on ajoute des acces control
```
firewalls:
        login:
            pattern:  ^/api/v1/login
            stateless: true
            anonymous: true
            json_login:
                check_path:               /api/v1/login_check
                success_handler:          lexik_jwt_authentication.handler.authentication_success
                failure_handler:          lexik_jwt_authentication.handler.authentication_failure
 
        api:
            pattern:   ^/api
            stateless: true
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator
        #main:
 
access_control:
     - { path: ^/admin, roles: ROLE_ADMIN }
     - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
     - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }
 
```
On modifie le **routes.yaml**. La route doit correspondre avec celle du **check_path**
```
api_login_check:
    path: /api/v1/login_check
```
On effectue des tests avec insomnia vers la route **api/v1/login_check**.

On a besoin de modifier une info dans **LoginController**, la donnée à envoyer est `‘username’` et non pas `‘email’` (même si c’est bien le mail qui va être pris en compte)
 ```
 $searchInputMail = $parametersAsArray['username'];
 $searchInputPassword = $parametersAsArray['password'];
```
Voici le type de requête à envoyer via insomnia :
```
{
    "username": "youyou@youyou.fr",
    "password": "youyou"
}
```
Une fois cette demande effectuée, si l’utilisateur existe, la route **login_check** renvoi un **token** qui prouve que l’utilisateur est bon. Voici la réponse avec le token :
```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1ODAyMzAwMTcsImV4cCI6MTU4MDIzMzYxNywicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InlvdXlvdUB5b3V5b3UuZnIifQ.R1ZvG-Oh6Az0uhTf1H6vyFgFmTdjYHaccyFi-u9yrhZjvw043SSRFyq21MzvaYYozc30DOWsYUmfzmADPVACYwmnVIUOEP206GpZvS4jAjprys3XfGbtrpYoMru-Hh9UaYFnjZK0O-bpvrvU4h47vIfiT-mNIgOzAhnjnux_YNgHMoNQLqZ2tNc4vD5Pf9FcKKiID1_uz-ZRdxThywrXYsVdgTSz0e5L1lbvpPZbuN3byg_4QalR01XWKgPeqfPkCpbEV3pDm7YrTEJo1OSVOmkU3P46M1P_cGGdAfSqsloD3LZ5WQN9DKQz-rYGqQPHzxK85aQtva_NSulx1h1ZdBUzw_MQR79BBVC5Mrq9hxwFV4_ZlkmR3eosWsOLRnHiPlR0c3g-2Tu2fr4ZzIRltwnw-P00a0IrXd8dqoXFKKV_fHwrBDy-WsSbLmxR0KYRWfIlVlb6v8Tptwyf_y9LkGx_VtjbW4YW5iYm61ZIwuc4dA1Gkp5tQulOywaE2FoHTMyxAHU8IrAwmkdTmwzAmQyTZ2v3xTprUy-701XqVmBSCW3ls1PrFLutZIFBfT_QFKeIEZObAxsrSwD386ty7Jn8KTUY12igkYxm_a4hXN3saSihlNTu1autEXbcHFGkQ2NDqF40cud35TgEx7mBfneVWVpatiiNh76iHnrTY8Q"
}
```
[Ce site](https://jwt.io/) permet de verifier ce que contient le token !

On a bien le token qui va nous permettre de nous connecter à notre API

Ensuite il suffit de faire une demande sur une route en ajoutant le token dans l'entête et de choisir le type **Bearer Token**.

Voici une requête type avec le **headers** envoyé par react
```
axios
    .get('http://localhost:8001/api/v1/product/add', {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    })
```
En effectuant ces requêtes avec le token on peut, si on est enregistré, récupérer / ajouter / modifier les données.

Autrement on aura une réponse en json avec une 401 ou une 403.


**Tout ce qui suit n'est pas finamelement pas utile. Il suffit en réalité de bien configurer le security.yaml**
```
On peut restreindre les routes à certains rôles. Il suffit d’ajouter l’annotation @IsGranted(“ROLE_SHOP”)  dans la méthode qui définit la route concernée
ROLE_USER
ROLE_SHOP
ROLE_ADMIN  (méthode inutile et contraignante, il vaut mieux tout configurer dans le sécurity.yaml, voir 37)

Avec l’annotation et son use : 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
 
@IsGranted("ROLE_SHOP")


Enfin pour éviter un retour en erreur symfony si l’utilisateur n’a pas le rôle définit on ajoute un gestionnaire d’exception avec une réponse en json en fonction de l’erreur

<?php
 
namespace App\EventSubscriber;
 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
 
class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {        
        $exception = $event->getThrowable();
        if($exception instanceof NotFoundHttpException) {
            $data = [
                'status' => $exception->getStatusCode(),
                'message' => 'Resource not found'
            ];
 
            $response = new JsonResponse($data);
            $event->setResponse($response);
        } elseif ($exception instanceof AccessDeniedHttpException) {
            $data = [
                'status' => $exception->getStatusCode(),
                'message' => 'Access denied'
            ];
 
            $response = new JsonResponse($data);
            $event->setResponse($response);
        }
    }
    public static function getSubscribedEvents()
    {
        return [
           'kernel.exception' => 'onKernelException',
        ];
    }
}

afin de rename certains use qui étaient obsolète
https://symfony.com/blog/new-in-symfony-4-3-simpler-event-dispatching 
Afin de trouver le getThrowable
https://symfony.com/doc/current/event_dispatcher.html 
```
## 34 - Modification Route /update
---
* On Rajoute  `/{id}/update` dans les route **/update** des controllers **Shop**, **User** et **Product**

* On ajoute à la fonction **int $id** en paramètre, cela permet de récupérer le **slug {id}** en annotation
```
/**
* @Route("/{id}/update", name="user", methods={"PUT"})
*/
   public function update(int $id, Request $request, SerializerInterface $serializer, UserRepository $ur)
```
* Ensuite on utilise **find** sur le repository pour avoir un objet en sortie
  * `$user = $ur->find($id);`
 
* On procède de le même façon sur les deux autres controllers, cela permet d’identifier l’utilisateur ou le commerçant qui effectue l’action


## 35 - Ajout données via insomnia
---
On décide d’ajouter des utilisateurs, des commerçant et des produit via **insomnia**, avant la mise en place de la protection avec jetons

* Ajout User via **insomnia**
```
15.188.195.37/api/v1/user/register
{
   "email":"jrl@laposte.net",
   "password":"password",
   "isShop":false,
   "nom":"Lambert",
   "prenom":"Jacques-René",
   "job":""
}
```
* Ajout product via insomnia
```
15.188.195.37/api/v1/product/add
{
   "shopId":"322",
   "categoryId":"89",
   "name":"Onglet de boeuf Angus",
   "image":"",
   "price":"4,5",
   "sale":"",
   "description":"",
   "unit":"les 100grs",
   "stock":"100"
}
```

## 36 - Mise en ligne des JWT
---
La mise sur le serveur des jetons se passe bien.

Coté react on doit ajouter des headers dans les requêtes ajax.

Elle doit contenir

``` Authorization: `Bearer ${token}` ```

Voilà à quoi peut ressembler la requête avec son **en-tête 
axios**
```
        .get('http://localhost:8001/user/profile', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
```
[Documentation sur l'ajout des headers pour axios](https://github.com/axios/axios/issues/858 )

Le **front demande un token** lors de la connexion et ensuite **envoi ce token à chaque requête**, sinon le serveur refuse l’envoi de réponse

Une fois quelque tests effectués sur le site en ligne, on constate qu’il est possible de se connecter avec un utilisateur(user) mais pas avec un commerçant(shop).

Cela vient du fait que le **security.yaml** ne contient qu’un seul **provider**, l’entité user.

On ajoute donc l’**entité shop** et ensuite on **chain les providers**, afin de les réunir en un. Ne pas oublier l’**encoder**, sinon cela remontera une erreur
```
security:
    encoders:
        App\Entity\User:
            algorithm: auto
        App\Entity\Shop:
            algorithm: auto
    providers:
        in_user:
            entity:
                class: App\Entity\User
                property: email
        in_shop:
            entity:
                class: App\Entity\Shop
                property: email
        app_user_provider:
            chain:
                providers: ['in_user', 'in_shop']
```
[Documentation Multiple providers](https://openclassrooms.com/forum/sujet/symfony-4-multiple-user-providers )

[Documentation sur mulitple providers pour rendre Shop disponible lors de la connexion](https://stackoverflow.com/questions/57574539/not-configuring-explicitly-the-provider-for-the-guard-listener-on-x-firewall)


## 37 - Configuration Firewalls de security.yaml
---

* On constate ensuite que les routes sont bien sécurisées, voire trop, par exemple les fonctions recherche ne sont plus accessible si l’utilisateur n’est pas loggué
* On souhaite que les routes en **GET** soient accessible par n’importe qui, excepté celle qui concerne les **users**.
Enfin les méthodes, **POST**, **PUT**, **UPDATE**, **DELETE** reste protégées et l’utilisateur doit être connecté en **user** voir en **shop** (pour ajouter des produits par exemple)
* On ajoute la regex
  * ` .*?` Devant **/add** (par exemple) pour spécifier que peu importe le chemin avant, si il termine par **/add**, il est concerné par cette couche de sécurité
* Le provider **‘in_shop’** nous permet de spécifier que le **/add** ne sera accessible que par quelqu’un qui est commerçant
```
        add:
            pattern: .*?/add
            stateless: true
            provider: 'in_shop'
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator
        update:
            pattern: .*?/update
            stateless: true
            provider: 'app_user_provider'
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator
        delete:
            pattern: .*?/delete
            stateless: true
            provider: 'in_shop'
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator
        user:
            pattern: .*?/user
            stateless: true
            provider: 'app_user_provider'
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator
        register:
            pattern:  ^/register
            stateless: true
            anonymous: true
        loginAdmin:
            anonymous: true
            provider: 'app_user_provider'
            json_login:
                check_path: /login
            guard:
                authenticators:
                    - App\Security\Authenticator
            logout:
                path: app_logout
            switch_user: true
        admin:
            pattern: /admin
            provider: 'app_user_provider'
            guard:
                authenticators:
                    - App\Security\Authenticator
```

[Documentation Regex Character](https://www.rexegg.com/regex-quickstart.html)

## 38 - Modification password
---
On créé la Route dans le LoginController
```
   /**
   * @Route("/reset-password", name="reset_password",  methods={"PUT"})
   */
```
On crée  ensuite la fonction qui à pour but de récupérer l’ancien **password** et le comparer à celui en base de donnée puis le modifier. Pour cela on utilise la méthode déjà existante **searchIfMailIsHere** dans les Repository User et Shop, qui nous permet d'extraire un password correspondant à un email.
```
public function resetPassword (Request $request,  ShopRepository $shopRepository, UserRepository $userRepository)
   {
 
       $parametersAsArray = [];
       $content = $request->getContent();
       $parametersAsArray = json_decode($content, true);
        // on récupere les passwords
       $searchInputMail = $parametersAsArray['username'];
       $searchInputOldPassword = $parametersAsArray['oldPassword'];
       $searchInputNewPassword = $parametersAsArray['newPassword'];
       $verifyPasswordInUser = $userRepository->searchIfMailIsHere($searchInputMail, $searchInputOldPassword);
       $verifyPasswordInShop = $shopRepository->searchIfMailIsHere($searchInputMail, $searchInputOldPassword);
```
Ensuite on ajoute une condition qui a pour but de verifier si l'utilisateur est un User un Shop ou non enregistré en base de donnée
``` 
if($verifyPasswordInUser == false) {

    if($verifyPasswordInShop == false) {

        // Ni user, ni Shop, donc false
        $result = false;

    } else {
        
        // Pas User mais Shop donc se retrouve ici

        $idShop = $verifyPasswordInShop[0]->getid();
        $em = $this->getDoctrine()->getManager();
        $shop = $shopRepository->find($idShop);
        $shop->setPassword(password_hash($searchInputNewPassword, PASSWORD_DEFAULT));

        $em->persist($shop);
        $em->flush();
        $result = $shop;
    }

} else {

// User donc se retrouve ici
$idUser = $verifyPasswordInUser[0]->getid();
$em = $this->getDoctrine()->getManager();
$user = $userRepository->find($idUser);
$user->setPassword(password_hash($searchInputNewPassword, PASSWORD_DEFAULT));

$em->persist($user);
$em->flush();
$result = $user;
}

return $this->json($result);
```              
## 39 - Delete Product
---
On créé la route Delete pour les produits

```
/**
* @Route("/{id}/delete", name="productDelete", methods={"DELETE"})
*
*/
```
On crée la méthode **delete** qui permet de supprimer un produit .
```
public function delete(int $id, Request $request, SerializerInterface $serializer, ProductRepository $pr)
   {
       $product = $pr->find($id);
       $em = $this->getDoctrine()->getManager();
       if (!$product) {
      throw $this->createNotFoundException('No product found for id'.$id);
       }
       $em->remove($product);
       $em->flush();
       return $this->json(true);
   }
```
On supprime les infos liées à cet id en base d donnée avec :

` $em->remove($product); `

[Documentation sur le delete](https://stackoverflow.com/questions/11809685/how-do-i-delete-an-entity-from-symfony2)

## 40 - Upload photo 
---
On décide de mettre au point une méthode afin de récupérer un **upload de photo** venant du front en réact. Le front envoi un fichier de type **.jpg .gif .png .jpeg**

On décide de séparer les controllers afin de mieux gérer les photos.

**ProductController, ShopController et UserController**, chacun aura sa méthode accessible via l’**id** du produit, du shop ou de l’utilisateur concerné. 

Nous allons prendre l’entitée **Product** en exemple 
```
    /**
     * @Route("/{id}/upload-image", name="uploadImageShop", methods={"POST"})
    */
```
On notera que cette méthode n’est **disponible qu’en POST**

Voici la méthode, elle est détaillée en dessous
```
    public function uploadImage(int $id, ShopRepository $sr, Request $request, SerializerInterface $serializer)
    {
        $image = $request->files->get('image');
        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        $image->move($this->getParameter('upload_image_shop'), $imageName);
 
        $em = $this->getDoctrine()->getManager();
        $shop = $sr->find($id);
        $shop->setImage($imageName);
        $em->persist($shop);
        $em->flush();
 
        $data = $serializer->normalize($shop, null, ['groups' => 'api_v1_image']);
        return $this->json($data);
 
    }
```


* On récupère le fichier avec :
  * `$image = $request->files->get('image');`
  * Il a pour nom ‘image’ dans la requête envoyé par le front
  * [Documentation sur files->get](https://symfony.com/doc/current/introduction/http_fundamentals.html )

* On donne un nom unique et on récupère l’extension du fichier avec guessExtension :
  * `$imageName = md5(uniqid()).'.'.$image->guessExtension();`

* On stocke l’image dans le dossier public afin de la rendre accessible.
  * Le **move** nécessite un ***chemin et un nom de fichier***, c’est la que l’on inclut le nom que l’on a créé au dessus :
  * `$image->move($this->getParameter('upload_image_shop'), $imageName);`
    * Le nom **upload_image_shop** vient du **security.yaml** ou l’on définit un chemin avec le nom upload_image_shop
    ```
    parameters:
    upload_image_product: '%kernel.project_dir%/public/images/products'
    ```

* Ensuite, classiquement, on cherche le produit en base de donnée avec l’id, on persist et on flush, puis on renvoi l’id et le nom de la photo.

* La **photo** est accessible via l’adresse :

  * `/images/products/nomDeLimage.extension`

On execute la même chose pour les users et les shops.

[Documentation sur l'upload](https://www.youtube.com/watch?v=jBeeV2_Imbw )

## 41 - Mise en ligne de l’upload photo
---
Lors de la mise en ligne de l’upload photo, une erreur remonte, en effet, le dossier public n’autorise pas la création de nouveau dossier ou fichier.

On applique donc les **permissions** après avoir créer le dossier :
```
    mkdir images
    chmod 777 images
```
Idem pour les sous-dossier products, users, shops

## 42 - Mise en prod de l’api sur le serveur
---
* On se connecte au serveur
* On se connecte au .env.local avec
  * `nano .env.local`
* On change le APP_ENV de dev vers prod
  * `APP_ENV=prod`
* On redémarre apache puis on relance les droits d’apache et on nettoie le cache
  * `sudo service apache2 restart`
  * `sudo chown -R ubuntu.www-data /var/www`
  * `sudo chmod -R ug+rwx /var/www`
  * `bin/console cache:clear`


