<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Communication\CommunicationRepository;
use Symfony\Component\Serializer\SerializerInterface;

class ShowContactsAction
{
    /**
     * @var CommunicationRepository
     */
    private $communicationRepository;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ShowAction constructor.
     * @param CommunicationRepository $communicationRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        CommunicationRepository $communicationRepository,
        SerializerInterface $serializer
    )
    {
        $this->communicationRepository = $communicationRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/communications/{numberOne}/contacts/{numberTwo}", name="api_communications_show_contacts", methods={"GET"})
     * @param Request $request
     * @param int $numberOne
     * @param int $numberTwo
     * @return Response
     */
    public function __invoke(Request $request, int $numberOne, int $numberTwo)
    {
        $type = $request->query->get('type');
        $direction = $request->query->get('direction');

        $communications = $this->communicationRepository
            ->findByPhoneNumber($numberOne)
            ->containingNumber($numberTwo)
            ->byType($type)
            ->byDirection($direction);

        return new Response(
            $this->serializer->serialize($communications, 'json'),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}