<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 15:40
 */

namespace App\Service;
use App\Entity\Container;
use Doctrine\ORM\EntityManagerInterface;

class ContainerService
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
            ->getRepository(Container::class)
            ->findAll();

        return $containers;
    }

    function find($id){
        $container = $this->entityManager
            ->getRepository(Container::class)
            ->find($id);

        return $container;
    }

    function insert($container){
        $this->entityManager->persist($container);
        $this->entityManager->flush();
    }
}