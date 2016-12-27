<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TUnidadesmedidaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label'=>'ID'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição' ))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
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
            ->with('grupo_1',array('description' => 'X','class' => 'col-md-6'))
            ->add('ftCodigo', null, array('label' => 'Código'))
            ->add('ftDescricao', null, array('label' => 'Descrição') )
            ->end()
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-6'))
            ->add('ftAlias', null, array('label' => 'Acrónimo'))
            ->add('ftObservacao', null, array('label' => 'Observação'))
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
            ->add('ftCodigo')
            ->add('ftDescricao')
            ->add('ftAlias')
            ->add('ftObservacao')
        ;
    }
}
