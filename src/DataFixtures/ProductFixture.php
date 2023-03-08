<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createProduct('Headphones',10000);
        $this->createProduct('Phone case',2000);

        $this->manager->flush();
    }

    private function createProduct(string $title, int $price): void
    {
        $product = new Product();
        $product->setTitle($title);
        $product->setPrice($price);
        $this->manager->persist($product);
    }
}
