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
            ['nom' => 'Pain de mie', 'description' => 'Pain de mie tranché nature 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Nutella', 'description' => 'Pâte à tartiner aux noisettes pot 750g', 'categorie' => 'Épicerie'],
            ['nom' => 'Yogourt chocolat', 'description' => 'Yaourt onctueux saveur chocolat x4', 'categorie' => 'Produits frais'],
            ['nom' => 'Yogourt fraise', 'description' => 'Yaourt aux fruits morceaux de fraise x4', 'categorie' => 'Produits frais'],
            ['nom' => 'Lait demi-écrémé', 'description' => 'Bouteille de lait UHT 1L', 'categorie' => 'Produits frais'],
            ['nom' => 'Beurre doux', 'description' => 'Plaque de beurre doux 250g', 'categorie' => 'Produits frais'],
            ['nom' => 'Jus d’orange', 'description' => 'Jus d’orange 100% pur jus 1L', 'categorie' => 'Boissons'],
            ['nom' => 'Café moulu', 'description' => 'Paquet de café arabica moulu 250g', 'categorie' => 'Épicerie'],
            ['nom' => 'Farine de blé', 'description' => 'Farine de blé type 55 sac 1kg', 'categorie' => 'Épicerie'],
            ['nom' => 'Sucre en poudre', 'description' => 'Sucre blanc cristallisé 1kg', 'categorie' => 'Épicerie'],
            ['nom' => 'Huile de tournesol', 'description' => 'Bouteille d’huile de tournesol 1L', 'categorie' => 'Épicerie'],
            ['nom' => 'Pâtes Coquillettes', 'description' => 'Paquet de pâtes de blé dur 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Riz basmati', 'description' => 'Riz basmati parfumé sachet 1kg', 'categorie' => 'Épicerie'],
            ['nom' => 'Biscuits chocolat', 'description' => 'Paquet de biscuits aux pépites de chocolat', 'categorie' => 'Épicerie'],
            ['nom' => 'Compote de pommes', 'description' => 'Gourdes de compote de pommes x4', 'categorie' => 'Épicerie'],
            ['nom' => 'Eau minérale', 'description' => 'Pack de 6 bouteilles d’eau 1.5L', 'categorie' => 'Boissons'],
            ['nom' => 'Céréales Chocapic', 'description' => 'Paquet de céréales au chocolat 450g', 'categorie' => 'Épicerie'],
            ['nom' => 'Emmental râpé', 'description' => 'Sachet d’emmental râpé 200g', 'categorie' => 'Produits frais'],
            ['nom' => 'Jambon blanc', 'description' => 'Tranches de jambon cuit supérieur x4', 'categorie' => 'Produits frais'],
            ['nom' => 'Chips nature', 'description' => 'Sachet de chips de pommes de terre 300g', 'categorie' => 'Épicerie'],
            ['nom' => 'Steak haché', 'description' => 'Barquette de steaks hachés pur bœuf x2', 'categorie' => 'Produits frais'],
            ['nom' => 'Saumon fumé', 'description' => 'Tranches de saumon fumé de Norvège 4 tranches', 'categorie' => 'Produits frais'],
            ['nom' => 'Sodebo Box', 'description' => 'Salade César poulet croustillant 300g', 'categorie' => 'Produits frais'],
            ['nom' => 'Pizza Margherita', 'description' => 'Pizza surgelée base tomate mozzarella 400g', 'categorie' => 'Surgelés'],
            ['nom' => 'Glace vanille', 'description' => 'Bac de crème glacée parfum vanille 1L', 'categorie' => 'Surgelés'],
            ['nom' => 'Blancs de poulet', 'description' => 'Filets de poulet frais emballés 500g', 'categorie' => 'Produits frais'],
            ['nom' => 'Oeufs frais', 'description' => 'Boîte de 12 œufs de poules élevées en plein air', 'categorie' => 'Produits frais'],
            ['nom' => 'Tortillas', 'description' => 'Galettes de blé pour fajitas x6', 'categorie' => 'Épicerie'],
            ['nom' => 'Sauce Tomate', 'description' => 'Coulis de tomate cuisiné aux herbes 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Mayonnaise', 'description' => 'Tube de mayonnaise de Dijon 250g', 'categorie' => 'Épicerie'],
            ['nom' => 'Ketchup', 'description' => 'Bouteille souple de ketchup classique 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Moutarde forte', 'description' => 'Pot de moutarde forte de Dijon 200g', 'categorie' => 'Épicerie'],
            ['nom' => 'Vinaigre balsamique', 'description' => 'Bouteille de vinaigre balsamique de Modène 50cl', 'categorie' => 'Épicerie'],
            ['nom' => 'Tablette de chocolat noir', 'description' => 'Chocolat noir 70% cacao 100g', 'categorie' => 'Épicerie'],
            ['nom' => 'Bonbons Haribo', 'description' => 'Sachet de bonbons gélifiés mix 300g', 'categorie' => 'Épicerie'],
            ['nom' => 'Brioche tranchée', 'description' => 'Brioche pur beurre familiale 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Consolette de thon', 'description' => 'Boîte de thon entier au naturel 160g', 'categorie' => 'Épicerie'],
            ['nom' => 'Sardines à l’huile', 'description' => 'Boîte de sardines à l’huile d’olive 115g', 'categorie' => 'Épicerie'],
            ['nom' => 'Soupe de légumes', 'description' => 'Brique de velouté de 10 légumes 1L', 'categorie' => 'Épicerie'],
            ['nom' => 'Purée de pommes de terre', 'description' => 'Flocons de purée instantanée sachet 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Thé vert menthe', 'description' => 'Boîte de 25 sachets de thé vert menthe', 'categorie' => 'Boissons'],
            ['nom' => 'Infusion camomille', 'description' => 'Boîte de 20 sachets d’infusion apaisante', 'categorie' => 'Boissons'],
            ['nom' => 'Boisson énergisante', 'description' => 'Canette boisson énergisante 25cl', 'categorie' => 'Boissons'],
            ['nom' => 'Coca-Cola', 'description' => 'Bouteille de soda cola 1.5L', 'categorie' => 'Boissons'],
            ['nom' => 'Ice Tea pêche', 'description' => 'Boisson rafraîchissante au thé pêche 1.5L', 'categorie' => 'Boissons'],
            ['nom' => 'Sirop de grenadine', 'description' => 'Bouteille de sirop concentré 75cl', 'categorie' => 'Boissons'],
            ['nom' => 'Compote abricot', 'description' => 'Gourdes de compote abricot x4', 'categorie' => 'Épicerie'],
            ['nom' => 'Biscuits petit-beurre', 'description' => 'Paquet de biscuits traditionnels 200g', 'categorie' => 'Épicerie'],
            ['nom' => 'Madeleines longues', 'description' => 'Sachet de madeleines pur beurre x12', 'categorie' => 'Épicerie'],
            ['nom' => 'Croissants surgelés', 'description' => 'Lot de 6 croissants pur beurre à cuire', 'categorie' => 'Surgelés'],
            ['nom' => 'Pain de campagne', 'description' => 'Boule de pain de campagne tranchée 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Fromage de chèvre', 'description' => 'Bûchette de chèvre affinée 180g', 'categorie' => 'Produits frais'],
            ['nom' => 'Camembert de Normandie', 'description' => 'Boîte de camembert au lait cru 250g', 'categorie' => 'Produits frais'],
            ['nom' => 'Roquefort', 'description' => 'Portion de roquefort AOP 150g', 'categorie' => 'Produits frais'],
            ['nom' => 'Mozzarella', 'description' => 'Boule de mozzarella di Bufala 125g', 'categorie' => 'Produits frais'],
            ['nom' => 'Crème fraîche épaisse', 'description' => 'Pot de crème fraîche 30% MG 200g', 'categorie' => 'Produits frais'],
            ['nom' => 'Lait de coco', 'description' => 'Brique de lait de coco cuisine 400ml', 'categorie' => 'Épicerie'],
            ['nom' => 'Pois chiches', 'description' => 'Boîte de conserve de pois chiches cuits 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Lentilles vertes', 'description' => 'Sachet de lentilles vertes du Puy 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Haricots verts', 'description' => 'Boîte de haricots verts fins extra 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Petits pois carottes', 'description' => 'Boîte de petits pois et carottes fondantes 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Champignons de Paris', 'description' => 'Boîte de champignons émincés 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Olives vertes', 'description' => 'Bocal d’olives vertes denoyautées 200g', 'categorie' => 'Épicerie'],
            ['nom' => 'Cornichons', 'description' => 'Bocal de cornichons croquants au vinaigre 250g', 'categorie' => 'Épicerie'],
            ['nom' => 'Chips paprika', 'description' => 'Sachet de chips saveur paprika 150g', 'categorie' => 'Épicerie'],
            ['nom' => 'Cacahuètes salées', 'description' => 'Sachet de cacahuètes grillées et salées 250g', 'categorie' => 'Épicerie'],
            ['nom' => 'Noix de cajou', 'description' => 'Sachet de noix de cajou grillées à sec 125g', 'categorie' => 'Épicerie'],
            ['nom' => 'Barres de céréales', 'description' => 'Boîte de 6 barres chocolat et avoine', 'categorie' => 'Épicerie'],
            ['nom' => 'Compote pomme-poire', 'description' => 'Gourdes compote pomme-poire x4', 'categorie' => 'Épicerie'],
            ['nom' => 'Galettes de riz', 'description' => 'Paquet de galettes de riz soufflé nature 150g', 'categorie' => 'Épicerie'],
            ['nom' => 'Papier toilette', 'description' => 'Paquet de 6 rouleaux ouate de cellulose', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Essuie-tout', 'description' => 'Lot de 3 rouleaux essuie-tout décorés', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Liquide vaisselle', 'description' => 'Flacon liquide vaisselle main citron 750ml', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Lessive liquide', 'description' => 'Bidon de lessive linge sensible 1.5L', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Adoucissant', 'description' => 'Bouteille d’adoucissant fraîcheur 1L', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Sacs poubelle', 'description' => 'Rouleau de 30 sacs poubelle 30L liens coulissants', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Éponges végétales', 'description' => 'Lot de 4 éponges grattons grattantes', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Gel douche', 'description' => 'Flacon gel douche corps et cheveux 250ml', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Shampoing doux', 'description' => 'Flacon de shampoing usage frequent 400ml', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Savon mains', 'description' => 'Flacon pompe savon liquide hydratant 300ml', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Dentifrice total', 'description' => 'Tube de dentifrice protection menthe 75ml', 'categorie' => 'Entretien & Hygiène'],
            ['nom' => 'Papier alu', 'description' => 'Rouleau de papier aluminium ménager 10m', 'categorie' => 'Épicerie'],
            ['nom' => 'Film étirable', 'description' => 'Rouleau film étirable alimentaire 20m', 'categorie' => 'Épicerie'],
            ['nom' => 'Sacs congélation', 'description' => 'Boîte de 40 sacs de congélation 3L', 'categorie' => 'Épicerie'],
            ['nom' => 'Papier cuisson', 'description' => 'Rouleau de papier sulfurisé anti-adhérent', 'categorie' => 'Épicerie'],
            ['nom' => 'Café en grains', 'description' => 'Paquet de café en grains 100% Arabica 1kg', 'categorie' => 'Épicerie'],
            ['nom' => 'Chocolat en poudre', 'description' => 'Boîte de cacao soluble pour petit déjeuner 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Confiture de fraise', 'description' => 'Pot de confiture extra de fraises 370g', 'categorie' => 'Épicerie'],
            ['nom' => 'Miel de fleurs', 'description' => 'Pot de miel liquide toutes fleurs 500g', 'categorie' => 'Épicerie'],
            ['nom' => 'Pâte à tarte brisée', 'description' => 'Pâte brisée pur beurre prête à dérouler 230g', 'categorie' => 'Produits frais'],
            ['nom' => 'Pâte feuilletée', 'description' => 'Pâte feuilletée pur beurre prête à dérouler 230g', 'categorie' => 'Produits frais'],
            ['nom' => 'Gnocchis à poêler', 'description' => 'Sachet de gnocchis frais au froment 400g', 'categorie' => 'Produits frais'],
            ['nom' => 'Tortellonis', 'description' => 'Pâtes fraîches farcies ricotta épinards 250g', 'categorie' => 'Produits frais'],
            ['nom' => 'Quiche Lorraine', 'description' => 'Quiche lorraine fraîche prête à réchauffer 400g', 'categorie' => 'Produits frais'],
            ['nom' => 'Croque-monsieur', 'description' => 'Pack de 2 croque-monsieur jambon emmental 200g', 'categorie' => 'Produits frais'],
            ['nom' => 'Nuggets de poulet', 'description' => 'Boîte de 16 nuggets de poulet panés 400g', 'categorie' => 'Surgelés'],
            ['nom' => 'Frites surgelées', 'description' => 'Sachet de frites croustillantes pour four 1kg', 'categorie' => 'Surgelés'],
            ['nom' => 'Haricots blancs', 'description' => 'Boîte de conserve de haricots blancs cuisinés 400g', 'categorie' => 'Épicerie'],
            ['nom' => 'Concentré de tomate', 'description' => 'Boîte de concentré de tomate double 140g', 'categorie' => 'Épicerie'],
            ['nom' => 'Vinaigre de cidre', 'description' => 'Bouteille de vinaigre de cidre brut 75cl', 'categorie' => 'Épicerie'],
        ];

        // On prend l'élément correspondant à l'index actuel, puis on incrémente
        $item = $catalogue100[self::$index % count($catalogue100)];
        self::$index++;

        return [
            'nom' => $item['nom'],
            'reference' => 'ART-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $item['description'],
            'categorie' => $item['categorie'] ?? 'Divers',
        ];
    }
}
