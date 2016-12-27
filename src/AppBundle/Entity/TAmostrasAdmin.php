<?php

namespace AppBundle\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TAmostrasAdmin extends Admin
{
   public function postPersist($user)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $sample = $user->getFnId();

        $paraGroup = $user->getFtGrupoparametros()->getFnId();

        $amostra = $em->getRepository('AppBundle:TAmostras')->findOneByFnId($sample);
        
        $sql = "select * from t_parametrosgrupo where t_grupo = " . $paraGroup;

        $activeDate = $em->getConnection()->prepare($sql);
        $activeDate->execute();
        $arr =  $activeDate->fetchAll();

        // Cria os parametros e gera os primeiros log
        foreach ($arr as $value) {

            $sql = "INSERT INTO t_parametrosamostra (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, fb_acreditado, fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, fn_volumeminimo, fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao ,fb_amostrainterno ,fb_amostraexterno ,fb_determinacaoexterno ,fb_determinacaointerno) SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, 6 , aa.fb_contraanalise, aa.fd_Realizacao ,aa.fb_amostrainterno ,aa.fb_amostraexterno ,aa.fb_determinacaoexterno ,aa.fb_determinacaointerno FROM t_parametros AS aa WHERE aa.fn_id = " . $value['t_parametro'];
            $activeDate = $em->getConnection();
            $activeDate->prepare($sql)->execute();
            $last = $activeDate->lastInsertId();

            //log parametros
            $sql = "INSERT INTO t_parametrosamostra_log (fn_id, listatrabalho_id, ft_descricao, fn_id_metodo, fn_id_tecnica, fn_id_amostra, fn_id_areaensaio, fd_limiterealizacao, ft_cumpreespecificacao, ft_conclusao, fn_id_modeloparametro, ft_observacao, fd_criacao, fd_conclusao, fd_autorizacao, fn_id_laboratorio, fn_precocompra, fn_precovenda, fn_factorcorreccao, fb_acreditado, fn_limitelegal, fn_id_familiaparametro, ft_formulaquimica, fn_id_frasco, fn_volumeminimo, fb_confirmacao, ft_id_estado, fb_contraanalise, fd_Realizacao,id) SELECT aa.fn_id, aa.listatrabalho_id, aa.ft_descricao, aa.fn_id_metodo, aa.fn_id_tecnica, aa.fn_id_amostra, aa.fn_id_areaensaio, aa.fd_limiterealizacao, aa.ft_cumpreespecificacao, aa.ft_conclusao, aa.fn_id_modeloparametro, aa.ft_observacao, aa.fd_criacao, aa.fd_conclusao, aa.fd_autorizacao, aa.fn_id_laboratorio, aa.fn_precocompra, aa.fn_precovenda, aa.fn_factorcorreccao, aa.fb_acreditado, aa.fn_limitelegal, aa.fn_id_familiaparametro, aa.ft_formulaquimica, aa.fn_id_frasco, aa.fn_volumeminimo, aa.fb_confirmacao, 6 , aa.fb_contraanalise, aa.fd_Realizacao , aa.id FROM t_parametrosamostra AS aa WHERE aa.id = " . $last ;
            $activeDate = $em->getConnection();
            $activeDate->prepare($sql)->execute();


            $sql = "UPDATE t_parametrosamostra SET fn_id_amostra = " . $sample . " where id=" .$last;
            $activeDate = $em->getConnection()->prepare($sql);
            $activeDate->execute();

            //log parametros
            $sql = "UPDATE t_parametrosamostra_log SET  date = NOW() ,  user = '". $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser() ."' , fn_id_amostra = " . $sample . " where id=" . $last;


            $activeDate = $em->getConnection()->prepare($sql);
            $activeDate->execute();
        }


        $arr = $em->getRepository('AppBundle:TParametrosamostra')->findByFnIdAmostra($sample);

