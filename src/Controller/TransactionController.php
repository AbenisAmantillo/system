<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TransactionController extends AbstractController
{
    #[Route('/transaction', name: 'app_transaction_index')]
    public function index(): Response
    {
        // Placeholder transaction data - replace with actual Transaction entity/repository when available
        $transactions = [
            [
                'order_id' => '',
                'customer_name' => '',
                'property_name' => '',
                'purchase_type' => '',
                'price' => '',
                'date' => ''
            ],
        ];

        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactions,
        ]);
    }
}




