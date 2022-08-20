<?php

namespace App\DataFixtures;

use App\Entity\UserSQL;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0; $i < 100; $i++){
            $user = new UserSQL($faker->name(), $faker->lastName(), $faker->phoneNumber());
            $manager->persist($user);
        }
        $manager->flush();
    }
}
