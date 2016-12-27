<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TProdutosAdmin extends Admin
{

    public function prePersist($project)
    {
        $project->setfnEspecificacoes($project->getfnEspecificacoes());
    }
    public function preUpdate($project)
    {
        $project->setfnEspecificacoes($project->getfnEspecificacoes());
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('fnEspecificacoes',null,array('label' => 'Especificações'))
            ->add('fnFamiliaproduto',null,array('label' => 'Família do Prod.'))
            ->add('fnLegislacao',null,array('label' => 'Legislação'))
            ->add('ftObservacao',null,array('label' => 'Observação'))

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
            ->add('fnFamiliaproduto',null,array('label' => 'Família do Produto'))
            ->add('fnLegislacao',null,array('label' => 'Legislação'))
            ->add('fnEspecificacoes',null,array('label' => 'Especificações'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('fbActivo',null,array('label' => 'Activo'))
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
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftDescricao',null,array('label' => 'Descrição'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('fnFamiliaproduto', 'sonata_type_model', array('attr'=> array('class'=>'largura'), 'label' => 'Família do Produto', 'by_reference' => false))
            ->end()
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-6'))
            ->add('fnEspecificacoes', 'sonata_type_model', array('label' => 'Especificações','btn_add' => false,'multiple' => true, 'by_reference' => false))
            ->add('fnLegislacao', 'sonata_type_model', array('attr'=> array('class'=>'largura'), 'label' => 'Legislação', 'by_reference' => false))
            ->add('ftObservacao', 'text', array('label' => 'Observações', 'by_reference' => false))
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
            ->add('fnEspecificacoes')
            ->add('fnFamiliaproduto')
            ->add('fnLegislacao')
            ->add('ftObservacao')

        ;
    }
}
