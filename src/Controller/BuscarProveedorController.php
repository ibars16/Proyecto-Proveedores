<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Proveedor;
use App\Form\createFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType; 

class BuscarProveedorController extends AbstractController
{

    /**
    * @Route("/buscar/{tipo}", name="buscar")
    */
   public function buscar_proveedor(Request $request,$tipo): Response
   {
       $encontrado=false;
       $entityManager = $this->getDoctrine()->getManager();
       $proveedores = $entityManager->getRepository(Proveedor::class)->findAll();

       $form = $this->crear_formulario();
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $data = $form->getData();
           $proveedor = $entityManager->getRepository(Proveedor::class)->findOneBy(['id'=>$data['id']]);

           /* Comprueba si existe un proveedor con esa id, y redirige a una url dependiendo el valor de $tipo 
           que puede ser editar o borrar */

           if ($entityManager->getRepository(Proveedor::class)->findOneBy(['id'=>$data['id']]) && $tipo=='editar') {
               return $this->redirectToRoute('editar',['proveedor'=>$data['id']]);
           }elseif ($entityManager->getRepository(Proveedor::class)->findOneBy(['id'=>$data['id']]) && $tipo=='borrar'){
               return $this->redirectToRoute('borrar',['proveedor'=>$data['id']]);
           }else{
               $encontrado = true;
           }

       
   }
   return $this->render('home/buscar.html.twig',[
       'form'=>$form->createView(),
       'buscar'=>$tipo,
       'proveedores'=>$proveedores,
       'encontrado'=>$encontrado
   ]);
}

    public function crear_formulario(){
        /* Esta función crea un formulario para introducir el id del proveedor */
        $form = $this->createFormBuilder()
       ->add('id', TextType::class ,array(
        'label' => 'ID: ',
    ))
       ->add('Enviar', SubmitType::class)
       ->getForm();
       ;

       return $form;
    }


}
