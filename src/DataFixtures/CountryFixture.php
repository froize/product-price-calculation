<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixture extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createCountry('Germany', 'DE', 19);
        $this->createCountry('Italy', 'IT', 22);
        $this->createCountry('Greece', 'GR', 24);

        $this->manager->flush();
    }

    private function createCountry(string $name, string $code, int $tax): void
    {
        $country = new Country();
        $country->setName($name);
        $country->setCode($code);
        $country->setTax($tax);
        $this->manager->persist($country);
    }
}
