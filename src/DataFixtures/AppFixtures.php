<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setTitle($faker->word);
            $product->setDescription($faker->realText($maxNbChars = 250));
            $product->setImage($i. '.jpg');
            $product->setPrice(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}