<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TEspecificacoesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId')
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

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId')
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

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId')
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
