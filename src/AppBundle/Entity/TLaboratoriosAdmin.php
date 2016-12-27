<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TLaboratoriosAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ftNclaboratorio',null,array('label' => 'Nc Laboratório'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftNome',null,array('label' => 'Nome'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftMorada',null,array('label' => 'Morada'))
            ->add('ftCodpostal',null,array('label' => 'Código postal'))
            ->add('ftLocalidade',null,array('label' => 'Localidade'))
            ->add('ftPais',null,array('label' => 'País'))
            ->add('ftTelefone',null,array('label' => 'Telefone'))
            ->add('ftEmail',null,array('label' => 'Email'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftNomecontacto',null,array('label' => 'Nome do cont.'))
            ->add('ftTelefonecontacto',null,array('label' => 'Telef. do cont.'))
            ->add('ftEmailcontacto',null,array('label' => 'Email do cont.'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ftNclaboratorio',null,array('label' => 'Nc Laboratório'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftNome',null,array('label' => 'Nome'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftMorada',null,array('label' => 'Morada'))
            ->add('ftCodpostal',null,array('label' => 'Código postal'))
            ->add('ftLocalidade',null,array('label' => 'Localidade'))
            ->add('ftPais',null,array('label' => 'País'))
            ->add('ftTelefone',null,array('label' => 'Telefone'))
            ->add('ftEmail',null,array('label' => 'Email'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftNomecontacto',null,array('label' => 'Nome do contacto'))
            ->add('ftTelefonecontacto',null,array('label' => 'Telefone do contacto'))
            ->add('ftEmailcontacto',null,array('label' => 'Email do contacto'))
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
            ->with('grupo_1',array('description' => 'x','class' => 'col-md-4'))
            ->add('ftNclaboratorio',null,array('label' => 'Nc Laboratório'))
            ->add('ftCodigo',null,array('label' => 'Código'))
            ->add('ftNome',null,array('label' => 'Nome'))
            ->add('ftAlias',null,array('label' => 'Acrónimo'))
            ->add('ftMorada',null,array('label' => 'Morada'))

            ->end()
            ->with('grupo_2',array('description' => 'y','class' => 'col-md-4'))
            ->add('ftCodpostal',null,array('label' => 'Código postal'))
            ->add('ftLocalidade',null,array('label' => 'Localidade'))
            ->add('ftPais',null,array('label' => 'País'))
            ->add('ftTelefone',null,array('label' => 'Telefone'))
            ->add('ftEmail',null,array('label' => 'Email'))

            ->end()
            ->with('grupo_3',array('description' => 'y','class' => 'col-md-4'))
            ->add('ftObservacao',null,array('label' => 'Observação'))
            ->add('ftNomecontacto',null,array('label' => 'Nome do contacto'))
            ->add('ftTelefonecontacto',null,array('label' => 'Telefone do contacto'))
            ->add('ftEmailcontacto',null,array('label' => 'Email do contacto'))

            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('ftNclaboratorio')
            ->add('ftCodigo')
            ->add('ftNome')
            ->add('ftAlias')
            ->add('ftMorada')
            ->add('ftCodpostal')
            ->add('ftLocalidade')
            ->add('ftPais')
            ->add('ftTelefone')
            ->add('ftFax')
            ->add('ftEmail')
            ->add('ftObservacao')
            ->add('ftNomecontacto')
            ->add('ftTelefonecontacto')
            ->add('ftEmailcontacto')
        ;
    }
}
