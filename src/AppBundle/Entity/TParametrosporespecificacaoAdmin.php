<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TParametrosporespecificacaoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label' => 'ID'))

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null,array('label' => 'ID'))
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
            ->add('fnIdFamiliaparametro', 'sonata_type_model', array('attr'=> array('class'=>'largura'),'label' => 'ID Família Parâmetros', 'by_reference' => false))
            ->add('fnMaximo', 'text', array('label' => 'Máximo'))
            ->end()
            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('fnMinimo', 'text', array('label' => 'Mínimo'))
            ->add('ftTextoRelatorio', 'text', array('label' => 'Texto no relatório'))
            ->end()
        ;

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId');
    }
}
