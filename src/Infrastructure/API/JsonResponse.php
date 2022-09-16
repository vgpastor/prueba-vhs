<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function __construct($data, int $status = 200, array $headers = [], bool $json = false)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);

        $serializer = new Serializer([$normalizer]);

        $result = $serializer->normalize($data, 'json', [AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true, AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
            return $object->getId();
        }]);

        parent::__construct($result, $status, $headers, $json);
    }
}
