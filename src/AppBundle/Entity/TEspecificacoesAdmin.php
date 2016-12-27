<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TEspecificacoesAdmin extends Admin
{

    public function prePersist($project)
    {
        $this->preUpdate($project);
    }

    public function preUpdate($project)
    {
        $project->setfnParametros($project->getfnParametros());
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ftCodigo',null, array('label' => 'Código'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('ftAlias',null, array('label' => 'Acrónimo'))
            ->add('ftMensagemUtilizador',null, array('label' => 'MSG utilizador'))
            ->add('ftObservacao',null, array('label' => 'Observação'))
            ->add('ftSiglavl',null, array('label' => 'SiglaVL'))
            ->add('ftLegendavl',null, array('label' => 'LegendaVL'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ftCodigo',null, array('label' => 'Código'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('ftObservacao',null, array('label' => 'Observações'))
            ->add('ftSiglavl',null, array('label' => 'SiglaVL'))
            ->add('ftLegendavl',null, array('label' => 'LegendaVL'))
            ->add('fbActivo',null, array('label' => 'Activo'))
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
            ->with('grupo_1',array('description' => 'X','class' => 'col-md-3'))
            ->add('ftCodigo', 'text', array('required' => true,'label' => 'Código'))
            ->add('ftDescricao', 'text', array('required' => true,'label' => 'Descrição'))
            ->add('ftAlias', 'text', array('required' => false,'label' => 'Acrónimo'))
            ->add('ftMensagemUtilizador', 'text', array('required' => false,'label' => 'MSG utilizador'))
            ->add('ftTextoQdPassaP', 'text', array('required' => false,'label' => 'Texto quando passa pârametro'))
            ->add('ftTextoQdNaoPassaP', 'text', array('required' => false,'label' => 'Texto quando não passa pârametro'))
            ->add('ftTextoQdCumpreA', 'text', array('required' => false,'label' => 'Texto quando cumpre amostra'))
            ->end()
            ->with('grupo_3',array('description' => 'Z','class' => 'col-md-3'))
            ->add('ftTextoQdNaoCumpreA', 'text', array('required' => false,'label' => 'Texto quando não cumpre amostra'))
            ->add('fbEmissaoDeRelatorio', 'checkbox', array('required' => true,'label' => 'Emissão de relatório'))
            ->add('fnLegislacao', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Legislação', 'by_reference' => false))
            ->add('ftObservacao', 'text', array('required' => false,'label' => 'Observações'))
            ->add('ftSiglavl', 'text', array('required' => false,'label' => 'SiglaVL'))
            ->add('ftLegendavl', 'text', array('required' => false,'label' => 'LegendaVL'))
            ->add('fbActivo', 'checkbox', array('required' => false,'label' => 'Activo'))
            ->end()
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-6 Especificacoes'))
            ->add('fnParametros', 'sonata_type_collection', array(
                'cascade_validation' => true,
                'label' => 'Parâmetros',
            ), array(
                    'edit'              => 'inline',
                    'inline'            => 'table',
                    'sortable'          => 'position',
                )
            )
            ->end();
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
            ->add('ftMensagemUtilizador')
            ->add('ftTextoQdPassaP')
            ->add('ftTextoQdNaoPassaP')
            ->add('ftTextoQdCumpreA')
            ->add('ftTextoQdNaoCumpreA')
            ->add('fbEmissaoDeRelatorio')
            ->add('ftObservacao')
            ->add('ftSiglavl')
            ->add('ftLegendavl')
            ->add('fbActivo')
        ;
    }
}
