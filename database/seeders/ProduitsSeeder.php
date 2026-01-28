<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class ProduitsSeeder extends Seeder
{
    public function run(): void
    {
        // Vider la table avant d'insérer
        DB::table('produits')->truncate();

        // Produits pour chiens
        $produits = [
            [
                'nom' => 'Croquettes Premium Chien',
                'description' => 'Croquettes sans céréales riches en protéines pour chiens adultes',
                'prix' => 59.99,
                'categorie' => 'chiens',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.l%2bSU%2bxg%2b5KErLg474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Friandises Dentaires',
                'description' => 'Friandises qui nettoient les dents et rafraîchissent l\'haleine',
                'prix' => 120.50,
                'categorie' => 'chiens',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.4Cc-_XrF7B0lRmRU0VjkjgHaHa?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 100,
            ],
            [
                'nom' => 'Jouet Interactif',
                'description' => 'Jouet qui stimule l\'intelligence de votre chien',
                'prix' => 180.99,
                'categorie' => 'chiens',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.cNWTovZIR%2bKldA474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 30,
            ],
            [
                'nom' => 'Harnais de Promenade',
                'description' => 'Harnais confortable et réglable pour promenades',
                'prix' => 320.99,
                'categorie' => 'chiens',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.rwNGiShj03_5oM7AC5_nLAHaHW?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 25,
            ],
            [
                'nom' => 'Panier Confortable',
                'description' => 'Panier douillet pour le repos de votre chien',
                'prix' => 450.99,
                'categorie' => 'chiens',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.m4SaJl6GKOsAkw474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 15,
            ],

            // Produits pour chats
            [
                'nom' => 'Pâtée Chat au Saumon',
                'description' => 'Pâtée délicieuse au saumon et légumes frais',
                'prix' => 180.99,
                'categorie' => 'chats',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.LCkoU0zElU%2bIeg474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 60,
            ],
            [
                'nom' => 'Arbre à Chat 120cm',
                'description' => 'Arbre à chat avec plateformes et griffoir',
                'prix' => 890.99,
                'categorie' => 'chats',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.0yHp8us0YWi66g474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 10,
            ],
            [
                'nom' => 'Jouet à Plumes',
                'description' => 'Canne à pêche avec plume pour jouer avec votre chat',
                'prix' => 90.99,
                'categorie' => 'chats',
                'image' => 'https://tse3.mm.bing.net/th/id/OIP.62R_j9W1H1djCKGHA5x9vAHaHa?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 40,
            ],
            [
                'nom' => 'Litière Aglomérante',
                'description' => 'Litière végétale agglomérante et sans poussière',
                'prix' => 220.50,
                'categorie' => 'chats',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.1_3LHvndfBq70qm24es1JgHaHa?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 35,
            ],
            [
                'nom' => 'Transporteur Chat',
                'description' => 'Transporteur confortable et aéré pour voyages',
                'prix' => 550.99,
                'categorie' => 'chats',
                'image' => 'https://tse1.mm.bing.net/th/id/OIP.zhBFcHpGejqRkOnj9uQffAHaGv?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 12,
            ],

            // Produits pour oiseaux
            [
                'nom' => 'Graines pour Canaris',
                'description' => 'Mélange de graines premium pour canaris',
                'prix' => 80.99,
                'categorie' => 'oiseaux',
                'image' => 'https://tse3.mm.bing.net/th/id/OIP.fw7hVv2N8HNuyberFldOkQHaHa?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 45,
            ],
            [
                'nom' => 'Cage pour Oiseaux',
                'description' => 'Cage spacieuse avec accessoires inclus',
                'prix' => 750.99,
                'categorie' => 'oiseaux',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.0cXBJoZjj2zRhw474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 8,
            ],
            [
                'nom' => 'Jouets pour Perruches',
                'description' => 'Set de jouets colorés pour perruches',
                'prix' => 140.99,
                'categorie' => 'oiseaux',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.AEo_loAbRAMM2BjY5onsbQHaJZ?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 25,
            ],

            // Produits pour rongeurs
            [
                'nom' => 'Nourriture Hamster',
                'description' => 'Aliment complet pour hamsters et gerbilles',
                'prix' => 70.99,
                'categorie' => 'rongeurs',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.S06pH0mP%2fzBa%2bA474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 55,
            ],
            [
                'nom' => 'Cage pour Hamster',
                'description' => 'Cage avec roue, tunnels et accessoires',
                'prix' => 420.99,
                'categorie' => 'rongeurs',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.x%2bODPD5ct2JOCw474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 15,
            ],
            [
                'nom' => 'Litière pour Rongeurs',
                'description' => 'Litière absorbante et douce',
                'prix' => 60.50,
                'categorie' => 'rongeurs',
                'image' => 'https://tse3.mm.bing.net/th/id/OIP.mlqAVcNuH_E90K2UI6fhHwHaHa?pid=Api&P=0&h=180',
                'en_stock' => true,
                'quantite' => 30,
            ],

            // Produits pour poissons
            [
                'nom' => 'Nourriture pour Poissons',
                'description' => 'Flocons équilibrés pour poissons tropicaux',
                'prix' => 110.99,
                'categorie' => 'poissons',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.XQ%2fbIO4SL1Jriw474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 40,
            ],
            [
                'nom' => 'Aquarium 60L',
                'description' => 'Aquarium complet avec filtre et éclairage',
                'prix' => 1200.99,
                'categorie' => 'poissons',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.%2fDrl4D8YUl1YoQ474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 6,
            ],
            [
                'nom' => 'Décor Aquarium',
                'description' => 'Roches et plantes artificielles pour aquarium',
                'prix' => 240.99,
                'categorie' => 'poissons',
                'image' => 'https://sp.yimg.com/ib/th?id=OPEC.MHx6RWx3SP7U7g474C474&o=5&pid=21.1&w=160&h=105',
                'en_stock' => true,
                'quantite' => 18,
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}