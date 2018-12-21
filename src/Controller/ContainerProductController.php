<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:59
 */

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use App\Service\ContainerProductService;
use App\Service\ContainerService;
use App\Service\ProductService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/product-container/new", name="productContainerInsert")
     */
    function insert(Request $request,ContainerProductService $containerProductService){

        $task = new ContainerProduct();



        $form = $this->createFormBuilder($task)
            ->add('container', EntityType::class, array('class' => Container::class, 'choice_label' => 'id'))
            ->add('product', EntityType::class, array('class' => Product::class, 'choice_label' => 'name'))
            ->add('quantity', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Containership'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            //var_dump($task);
            //exit();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $containerProductService->insert($task);
            return $this->redirectToRoute('productContainerInsert');
        }

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

        return $this->render('productcontainer/productcontainerinsert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}