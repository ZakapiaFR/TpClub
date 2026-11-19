<?php

namespace App\DataFixtures;

use App\Entity\Athlete;
use App\Entity\Famille;
use App\Entity\Profil;
use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Initialisation de Faker en français
        $faker = Factory::create('fr_FR');

        // 1. Génération de 10 Familles
        $familles = [];
        for ($i = 0; $i < 10; $i++) {
            $famille = new Famille();
            $famille->setNom($faker->unique()->word());

            $manager->persist($famille);
            $familles[] = $famille;
        }

        // 2. Génération de 50 Sports (affectés chacun à une famille tirée au sort)
        $sports = [];
        for ($i = 0; $i < 50; $i++) {
            $sport = new Sport();
            $sport->setNom($faker->unique()->words(2, true));
            $sport->setLogo('https://picsum.photos/200?image=' . $faker->numberBetween(100, 300));
            $sport->setDescription($faker->text(200));
            $sport->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now')));
            
            // Tirage au sort d'une famille parmi les 10 créées
            $sport->setFamille($faker->randomElement($familles));

            $manager->persist($sport);
            $sports[] = $sport;
        }

        // 3. Génération de 30 Athlètes et 15 Profils (1 athlète sur 2)
        for ($i = 0; $i < 30; $i++) {
            $athlete = new Athlete();
            
            // Gestion cohérente du sexe et du prénom
            $sexe = $faker->randomElement(['M', 'F']);
            $prenom = ($sexe === 'M') ? $faker->firstNameMale() : $faker->firstNameFemale();

            $createdAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', '-1 month'));
            $updatedAt = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween($createdAt->format('Y-m-d H:i:s'), 'now'));

            $athlete->setNom($faker->lastName());
            $athlete->setPrenom($prenom);
            $athlete->setDtn($faker->dateTimeBetween('-40 years', '-16 years'));
            $athlete->setSexe($sexe);
            $athlete->setEmail($faker->unique()->safeEmail());
            $athlete->setTph($faker->phoneNumber());
            $athlete->setNationalite($faker->country());
            $athlete->setCreatedAt($createdAt);
            $athlete->setUpdatedAt($updatedAt);

            // Affectation de 2 sports distincts tirés au sort
            $sportsChoisis = $faker->randomElements($sports, 2);
            foreach ($sportsChoisis as $sportChoisi) {
                $athlete->addSport($sportChoisi);
            }

            // Affectation d'un profil à un athlète sur deux (soit 15 profils au total)
            if ($i % 2 === 0) {
                $profil = new Profil();
                $profil->setImage('https://picsum.photos/200?image=' . $faker->numberBetween(100, 300));
                $profil->setDescription($faker->text(200));
                $profil->setCompteInstagram('@' . $faker->userName());
                $profil->setCreatedAt($createdAt);
                $profil->setUpdatedAt($updatedAt);

                $manager->persist($profil);
                $athlete->setProfil($profil);
            }

            $manager->persist($athlete);
        }

        // Envoi de toutes les requêtes SQL en base de données
        $manager->flush();
    }
}
