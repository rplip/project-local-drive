<?php

namespace App\DataFixtures\Provider;

class localDriveProvider extends \Faker\Provider\Base
{
    protected static $unit = [
        'le kilo',
        'la pièce',
        'les 100g',
        'la livre',
        'le lot de 4',
    ];

    protected static $category = [
        'Viennoiserie',
        'Pain',
        'Gateau',
        'Boissons gazeuses',
        'Boeuf',
        'Veau',
        'Volaille',
        'Poisson de mer',
        'Crustacés',
        'Fruit',
        'Légume',
        'Vin rouge',
        'Vin blanc',
        'Champagne',
        'Cremerie',
        'Dessert',
        'Fromage',
        'Poisson',
        'Crustacé',
        'Poulet',
        'Traiteur',
        'Saucisse',
        'Jus de fruit',
        'Sucrerie',
        'Produit Bio',

    ];

    protected static $product = [
        'tomate',
        'gigot d\'agneau',
        'concombre',
        'salade nicoise',
        'poire',
        'bavette d\'aloyau',
        'andouilette AAAA',
        'oignon',
        'poulet',
        'pain de campagane',
        'pain bio',
        'peches',
        'sardine',
        'cabillaud',
        'sauce au beurre',
        'café',
        'merguez',
        'poivron',
        'jus de pomme',
        'galette des rois',
        'jambon',
        'ananas',
        'Clementine',
        'Langue de boeuf',
        'Safran',
        '7up',
        'Liptonic',
        'Eclair au cafe',
        'Pain au chocolat',
        'Croissant',
        'Brocoli',
        'Haricots vert',
        'Magret de canard',
        'filet de sole',
        'Roquefort',
        'Gruyere Suisse',
        'Oeufs',
        'Lait écremé',
        'Beurre salé',
        'Lait de soja',
        'Yaourt nature',
        'Compote de pomme',
        'Roquefort',
        'Comté 18mois',
        'Poulet roti',
        'Saucisse de Morteau',
        'Côte de porc',
        'Crevettes grises',
        'Moule de bouchot',
        'Saumon fumé',
        'Pain de seigle',
        'Henriette du Mans',
        'Taboulé',
        'Tzatziki',
        'Pain au noix',
        'Amandes',
        'Kiwi',
        'Courgette',
        'Haricots coco',
        'Gaspacho',
        'Pierre Chanau Beaujolais village 2019',
        'Gevrey Chambertin craipillot domaine Seguin',
    ];

    protected static $job = [
        'boucherie',
        'boulangerie',
        'poissonerie',
        'primeur',
        'pharmacien',
        'agriculteur',
        'traiteur',
        'caviste',
        'epicerie fine',
        'fromager',
        'charcutier',
        'magasin Bio',
        'animalerie',
        'laiterie',
    ];

    public static function unitName(){
        return static::randomElement(static::$unit);
    }

    public static function categoryName(){
        return static::randomElement(static::$category);
    }

    public static function productName(){
        return static::randomElement(static::$product);
    }

    public static function jobName(){
        return static::randomElement(static::$job);
    }

}