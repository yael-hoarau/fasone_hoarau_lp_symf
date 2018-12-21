<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:59
 */

namespace App\Controller;
use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    function display(){
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/product.html.twig',[
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/{id<\d+>}", name="productId")
     */
    function displayId($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        return $this->render('product/productid.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/product/new", name="productInsert")
     */
    function insert(Request $request){
        $task = new Product();



        $form = $this->createFormBuilder($task)
            ->add('name', TextType::class)
            ->add('length', IntegerType::class)
            ->add('width', IntegerType::class)
            ->add('height', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Containership'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('productInsert');
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

        return $this->render('product/productinsert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}