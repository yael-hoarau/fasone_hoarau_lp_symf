<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:58
 */

namespace App\Controller;
use App\Entity\Container;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="contain")
     */
    function display(){
        $containers = $this->getDoctrine()
            ->getRepository(Container::class)
            ->findAll();

        return $this->render('container/container.html.twig',[
            'containers' => $containers
        ]);
    }
}