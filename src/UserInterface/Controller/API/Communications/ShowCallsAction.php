<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Communication\CommunicationRepository;
use Symfony\Component\Serializer\SerializerInterface;

class ShowCallsAction
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
     * @Route("/api/communications/{number}/calls", name="api_communications_show_calls", methods={"GET"})
     * @param Request $request
     * @param int $number
     * @return Response
     */
    public function __invoke(Request $request, int $number)
    {
        $direction = $request->query->get('direction');

        $communications = $this->communicationRepository
            ->findByPhoneNumber($number)
            ->byDirection($direction)
            ->calls();

        return new Response(
            $this->serializer->serialize($communications, 'json'),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}