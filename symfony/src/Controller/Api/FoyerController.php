<?php

namespace App\Controller\Api;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class FoyerController
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    /**
     * @Rest\Post(
     *     path = "/foyers/{id}",
     *     name = "api_foyer_post",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function postFoyerAction(): JsonResponse
    {
        return new JsonResponse(['foo' => 'bar']);
    }

    /**
     * @Rest\Get(
     *     path = "/foyers/{id}",
     *     name = "api_foyer_get",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function getFoyerAction(): JsonResponse
    {
        return new JsonResponse(['foo' => 'bar']);
    }
}
