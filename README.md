# BusRatp

La classe `BusRatp.php` permet d'extraire les informations visibles du [site mobile de la RATP](http://wap.ratp.fr), dont les **horaires réels** des passages des bus à un arrêt donné.

Merci à [Aurélien Fache](https://github.com/mathemagie/arret_demande) pour m'avoir informé de l'existance du [wap RATP](http://wap.ratp.fr)

Usage : 
---
```php
<?php
require_once('BusRatp.php');

$type = 'bus'; // bus/noctilien
$line = '39';  // $line_num
$stop = false; // false/$stop_id

$BusRatp = new BusRatp($type, $line, $stop);
print_r($BusRatp);
```

Résultat : 
---
```
BusRatp Object
(
    [type] => bus
    [type_display] => Bus
    [line] => 39
    [line_display] => 39
    [direction] => 
    [stop] => 39_15_72
    [stop_display] => Abbe Groult
    [stops] => Array
        (
            [39_15_72] => Abbe Groult
            [39_24_65] => Bac-Saint-Placide
            [39_77] => Balard
            [39_76] => Balard-Lecourbe
            [39_53] => Bibliotheque Nationale
            [39_34] => Bourse
            [39_70] => Cambronne-Lecourbe
            [39_17] => Cambronne-Vaugirard
            [39_39] => Chateau d'Eau
            [39_118] => Colonel Pierre Avia
            [39_73] => Convention-Lecourbe
            [39_14] => Convention-Vaugirard
            [39_9] => Desnouettes
            [39_10] => Desnouettes-Vasco de Gama
            [39_74] => Duranton
            [39_21_44] => Gare de l'Est
            [39_89] => Gare du Nord
            [39_50] => Grands Boulevards
            [39_11] => Hameau
            [39_13] => Hopital de Vaugirard
            [39_22_67] => Hopital des Enfants Malades
            [39_116] => Issy-Freres Voisin
            [39_28_57] => Jacob
            [39_91] => La Fayette-Dunkerque
            [39_82] => Louis Armand
            [39_75] => Lycee Louis Armand
            [39_45] => Magenta Saint-Martin
            [39_46] => Mairie du 10 Eme
            [39_71] => Mairie du 15 Eme
            [39_4] => Maison de Retraite
            [39_103_104] => Michel Debre
            [39_30_55] => Musee du Louvre
            [39_31_54] => Palais Royal-Comedie Francaise
            [39_19] => Pasteur-Lycee Buffon
            [39_49] => Poissonniere-Bonne Nouvelle
            [39_29_56] => Pont du Carrousel-Quai Voltaire
            [39_48] => Porte Saint-Denis
            [39_47] => Porte Saint-Martin
            [39_42] => Porte d'Issy
            [39_35] => Reaumur-Montmartre
            [39_37] => Reaumur-Sebastopol
            [39_33_52] => Richelieu 4 Septembre
            [39_51] => Richelieu-Drouot
            [39_27_58] => Saint-Germain des Pres
            [39_32] => Sainte-Anne-Petits-Champs
            [39_36] => Sentier
            [39_5] => Severine
            [39_25_60] => Sevres-Babylone
            [39_20_68] => Sevres-Lecourbe
            [39_38] => Strasbourg-Saint-Denis
            [39_90] => Valenciennes
            [39_23_66] => Vaneau-Saint-Romain
            [39_120] => Vaugirard-Croix Nivert
            [39_16] => Vaugirard-Favorites
            [39_69] => Volontaires-Lecourbe
            [39_18] => Volontaires-Vaugirard
        )
    [directions] => Array
        (
            [0] => stdClass Object
                (
                    [direction] =>  Gare du Nord
                    [stops] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [terminus] =>  Gare du Nord
                                    [timeout] => 4 mn
                                )
                            [1] => stdClass Object
                                (
                                    [terminus] =>  Gare du Nord
                                    [timeout] => 8 mn
                                )
                        )
                )
            [1] => stdClass Object
                (
                    [direction] =>  Issy - Freres Voisin
                    [stops] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [terminus] =>  Issy-Freres Voisin
                                    [timeout] => 2 mn
                                )
                            [1] => stdClass Object
                                (
                                    [terminus] =>  Issy-Freres Voisin
                                    [timeout] => 18 mn
                                )
                        )
                )
        )
)
```
