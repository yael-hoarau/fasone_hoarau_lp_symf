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

    /**
     * @Route("/container/insert", name="contain")
     */
    function insert(){
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}