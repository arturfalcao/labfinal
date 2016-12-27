<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TRequisicoesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('fnIdLaboratorio',null,array('label' => 'ID laboratório'))
            ->add('fdUltimaemissao', 'doctrine_orm_datetime_range', array('label' => false,'field_type'=>'sonata_type_datetime_range_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdUltimaemissao', 'doctrine_orm_datetime_range', array('label' => false), null, array('label' => 'Última emissão','widget' => 'single_text','attr' => array('class' => 'datepicker')))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftUltimoutilizador',null,array('label' => 'Último utilizador'))
            ->add('fbAnulada',null,array('label' => 'Anulada'))
            ->add('fnDesconto',null,array('label' => 'Desconto'))
            ->add('ftTipopagamento',null,array('label' => 'Tipo de pag.'))
            ->add('ftPrazoentrega',null,array('label' => 'Prazo de entrega'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('fnIdLaboratorio',null,array('label' => 'ID laboratório'))
            ->add('fdUltimaemissao',null,array('label' => 'Última emissão'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftUltimoutilizador',null,array('label' => 'Último utilizador'))
            ->add('fbAnulada',null,array('label' => 'Anulada'))
            ->add('fnDesconto',null,array('label' => 'Desconto'))
            ->add('ftTipopagamento',null,array('label' => 'Tipo de pagamento'))
            ->add('ftPrazoentrega',null,array('label' => 'Prazo de entrega'))
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
            ->add('fnIdLaboratorio',null,array('label' => 'ID laboratório'))
            ->add('fdUltimaemissao','sonata_type_datetime_picker', array('label' => 'Última emissão','format' => 'dd-MM-yyyy',
                'attr' => array(
        'data-date-format' => 'DD-MM-YYYY',
    )))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftUltimoutilizador',null,array('label' => 'Último utilizador'))
            ->end()
            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('fbAnulada',null,array('label' => 'Anulada'))
            ->add('fnDesconto',null,array('label' => 'Desconto'))
            ->add('ftTipopagamento',null,array('label' => 'Tipo de pagamento'))
            ->add('ftPrazoentrega',null,array('label' => 'Prazo de entrega'))
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
            ->add('fnIdLaboratorio')
            ->add('fdUltimaemissao')
            ->add('ftObservacao')
            ->add('ftUltimoutilizador')
            ->add('fbAnulada')
            ->add('fnDesconto')
            ->add('ftTipopagamento')
            ->add('ftPrazoentrega')
        ;
    }
}
