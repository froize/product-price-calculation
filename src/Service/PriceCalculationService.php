<?php


namespace App\Service;


use App\Entity\Country;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\Pure;

class PriceCalculationService
{

    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    public function getCountry(string $taxNumber): ?Country
    {
        $code = substr($taxNumber, 0, 2);

        return $this->entityManager->getRepository(Country::class)->findOneBy([
            'code' => $code
        ]);
    }

    public function getTotalPrice(Product $product, Country $country): float
    {
        return round($product->getPrice() * (1 + $country->getTax() / 100), 2);
    }
}