        foreach ($arr as $value) {

            $value2= $em->getRepository('AppBundle:TParametrosamostra')->findOneBy(array('id' => $value->getId()));
            if(!$em->getRepository('AppBundle:TResultados')->findOneBy(array('fnParametro' => $value2->getFnId(),'fnAmostra' => $amostra->getFnId()))){

                $result = new TResultados();
                $estado_resultados = $em->getRepository('AppBundle:TEstados')->findOneByFtCodigo('D');
                $result->setFnAmostra($amostra);
                $result->setFnParametro($value2);
                $mod_para_id = $value2->getFnIdModeloparametro();
                $mod_para = $em->getRepository('AppBundle:TModelosparametro')->findOneByFnId($mod_para_id);
                $result->setFnModeloresultado($mod_para->getFnModeloresultado());
                $result->setFnUnidade($mod_para->getFnModeloresultado()->getFnUnidade());
                $result->setFtDescricao($value2->getFtDescricao());
                $result->setFtEstado($estado_resultados);

                $em->persist($result);
                $em->flush();
                $sql = "UPDATE t_resultados SET fn_id_parametro = " . $result->getFnParametro()->getId() . " where fn_id=" . $result->getFnId();
                $activeDate = $em->getConnection()->prepare($sql);
                $activeDate->execute();
            }
        }
    }

    public function prePersist($user)
    {
        $user1 = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $user->setUpdatedBy($user1->getUsername());
        $user->setUpdatedByTime(date('Y-m-d H:i:s'));
    }

    public function preUpdate($user)
    {
        $user1 = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $user->setUpdatedBy($user1->getUsername());
        $user->setUpdatedByTime(date('Y-m-d H:i:s'));
    }

    public function preRemove($user)
    {
        $user1 = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $user->setUpdatedBy($user1->getUsername());
        $user->setUpdatedByTime(date('Y-m-d H:i:s'));
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fnId',null,array('label' => 'ID'))
            ->add('fnNumero',null,array('label' => 'Número'))
            ->add('ftSerie',null,array('label' => 'Série'))
            ->add('fdCriacao','doctrine_orm_datetime', array('label'=> 'Criação',
                'field_type'=>'sonata_type_datetime_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdCriacao',null, array('label'=> 'Criação'))
            ->add('fdColheita', 'doctrine_orm_datetime_range', array('label' => false,'field_type'=>'sonata_type_datetime_range_picker','format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdColheita', 'doctrine_orm_datetime_range', array('label' => false), null, array('label' => 'Data colheita','widget' => 'single_text','attr' => array('class' => 'datepicker')))
            ->add('fdRecepcao','doctrine_orm_datetime', array('label'=> 'Recepção','field_type'=>'sonata_type_datetime_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdRecepcao',null,array('label' => 'Recepção'))
            ->add('fdConclusao','doctrine_orm_datetime', array('label'=> 'Conclusão','field_type'=>'sonata_type_datetime_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdConclusao',null,array('label' => 'Conclusão'))
            ->add('fdLimite','doctrine_orm_datetime', array('label'=> 'Limite','field_type'=>'sonata_type_datetime_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdLimite',null,array('label' => 'Limite'))
            ->add('ftResponsavelcolheita',null,array('label' => 'Responsável'))
            ->add('fnLocalcolheita',null,array('label' => 'Local da colheita'))
            ->add('fnOperador',null,array('label' => 'Operador'))
            ->add('fnCliente',null,array('label' => 'Cliente'))
            ->add('fnModelo',null,array('label' => 'Modelo'))
            ->add('fnTipoaprovacao',null,array('label' => 'Tipo de aprovação'))
            ->add('fdAutorizacao','doctrine_orm_datetime', array('label'=> 'Autorização','field_type'=>'sonata_type_datetime_picker','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            //->add('fdAutorizacao',null,array('label' => 'Autorização'))
            ->add('fnProduto',null,array('label' => 'Produto'))
            ->add('fnTipocontrolo',null,array('label' => 'Tipo de controlo'))
            ->add('fnIdOrcamento',null,array('label' => 'ID orçamento'))
            ->add('ftEstado',null,array('label' => 'Estado'))
            ->add('fnEspecificacao',null,array('label' => 'Especificação'))
            ->add('ftCumpreespecificacao',null,array('label' => 'Cumpre especificação'))
            ->add('fdInicioanalise','doctrine_orm_datetime', array('label'=> 'Ínicio da análise','field_type'=>'sonata_type_datetime_picker',))
            //->add('fdInicioanalise',null,array('label' => 'Início da análise'))
            ->add('fbFacturada',null,array('label' => 'Faturada'))
            ->add('fnRequisicaocliente',null,array('label' => 'Requisição cliente'))

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fnId','bigint',array('label' => 'ID'))
            ->add('ftEstado',null,array('label' => 'Estado'))
            ->add('fbRelatorioemitido','boolean', array('label' => 'Relatório') )
            ->add('ftSerie','string',array('label' => 'Série'))
            ->add('fnProduto',null,array('label' => 'Produto'))
            ->add('fdColheita','datetime',array('label' => 'Colheita'))
            ->add('fdConclusao','datetime',array('label' => 'Data da conclusão'))
            ->add('fnCliente',null,array('label' => 'Cliente'))
            ->add('fnLocalcolheita',null,array('label' => 'Local da colheita'))
            ->add('ftConclusao','string',array('label' => 'Conclusão'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    

                )
            ))
        ;


    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $x= 'col-md-6';
        if ($this->id($this->getSubject())) {
            $formMapper
                ->with('codigo',array('description' => 'Código','class' => 'Codigo_amostra col-md-2'))
                ->add('fnId', 'text', array('label' => 'ID','read_only' => true,'disabled'  => true))
                ->end();

                $x = 'col-md-4';
        }
        
        $formMapper
            ->with('Cliente',array('description' => 'Cliente','class' => $x . ' Cliente_amostra'))
                ->add('fnCliente', 'sonata_type_model', array('label' => 'Cliente', 'by_reference' => false))
            ->end()

            ->end()

            ->with('Caracterização',array('description' => 'Caracterização','class' => 'Caracterizacao_amostra'))
            ->add('fbFacturada','checkbox',array('required'=> false,'label' => 'Faturada'))
            ->add('fnProduto', 'sonata_type_model', array('attr'=> array('class'=>'_produto'),'label' => 'Produto', 'by_reference' => false))
            ->add('ftOrigem', 'text', array('label' => 'Origem', 'by_reference' => false))
            ->add('fnLegislacao', 'sonata_type_model', array('attr'=> array('class'=>'_legislacao'),'label' => 'Legislação', 'by_reference' => false))
            ->add('fnEspecificacao', 'sonata_type_model', array('attr'=> array('class'=>'_especificacao'),'label' => 'Especificação', 'by_reference' => false))
            ->add('fnRequisicaocliente', 'sonata_type_model', array('label' => 'Requisição do cliente', 'by_reference' => false))
            ->add('fnTipocontrolo', 'sonata_type_model', array('label' => 'Tipo de Controlo', 'by_reference' => false))
            ->add('fnTipo', 'sonata_type_model', array('label' => 'Tipo', 'by_reference' => false))
            ->add('fnTipoaprovacao', 'sonata_type_model', array('label' => 'Tipo de aprovação', 'by_reference' => false))
            ->add('ftEstado', 'sonata_type_model', array('attr'=> array('class'=>'_estado'),'label' => 'Estado', 'by_reference' => false))
            ->add('fbFacturada', null, array('label' => 'Faturada'))
            ->add('ftConclusao', 'text', array('required'=> false,'attr'=> array('class'=>'_conclusao'),'label' => 'Conclusão'))
            ->add('ftObs', 'text', array('required'=> false,'label' => 'Observações'))
            ->end()


            ->with('Lancamento',array('description' => 'Lançamento','class' => 'Lancamento_amostra'))
                ->add('fnModelo', 'sonata_type_model', array('btn_add' => false,'required' => true,'attr'=> array('class'=>'_modeloamostra'),'label' => 'Modelo Amostra', 'by_reference' => false))
                ->add('ftGrupoparametros', 'sonata_type_model', array( 'btn_add' => false,'required' => true,'attr'=> array('class'=>'_grupoparametros'),'label' => 'Grupo de parâmetros', 'by_reference' => true,'disabled'  => false))
            ->end()

            ->with('Lote',array('description' => 'Lote','class' => 'Lote_amostra'))
            ->add('fnAmostrasalimentos', 'sonata_type_admin',array(
                'btn_add' => false,'delete' => false,'label' => 'Amostras de alimentos','required' => false,
                'label_attr' => array('class' => 'L_AA'),
            ))
            ->end()

            ->with('x',array('description' => 'Dados da colheita','class' => ' Dados_amostra'))
            ->add('fdColheita','sonata_type_datetime_picker', array('label' => 'Data/hora colheita','format' => 'dd-MM-yyyy',
                'attr' => array(
                    'data-date-format' => 'DD-MM-YYYY',
                )))
            ->add('fnOperador',null,array('label'=>'Nome do operador'))
            ->add('ftResponsavelcolheita', 'choice',  array('label'=>'Responsável colheita','multiple' => false,'choices' => array('Cliente' => 'Cliente','Laboratorio' => 'Laboratório','Outro' => 'Outro')))
            ->end();

             if ($this->id($this->getSubject())) {
             }
             else {
                 $em = $this->modelManager->getEntityManager('AppBundle:TEstados');
                 $query = $em->createQueryBuilder('c')
                     ->select('c')
                     ->from('AppBundle:TEstados', 'c')
                     ->where("c.ftId = 'V' or c.ftId = 'I'");
                 $formMapper ->with('Addresses', array('class' => 'display_none'))
                     ->add('ftEstado','sonata_type_model', array('label'=>'Estado','query' => $query))
                     ->end();
             }
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fnId')
            ->add('fnNumero')
            ->add('ftSerie')
            ->add('fdCriacao')
            ->add('fdColheita')
            ->add('fdRecepcao')
            ->add('fdConclusao')
            ->add('fdLimite')
            ->add('ftResponsavelcolheita')
            ->add('fnLocalcolheita')
            ->add('fnOperador')
            ->add('fnCliente')
            ->add('fnModelo')
            ->add('fnTipoaprovacao')
            ->add('fdAutorizacao')
            ->add('fnProduto')
            ->add('ftOrigem')
            ->add('ftGrupoparametros')
            ->add('fnLegislacao')
            ->add('ftTipoemissaorelatorio')
            ->add('fbRelatorioemitido')
            ->add('fdEmissaorelatorio')
            ->add('fnTipo')
            ->add('ftRefexterna')
            ->add('ftConclusao')
            ->add('ftObs')
            ->add('fnTipocontrolo')
            ->add('fnIdOrcamento')
            ->add('ftEstado')
            ->add('fnEspecificacao')
            ->add('ftCumpreespecificacao')
            ->add('fdInicioanalise')
            ->add('fbFacturada')
            ->add('fnRequisicaocliente')
        ;
    }
}
