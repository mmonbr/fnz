<?php

namespace App\Infrastructure\Repository;

use App\Domain\Communication\Contact;
use SplFileObject;
use DateTimeImmutable;
use App\Domain\Communication\SMS;
use App\Domain\Communication\Call;
use App\Domain\Communication\Communications;
use App\Domain\Communication\CommunicationCollection;
use App\Domain\Communication\CommunicationRepository;

class LogCommunicationRepository implements CommunicationRepository
{
    /**
     * @param int $phoneNumber
     * @return CommunicationCollection
     */
    public function findByPhoneNumber(int $phoneNumber): CommunicationCollection
    {
        $file = new SplFileObject("https://gist.githubusercontent.com/rodrigm/8d9c2f79d637c4e0673c85f1da365ae3/raw/16ccd81dbaa895d44ac05190626de84169722700/communications.{$phoneNumber}.log");

        $communications = new Communications();

        while (false === $file->eof()) {
            $currentLine = $file->fgets();

            if (preg_match('/C(\s{0,6}\d{3,9})(\s{0,6}\d{3,9})(0|1)(.{1,24})(\d{14})(\d{6})/', $currentLine, $matches)) {
                $communications->add($this->buildCallFromArray($matches));
            }

            if (preg_match('/S(\s{0,6}\d{3,9})(\s{0,6}\d{3,9})(0|1)(.{1,24})(\d{14})/', $currentLine, $matches)) {
                $communications->add($this->buildSMSFromArray($matches));
            }
        }

        return $communications;
    }

    /**
     * @param array $data
     * @return Call
     */
    private function buildCallFromArray(array $data): Call
    {
        $origin = $data[1];
        $destination = $data[2];
        $direction = $data[3];
        $contactName = trim($data[4]);
        $date = DateTimeImmutable::createFromFormat('dmYHis', $data[5]);
        $duration = $data[6];

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            $contactNumber
        );

        return new Call(
            $origin,
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
        $origin = $data[1];
        $destination = $data[2];
        $direction = $data[3];
        $contactName = trim($data[4]);
        $date = DateTimeImmutable::createFromFormat('dmYHis', $data[5]);

        $contactNumber = (1 === $direction) ? $origin : $destination;

        $contact = new Contact(
            $contactName,
            $contactNumber
        );

        return new SMS(
            $origin,
            $direction,
            $contact,
            $date
        );
    }
}