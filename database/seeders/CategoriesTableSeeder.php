<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Électronique',
                'description' => 'Découvrez une variété d\'appareils électroniques d\'occasion, des smartphones aux appareils photo en passant par les accessoires audio.'
            ],
            [
                "name" => "Mode",
                "description" => "Trouvez des vêtements, chaussures et accessoires de mode d'occasion pour hommes et femmes, à des prix abordables."
            ],
            [
                "name" => "Maison et jardin",
                "description" => "Explorez des meubles, des décorations intérieures, des appareils électroménagers et plus encore pour améliorer votre espace de vie."
            ],
            [
                "name" => "Livres, films et musique",
                "description" => "Plongez dans le monde de la littérature, du cinéma et de la musique avec des livres, des DVD, des CD et des instruments de musique d'occasion."
            ],
            [
                "name" => "Sports et loisirs",
                "description" => "Équipez-vous pour vos activités sportives et de loisirs avec des équipements, des vélos, des jeux de société et bien plus encore."
            ],
            [
                "name" => "Jouets et jeux",
                "description" => "Trouvez des jouets pour enfants, des jeux vidéo rétro et modernes, des puzzles et des figurines pour les collectionneurs."
            ],
            [
                "name" => "Art et collection",
                "description" => "Explorez des œuvres d'art uniques, des antiquités, des cartes à collectionner et d'autres objets de valeur pour les collectionneurs passionnés."
            ],
            [
                "name" => "Bébés et enfants",
                "description" => "Trouvez tout ce dont vous avez besoin pour vos tout-petits, des vêtements aux jouets, en passant par les poussettes et les articles de puériculture."
            ],
            [
                "name" => "Automobiles et accessoires",
                "description" => "Parcourez une sélection de voitures d'occasion, de pièces détachées et d'accessoires automobiles pour entretenir et personnaliser votre véhicule."
            ],
            [
                "name" => "Équipements et fournitures professionnels",
                "description" => "Découvrez du matériel informatique professionnel, des fournitures de bureau, des outils industriels et tout ce dont vous avez besoin pour votre entreprise."
            ],
            [
                "name" => "Loisirs créatifs et artisanat",
                "description" => "Exprimez votre créativité avec du matériel d'artisanat, des fournitures de couture, de la peinture et d'autres outils pour vos projets créatifs."
            ],
            [
                "name" => "Articles de maison et de cuisine",
                "description" => "Trouvez des articles essentiels pour la maison et la cuisine, tels que de la vaisselle, des ustensiles, des appareils électroménagers et plus encore."
            ],
            [
                "name" => "Technologie et gadgets",
                "description" => "Explorez une gamme de gadgets électroniques, d'accessoires pour smartphones, d'objets connectés et de produits high-tech d'occasion."
            ],
            [
                "name" => "Santé et beauté",
                "description" => "Prenez soin de vous avec des produits de beauté, des équipements médicaux, des articles de bien-être et des produits de soins personnels."
            ],
            [
                "name" => "Autres",
                "description" => "Découvrez une variété d'articles divers qui ne rentrent pas dans les autres catégories, vous pourriez y trouver des surprises inattendues."
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
