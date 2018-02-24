<?php

namespace App\Infrastructure\Repository;

use DateTimeImmutable;
use GuzzleHttp\ClientInterface;
use App\Domain\Communication\SMS;
use App\Domain\Communication\PhoneCall;
use GuzzleHttp\Exception\ClientException;
use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\ValueObject\PhoneNumber;
use App\Domain\Communication\CommunicationCollection;
use App\Domain\Communication\CommunicationRepository;

class LogCommunicationRepository implements CommunicationRepository
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var CommunicationCollection
     */
    private $communicationCollection;

    /**
     * LogCommunicationRepository constructor.
     * @param ClientInterface $client
     * @param CommunicationCollection $communicationCollection
     */
    public function __construct(ClientInterface $client, CommunicationCollection $communicationCollection)
    {
        $this->client = $client;
        $this->communicationCollection = $communicationCollection;
    }

    /**
     * @param int $phoneNumber
     * @return CommunicationCollection
     */
    public function findByPhoneNumber(int $phoneNumber): CommunicationCollection
    {
        try {
            $response = $this->client->request('GET', "communications.{$phoneNumber}.log")->getBody();
        } catch (ClientException $exception) {
            return $this->communicationCollection;
        }

        while (false === $response->eof()) {
            $currentLine = \GuzzleHttp\Psr7\readline($response);

            if (preg_match('/C(\s{0,6}\d{3,9})(\s{0,6}\d{3,9})(0|1)(.{1,24})(\d{14})(\d{6})/', $currentLine, $matches)) {
                $this->communicationCollection->add($this->buildCallFromArray($matches));
            }

            if (preg_match('/S(\s{0,6}\d{3,9})(\s{0,6}\d{3,9})(0|1)(.{1,24})(\d{14})/', $currentLine, $matches)) {
                $this->communicationCollection->add($this->buildSMSFromArray($matches));
            }
        }

        return $this->communicationCollection;
    }

    /**
     * @param array $data
     * @return PhoneCall
     */
    private function buildCallFromArray(array $data): PhoneCall
    {
        $data = array_map('trim', $data);

        $origin = $data[1];
        $destination = $data[2];
        $direction = $data[3];
        $contactName = $data[4];
        $date = DateTimeImmutable::createFromFormat('dmYHis', $data[5]);
        $duration = $data[6];

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            new PhoneNumber($contactNumber)
        );

        return new PhoneCall(
            new PhoneNumber($origin),
            $direction,
            $contact,
            $date,
            $duration
        );
    }

    /**
     * @param array $data
     * @return SMS
     */
    private function buildSMSFromArray(array $data): SMS
    {
        $data = array_map('trim', $data);

        $origin = $data[1];
        $destination = $data[2];
        $direction = $data[3];
        $contactName = $data[4];
        $date = DateTimeImmutable::createFromFormat('dmYHis', $data[5]);

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            new PhoneNumber($contactNumber)
        );

        return new SMS(
            new PhoneNumber($origin),
            $direction,
            $contact,
            $date
        );
    }
}