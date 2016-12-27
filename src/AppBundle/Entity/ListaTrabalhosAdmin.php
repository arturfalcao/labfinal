<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ListaTrabalhosAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,array('label' => 'ID'))
            ->add('dataemissao', 'doctrine_orm_datetime_range', array('label' => false), null, array('label' => 'Data de emissão','widget' => 'single_text','attr' => array('class' => 'datepicker')))
            ->add('datafecho', 'doctrine_orm_datetime_range', array('label' => false), null, array('label' => 'Data de emissão','widget' => 'single_text','attr' => array('class' => 'datepicker')))
            ->add('id_parametro_amostra.fnIdAmostra',null,array('label' => 'ID Amostra'))
            ->add('id_parametro_amostra.ftDescricao',null,array('label' => 'Parâmetro'))
        ;
    }



    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,array('label' => 'ID'))
            ->add('dataemissao',null,array('label' => 'Data de emissão'))
            ->add('datafecho',null,array('label' => 'Data de fecho'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'imprime' => array(),
                    
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
            ->add('id',null,array('label' => 'ID'))
            ->add('dataemissao',null,array('label' => 'Data de emissão'))
            ->add('datafecho',null,array('label' => 'Data de emissão'))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id',null,array('label' => 'ID'))
            ->add('dataemissao',null,array('label' => 'Data de emissão'))
            ->add('datafecho',null,array('label' => 'Data de emissão'))
        ;
    }
}
