<?php

namespace App\Controller\Api;

use App\Entity\Consommation;
use App\Entity\Foyer;
use App\Repository\ConsommationRepository;
use App\Repository\FoyerRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class FoyerController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Rest\Get(
     *     path = "/foyers",
     *     name = "api_foyer_get_all"
     * )
     */
    public function getAllFoyersAction(FoyerRepository $foyerRepository): JsonResponse
    {
        $foyers = $foyerRepository->findAll();

        return new JsonResponse($foyers);
    }

    /**
     * @Rest\Post(
     *     path = "/foyers/add/nb_pers={id}",
     *     name = "api_foyer_post",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function postFoyerAction(int $id): JsonResponse
    {
        $foyer = new Foyer();
        $foyer->setFoyNbPersonnes($id);
        $this->em->persist($foyer);
        $this->em->flush();

        return new JsonResponse($foyer);
    }

    /**
     * @Rest\Get(
     *     path = "/foyers/{id}",
     *     name = "api_foyer_get",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function getOneFoyerAction(FoyerRepository $foyerRepository, int $id): JsonResponse
    {
        $foyers = $foyerRepository->find($id);

        return new JsonResponse(['foyers' => $foyers]);
    }

    /**
     * @Rest\Get(
     *     path = "/foyers/consos/foyer={id}",
     *     name = "api_foyer_get_consos",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function getAllConsosOfFoyerAction(FoyerRepository $foyerRepository, int $id): JsonResponse
    {
        $consos = $foyerRepository->find($id)->getFoyConsommations()->toArray();

        return new JsonResponse($consos);
    }


    /**
     * @Rest\Post(
     *     path = "/foyers/consos/add/foyer={id}&litres={litres}",
     *     name = "api_foyer_add_conso",
     *     requirements = {"id"="\d+", "litres"="\d+"}
     * )
     */
    public function addNewConso(FoyerRepository $foyerRepository, EntityManagerInterface $em, int $id, int $litres)
    {
        $conso = new Consommation($litres);
        $em->persist($conso);

        $foyer = $foyerRepository->find($id);
        $foyer->addFoyConsommation($conso);

        $em->persist($foyer);
        $em->flush();

        return new JsonResponse($conso);
    }


    /**
     * @Rest\Post(
     *     path = "/foyers/consos/update/foyer={id}&litres={litres}",
     *     name = "api_foyer_update_conso",
     *     requirements = {"id"="\d+", "litres"="\d+"}
     * )
     */
    public function editConso(FoyerRepository $foyerRepository, ConsommationRepository $consommationRepository, EntityManagerInterface $em, int $id, int $litres)
    {
        $today = new \DateTime();
        $foyer = $foyerRepository->find($id);

        $conso = $consommationRepository->getConsoOfTheDay($foyer, $today->format("Y-m-d"));
        $conso->setCsmLitres($conso->getCsmLitres() + $litres);

        $em->persist($conso);
        $em->flush();

        return new JsonResponse($conso);
    }
}
