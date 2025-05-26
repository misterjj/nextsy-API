<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $cat = new Category();
        $cat->setNameFr($faker->name());
        $cat->setNameEn($faker->name());
        $cat->setDescriptionFr($faker->name());
        $cat->setDescriptionEn($faker->name());

        $manager->persist($cat);

        $manager->flush();
    }
}
