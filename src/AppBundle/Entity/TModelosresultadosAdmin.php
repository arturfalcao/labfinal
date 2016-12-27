<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TModelosresultadosAdmin extends Admin
{

    public function prePersist($project)
    {
        $this->preUpdate($project);
    }

    public function preUpdate($project)
    {
        $project->setRegasFormatacao($project->getRegasFormatacao());
    }


    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('fbIncluirnorelatorio',null, array('label' => 'Incluir relatório'))
            ->add('fbGamavalores',null, array('label' => 'Gama de valores'))
            ->add('fnMaximo',null, array('label' => 'Máximo'))
            ->add('fnMinimo',null, array('label' => 'Mínimo'))
            ->add('ftMensagemutilizador',null, array('label' => 'MSG utilizador'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('fnLimitequantificacao',null, array('label' => 'Limite'))
            ->add('ftObservacao',null, array('label' => 'Observação'))
            ->add('fnIncerteza',null, array('label' => 'Incerteza'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId','number', array('label' => 'ID'))
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('fbIncluirnorelatorio',null, array('label' => 'Boletim'))
            ->add('ftDescricao','text', array('label' => 'Nome'))
            ->add('fnUnidade','text', array('label' => 'Unidades'))
            ->add('fnLimitequantificacao','text', array('label' => 'Quantificação'))
            ->add('fbGamavalores',null, array('label' => 'Gama de valores'))
            ->add('fnMaximo','number', array('label' => 'Máximo'))
            ->add('fnMinimo','number', array('label' => 'Mínimo'))
            ->add('fnIncerteza','number', array('label' => 'Incerteza'))
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
            ->with('x',array('class' => 'Modelosresultados col-md-6'))
                ->add('fbActivo',null, array('label' => 'Activo'))
                ->add('ftDescricao','text', array('label' => 'Descrição'))
                ->add('ftObservacao','text', array('label' => 'Observação'))
                ->add('fnUnidade', 'sonata_type_model', array('attr'=> array('class'=>'largura_3'), 'label' => 'Unidade de Medida', 'by_reference' => false))
                ->add('fnTipoarredondamento', 'sonata_type_model', array('attr'=> array('class'=>'largura_3'),'label' => 'Tipo de Arredondamento','by_reference' => false))
                
                ->add('fbGamavalores',null,array('label' => 'Gama de Valores'))
                ->add('fbIncluirnorelatorio','checkbox', array('label' => 'Incluir no relatório'))
                ->add('fnMaximo','number', array('label' => 'Máximo'))
                ->add('fnMinimo','number', array('label' => 'Mínimo'))
                ->add('fnIncerteza','number', array('label' => 'Incerteza'))
                ->add('fnLimitequantificacao','integer', array('label' => 'Limite quantificação'))
                ->add('ftMensagemutilizador','text', array('label' => 'Mensagem utilizador'))

            ->end()

            ->with('Gallery',array('class'=> 'TabelaModeloresultados col-md-6'))
            ->add('RegasFormatacao', 'sonata_type_collection', array(
                'cascade_validation' => true,
                'label' => 'Regras de Formatação',
            ), array(
                    'edit'              => 'inline',
                    'inline'            => 'table',
                    'sortable'          => 'position',
                )
            )
            ->end()
        ;

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fbActivo')
            ->add('fbIncluirnorelatorio')
            ->add('fbGamavalores')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('ftMensagemutilizador')
            ->add('ftDescricao')
            ->add('fnLimitequantificacao')
            ->add('ftObservacao')
        ;
    }
}
