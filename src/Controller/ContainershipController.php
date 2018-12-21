<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:59
 */

namespace App\Controller;
use App\Entity\Containership;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/containership/{id}", name="containshipId")
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
}