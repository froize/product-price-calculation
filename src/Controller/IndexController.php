<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\PriceCalculationType;
use App\Service\PriceCalculationService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(
        Request $request,
        LoggerInterface $logger,
        PriceCalculationService $priceCalculationService
    ): Response
    {
        $form = $this->createForm(PriceCalculationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $country = $priceCalculationService->getCountry($data['taxNumber']);
                if (!$country) {
                    throw new \Exception('Country not found');
                }
                $totalPrice = $priceCalculationService->getTotalPrice($data['product'], $country);

                return $this->render('index/index.html.twig', [
                    'country' => $country,
                    'total_price' => $totalPrice,
                    'form' => $form->createView(),
                ]);
            } catch (\Exception $exception) {
                $form->addError(new FormError($exception->getMessage()));
                $logger->error($exception->getMessage(), ['exception' => $exception]);
            }
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
