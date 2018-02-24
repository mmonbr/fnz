<?php

namespace App\UserInterface\Controller\API\Communications;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use App\Domain\Communication\CommunicationRepository;

class ShowAction
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
     * @Route("/api/communications/{number}", name="api_communications_show", methods={"GET"})
     * @param Request $request
     * @param int $number
     * @return Response
     */
    public function __invoke(Request $request, int $number)
    {
        $communications = $this->communicationRepository->findByPhoneNumber($number)->byType($request->query->get('type'));

        return new Response(
            $this->serializer->serialize($communications, 'json'),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}