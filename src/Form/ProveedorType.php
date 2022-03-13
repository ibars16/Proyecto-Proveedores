<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Entity\TipoProveedor;


class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nombre',TextType::class , array(
            'label' => 'Nombre: ',
            
        ))
        ->add('correoelectronico',EmailType::class,array(
            'label' => 'Correo electrónico: ',
           
        ))
        ->add('telefono',TextType::class , array(
            'label' => 'Teléfono: ',
            ))
            ->add('tipoproveedor', ChoiceType::class, [
                'label' => 'Tipo Proveedor: ',
                'choices'  => [
                    'Hotel' => 'Hotel',
                    'Pista' => 'Pista',
                    'Complemento' => 'Complemento',
                ],
                
            ])
            ->add('telefono',TextType::class , array(
                'label' => 'Teléfono: ',
                ))
            ->add('activo', ChoiceType::class, [
                'label' => 'Activo: ',
                'choices'  => [
                    'Si' => true,
                    'No' => false
                    ],
                    
                ])
        ->add('Enviar', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
