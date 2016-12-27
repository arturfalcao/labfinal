<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TClientesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null, array('label' => 'ID'))
            ->add('ftCodigo',null, array('label' => 'Código'))
            ->add('ftNome',null, array('label' => 'Nome'))
            ->add('ftAlias',null, array('label' => 'Acrónimo'))
            ->add('ftMorada',null, array('label' => 'Morada'))
            ->add('ftCodpostal',null, array('label' => 'Codigo postal'))
            ->add('ftLocalidade',null, array('label' => 'Localidade'))
            ->add('ftPais',null, array('label' => 'País'))
            ->add('ftTelefone',null, array('label' => 'Telefone'))
            ->add('ftEmail',null, array('label' => 'Email'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId',null, array('label' => 'ID'))
            ->add('ftCodigo',null, array('label' => 'Código'))
            ->add('ftNome',null, array('label' => 'Nome'))
            ->add('ftMorada',null, array('label' => 'Morada'))
            ->add('ftLocalidade',null, array('label' => 'Localidade'))
            ->add('ftTelefone',null, array('label' => 'Telefone'))
            ->add('ftEmail',null, array('label' => 'Email'))
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
            ->add('ftCodigo', 'text', array('required' => true,'label' => 'Código'))
            ->add('ftNome', 'text', array('required' => true,'label' => 'Nome'))
            ->add('ftMorada', 'text', array('required' => true,'label' => 'Morada'))
            ->add('ftCodpostal', 'text', array('required' => true,'label' => 'Código postal'))
            ->add('ftLocalidade', 'text', array('required' => true,'label' => 'Localidade'))
            ->add('ftPais', 'text', array('required' => true,'label' => 'País'))
            ->end();


        $formMapper
            ->with('grupo_2',array('description' => 'Y','class' => 'col-md-4'))

            ->add('ftTelefone', 'integer', array('required' => true,'label' => 'Telefone'))
            ->add('ftNomeUtilizador', 'text', array('required' => false,'label' => 'Nome de Utilizador'))
            ->add('ftEmail', 'text', array('required' => true,'label' => 'Email'))
            ->add('ftpassword', 'text', array('required' => false,'label' => 'Password'))
            ->add('ftNomecontacto', 'text', array('required' => false,'label' => 'Nome do Contacto'))
            ->end();

        $formMapper
            ->with('grupo_3',array('description' => 'Y','class' => 'col-md-4'))
            ->add('ftTelefonecontacto', 'integer', array('required' => false,'label' => 'Telefone Contacto'))
            ->add('ftEmailcontacto', 'text', array('required' => false,'label' => 'Email Contacto'))
            ->add('ftAlias', 'text', array('required' => false,'label' => 'Acrónimo'))
            ->add('ftObservacao', 'text', array('required' => false,'label' => 'Observações'))
            ->add('fbuserativo', 'checkbox', array('label'=> 'Utilizador Ativo','required'  => false,))
            ->end();

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId')
            ->add('ftCodigo')
            ->add('ftNome')
            ->add('ftAlias')
            ->add('ftMorada')
            ->add('ftCodpostal')
            ->add('ftLocalidade')
            ->add('ftPais')
            ->add('ftTelefone')
            ->add('ftEmail')
            ->add('ftObservacao')
            ->add('ftNomecontacto')
            ->add('ftTelefonecontacto')
            ->add('ftEmailcontacto')
        ;
    }
}
