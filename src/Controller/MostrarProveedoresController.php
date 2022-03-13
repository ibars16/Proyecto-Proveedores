<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Proveedor;

class MostrarProveedoresController extends AbstractController
{
     /**
     * @Route("/mostrar", name="mostrar")
     */
    public function mostrar(): Response
    {
         /* Esta función nos sirve para mostrar todos los proveedores */
        $entityManager = $this->getDoctrine()->getManager();
        $proveedor = $entityManager->getRepository(Proveedor::class)->findAll();
       
        return $this->render('home/mostrar.html.twig', [
            'proveedores'=>$proveedor
            
        ]);
    }
}
