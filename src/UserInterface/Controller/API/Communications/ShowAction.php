<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Communication\CommunicationRepository;

class ShowAction
{
    /**
     * @var CommunicationRepository
     */
    private $communicationRepository;

    /**
     * ShowAction constructor.
     * @param CommunicationRepository $communicationRepository
     */
    public function __construct(CommunicationRepository $communicationRepository)
    {
        $this->communicationRepository = $communicationRepository;
    }

    /**
     * @Route("/api/communications/{number}", name="api_communications_show", methods={"GET"})
     * @param Request $request
     * @param int $number
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $number)
    {
        $communications = $this->communicationRepository->findByPhoneNumber($number);

        return new JsonResponse(
            $communications->toArray()
        );
    }
}