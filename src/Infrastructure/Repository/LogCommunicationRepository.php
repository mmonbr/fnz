<?php

namespace App\Infrastructure\Repository;

use DateTimeImmutable;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use App\Domain\Communication\SpokenCommunication;
use App\Domain\Communication\Written\IncomingSMS;
use App\Domain\Communication\Written\OutgoingSMS;
use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\WrittenCommunication;
use App\Domain\Communication\ValueObject\PhoneNumber;
use App\Domain\Communication\CommunicationCollection;
use App\Domain\Communication\CommunicationRepository;
use App\Domain\Communication\Spoken\IncomingPhoneCall;
use App\Domain\Communication\Spoken\OutgoingPhoneCall;

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
     * @return SpokenCommunication
     */
    private function buildCallFromArray(array $data): SpokenCommunication
    {
        $data = array_map('trim', $data);

        $origin = (int)$data[1];
        $destination = (int)$data[2];
        $direction = (int)$data[3];
        $contactName = (string)$data[4];
        $date = DateTimeImmutable::createFromFormat('dmYHis', (string)$data[5]);
        $duration = (int)$data[6];

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            new PhoneNumber($contactNumber)
        );

        if (1 === $direction) {
            return new IncomingPhoneCall(
                new PhoneNumber($origin),
                $contact,
                $date,
                $duration
            );
        } else {
            return new OutgoingPhoneCall(
                new PhoneNumber($origin),
                $contact,
                $date,
                $duration
            );
        }
    }

    /**
     * @param array $data
     * @return WrittenCommunication
     */
    private function buildSMSFromArray(array $data): WrittenCommunication
    {
        $data = array_map('trim', $data);

        $origin = (int)$data[1];
        $destination = (int)$data[2];
        $direction = (int)$data[3];
        $contactName = (string)$data[4];
        $date = DateTimeImmutable::createFromFormat('dmYHis', (string)$data[5]);

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            new PhoneNumber($contactNumber)
        );

        if (1 === $direction) {
            return new IncomingSMS(
                new PhoneNumber($origin),
                $contact,
                $date
            );
        } else {
            return new OutgoingSMS(
                new PhoneNumber($origin),
                $contact,
                $date
            );
        }
    }
}