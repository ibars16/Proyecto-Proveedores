<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Proveedor;

class EliminarProveedorController extends AbstractController
{
  /**
     * @Route("/borrar/{proveedor}", name="borrar")
     */
    public function eliminar_proveedor($proveedor){
         /* Este función nos sirve para borrar un proveedor */
        $entityManager = $this->getDoctrine()->getManager();
        $proveedor = $entityManager->getRepository(Proveedor::class)->findOneBy(['id'=>$proveedor]);
        $entityManager->remove($proveedor);
        $entityManager->flush();

        $this->addFlash(
            'exito',
            'Se ha eliminado el proveedor de forma correcta'
        );

        return $this->redirectToRoute('buscar',['tipo'=>'borrar']);
    }
}
