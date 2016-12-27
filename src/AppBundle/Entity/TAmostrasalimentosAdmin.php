<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TAmostrasalimentosAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label'=>'ID'))
            ->add('ftLote',null,array('label'=>'Lote'))
            ->add('ftAcondicionamento',null,array('label'=>'Acondicionamento'))
            ->add('ftValidade',null,array('label'=>'Validade'))
            ->add('ftTemperatura',null,array('label'=>'Temperatura'))
            ->add('ftFaseprocesso',null,array('label'=>'Fase do proc.'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null,array('label'=>'ID'))
            ->add('ftLote',null,array('label'=>'Lote'))
            ->add('ftAcondicionamento',null,array('label'=>'Acondicionamento'))
            ->add('ftValidade',null,array('label'=>'Validade'))
            ->add('ftTemperatura',null,array('label'=>'Temperatura'))
            ->add('ftFaseprocesso',null,array('label'=>'Fase do processo'))
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
            ->add('ftLote',null,array('required' => false,'label'=>'Lote'))
            ->add('ftAcondicionamento',null,array('required' => false,'label'=>'Acondicionamento'))
            ->end()
            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('ftValidade',null,array('required' => false,'label'=>'Validade'))
            ->add('ftTemperatura',null,array('required' => false,'label'=>'Temperatura'))
            ->add('ftFaseprocesso',null,array('required' => false,'label'=>'Fase do processo'))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId',null,array('label'=>'ID'))
            ->add('ftLote',null,array('label'=>'Lote'))
            ->add('ftAcondicionamento',null,array('label'=>'Acondicionamento'))
            ->add('ftValidade',null,array('label'=>'Validade'))
            ->add('ftTemperatura',null,array('label'=>'Temperatura'))
            ->add('ftFaseprocesso',null,array('label'=>'Fase do processo'))
        ;
    }
}
