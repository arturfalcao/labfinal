<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TModelosresultadosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fbActivo')
            ->add('fnIdUnidade')
            ->add('fbIncluirnorelatorio')
            ->add('fbGamavalores')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('ftMensagemutilizador')
            ->add('ftDescricao')
            ->add('fnLimitequantificacao')
            ->add('ftObservacao')
            ->add('fnTipoarredondamento')
            ->add('save', 'submit', array('label' => 'Gravar'))
            ->add('saveandback', 'submit', array('label' => 'Gravar e voltar a lista '))
            ->add('saveandadd', 'submit', array('label' => 'Gravar e adicionar novo'))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TModelosresultados'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_tmodelosresultados';
    }
}
