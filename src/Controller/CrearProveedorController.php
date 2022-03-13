<?php

namespace App\Controller;
use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class CrearProveedorController extends AbstractController
{
     /**
     * @Route("/crear", name="crear")
     */
    public function crear_proveedor(Request $request): Response
    {
        /* Esta función sirve para generar un formulario para la creación de un proveedor */
        $error = '';
        $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class,$proveedor);
        $form->handleRequest($request);

        try {
            /* Este try catch comprueba que no exista un proveedor en la base de datos con 
            algún dato igual */
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $proveedor = $form->getData();
                $entityManager->persist($proveedor);
                $entityManager->flush();
    
                $this->addFlash(
                    'exito',
                    'Se ha creado el proveedor de forma correcta'
                );
    
                return $this->redirectToRoute('crear');
            }
        } catch (\Throwable $th) {
            $error = 'Ya existe un proveedor con esa información';
        }

        return $this->render('home/crear.html.twig', [
            'form'=>$form->createView(),
            'error'=>$error
        ]);
    }
}
