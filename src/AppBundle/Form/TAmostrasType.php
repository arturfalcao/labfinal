<?php

namespace AppBundle\Form;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TAmostrasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fnCliente',null, array('label'=>'Cliente'))
            ->add('ftRefexterna','text', array('label'=>'Local de Recolha'))
            ->add('ftGrupoparametros',null, array('label'=>'Grupo de Parametros'))
            ->add('startdatetime', 'datetime', array('label'=>'Data de inicio','date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('enddatetime', 'datetime', array('label'=>'Data de fim','date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('fnProduto',null, array('label'=>'Produto'))

        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnCliente')
            ->add('fnLocalcolheita')
            ->add('ftGrupoparametros')
            ->add('startdatetime', 'datetime', array('label'=>'Data de inicio','date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('enddatetime', 'datetime', array('label'=>'Data de fim','date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnCliente')
            ->add('fnLocalcolheita')
            ->add('ftGrupoparametros')
            ->add('startdatetime', 'datetime', array('label'=>'Data de inicio','date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('enddatetime', 'datetime', array('label'=>'Data de fim','date_widget' => "single_text", 'time_widget' => "single_text"));
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TAmostras'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Novo_Planeamento';
    }
}
