<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TRegrasformatacaoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fnOrdem')
            ->add('ftDescricao')
            ->add('fnLimiteinferior')
            ->add('fnLimitesuperior')
            ->add('fnCasasdecimais')
            ->add('fbFormatoexponencial')
            ->add('fbFormatoutilizador')
            ->add('ftExpressaoutilizador')
            ->add('fnModeloresultado')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TRegrasformatacao'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_tregrasformatacao';
    }
}
