<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Communication\CommunicationRepository;

class ShowContactsAction
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
     * @Route("/api/communications/{numberOne}/contacts/{numberTwo}", name="api_communications_show_contacts", methods={"GET"})
     * @param int $numberOne
     * @param int $numberTwo
     * @return JsonResponse
     */
    public function __invoke(int $numberOne, int $numberTwo)
    {
        $communications = $this->communicationRepository->findByPhoneNumber($numberOne)->containingNumber($numberTwo);

        return new JsonResponse(
            $communications->toArray()
        );
    }
}