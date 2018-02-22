<?php

namespace App\Infrastructure\Repository;

use Psr\Cache\CacheItemPoolInterface;
use App\Domain\Communication\CommunicationCollection;
use App\Domain\Communication\CommunicationRepository;

class CacheLogCommunicationRepository implements CommunicationRepository
{
    /**
     * @var CommunicationRepository
     */
    private $communicationRepository;
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * CacheLogCommunicationRepository constructor.
     * @param CommunicationRepository $communicationRepository
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(CommunicationRepository $communicationRepository, CacheItemPoolInterface $cache)
    {
        $this->communicationRepository = $communicationRepository;
        $this->cache = $cache;
    }

    /**
     * @param int $phoneNumber
     * @return CommunicationCollection
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function findByPhoneNumber(int $phoneNumber): CommunicationCollection
    {
        $item = $this->cache->getItem((string)$phoneNumber);

        if (false === $item->isHit()) {
            $communications = $this->communicationRepository->findByPhoneNumber((string)$phoneNumber);

            $item->set($communications);

            $this->cache->save($item);
        }

        return $item->get();
    }
}