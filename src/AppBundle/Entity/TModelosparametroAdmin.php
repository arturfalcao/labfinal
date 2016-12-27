<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TModelosparametroAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('ftFormulaquimica',null, array('label' => 'Fórmula Q.'))
            ->add('fnPrecocompra',null, array('label' => 'Preço Compra'))
            ->add('fnPrecovenda',null, array('label' => 'Preço Venda'))
            ->add('fnFactorcorreccao',null, array('label' => 'Factor correcção'))
            ->add('fnNrdiasparaexecucao',null, array('label' => 'Dias para Exec.'))
            ->add('fbAcreditado',null, array('label' => 'Acreditado'))
            ->add('fnVolumeminimo',null, array('label' => 'Volume mínimo'))
            ->add('ftObservacao',null, array('label' => 'Observação'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fbActivo',null, array('label' => 'Activo'))
            ->add('ftDescricao',null, array('label' => 'Descrição'))
            ->add('ftFormulaquimica',null, array('label' => 'Fórmula Química'))
            ->add('fnNrdiasparaexecucao',null, array('label' => 'Dias para Execução'))
            ->add('fbAcreditado',null, array('label' => 'Acreditado'))
            ->add('fnVolumeminimo',null, array('label' => 'Volume mínimo'))
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
            ->with('grupo_1',array('description' => 'X','class' => 'col-md-4'))
            ->add('fbActivo', 'checkbox', array('required' => false,'label' => 'Activo'))
            ->add('ftDescricao', 'text', array('required' => true,'label' => 'Descrição'))
            ->add('ftFormulaquimica', 'text', array('required' => false,'label' => 'Fórmula Química'))
            ->add('fnPrecocompra', 'text', array('required' => false,'label' => 'Preço Compra'))
            ->add('fnPrecovenda', 'text', array('required' => false,'label' => 'Preço Venda'))
            ->add('fnFactorcorreccao', 'text', array('required' => false,'label' => 'Factor correcção'))
            ->end()
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-4'))
            ->add('fnNrdiasparaexecucao', 'text', array('required' => true,'label' => 'Dias para Execução'))
            ->add('fbAcreditado', 'checkbox', array('required' => false,'label' => 'Acreditado'))
            ->add('fnVolumeminimo', 'text', array('required' => false,'label' => 'Volume mínimo'))
            ->add('ftObservacao', 'text', array('required' => false,'label' => 'Observação'))
            ->add('fnFamiliaparametro', 'sonata_type_model', array('attr'=> array('class'=>'largura_4'),'label' => 'Família Pârametro','by_reference' => false))
            ->add('fnLaboratorio', 'sonata_type_model', array('attr'=> array('class'=>'largura_4'),'label' => 'Laboratório','by_reference' => false))
            ->end()
            ->with('grupo_3',array('description' => 'Y','class' => 'col-md-4'))
            ->add('fnMetodo', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Método','by_reference' => false))
            ->add('fnTecnica', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Técnica','by_reference' => false))
            ->add('fnAreaensaio', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Área de Ensaio','by_reference' => false))
            ->add('fnModeloresultado', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Modelo de resultado','by_reference' => false))
            ->add('fnFrasco', 'sonata_type_model', array('attr'=> array('class'=>'largura_2'),'label' => 'Frasco','by_reference' => false))
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
            ->add('ftDescricao')
            ->add('ftFormulaquimica')
            ->add('fnPrecocompra')
            ->add('fnPrecovenda')
            ->add('fnFactorcorreccao')
            ->add('fnNrdiasparaexecucao')
            ->add('fbAcreditado')
            ->add('fnVolumeminimo')
            ->add('ftObservacao')
        ;
    }
}
