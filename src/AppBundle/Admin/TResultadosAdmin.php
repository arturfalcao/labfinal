<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TResultadosAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId')
            ->add('ftDescricao')
            ->add('ftFormatado')
            ->add('ftOriginal')
            ->add('ftPrefixo')
            ->add('fnValor')
            ->add('fnCalculado')
            ->add('ftObservacao')
            ->add('fdCriacao')
            ->add('fdConclusao')
            ->add('fdAutorizacao')
            ->add('fbIncluirnorelatorio')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('fnLimitequantificacao')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId')
            ->add('ftDescricao')
            ->add('ftFormatado')
            ->add('ftOriginal')
            ->add('ftPrefixo')
            ->add('fnValor')
            ->add('fnCalculado')
            ->add('ftObservacao')
            ->add('fdCriacao')
            ->add('fdConclusao')
            ->add('fdAutorizacao')
            ->add('fbIncluirnorelatorio')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('fnLimitequantificacao')
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
            ->add('fnId')
            ->add('ftDescricao')
            ->add('ftFormatado')
            ->add('ftOriginal')
            ->add('ftPrefixo')
            ->add('fnValor')
            ->add('fnCalculado')
            ->add('ftObservacao')
            ->add('fdCriacao')
            ->add('fdConclusao')
            ->add('fdAutorizacao')
            ->add('fbIncluirnorelatorio')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('fnLimitequantificacao')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId')
            ->add('ftDescricao')
            ->add('ftFormatado')
            ->add('ftOriginal')
            ->add('ftPrefixo')
            ->add('fnValor')
            ->add('fnCalculado')
            ->add('ftObservacao')
            ->add('fdCriacao')
            ->add('fdConclusao')
            ->add('fdAutorizacao')
            ->add('fbIncluirnorelatorio')
            ->add('fnMaximo')
            ->add('fnMinimo')
            ->add('fnLimitequantificacao')
        ;
    }
}
