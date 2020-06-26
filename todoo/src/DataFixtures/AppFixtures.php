<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $passwordEncoder;



    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager )
    {
        // $product = new Product();
        // $manager->persist($product);



        $manager->flush();


    }
}
