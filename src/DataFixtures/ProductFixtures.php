<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $category = $manager->getRepository(Category::class)->findAll();

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $randomWord = $faker->numberBetween(2, 6);
            $product->setNameFr($faker->sentence($randomWord));
            $product->setNameEn($faker->sentence($randomWord));
            $product->setDescriptionFr($faker->paragraph(2, false));
            $product->setDescriptionEn($faker->paragraph(2, false));
            $product->setPrice($faker->randomFloat(2, 5, 60));
            $product->setStock($faker->randomNumber(3));
            $product->setCategories($faker->randomElements($category, $faker->numberBetween(1, 4)));

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
