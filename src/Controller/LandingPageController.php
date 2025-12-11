<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    #[Route('/', name: 'landing_page')]
    public function index(PropertyRepository $propertyRepository): Response
    {
        // Redirect logged-in users to their appropriate dashboard
        if ($this->getUser()) {
            $roles = $this->getUser()->getRoles();

            if (in_array('ROLE_ADMIN', $roles) || in_array('ROLE_STAFF', $roles)) {
                return $this->redirectToRoute('app_dashboard');
            }

            if (in_array('ROLE_USER', $roles)) {
                return $this->redirectToRoute('app_client_dashboard');
            }
        }
        $stats = [
            ['number' => '2,500+', 'label' => 'Properties Listed'],
            ['number' => '15,000+', 'label' => 'Happy Clients'],
            ['number' => '250+', 'label' => 'Expert Agents'],
            ['number' => '50+', 'label' => 'Cities Covered'],
        ];

        // Fetch available properties from the database
        // Try both 'available' and 'Available' status to handle case variations
        $availableProperties = $propertyRepository->findBy(['status' => 'available'], ['id' => 'DESC'], 3);
        if (empty($availableProperties)) {
            $availableProperties = $propertyRepository->findBy(['status' => 'Available'], ['id' => 'DESC'], 3);
        }
        
        // If still empty, get all properties (fallback)
        if (empty($availableProperties)) {
            $availableProperties = $propertyRepository->findBy([], ['id' => 'DESC'], 3);
        }

        $featuredProperties = $availableProperties;

        $services = [
            [
                'icon' => 'home',
                'title' => 'Property Sales',
                'description' => 'Expert guidance in buying and selling residential and commercial properties'
            ],
            [
                'icon' => 'building',
                'title' => 'Property Rental',
                'description' => 'Find the perfect rental property or tenant with our comprehensive services'
            ],
            [
                'icon' => 'furniture',
                'title' => 'Furniture Sales',
                'description' => 'Full-service property management to maximize your investment returns'
            ],
            [
                'icon' => 'chart',
                'title' => 'Property Valuation',
                'description' => 'Accurate property valuations from certified professionals'
            ],
        ];

        return $this->render('landing_page/index.html.twig', [
            'stats' => $stats,
            'featured_properties' => $featuredProperties,
            'services' => $services,
        ]);
    }
}