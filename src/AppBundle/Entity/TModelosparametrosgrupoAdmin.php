<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TModelosparametrosgrupoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnIdGrupo',null,array('label' => 'ID Grupo'))
            ->add('fnIdModeloparametro',null,array('label' => 'ID Modelo Parâmetro'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnIdGrupo',null,array('label' => 'ID Grupo'))
            ->add('fnIdModeloparametro',null,array('label' => 'ID Modelo parâmetro'))
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
            ->add('fnIdGrupo',null,array('label' => 'ID'))
            ->add('fnIdModeloparametro',null,array('label' => 'ID Modelo parâmetro'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnIdGrupo')
            ->add('fnIdModeloparametro')
        ;
    }
}
