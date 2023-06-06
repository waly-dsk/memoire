<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        DB::table('entites')->insert([
            ['id' => 1,  'intitule' => 'Agronomie'],
            ['id' => 2,  'intitule' => 'ENATSE'],
            ['id' => 3,  'intitule' => 'ENSPD'],
            ['id' => 4,  'intitule' => 'FASEG'],
            ['id' => 5,  'intitule' => 'FDSP'],
            ['id' => 6,  'intitule' => 'FLASH'],
            ['id' => 7,  'intitule' => 'IFSIO'],
            ['id' => 8,  'intitule' => 'IUT'],
            ['id' => 9,  'intitule' => 'Medécine'],
        ]);

        DB::table('options')->insert([
            ['intitule' => 'Production Animale', 'entite_id' => 1],
            ['intitule' => 'Production Végétale', 'entite_id' => 1],
            ['intitule' => 'Option 1', 'entite_id' => 2],
            ['intitule' => 'Option 2', 'entite_id' => 2],
            ['intitule' => 'Plannification', 'entite_id' => 3],
            ['intitule' => 'Statistiques', 'entite_id' => 3],
            ['intitule' => 'Economie', 'entite_id' => 4],
            ['intitule' => 'Gestion', 'entite_id' => 4],
            ['intitule' => 'Droit Privé', 'entite_id' => 5],
            ['intitule' => 'Droit Public', 'entite_id' => 5],
            ['intitule' => 'Sciences Politiques', 'entite_id' => 5],
            ['intitule' => 'Anglais', 'entite_id' => 6],
            ['intitule' => 'Allemand', 'entite_id' => 6],
            ['intitule' => 'Espagnol', 'entite_id' => 6],
            ['intitule' => 'Lettres Modernes', 'entite_id' => 6],
            ['intitule' => 'Infirmerie', 'entite_id' => 7],
            ['intitule' => 'Sage-Femme', 'entite_id' => 7],
            ['intitule' => 'Gestion des Ressources Humaines', 'entite_id' => 8],
            ['intitule' => 'Gestion des Transports et Logistiques', 'entite_id' => 8],
            ['intitule' => 'Gestion des Entreprises', 'entite_id' => 8],
            ['intitule' => 'Gestion Commerciale', 'entite_id' => 8],
            ['intitule' => 'Gestion des Banques', 'entite_id' => 8],
            ['intitule' => 'Informatique de Gestion', 'entite_id' => 8],
            ['intitule' => 'Medecine Générale', 'entite_id' => 9],
        ]);
    }
}
