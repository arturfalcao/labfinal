<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TRequisicoesclienteAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('fnIdCliente',null,array('label' => 'ID cliente'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fdDatarequisicao', 'doctrine_orm_datetime_range', array('label' => false,'field_type'=>'sonata_type_datetime_range_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdDatarequisicao', 'doctrine_orm_datetime_range', array('label' => false), null, array('label' => 'Data da requisição','widget' => 'single_text','attr' => array('class' => 'datepicker')))
            ->add('fbActiva',null,array('label' => 'Activa'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('fnIdCliente',null,array('label' => 'ID cliente'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fdDatarequisicao',null,array('label' => 'Data da requisição'))
            ->add('fbActiva',null,array('label' => 'Activa'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('grupo_1',array('description' => 'Lançamento','class' => 'col-md-6'))
            ->add('fnIdCliente',null,array('label' => 'ID cliente'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->end()
            ->with('grupo_2',array('description' => 'Lançamento','class' => 'col-md-6'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fdDatarequisicao','sonata_type_datetime_picker', array('label' => 'Data da requisição','format' => 'dd-MM-yyyy',
                'attr' => array(
        'data-date-format' => 'DD-MM-YYYY',
    )))
            ->add('fbActiva',null,array('label' => 'Activa'))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId')
            ->add('fnIdCliente')
            ->add('ftCodigo')
            ->add('ftObservacao')
            ->add('fdDatarequisicao')
            ->add('fbActiva')
        ;
    }
}
