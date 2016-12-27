<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TModelosamostraAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null, array('label' => 'ID'))
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('fnLimitedias',null, array('label' => 'Limite de dias'))
            ->add('fnIdOrcamento',null, array('label' => 'Orçamento'))
            ->add('ftObservacao',null, array('label' => 'Observação'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null, array('label' => 'ID'))
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('ftObservacao',null, array('label' => 'Observação'))
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
            ->add('fbActivo', 'checkbox', array('required' => true,'label' => 'Activo'))
            ->add('ftDescricao', 'text', array('required' => true,'label' => 'Descrição'))
            ->add('fnLimitedias', 'checkbox', array('required' => true,'label' => 'Limite de dias'))
            ->add('fnIdOrcamento', 'text', array('required' => false,'label' => 'Orçamento'))
            ->add('ftObservacao', 'text', array('required' => false,'label' => 'Observação'))
            ->add('fnCliente', 'sonata_type_model', array('attr'=> array('class'=>'largura'), 'label' => 'Cliente','by_reference' => false))
            ->add('fnTipoaprovacao', 'sonata_type_model', array('attr'=> array('class'=>'largura'), 'label' => 'Tipo aprovação','by_reference' => false))
            ->end();

        $formMapper
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-6'))
            ->add('fnProduto', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'Produto','by_reference' => false))
            ->add('fnLegislacao', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'Legislação','by_reference' => false))
            ->add('fnTipoamostra', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'Tipo amostra','by_reference' => false))
            ->add('fnTipocontrolo', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'Tipo controlo','by_reference' => false))
            ->add('fnGrupoparametros', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'Grupo parâmetros','by_reference' => false))
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
            ->add('fbActivo')
            ->add('ftDescricao')
            ->add('fnLimitedias')
            ->add('fnIdOrcamento')
            ->add('ftObservacao')
        ;
    }
}
