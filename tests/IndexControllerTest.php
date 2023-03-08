<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class IndexControllerTest extends WebTestCase
{
    private ?Router $router;
    private ?KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = $this->client->getContainer();

        $this->router = $container->get('router');
    }

    protected function tearDown(): void
    {
        $this->router = null;
        $this->client = null;
    }

    public function testPriceCalculationForm(): void
    {
        $url = $this->router->generate('app_index');
        $crawler = $this->client->request('GET', $url);
        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode(), $crawler->filter('title')->text());
        $form = $crawler->selectButton('price_calculation_submit')->form([
            'price_calculation[product]' => 1,
            'price_calculation[taxNumber]' => 'DE398272932'
        ]);
        $this->client->submit($form);

        self::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode(),
            $crawler->filter('title')->text()
        );
    }
}
