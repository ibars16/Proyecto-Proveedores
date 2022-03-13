<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Proveedor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Form\createFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class EditarProveedorController extends AbstractController
{
  
     /**
     * @Route("/editar/{proveedor}", name="editar")
     */
    public function editar_proveedor(Request $request, $proveedor): Response
    {
            $error = "";
            $entityManager = $this->getDoctrine()->getManager();
            $proveedor = $entityManager->getRepository(Proveedor::class)->findOneBy(['id'=>$proveedor]);
           
            $form = $this->crear_formulari($proveedor);
            $form->handleRequest($request);

            try {
                if ($form->isSubmitted() && $form->isValid()) {
                    $data = $form->getData();
                    $this->atualizar_informacion($proveedor,$data);
                    $entityManager->persist($proveedor);
                    $entityManager->flush();
    
                    $this->addFlash(
                        'exito',
                        'Se ha editado el proveedor de forma correcta'
                    );
    
                    return $this->redirectToRoute('editar',['proveedor'=>$proveedor->getId()]);
            }
            } catch (\Throwable $th) {
                $error = 'Ya existe un proveedor con esa información';
            }
            
        return $this->render('home/editar.html.twig',[
            'proveedor'=>$proveedor,
            'form'=>$form->createView(),
            'error'=>$error
        ]);
          
    }

    public function atualizar_informacion(Proveedor $proveedor,$data){
        $proveedor->setNombre($data['nombre']);
        $proveedor->setCorreoelectronico($data['correoelectronico']);
        $proveedor->setTelefono($data['telefono']);
        $proveedor->settipoproveedor($data['tipoproveedor']);
        $proveedor->setActivo($data['activo']);
        $proveedor->actualizar();
    }

    public function crear_formulari(Proveedor $proveedor){
        $form = $this->createFormBuilder()
        ->add('nombre',TextType::class , array(
            'label' => 'Nombre: ',
            'attr' => array(
                'value' => $proveedor->getNombre()
            )
        ))
        ->add('correoelectronico',EmailType::class,array(
            'label' => 'Correo electrónico: ',
            'attr' => array(
                'value' => $proveedor->getCorreoelectronico()
            )
        ))
        ->add('telefono',TextType::class , array(
            'label' => 'Teléfono: ',
            'attr' => array(
                'value' => $proveedor->getTelefono()
            )))
            ->add('tipoproveedor', ChoiceType::class, [
                'choices'  => [
                    'Hotel' => 'Hotel',
                    'Pista' => 'Pista',
                    'Complemento' => 'Complemento',
                ],
               
                
            ])
        ->add('activo', ChoiceType::class, [
                'label' => 'Activo: ',
                'choices'  => [
                    'Si' => true,
                    'No' => false
                    ],
                    
                ])
        ->add('Enviar', SubmitType::class)
        ->getForm();
        ;
        return $form;
    }
}
