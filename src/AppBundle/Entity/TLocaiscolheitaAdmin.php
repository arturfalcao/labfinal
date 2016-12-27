<?php

namespace AppBundle\Entity;

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
            ->add('ftCodigo' ,null,array('label' => 'Código'))
            ->add('ftDescricao' ,null,array('label' => 'Descrição'))
            ->add('ftAlias' ,null,array('label' => 'Acrónimo'))
            ->add('fnIdConcelho' ,null,array('label' => 'ID concelho'))
            ->add('fnIdTipoLocalcolheita' ,null,array('label' => 'ID tipo local de colheita'))
            ->add('fnIdSistemaabastecimento' ,null,array('label' => 'ID sistema de abast.'))
            ->add('fnIdCliente' ,null,array('label' => 'ID cliente'))
            ->add('ftObservacao' ,null,array('label' => 'Observação'))
            ->add('fbActivo' ,null,array('label' => 'Activo'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ftCodigo' ,null,array('label' => 'Código'))
            ->add('ftDescricao' ,null,array('label' => 'Descrição'))
            ->add('ftAlias' ,null,array('label' => 'Acrónimo'))
            ->add('fnIdConcelho' ,null,array('label' => 'ID concelho'))
            ->add('fnIdTipoLocalcolheita' ,null,array('label' => 'ID tipo local de colheita'))
            ->add('fnIdSistemaabastecimento' ,null,array('label' => 'ID sistema de abastecimento'))
            ->add('fnIdCliente' ,null,array('label' => 'ID cliente'))
            ->add('ftObservacao' ,null,array('label' => 'Observação'))
            ->add('fbActivo' ,null,array('label' => 'Activo'))
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
            ->with('grupo_1',array('description' => 'x','class' => 'col-md-6'))
            ->add('ftCodigo' ,null,array('label' => 'Código'))
            ->add('ftDescricao' ,null,array('label' => 'Descrição'))
            ->add('ftAlias' ,null,array('label' => 'Acrónimo'))
            ->add('fnIdConcelho' ,null,array('label' => 'ID concelho'))
            ->add('fnIdTipoLocalcolheita' ,null,array('label' => 'ID local de colheita'))
            ->end()
            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('fnIdSistemaabastecimento' ,null,array('label' => 'ID sistema de abastecimento'))
            ->add('fnIdCliente' ,null,array('label' => 'ID cliente'))
            ->add('ftObservacao' ,null,array('label' => 'Observação'))
            ->add('fbActivo' ,null,array('label' => 'Activo'))
            ->end()
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
