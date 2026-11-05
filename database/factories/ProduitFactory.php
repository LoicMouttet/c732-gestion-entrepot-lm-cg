<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    // Déclaration d'une liste statique de 100 produits pour éviter de dupliquer
    protected static int $index = 0;

    public function definition(): array
    {
        $catalogue100 = [
            ['nom' => 'Pain de mie', 'description' => 'Pain de mie tranché nature 500g'],
            ['nom' => 'Nutella', 'description' => 'Pâte à tartiner aux noisettes pot 750g'],
            ['nom' => 'Yogourt chocolat', 'description' => 'Yaourt onctueux saveur chocolat x4'],
            ['nom' => 'Yogourt fraise', 'description' => 'Yaourt aux fruits morceaux de fraise x4'],
            ['nom' => 'Lait demi-écrémé', 'description' => 'Bouteille de lait UHT 1L'],
            ['nom' => 'Beurre doux', 'description' => 'Plaque de beurre doux 250g'],
            ['nom' => 'Jus d’orange', 'description' => 'Jus d’orange 100% pur jus 1L'],
            ['nom' => 'Café moulu', 'description' => 'Paquet de café arabica moulu 250g'],
            ['nom' => 'Farine de blé', 'description' => 'Farine de blé type 55 sac 1kg'],
            ['nom' => 'Sucre en poudre', 'description' => 'Sucre blanc cristallisé 1kg'],
            ['nom' => 'Huile de tournesol', 'description' => 'Bouteille d’huile de tournesol 1L'],
            ['nom' => 'Pâtes Coquillettes', 'description' => 'Paquet de pâtes de blé dur 500g'],
            ['nom' => 'Riz basmati', 'description' => 'Riz basmati parfumé sachet 1kg'],
            ['nom' => 'Biscuits chocolat', 'description' => 'Paquet de biscuits aux pépites de chocolat'],
            ['nom' => 'Compote de pommes', 'description' => 'Gourdes de compote de pommes x4'],
            ['nom' => 'Eau minérale', 'description' => 'Pack de 6 bouteilles d’eau 1.5L'],
            ['nom' => 'Céréales Chocapic', 'description' => 'Paquet de céréales au chocolat 450g'],
            ['nom' => 'Emmental râpé', 'description' => 'Sachet d’emmental râpé 200g'],
            ['nom' => 'Jambon blanc', 'description' => 'Tranches de jambon cuit supérieur x4'],
            ['nom' => 'Chips nature', 'description' => 'Sachet de chips de pommes de terre 300g'],
            ['nom' => 'Steak haché', 'description' => 'Barquette de steaks hachés pur bœuf x2'],
            ['nom' => 'Saumon fumé', 'description' => 'Tranches de saumon fumé de Norvège 4 tranches'],
            ['nom' => 'Sodebo Box', 'description' => 'Salade César poulet croustillant 300g'],
            ['nom' => 'Pizza Margherita', 'description' => 'Pizza surgelée base tomate mozzarella 400g'],
            ['nom' => 'Glace vanille', 'description' => 'Bac de crème glacée parfum vanille 1L'],
            ['nom' => 'Blancs de poulet', 'description' => 'Filets de poulet frais emballés 500g'],
            ['nom' => 'Oeufs frais', 'description' => 'Boîte de 12 œufs de poules élevées en plein air'],
            ['nom' => 'Tortillas', 'description' => 'Galettes de blé pour fajitas x6'],
            ['nom' => 'Sauce Tomate', 'description' => 'Coulis de tomate cuisiné aux herbes 400g'],
            ['nom' => 'Mayonnaise', 'description' => 'Tube de mayonnaise de Dijon 250g'],
            ['nom' => 'Ketchup', 'description' => 'Bouteille souple de ketchup classique 500g'],
            ['nom' => 'Moutarde forte', 'description' => 'Pot de moutarde forte de Dijon 200g'],
            ['nom' => 'Vinaigre balsamique', 'description' => 'Bouteille de vinaigre balsamique de Modène 50cl'],
            ['nom' => 'Tablette de chocolat noir', 'description' => 'Chocolat noir 70% cacao 100g'],
            ['nom' => 'Bonbons Haribo', 'description' => 'Sachet de bonbons gélifiés mix 300g'],
            ['nom' => 'Brioche tranchée', 'description' => 'Brioche pur beurre familiale 400g'],
            ['nom' => 'Consolette de thon', 'description' => 'Boîte de thon entier au naturel 160g'],
            ['nom' => 'Sardines à l’huile', 'description' => 'Boîte de sardines à l’huile d’olive 115g'],
            ['nom' => 'Soupe de légumes', 'description' => 'Brique de velouté de 10 légumes 1L'],
            ['nom' => 'Purée de pommes de terre', 'description' => 'Flocons de purée instantanée sachet 400g'],
            ['nom' => 'Thé vert menthe', 'description' => 'Boîte de 25 sachets de thé vert menthe'],
            ['nom' => 'Infusion camomille', 'description' => 'Boîte de 20 sachets d’infusion apaisante'],
            ['nom' => 'Boisson énergisante', 'description' => 'Canette boisson énergisante 25cl'],
            ['nom' => 'Coca-Cola', 'description' => 'Bouteille de soda cola 1.5L'],
            ['nom' => 'Ice Tea pêche', 'description' => 'Boisson rafraîchissante au thé pêche 1.5L'],
            ['nom' => 'Sirop de grenadine', 'description' => 'Bouteille de sirop concentré 75cl'],
            ['nom' => 'Compote abricot', 'description' => 'Gourdes de compote abricot x4'],
            ['nom' => 'Biscuits petit-beurre', 'description' => 'Paquet de biscuits traditionnels 200g'],
            ['nom' => 'Madeleines longues', 'description' => 'Sachet de madeleines pur beurre x12'],
            ['nom' => 'Croissants surgelés', 'description' => 'Lot de 6 croissants pur beurre à cuire'],
            ['nom' => 'Pain de campagne', 'description' => 'Boule de pain de campagne tranchée 400g'],
            ['nom' => 'Fromage de chèvre', 'description' => 'Bûchette de chèvre affinée 180g'],
            ['nom' => 'Camembert de Normandie', 'description' => 'Boîte de camembert au lait cru 250g'],
            ['nom' => 'Roquefort', 'description' => 'Portion de roquefort AOP 150g'],
            ['nom' => 'Mozzarella', 'description' => 'Boule de mozzarella di Bufala 125g'],
            ['nom' => 'Crème fraîche épaisse', 'description' => 'Pot de crème fraîche 30% MG 200g'],
            ['nom' => 'Lait de coco', 'description' => 'Brique de lait de coco cuisine 400ml'],
            ['nom' => 'Pois chiches', 'description' => 'Boîte de conserve de pois chiches cuits 400g'],
            ['nom' => 'Lentilles vertes', 'description' => 'Sachet de lentilles vertes du Puy 500g'],
            ['nom' => 'Haricots verts', 'description' => 'Boîte de haricots verts fins extra 400g'],
            ['nom' => 'Petits pois carottes', 'description' => 'Boîte de petits pois et carottes fondantes 400g'],
            ['nom' => 'Champignons de Paris', 'description' => 'Boîte de champignons émincés 400g'],
            ['nom' => 'Olives vertes', 'description' => 'Bocal d’olives vertes denoyautées 200g'],
            ['nom' => 'Cornichons', 'description' => 'Bocal de cornichons croquants au vinaigre 250g'],
            ['nom' => 'Chips paprika', 'description' => 'Sachet de chips saveur paprika 150g'],
            ['nom' => 'Cacahuètes salées', 'description' => 'Sachet de cacahuètes grillées et salées 250g'],
            ['nom' => 'Noix de cajou', 'description' => 'Sachet de noix de cajou grillées à sec 125g'],
            ['nom' => 'Barres de céréales', 'description' => 'Boîte de 6 barres chocolat et avoine'],
            ['nom' => 'Compote pomme-poire', 'description' => 'Gourdes compote pomme-poire x4'],
            ['nom' => 'Galettes de riz', 'description' => 'Paquet de galettes de riz soufflé nature 150g'],
            ['nom' => 'Papier toilette', 'description' => 'Paquet de 6 rouleaux ouate de cellulose'],
            ['nom' => 'Essuie-tout', 'description' => 'Lot de 3 rouleaux essuie-tout décorés'],
            ['nom' => 'Liquide vaisselle', 'description' => 'Flacon liquide vaisselle main citron 750ml'],
            ['nom' => 'Lessive liquide', 'description' => 'Bidon de lessive linge sensible 1.5L'],
            ['nom' => 'Adoucissant', 'description' => 'Bouteille d’adoucissant fraîcheur 1L'],
            ['nom' => 'Sacs poubelle', 'description' => 'Rouleau de 30 sacs poubelle 30L liens coulissants'],
            ['nom' => 'Éponges végétales', 'description' => 'Lot de 4 éponges grattons grattantes'],
            ['nom' => 'Gel douche', 'description' => 'Flacon gel douche corps et cheveux 250ml'],
            ['nom' => 'Shampoing doux', 'description' => 'Flacon de shampoing usage frequent 400ml'],
            ['nom' => 'Savon mains', 'description' => 'Flacon pompe savon liquide hydratant 300ml'],
            ['nom' => 'Dentifrice total', 'description' => 'Tube de dentifrice protection menthe 75ml'],
            ['nom' => 'Papier alu', 'description' => 'Rouleau de papier aluminium ménager 10m'],
            ['nom' => 'Film étirable', 'description' => 'Rouleau film étirable alimentaire 20m'],
            ['nom' => 'Sacs congélation', 'description' => 'Boîte de 40 sacs de congélation 3L'],
            ['nom' => 'Papier cuisson', 'description' => 'Rouleau de papier sulfurisé anti-adhérent'],
            ['nom' => 'Café en grains', 'description' => 'Paquet de café en grains 100% Arabica 1kg'],
            ['nom' => 'Chocolat en poudre', 'description' => 'Boîte de cacao soluble pour petit déjeuner 500g'],
            ['nom' => 'Confiture de fraise', 'description' => 'Pot de confiture extra de fraises 370g'],
            ['nom' => 'Miel de fleurs', 'description' => 'Pot de miel liquide toutes fleurs 500g'],
            ['nom' => 'Pâte à tarte brisée', 'description' => 'Pâte brisée pur beurre prête à dérouler 230g'],
            ['nom' => 'Pâte feuilletée', 'description' => 'Pâte feuilletée pur beurre prête à dérouler 230g'],
            ['nom' => 'Gnocchis à poêler', 'description' => 'Sachet de gnocchis frais au froment 400g'],
            ['nom' => 'Tortellonis', 'description' => 'Pâtes fraîches farcies ricotta épinards 250g'],
            ['nom' => 'Quiche Lorraine', 'description' => 'Quiche lorraine fraîche prête à réchauffer 400g'],
            ['nom' => 'Croque-monsieur', 'description' => 'Pack de 2 croque-monsieur jambon emmental 200g'],
            ['nom' => 'Nuggets de poulet', 'description' => 'Boîte de 16 nuggets de poulet panés 400g'],
            ['nom' => 'Frites surgelées', 'description' => 'Sachet de frites croustillantes pour four 1kg'],
            ['nom' => 'Haricots blancs', 'description' => 'Boîte de conserve de haricots blancs cuisinés 400g'],
            ['nom' => 'Concentré de tomate', 'description' => 'Boîte de concentré de tomate double 140g'],
            ['nom' => 'Vinaigre de cidre', 'description' => 'Bouteille de vinaigre de cidre brut 75cl'],
        ];

        // On prend l'élément correspondant à l'index actuel, puis on incrémente
        $item = $catalogue100[self::$index % count($catalogue100)];
        self::$index++;

        return [
            'nom' => $item['nom'],
            'reference' => 'ART-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $item['description'],
            'categorie' => 'À définir',
        ];
    }
}
