<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:59
 */

namespace App\Controller;
use App\Entity\Containership;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContainershipController extends AbstractController
{
    /**
     * @Route("/containership", name="containship")
     */
    function display(){
        $containerships = $this->getDoctrine()
            ->getRepository(Containership::class)
            ->findAll();

        return $this->render('containership/containership.html.twig',[
            'containerships' => $containerships
        ]);
    }

    /**
     * @Route("/containership/{id<\d+>}", name="containshipId")
     */
    function displayId($id)
    {
        $containership = $this->getDoctrine()
            ->getRepository(Containership::class)
            ->find($id);

        return $this->render('containership/containershipid.html.twig', [
            'containership' => $containership
        ]);
    }

    /**
     * @Route("/containership/new", name="containshipInsert")
     */
    function insert(Request $request){
        $task = new Containership();



        $form = $this->createFormBuilder($task)
            ->add('name', TextType::class)
            ->add('captainname', TextType::class)
            ->add('containerlimit', IntegerType::class)
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

            return $this->redirectToRoute('containshipInsert');
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

        return $this->render('containership/containershipinsert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}