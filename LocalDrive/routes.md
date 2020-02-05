
|Route|Méthode|Description|
|-|-|-|
/login| *ANY* | *Login EasyAdmin* |
/logout| *ANY* | *Logout EasyAdmin* |
/admin| *ANY* | *Connexion EasyAdmin* |
/register| *POST* | *Inscription en tant qu'utilisateur ou commerçant* |
/reset-password| *PUT* | *Changer son mot de passe* |
/api/v1/login| *POST* | *Connexion au site Local-Drive* |
/api/v1/login_check| *ANY* | *Obtention du token* |
/api/v1/user| *GET* | *Liste de tout les utilisateurs* |
/api/v1/user/{id} | *GET* | *Affichage d'un utilisateur avec son id* |
/api/v1/user/{id}/update | *PUT* | *Mise à jour d'un compte utilisateur* |
/api/v1/user/{id}/upload-image | *POST* | *Ajout d'une image pour un utilisateur* 
/api/v1/category| *GET* | *Liste de toute les catégories* |
/api/v1/category/{id} | *GET* | *Affichage d'une catégorie* |
/api/v1/category/search | *POST* | *Méthode pour la barre de recherche catégorie* |
/api/v1/product | *GET* | *Liste de tout les produits* |
/api/v1/product/search | *POST* | *Méthode pour la barre de recherche produit* |
/api/v1/product/add | *POST* | *Ajout d'un produit* |
/api/v1/product/{id} | *GET* | *Affichage d'un produit* |
/api/v1/product/{id}/update | *PUT* | *Mise à jour d'un produit* |
/api/v1/product/{id}/delete | *DELETE* | *Supression d'un produit |
/api/v1/product/{id}/upload-image | *POST* | *Ajout d'une image pour un produit* |
/api/v1/shop/ | *GET* | *Liste de tout les commerçants* |
/api/v1/shop/{id} | *GET* | *Affichage d'un commerçant* |
/api/v1/shop/{id}/update| *PUT* | *Mise à jour d'un compte commerçant* |
/api/v1/shop/{id}/upload-image | *POST* | *Ajout d'une image pour un commerçant* 
/api/v1/shop/search | *POST* | *Methode pour la barre de recherche commerçant* |
/api/v1/shop/{id}/sale | *GET* | *Affichage des soldes par magasin* |
/api/v1/shop/sale/update | *PUT* | *Ajout/Modification d'une promotion sur un produit* |
/api/v1/shop/sale/delete | *DELETE* | *Suppression d'une promotion* |

