<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]
    public function index(TranslatorInterface $translator, LoggerInterface $logger): Response
    {
        $currentDate = new \DateTimeImmutable('now',new \DateTimeZone('Europe/Paris'));
        $appName = $translator->trans('DigitalFirstSteps');  // Pour forcer la traduction en français voici la commande : php bin/console debug:translation fr --only-missing///
        $logger->info('Application starting');
        return $this->render('welcome/index.html.twig', [
            'currentDate' => $currentDate->format('H:i d/m/Y'),
            'appName' => $appName
        ]);
    }
}
