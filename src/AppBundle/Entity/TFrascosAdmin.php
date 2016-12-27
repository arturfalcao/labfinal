<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TFrascosAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fnCapacidade',null,array('label' => 'Capacidade'))
            ->add('fnIdTipomaterial',null,array('label' => 'ID tipo de mat.'))
            ->add('fbEsteril',null,array('label' => 'Estéril'))
            ->add('fnIdAditivo',null,array('label' => 'ID aditivo'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fnCapacidade',null,array('label' => 'Capacidade'))
            ->add('fnIdTipomaterial',null,array('label' => 'ID tipo de material'))
            ->add('fbEsteril',null,array('label' => 'Estéril'))
            ->add('fnIdAditivo',null,array('label' => 'ID aditivo'))
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
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->end()
            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('fnCapacidade',null,array('label' => 'Capacidade'))
            ->add('fnIdTipomaterial',null,array('label' => 'ID tipo de material'))
            ->add('fbEsteril',null,array('label' => 'Estéril'))
            ->add('fnIdAditivo',null,array('label' => 'ID aditivo'))
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
            ->add('ftObservacao')
            ->add('fnCapacidade')
            ->add('fnIdTipomaterial')
            ->add('fbEsteril')
            ->add('fnIdAditivo')
        ;
    }
}
