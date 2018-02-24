<?php

namespace App\UserInterface\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse([
            'hello' => 'world'
        ]);
    }
}