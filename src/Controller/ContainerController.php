<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:58
 */

namespace App\Controller;
use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use App\Controller\ContainershipController;
use App\Service\ContainerModelService;
use App\Service\ContainerService;
use App\Service\ContainershipService;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="contain")
     */
    function display(ContainerService $containerService){

        $containers = $containerService->findAll();

        return $this->render('container/container.html.twig',[
            'containers' => $containers
        ]);
    }

    /**
     * @Route("/container/{id<\d+>}", name="containId")
     */
    function displayId($id, ContainerService $containerService)
    {
        $container = $containerService->find($id);

        return $this->render('container/containerid.html.twig', [
            'container' => $container
        ]);
    }


    /**
     * @Route("/container/new", name="containInsert")
     */
    function insert(Request $request, ContainerService $containerService){
        $task = new Container();

        $form = $this->createFormBuilder($task)
            ->add('color', TextType::class)
            ->add('containerShip', EntityType::class, array('class' => Containership::class, 'choice_label' => 'name'))
            ->add('containerModel', EntityType::class, array('class' => ContainerModel::class, 'choice_label' => 'name'))
            ->add('save', SubmitType::class, array('label' => 'Create Container'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $containerService->insert($task);


            return $this->redirectToRoute('containInsert');
        }

        return $this->render('container/containerinsert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}