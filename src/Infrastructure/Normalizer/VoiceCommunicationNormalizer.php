<?php

namespace App\Infrastructure\Normalizer;

use App\Domain\Communication\SpokenCommunication;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\CircularReferenceException;

class VoiceCommunicationNormalizer implements NormalizerInterface
{

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param object $object Object to normalize
     * @param string $format Format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array|string|int|float|bool
     *
     * @throws InvalidArgumentException   Occurs when the object given is not an attempted type for the normalizer
     * @throws CircularReferenceException Occurs when the normalizer detects a circular reference when no circular
     *                                    reference handler can fix it
     * @throws LogicException             Occurs when the normalizer is not called in an expected context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        /** @var SpokenCommunication $object */

        return [
            'type'        => 'call',
            'origin'      => $object->origin()->number(),
            'destination' => $object->destination()->number(),
            'direction'   => $object->direction(),
            'contact'     => [
                'name'   => $object->contact()->name()
            ],
            'date'        => $object->date(),
            'duration'    => $object->duration()
        ];
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof SpokenCommunication;
    }
}