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

        DB::table('type_suggestions')->insert([
            ['id' => 1, 'intitule' => 'Cadre'],
            ['id' => 2, 'intitule' => 'Equipements'],
            ['id' => 3, 'intitule' => 'Technologie'],
            ['id' => 4, 'intitule' => 'Autres'],
        ]);

        DB::table('type_documents')->insert([
            ['id' => 1, 'intitule' => 'Mémoire de Licence'],
            ['id' => 2, 'intitule' => 'Mémoire de Master'],
            ['id' => 3, 'intitule' => 'Doctorat en  Médecine'],
            ['id' => 4, 'intitule' => 'Thèse PHD'],
        ]);


        DB::table('type_abonnes')->insert([
            ['id' => 1, 'nom' => 'Etudiant'],
            ['id' => 2, 'nom' => 'Enseignant'],
            ['id' => 3, 'nom' => 'Personnel Administratif Technique et de Service (ATS)'],
        ]);

        DB::table('entites')->insert([
            ['id' => 1,  'intitule' => 'ENATSE'],
            ['id' => 2,  'intitule' => 'ENSPD'],
            ['id' => 3,  'intitule' => 'FA'],
            ['id' => 4,  'intitule' => 'FASEG'],
            ['id' => 5,  'intitule' => 'FDSP'],
            ['id' => 6,  'intitule' => 'FLASH'],
            ['id' => 7,  'intitule' => 'FM'],
            ['id' => 8,  'intitule' => 'IFSIO'],
            ['id' => 9,  'intitule' => 'IUT'],
        ]);

        DB::table('options')->insert([
            ['intitule' => 'Santé Publique et Surveillance Epidémiologique', 'entite_id' => 1],
            ['intitule' => 'Plannification', 'entite_id' => 2],
            ['intitule' => 'Statistiques', 'entite_id' => 2],
            ['intitule' => 'Production Animale', 'entite_id' => 3],
            ['intitule' => 'Production Végétale', 'entite_id' => 3],
            ['intitule' => 'Economie', 'entite_id' => 4],
            ['intitule' => 'Gestion', 'entite_id' => 4],
            ['intitule' => 'Droit Privé', 'entite_id' => 5],
            ['intitule' => 'Droit Public', 'entite_id' => 5],
            ['intitule' => 'Sciences Politiques', 'entite_id' => 5],
            ['intitule' => 'Anglais', 'entite_id' => 6],
            ['intitule' => 'Allemand', 'entite_id' => 6],
            ['intitule' => 'Espagnol', 'entite_id' => 6],
            ['intitule' => 'Lettres Modernes', 'entite_id' => 6],
            ['intitule' => 'Medecine Générale', 'entite_id' => 7],
            ['intitule' => 'Infirmerie', 'entite_id' => 8],
            ['intitule' => 'Sage-Femme', 'entite_id' => 8],
            ['intitule' => 'Gestion des Banques', 'entite_id' => 9],
            ['intitule' => 'Gestion Commerciale', 'entite_id' => 9],
            ['intitule' => 'Gestion des Entreprises', 'entite_id' => 9],
            ['intitule' => 'Gestion des Ressources Humaines', 'entite_id' => 9],
            ['intitule' => 'Gestion des Transports et Logistiques', 'entite_id' => 9],
            ['intitule' => 'Informatique de Gestion', 'entite_id' => 9],
        ]);

        DB::table('categories')->insert([
            ['id' => 1, 'classe' => '000', 'intitule' => 'Informatique, information et ouvrages généraux'],
            ['id' => 2, 'classe' => '100', 'intitule' => 'Philosophie et Psychologie'],
            ['id' => 3, 'classe' => '200', 'intitule' => 'Religion'],
            ['id' => 4, 'classe' => '300', 'intitule' => 'Sciences Sociales'],
            ['id' => 5, 'classe' => '400', 'intitule' => 'Langues'],
            ['id' => 6, 'classe' => '500', 'intitule' => 'Sciences'],
            ['id' => 7, 'classe' => '600', 'intitule' => 'Technologie'],
            ['id' => 8, 'classe' => '700', 'intitule' => 'Arts et Loisirs'],
            ['id' => 9, 'classe' => '800', 'intitule' => 'Littérature'],
            ['id' => 10, 'classe' => '900', 'intitule' => 'Histoire et Géographie'],
        ]);

        DB::table('divisions')->insert([
            ['classe' => '000', 'intitule' => 'Informatique', 'category_id' => 1],
            ['classe' => '010', 'intitule' => 'Bibliographies', 'category_id' => 1],
            ['classe' => '020', 'intitule' => 'Bibliothéconomie et sciences de l’information', 'category_id' => 1],
            ['classe' => '030', 'intitule' => 'Encyclopédies et livres de renseignements', 'category_id' => 1],
            ['classe' => '050', 'intitule' => 'Magazines, journaux et publications en série', 'category_id' => 1],
            ['classe' => '060', 'intitule' => 'Associations, organisations et musées', 'category_id' => 1],
            ['classe' => '070', 'intitule' => 'Médias d’information, journalisme, édition', 'category_id' => 1],
            ['classe' => '080', 'intitule' => 'Citations', 'category_id' => 1],
            ['classe' => '090', 'intitule' => 'Manuscrits et livres rares', 'category_id' => 1],

            ['classe' => '100', 'intitule' => 'Ouvrages généraux', 'category_id' => 2],
            ['classe' => '110', 'intitule' => 'Métaphysique', 'category_id' => 2],
            ['classe' => '120', 'intitule' => 'Épistémologie', 'category_id' => 2],
            ['classe' => '130', 'intitule' => 'Parapsychologie et occultisme', 'category_id' => 2],
            ['classe' => '140', 'intitule' => 'Écoles de pensée philosophiques', 'category_id' => 2],
            ['classe' => '150', 'intitule' => 'Psychologie', 'category_id' => 2],
            ['classe' => '160', 'intitule' => 'Logique', 'category_id' => 2],
            ['classe' => '170', 'intitule' => 'Morale', 'category_id' => 2],
            ['classe' => '180', 'intitule' => 'Philosophie ancienne, médiévale, orientale', 'category_id' => 2],
            ['classe' => '190', 'intitule' => 'Philosophie occidentale moderne', 'category_id' => 2],


            ['classe' => '200', 'intitule' => 'Ouvrages généraux', 'category_id' => 3],
            ['classe' => '210', 'intitule' => 'Philosophie et théorie de la religion', 'category_id' => 3],
            ['classe' => '220', 'intitule' => 'La Bible', 'category_id' => 3],
            ['classe' => '230', 'intitule' => 'Christianisme et théologie chrétienne', 'category_id' => 3],
            ['classe' => '240', 'intitule' => 'Pratique et observances chrétiennes', 'category_id' => 3],
            ['classe' => '250', 'intitule' => 'Pratiques pastorales chrétiennes et ordres religieux', 'category_id' => 3],
            ['classe' => '260', 'intitule' => 'Organisation chrétienne, travail social et culte', 'category_id' => 3],
            ['classe' => '270', 'intitule' => 'Histoire du christianisme', 'category_id' => 3],
            ['classe' => '280', 'intitule' => 'Confessions chrétiennes', 'category_id' => 3],
            ['classe' => '290', 'intitule' => 'Autres religions', 'category_id' => 3],

            ['classe' => '300', 'intitule' => 'Ouvrages généraux', 'category_id' => 4],
            ['classe' => '310', 'intitule' => 'Statistiques', 'category_id' => 4],
            ['classe' => '320', 'intitule' => 'Science politique', 'category_id' => 4],
            ['classe' => '330', 'intitule' => 'Économie', 'category_id' => 4],
            ['classe' => '340', 'intitule' => 'Droit', 'category_id' => 4],
            ['classe' => '350', 'intitule' => 'Administration publique et science militaire', 'category_id' => 4],
            ['classe' => '360', 'intitule' => 'Problèmes et services sociaux', 'category_id' => 4],
            ['classe' => '370', 'intitule' => 'Éducation', 'category_id' => 4],
            ['classe' => '380', 'intitule' => 'Commerce, communications et transports', 'category_id' => 4],
            ['classe' => '390', 'intitule' => 'Coutumes, étiquette et folklore', 'category_id' => 4],

            ['classe' => '400', 'intitule' => 'Ouvrages généraux', 'category_id' => 5],
            ['classe' => '410', 'intitule' => 'Linguistique', 'category_id' => 5],
            ['classe' => '420', 'intitule' => 'Anglais et vieil anglais', 'category_id' => 5],
            ['classe' => '430', 'intitule' => 'Allemand et langues germaniques', 'category_id' => 5],
            ['classe' => '440', 'intitule' => 'Français et langues romanes', 'category_id' => 5],
            ['classe' => '450', 'intitule' => 'Italien et roumain', 'category_id' => 5],
            ['classe' => '460', 'intitule' => 'Espagnol et portugais', 'category_id' => 5],
            ['classe' => '470', 'intitule' => 'Latin et langues italiques', 'category_id' => 5],
            ['classe' => '480', 'intitule' => 'Grec classique et moderne', 'category_id' => 5],
            ['classe' => '490', 'intitule' => 'Autres langues', 'category_id' => 5],

            ['classe' => '500', 'intitule' => 'Ouvrages généraux', 'category_id' => 6],
            ['classe' => '510', 'intitule' => 'Mathématiques', 'category_id' => 6],
            ['classe' => '520', 'intitule' => 'Astronomie', 'category_id' => 6],
            ['classe' => '530', 'intitule' => 'Physique', 'category_id' => 6],
            ['classe' => '540', 'intitule' => 'Chimie', 'category_id' => 6],
            ['classe' => '550', 'intitule' => 'Sciences de la Terre et géologie', 'category_id' => 6],
            ['classe' => '560', 'intitule' => 'Fossiles et vie préhistorique', 'category_id' => 6],
            ['classe' => '570', 'intitule' => 'Sciences de la vie ; biologie', 'category_id' => 6],
            ['classe' => '580', 'intitule' => 'Plantes (Botanique)', 'category_id' => 6],
            ['classe' => '590', 'intitule' => 'Animaux (Zoologie)', 'category_id' => 6],

            ['classe' => '600', 'intitule' => 'Ouvrages généraux', 'category_id' => 7],
            ['classe' => '610', 'intitule' => 'Médecine et santé', 'category_id' => 7],
            ['classe' => '620', 'intitule' => 'Ingénierie', 'category_id' => 7],
            ['classe' => '630', 'intitule' => 'Agriculture', 'category_id' => 7],
            ['classe' => '640', 'intitule' => 'Gestion de la vie familiale', 'category_id' => 7],
            ['classe' => '650', 'intitule' => 'Gestion et relations publiques', 'category_id' => 7],
            ['classe' => '660', 'intitule' => 'Génie chimique', 'category_id' => 7],
            ['classe' => '670', 'intitule' => 'Fabrication industrielle', 'category_id' => 7],
            ['classe' => '680', 'intitule' => 'Fabrications de produits à usages particuliers', 'category_id' => 7],
            ['classe' => '690', 'intitule' => 'Bâtiments et construction', 'category_id' => 7],

            ['classe' => '700', 'intitule' => 'Ouvrages généraux', 'category_id' => 8],
            ['classe' => '710', 'intitule' => 'Art du paysage et urbanisme', 'category_id' => 8],
            ['classe' => '720', 'intitule' => 'Architecture', 'category_id' => 8],
            ['classe' => '730', 'intitule' => 'Sculpture, céramique et ferronnerie', 'category_id' => 8],
            ['classe' => '740', 'intitule' => 'Dessin et arts décoratifs', 'category_id' => 8],
            ['classe' => '750', 'intitule' => 'Peinture', 'category_id' => 8],
            ['classe' => '760', 'intitule' => 'Arts graphiques', 'category_id' => 8],
            ['classe' => '770', 'intitule' => 'Photographie et art par ordinateur', 'category_id' => 8],
            ['classe' => '780', 'intitule' => 'Musique', 'category_id' => 8],
            ['classe' => '790', 'intitule' => 'Sports, jeux et divertissement', 'category_id' => 8],

            ['classe' => '800', 'intitule' => 'Littérature', 'category_id' => 9],
            ['classe' => '810', 'intitule' => 'Littérature américaine en anglais', 'category_id' => 9],
            ['classe' => '820', 'intitule' => 'Littératures anglaise et du vieil anglais', 'category_id' => 9],
            ['classe' => '830', 'intitule' => 'Littératures allemande et des langues germaniques', 'category_id' => 9],
            ['classe' => '840', 'intitule' => 'Littératures française et des langues romanes', 'category_id' => 9],
            ['classe' => 'C840', 'intitule' => 'Littérature canadienne et québécoise', 'category_id' => 9],
            ['classe' => '850', 'intitule' => 'Littératures italienne et roumaine', 'category_id' => 9],
            ['classe' => '860', 'intitule' => 'Littératures espagnole et portugaise', 'category_id' => 9],
            ['classe' => '870', 'intitule' => 'Littératures latines et italiques', 'category_id' => 9],
            ['classe' => '880', 'intitule' => 'Littératures grecques classique et moderne', 'category_id' => 9],
            ['classe' => '890', 'intitule' => 'Autres littératures', 'category_id' => 9],

            ['classe' => '900', 'intitule' => 'Ouvrages généraux', 'category_id' => 10],
            ['classe' => '910', 'intitule' => 'Géographie et voyages', 'category_id' => 10],
            ['classe' => '920', 'intitule' => 'Biographie et généalogie', 'category_id' => 10],
            ['classe' => '930', 'intitule' => 'Histoire du monde antique (jusque vers 499)', 'category_id' => 10],
            ['classe' => '940', 'intitule' => 'Histoire de l’Europe', 'category_id' => 10],
            ['classe' => '950', 'intitule' => 'Histoire de l’Asie', 'category_id' => 10],
            ['classe' => '960', 'intitule' => 'Histoire de l’Afrique', 'category_id' => 10],
            ['classe' => '970', 'intitule' => 'Histoire de l’Amérique du Nord', 'category_id' => 10],
            ['classe' => '980', 'intitule' => 'Histoire de l’Amérique du Sud', 'category_id' => 10],
            ['classe' => '990', 'intitule' => 'Histoire des autres régions du monde', 'category_id' => 10],
        ]);


        DB::table('rayons')->insert([
            ['id' => 1, 'nom' => 'R-0-0-01', 'created_at' => now()],
            ['id' => 2, 'nom' => 'R-0-0-02', 'created_at' => now()],
            ['id' => 3, 'nom' => 'R-0-0-03', 'created_at' => now()],
            ['id' => 4, 'nom' => 'R-0-0-04', 'created_at' => now()],
        ]);

        // Code pour enregistrer 5 loges par rayon

        $rayons = DB::table('rayons')->get(); // Récupérer tous les rayons

        foreach ($rayons as $rayon) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('loges')->insert([
                    'rayon_id' => $rayon->id,
                    'nom' => $rayon->nom . ' / Loge ' . $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        $livres = [
            ['loge_id' => 1, 'division_id' => 1, 'cote' => 'A001', 'auteur' => 'John Doe', 'titre' => 'Le Seigneur des Anneaux'],
            ['loge_id' => 2, 'division_id' => 2, 'cote' => 'A002', 'auteur' => 'Jane Smith', 'titre' => 'Harry Potter à l\'école des sorciers'],
            ['loge_id' => 3, 'division_id' => 1, 'cote' => 'A003', 'auteur' => 'James Johnson', 'titre' => '1984'],
            ['loge_id' => 1, 'division_id' => 2, 'cote' => 'A004', 'auteur' => 'Emily Davis', 'titre' => 'Pride and Prejudice'],
            ['loge_id' => 2, 'division_id' => 1, 'cote' => 'A005', 'auteur' => 'Michael Wilson', 'titre' => 'Le Petit Prince'],
            ['loge_id' => 3, 'division_id' => 2, 'cote' => 'A006', 'auteur' => 'Sarah Thompson', 'titre' => 'To Kill a Mockingbird'],
            ['loge_id' => 1, 'division_id' => 1, 'cote' => 'A007', 'auteur' => 'David Anderson', 'titre' => 'Le Comte de Monte-Cristo'],
            ['loge_id' => 2, 'division_id' => 2, 'cote' => 'A008', 'auteur' => 'Olivia Lee', 'titre' => 'Guerre et Paix'],
            ['loge_id' => 3, 'division_id' => 1, 'cote' => 'A009', 'auteur' => 'William Turner', 'titre' => 'L\'Odyssée'],
            ['loge_id' => 1, 'division_id' => 2, 'cote' => 'A010', 'auteur' => 'Sophia Garcia', 'titre' => 'Les Misérables'],
            ['loge_id' => 1, 'division_id' => 10, 'cote' => 'PHI001', 'auteur' => 'René Descartes', 'titre' => 'Méditations métaphysiques'],
            ['loge_id' => 2, 'division_id' => 10, 'cote' => 'PHI002', 'auteur' => 'Friedrich Nietzsche', 'titre' => 'Ainsi parlait Zarathoustra'],
            ['loge_id' => 3, 'division_id' => 10, 'cote' => 'PHI003', 'auteur' => 'Platon', 'titre' => 'La République'],
            ['loge_id' => 1, 'division_id' => 10, 'cote' => 'PHI004', 'auteur' => 'Jean-Paul Sartre', 'titre' => 'L\'Être et le Néant'],
            ['loge_id' => 2, 'division_id' => 10, 'cote' => 'PHI005', 'auteur' => 'Aristote', 'titre' => 'Éthique à Nicomaque'],
            ['loge_id' => 3, 'division_id' => 10, 'cote' => 'PHI006', 'auteur' => 'Immanuel Kant', 'titre' => 'Critique de la raison pure'],
            ['loge_id' => 1, 'division_id' => 10, 'cote' => 'PHI007', 'auteur' => 'Martin Heidegger', 'titre' => 'Être et Temps'],
            ['loge_id' => 2, 'division_id' => 10, 'cote' => 'PHI008', 'auteur' => 'Michel Foucault', 'titre' => 'Surveiller et Punir'],
            ['loge_id' => 3, 'division_id' => 10, 'cote' => 'PHI009', 'auteur' => 'Simone de Beauvoir', 'titre' => 'Le Deuxième Sexe'],
            ['loge_id' => 1, 'division_id' => 10, 'cote' => 'PHI010', 'auteur' => 'John Locke', 'titre' => 'Essai philosophique concernant l\'entendement humain'],

        ];

        DB::table('livre_imprimes')->insert($livres);
        $livreIds = DB::table('livre_imprimes')->get();

        foreach ($livreIds as $livre) {
            // Boucle pour enregistrer 5 exemplaires pour chaque livre
            for ($i = 1; $i <= 5; $i++) {
                DB::table('livre_imprime_exemplaires')->insert([
                    'livre_imprime_id' => $livre->id,
                    'statut' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
