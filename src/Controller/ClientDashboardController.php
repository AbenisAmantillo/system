<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use App\Repository\FurnitureRepository;
use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ClientDashboardController extends AbstractController
{
    #[Route('/client_dashboard', name: 'app_client_dashboard')]
    public function index(PropertyRepository $propertyRepository, FurnitureRepository $furnitureRepository, PaymentRepository $paymentRepository): Response
    {
        if ($this->isGranted('ROLE_STAFF') || $this->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException('Staff and administrators cannot access the client dashboard.');
    }
        // Get featured properties (you can add a featured field to Property entity)
        $featuredProperties = $propertyRepository->findBy([], ['id' => 'DESC'], 6);
        
        // Get all properties for payment form dropdown
        $allProperties = $propertyRepository->findAll();
        
        // Get available furniture - handle both "Available" and "available" status
        try {
            $availableFurniture = $furnitureRepository->findBy(['status' => 'Available'], ['id' => 'DESC'], 6);
            if (empty($availableFurniture)) {
                // Try lowercase if no results
                $availableFurniture = $furnitureRepository->findBy(['status' => 'available'], ['id' => 'DESC'], 6);
            }
        } catch (\Exception $e) {
            // If there's an error, just get all furniture
            $availableFurniture = $furnitureRepository->findBy([], ['id' => 'DESC'], 6);
        }
        
        // Get payments for payment history
        $payments = $paymentRepository->findBy([], ['date' => 'DESC']);
        
        // Get statistics
        try {
            $totalProperties = count($propertyRepository->findAll());
            $totalFurniture = count($furnitureRepository->findAll());
        } catch (\Exception $e) {
            $totalProperties = 0;
            $totalFurniture = 0;
        }
        
        return $this->render('client_dashboard/index.html.twig', [
            'featured_properties' => $featuredProperties,
            'all_properties' => $allProperties,
            'available_furniture' => $availableFurniture,
            'total_properties' => $totalProperties,
            'total_furniture' => $totalFurniture,
            'payments' => $payments,
        ]);
    }
}