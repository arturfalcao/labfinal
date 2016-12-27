<?php
//src/YourVendor/YourBundle/Admin/UserAdmin.php

namespace AppBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;


class UserAdmin extends BaseUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username',null,array('label' => 'Nome de utilizador'))
            ->add('email',null,array('label' => 'Email'))
            ->add('groups',null,array('label' => 'Grupos'))
            ->add('enabled', null, array('label' => 'Habilitado' ,'editable' => true))
            ->add('locked', null, array('label'=> 'Bloqueado', 'editable' => true))
            ->add('createdAt',null,array('label' => 'Criado em'))
        ;

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper
                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id',null,array('label' => 'ID'))
            ->add('username',null,array('label' => 'Nome de util.'))
            ->add('locked',null,array('label' => 'Bloqueado'))
            ->add('email',null,array('label' => 'Email'))
            ->add('groups',null,array('label' => 'Grupos'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->end()
            ->with('Groups')
            ->add('groups')
            ->end()
            ->with('Profile')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add('gender')
            ->add('locale')
            ->add('timezone')
            ->add('phone')
            ->end()
            ->with('Social')
            ->add('facebookUid')
            ->add('facebookName')
            ->add('twitterUid')
            ->add('twitterName')
            ->add('gplusUid')
            ->add('gplusName')
            ->end()
            ->with('Security')
            ->add('token')
            ->add('twoStepVerificationCode')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('grupo_1',array('description' => 'x','class' => 'col-md-6'))
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->add('dateOfBirth','sonata_type_date_picker', array('label' => 'Data de nascimento','required' => false))
            ->add('firstname', null, array('label' => 'Primeiro nome' ,'required' => false))
            ->add('lastname', null, array('label' => 'Último nome' ,'required' => false))
            ->add('website', 'url', array('label' => 'Website' ,'required' => false))
            ->add('biography', 'text', array('label' => 'Biografia' ,'required' => false))
            ->add('gender', 'sonata_user_gender', array(
                'label' => 'Género' ,
                'required' => true,
                'attr'=> array('class'=>'t_generos'),
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('locale', 'locale', array('label' => 'Nacionalidade' ,'required' => false))
            ->add('timezone', 'timezone', array('label' => 'Fuso horário' ,'required' => false))
            ->add('phone', null, array('label' => 'Telefone' ,'required' => false))
            ->add('facebookUid', null, array('label' => 'ID facebook' ,'required' => false))
            ->add('facebookName', null, array('label' => 'Nome facebook' ,'required' => false))
            ->add('twitterUid', null, array('label' => 'ID twitter' ,'required' => false))
            ->add('twitterName', null, array('label' => 'Nome twitter' ,'required' => false))
            ->add('gplusUid', null, array('label' => 'ID google+' ,'required' => false))
            ->add('gplusName', null, array('label' => 'Nome google+' ,'required' => false))
            ->add('locked', null, array('label' => 'Bloqueado' ,'required' => false))
            ->add('expired', null, array('label' => 'Expirado' ,'required' => false))
            ->add('enabled', null, array('label' => 'Habilitado' ,'required' => false))
            ->add('credentialsExpired', null, array('label' => 'Credenciais expiradas' ,'required' => false))
            ->add('token', null, array('label' => 'Token' ,'required' => false))
            ->add('twoStepVerificationCode', null, array('label' => 'Código de verificação 2 passos' ,'required' => false))
            ->end()

            ->with('grupo_2',array('description' => 'x','class' => 'col-md-6'))
            ->add('groups', 'sonata_type_model', array(
                'label' => 'Grupos' ,
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ));
            if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
                $formMapper
                    ->add('realRoles', 'sonata_security_roles', array(
                        'label'    => 'Permissões',
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false
                    ))
                    ->end()
                ;
            };


        ;




    }

}