<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Communication\CommunicationRepository;

class ShowCallsAction
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
     * @Route("/api/communications/{number}/calls", name="api_communications_show_calls", methods={"GET"})
     * @param int $number
     * @return JsonResponse
     */
    public function __invoke(int $number)
    {
        $communications = $this->communicationRepository->findByPhoneNumber($number);

        return new JsonResponse(
            $communications->toArray()
        );
    }
}