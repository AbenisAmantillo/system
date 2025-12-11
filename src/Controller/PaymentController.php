<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/payment')]
final class PaymentController extends AbstractController
{
    #[Route(name: 'app_payment_index', methods: ['GET'])]
    public function index(): Response
    {
        // Placeholder payment data - replace with actual Payment entity/repository when available
        $payments = [
            // Example structure - replace with actual data from PaymentRepository
            // [
            //     'id' => 1,
            //     'customer_name' => 'John Doe',
            //     'transaction_id' => 'TXN-001',
            //     'amount' => 50000.00,
            //     'payment_method' => 'Bank Transfer',
            //     'status' => 'Completed',
            //     'date' => new \DateTime('2024-01-15'),
            // ],
        ];

        return $this->render('payment/index.html.twig', [
            'payments' => $payments,
        ]);
    }
}




