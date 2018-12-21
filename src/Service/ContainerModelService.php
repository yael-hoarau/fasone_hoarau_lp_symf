<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 15:41
 */

namespace App\Service;



use App\Entity\ContainerModel;
use Doctrine\ORM\EntityManagerInterface;

class ContainerModelService
{
    private $entityManager;
    /**
     * ContainerService constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    function findAll(){
        $containers = $this->entityManager
            ->getRepository(ContainerModel::class)
            ->findAll();

        return $containers;
    }

    function find($id){
        $container = $this->entityManager
            ->getRepository(ContainerModel::class)
            ->find($id);

        return $container;
    }
}