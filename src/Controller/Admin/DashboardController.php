<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Entity\Picture;
use App\Entity\Reservation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(HotelCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/assets2/images/logo_ts.png">');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Site Web', 'fa fa-home', 'app_home');
    
        yield MenuItem::section('Gestion User');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);

        yield MenuItem::section('Gestion Patrimoine');
        yield MenuItem::linkToCrud('Hotel', 'fa-solid fa-hotel', Hotel::class);
        yield MenuItem::linkToCrud('Chambres', 'fa-solid fa-bed', Chambre::class);
        yield MenuItem::linkToCrud('Images', 'fa-solid fa-image', Picture::class); 

        yield MenuItem::section('Les réservations');
        yield MenuItem::linkToCrud('Réservation', 'fa-solid fa-calendar-days', Reservation::class);
    }
}