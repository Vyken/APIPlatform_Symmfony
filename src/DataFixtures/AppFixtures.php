<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Film;
use App\Entity\Platform;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    //Fausses données pour un user, un admin, et des films
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
      
        $plainPassword = 'password';
        $user = (new User())
                ->setEmail('user@mail.fr');
        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        $admin = (new User())
            ->setEmail('admin@mail.fr')
            ->setRoles(['ROLE_ADMIN']);
        $plainPasswordAdmin = 'password';
        $admin->setPassword($this->passwordHasher->hashPassword($admin, $plainPasswordAdmin));

        $manager->persist($user);
        $manager->persist(($admin));

        $mvtitle = ["Avatar", "Le dernier samourai", "l'age de glace", "Avengers Endgame", "Hostel", "Le petit chaperon rouge", "Le bossu du vatican", "Pourquoi il est si tard", "La belle dormant aux bois"];
        $mvcat = ["Animation", "Horreur", "Action", "Science Fiction"];
        $date =["08-205","01-2015","05-2006","11-2012","03-2009","07-2018","09-2016","06-2011","10-2000"];
        $platf =["Disney Plus", "Netflix", "Prime Video", "Shadowz"];
        
        foreach($platf as $platfrm){
            $platfrm = (new Platform())
                ->setName($platfrm);

            $manager->persist($platfrm);
        }


       
        foreach($mvtitle as $titre) {
            $titre = (new Film())
                ->setName($titre)
                ->setCategory(rand($mvcat[]))
                ->setDateSortie($date[]); 

            $manager->persist($titre);
        }

  
            
       

        $manager->flush();
    }
}
