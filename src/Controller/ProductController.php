<?php
/**
 * Created by PhpStorm.
 * User: hugofasone
 * Date: 21/12/18
 * Time: 13:59
 */

namespace App\Controller;
use App\Entity\Product;
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
     * @Route("/product/{id}", name="productId")
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
}