<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ModelosListasAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tablejson',null,array('label' => 'Estrutura lista de trabalho'))
            ->add('idParametro',null,array('label' => 'ID parâmetro'))
        ;
    }



    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idParametro',null,array('label' => 'ID parâmetro'))
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
            ->add('idParametro',null,array('required'=>true,'label' => 'ID parâmetro'))
            ->add('tablejson', 'text', array('attr' => array('class' => 'tabela'),'label_attr' => array('class' => 'margem_n20'), 'label'=>'Estrutura lista de trabalho'))
            ->add('cabecalhojson', 'text', array('required' => false,'attr' => array('class' => 'header'),'label_attr' => array('class' => 'LABELCABJSON'),
                'label'=>''))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('tablejson')
        ;
    }
}
