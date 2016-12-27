<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TLocaiscolheitaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ftCodigo')
            ->add('ftDescricao')
            ->add('ftAlias')
            ->add('fnIdConcelho')
            ->add('fnIdTipoLocalcolheita')
            ->add('fnIdSistemaabastecimento')
            ->add('fnIdCliente')
            ->add('ftObservacao')
            ->add('fbActivo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ftCodigo')
            ->add('ftDescricao')
            ->add('ftAlias')
            ->add('fnIdConcelho')
            ->add('fnIdTipoLocalcolheita')
            ->add('fnIdSistemaabastecimento')
            ->add('fnIdCliente')
            ->add('ftObservacao')
            ->add('fbActivo')
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
            ->add('ftCodigo')
            ->add('ftDescricao')
            ->add('ftAlias')
            ->add('fnIdConcelho')
            ->add('fnIdTipoLocalcolheita')
            ->add('fnIdSistemaabastecimento')
            ->add('fnIdCliente')
            ->add('ftObservacao')
            ->add('fbActivo')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('ftCodigo')
            ->add('ftDescricao')
            ->add('ftAlias')
            ->add('fnIdConcelho')
            ->add('fnIdTipoLocalcolheita')
            ->add('fnIdSistemaabastecimento')
            ->add('fnIdCliente')
            ->add('ftObservacao')
            ->add('fbActivo')
        ;
    }
}
