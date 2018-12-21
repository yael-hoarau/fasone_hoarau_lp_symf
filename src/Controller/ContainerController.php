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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
     * @Route("/container/{id}", name="containId")
     */
    function displayId($id)
    {
        $container = $this->getDoctrine()
            ->getRepository(Container::class)
            ->find($id);

        return $this->render('container/containerid.html.twig', [
            'container' => $container
        ]);
    }

    /**
     * @Route("/container_insert", name="containInsert")
     */
    function insert(){
        $task = new Container();
        $task->setColor('ROUGE');


        $form = $this->createFormBuilder($task)
            ->add('containerName', TextType::class)
            ->add('containerShip', \App\Entity\Containership::class)
            ->add('save', SubmitType::class, array('label' => 'Create Container'))
            ->getForm();

//
        //$entityManager = $this->getDoctrine()->getManager();
//
        //$product = new Product();
        //$product->setName('Keyboard');
        //$product->setPrice(1999);
        //$product->setDescription('Ergonomic and stylish!');
//
        //// tell Doctrine you want to (eventually) save the Product (no queries yet)
        //$entityManager->persist($product);
//
        //// actually executes the queries (i.e. the INSERT query)
        //$entityManager->flush();

        return $this->render('container/containerinsert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}