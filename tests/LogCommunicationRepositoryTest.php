<?php

namespace App\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Communications;
use App\Infrastructure\Repository\LogCommunicationRepository;

class LogCommunicationRepositoryTest extends TestCase
{
    /** @var LogCommunicationRepository */
    private $repository;

    public function setUp()
    {
        $this->repository = new LogCommunicationRepository(
            new Client([
                'base_uri' => 'https://gist.githubusercontent.com/rodrigm/8d9c2f79d637c4e0673c85f1da365ae3/raw/16ccd81dbaa895d44ac05190626de84169722700'
            ]),
            new Communications()
        );
    }

    public function test_results_are_returned_when_file_is_found()
    {
        $this->assertGreaterThan(0, $this->repository->findByPhoneNumber(611222333)->count());
    }

    public function test_no_results_are_returned_when_no_file_is_found()
    {
        $this->assertEquals(0, $this->repository->findByPhoneNumber(700000000)->count());
    }
}