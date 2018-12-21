<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 15:41
 */

namespace App\Service;


use App\Entity\Containership;
use Doctrine\ORM\EntityManagerInterface;

class ContainershipService
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
            ->getRepository(Containership::class)
            ->findAll();

        return $containers;
    }

    function find($id){
        $container = $this->entityManager
            ->getRepository(Containership::class)
            ->find($id);

        return $container;
    }

    function getManager(){
        return $this->entityManager;
    }

    function insert(Containership $task){
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}