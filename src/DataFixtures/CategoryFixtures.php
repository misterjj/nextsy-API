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

        for ($i = 0; $i < 10; $i++) {
            $cat = new Category();
            $randomWord = $faker->numberBetween(1, 2);
            $cat->setNameFr($faker->words($randomWord, true));
            $cat->setNameEn($faker->words($randomWord, true));
            $cat->setDescriptionFr($faker->paragraph(2, false));
            $cat->setDescriptionEn($faker->paragraph(2, false));

            $manager->persist($cat);
        }

        $manager->flush();
    }
}
