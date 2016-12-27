<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
/**
 * TAmostras
 *
 * @ORM\Table(name="t_amostras", indexes={@ORM\Index(name="IDX_6F19836424C8FD6", columns={"fn_id_cliente"}), @ORM\Index(name="IX_t_amostras_data_colheita", columns={"fd_colheita"}), @ORM\Index(name="IX_t_amostras_estado", columns={"ft_id_estado"}), @ORM\Index(name="IX_t_amostras_local_colheita", columns={"fn_id_localcolheita"}), @ORM\Index(name="IX_t_amostras_orcamento", columns={"fn_id_orcamento"}), @ORM\Index(name="IX_t_amostras_produto", columns={"fn_id_produto"})})
 * @ORM\Entity
 */
class TAmostras
{

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_done", type="integer")
     */

    private $fnDone=0;

    /**
     * Set done
     *
     * @param integer $done
     * @return Agenda
     */
    public function setFnDone($done)
    {
        $this->fnDone = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return integer
     */
    public function getFnDone()
    {
        return $this->fnDone;
    }




    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    private $createdBy;

    /**
     * @var string $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(type="string")
     */
    private $updatedBy;
    /**
     * @var string $createdByTime
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    private $createdByTime;

    /**
     * @var string $updatedByTime
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(type="string")
     */
    private $updatedByTime;



    public function getCreatedByTime()
    {
        return $this->createdByTime;
    }

    public function getUpdatedByTime()
    {
        return $this->updatedByTime;
    }



    public function setCreatedByTime($createdByTime)
    {
        $this->createdByTime = $createdByTime;
        return $this->createdByTime;
    }

    public function setUpdatedByTime($updatedByTime)
    {
        $this->updatedByTime = $updatedByTime;
        return $this->updatedByTime;
    }



    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }



    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this->createdBy;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this->updatedBy;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fnId;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_numero", type="bigint", nullable=true)
     */
    private $fnNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_serie", type="string", length=5, nullable=true)
     */
    private $ftSerie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_criacao", type="datetime", nullable=true)
     */
    private $fdCriacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_colheita", type="datetime", nullable=true)
     */
    private $fdColheita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_recepcao", type="datetime", nullable=true)
     */
    private $fdRecepcao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_conclusao", type="datetime", nullable=true)
     */
    private $fdConclusao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_limite", type="datetime", nullable=true)
     */
    private $fdLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_responsavelcolheita", type="string", length=100, nullable=true)
     */
    private $ftResponsavelcolheita;

  
    /**
     * @ORM\ManyToMany(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinTable(name="operador_amostra",
     *      joinColumns={@ORM\JoinColumn(name="fn_id_amostra", referencedColumnName="fn_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_operador", referencedColumnName="id")}
     *      )
     */
    private $fnOperador;

    public function __construct() {
        $this->fnOperador = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function addFnOperador(\Application\Sonata\UserBundle\Entity\User $fnOperador)
    {
        $this->fnOperador[] = $fnOperador;
        return $this;
    }
    public function removeFnOperador(\Application\Sonata\UserBundle\Entity\User $fnOperador)
    {
        $this->fnOperador->remove($fnOperador);
    }
    public function setFnOperador($fnOperador)
    {
        $this->fnOperador = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($fnOperador as $m) {
            $this->addFnOperador($m);
        }
        return $this;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_autorizacao", type="datetime", nullable=true)
     */
    private $fdAutorizacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_origem", type="string", length=100, nullable=true)
     */
    private $ftOrigem;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_tipoemissaorelatorio", type="string", length=2, nullable=true)
     */
    private $ftTipoemissaorelatorio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_relatorioemitido", type="boolean", nullable=true)
     */
    private $fbRelatorioemitido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_emissaorelatorio", type="datetime", nullable=true)
     */
    private $fdEmissaorelatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_refexterna", type="string", length=300, nullable=true)
     */
    private $ftRefexterna;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_conclusao", type="string", length=300, nullable=true)
     */
    private $ftConclusao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_obs", type="string", length=300, nullable=true)
     */
    private $ftObs;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_orcamento", type="bigint", nullable=true)
     */
    private $fnIdOrcamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_cumpreespecificacao", type="string", length=1, nullable=true)
     */
    private $ftCumpreespecificacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_inicioanalise", type="datetime", nullable=true)
     */
    private $fdInicioanalise;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_facturada", type="boolean", nullable=true)
     */
    private $fbFacturada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDatetime", type="datetime", nullable=true)
     */
    private $startdatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDatetime", type="datetime", nullable=true)
     */
    private $enddatetime;

    /**
     * @var \TClientes
     *
     * @ORM\ManyToOne(targetEntity="TClientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_cliente", referencedColumnName="fn_id")
     * })
     */
    private $fnCliente;

    /**
     * @var \TGruposparametros
     *
     * @ORM\ManyToOne(targetEntity="TGruposparametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ft_grupoparametros", referencedColumnName="fn_id")
     * })
     */
    private $ftGrupoparametros;

    /**
     * @var \TProdutos
     *
     * @ORM\ManyToOne(targetEntity="TProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_produto", referencedColumnName="fn_id")
     * })
     */
    private $fnProduto;

    /**
     * @var \TLocaiscolheita
     *
     * @ORM\ManyToOne(targetEntity="TLocaiscolheita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_localcolheita", referencedColumnName="fn_id")
     * })
     */
    private $fnLocalcolheita;

    /**
     * @var \TTipoaprovacao
     *
     * @ORM\ManyToOne(targetEntity="TTipoaprovacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tipoaprovacao", referencedColumnName="fn_id")
     * })
     */
    private $fnTipoaprovacao;

    /**
     * @var \TEspecificacoes
     *
     * @ORM\ManyToOne(targetEntity="TEspecificacoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_especificacao", referencedColumnName="fn_id")
     * })
     */
    private $fnEspecificacao;

    /**
     * @var \TLegislacao
     *
     * @ORM\ManyToOne(targetEntity="TLegislacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_legislacao", referencedColumnName="fn_id")
     * })
     */
    private $fnLegislacao;

    /**
     * @var \TModelosamostra
     *
     * @ORM\ManyToOne(targetEntity="TModelosamostra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_modelo", referencedColumnName="fn_id")
     * })
     */
    private $fnModelo;

    /**
     * @var \TTiposamostra
     *
     * @ORM\ManyToOne(targetEntity="TTiposamostra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tipo", referencedColumnName="fn_id")
     * })
     */
    private $fnTipo;

    /**
     * @var \TTiposcontrolo
     *
     * @ORM\ManyToOne(targetEntity="TTiposcontrolo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tipocontrolo", referencedColumnName="fn_id")
     * })
     */
    private $fnTipocontrolo;

    /**
     * @var \TEstados
     *
     * @ORM\ManyToOne(targetEntity="TEstados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ft_id_estado", referencedColumnName="fn_id")
     * })
     */
    private $ftEstado;

    /**
     * @var \TAmostrasalimentos
     *
     * @ORM\ManyToOne(targetEntity="TAmostrasalimentos",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_amostraalimentos", referencedColumnName="fn_id")
     * })
     */
    private $fnAmostrasalimentos;

    /**
     * @var \TRequisicoescliente
     *
     * @ORM\ManyToOne(targetEntity="TRequisicoescliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_requisicaocliente", referencedColumnName="fn_id")
     * })
     */
    private $fnRequisicaocliente;







    public function getId()
    {
        return $this->fnId;
    }
    /**
     * Get fnId
     *
     * @return integer 
     */
    public function getFnId()
    {
        return $this->fnId;
    }
    public function getSerie()
    {
        return $this->ftSerie  . " - " . $this->fnId;
    }


    /**
     * Set fnNumero
     *
     * @param integer $fnNumero
     * @return TAmostras
     */
    public function setFnNumero($fnNumero)
    {
        $this->fnNumero = $fnNumero;

        return $this;
    }

    /**
     * Get fnNumero
     *
     * @return integer 
     */
    public function getFnNumero()
    {
        return $this->fnNumero;
    }

    /**
     * Set ftSerie
     *
     * @param string $ftSerie
     * @return TAmostras
     */
    public function setFtSerie($ftSerie)
    {
        $this->ftSerie = $ftSerie;

        return $this;
    }

    /**
     * Get ftSerie
     *
     * @return string 
     */
    public function getFtSerie()
    {
        return $this->ftSerie;
    }

    /**
     * Set fdCriacao
     *
     * @param \DateTime $fdCriacao
     * @return TAmostras
     */
    public function setFdCriacao($fdCriacao)
    {
        $this->fdCriacao = $fdCriacao;

        return $this;
    }

    /**
     * Get fdCriacao
     *
     * @return \DateTime 
     */
    public function getFdCriacao()
    {
        return $this->fdCriacao;
    }

    /**
     * Set fdColheita
     *
     * @param \DateTime $fdColheita
     * @return TAmostras
     */
    public function setFdColheita($fdColheita)
    {
        $this->fdColheita = $fdColheita;

        return $this;
    }

    /**
     * Set ftCodigo
     *
     * @param string $fnId
     * @return TProdutos
     */
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;

        return $this;
    }
    /**
     * Get fdColheita
     *
     * @return \DateTime 
     */
    public function getFdColheita()
    {
        return $this->fdColheita;
    }

    /**
     * Set fdRecepcao
     *
     * @param \DateTime $fdRecepcao
     * @return TAmostras
     */
    public function setFdRecepcao($fdRecepcao)
    {
        $this->fdRecepcao = $fdRecepcao;

        return $this;
    }

    /**
     * Get fdRecepcao
     *
     * @return \DateTime 
     */
    public function getFdRecepcao()
    {
        return $this->fdRecepcao;
    }

    /**
     * Set fdConclusao
     *
     * @param \DateTime $fdConclusao
     * @return TAmostras
     */
    public function setFdConclusao($fdConclusao)
    {
        $this->fdConclusao = $fdConclusao;

        return $this;
    }

    /**
     * Get fdConclusao
     *
     * @return \DateTime 
     */
    public function getFdConclusao()
    {
        return $this->fdConclusao;
    }

    /**
     * Set fdLimite
     *
     * @param \DateTime $fdLimite
     * @return TAmostras
     */
    public function setFdLimite($fdLimite)
    {
        $this->fdLimite = $fdLimite;

        return $this;
    }

    /**
     * Get fdLimite
     *
     * @return \DateTime 
     */
    public function getFdLimite()
    {
        return $this->fdLimite;
    }

    /**
     * Set ftResponsavelcolheita
     *
     * @param string $ftResponsavelcolheita
     * @return TAmostras
     */
    public function setFtResponsavelcolheita($ftResponsavelcolheita)
    {
        $this->ftResponsavelcolheita = $ftResponsavelcolheita;

        return $this;
    }

    /**
     * Set startdatetime
     *
     * @param \DateTime $startdatetime
     * @return Agenda
     */
    public function setStartdatetime($startdatetime)
    {
        $this->startdatetime = $startdatetime;

        return $this;
    }

    /**
     * Get startdatetime
     *
     * @return \DateTime
     */
    public function getStartdatetime()
    {
        return $this->startdatetime;
    }

    /**
     * Set enddatetime
     *
     * @param \DateTime $enddatetime
     * @return Agenda
     */
    public function setEnddatetime($enddatetime)
    {
        $this->enddatetime = $enddatetime;

        return $this;
    }

    /**
     * Get enddatetime
     *
     * @return \DateTime
     */
    public function getEnddatetime()
    {
        return $this->enddatetime;
    }
    /**
     * Get ftResponsavelcolheita
     *
     * @return string 
     */
    public function getFtResponsavelcolheita()
    {
        return $this->ftResponsavelcolheita;
    }

    /**
     * Set fnIdLocalcolheita
     *
     * @param integer $fnIdLocalcolheita
     * @return TAmostras
     */
    public function setFnIdLocalcolheita($fnIdLocalcolheita)
    {
        $this->fnIdLocalcolheita = $fnIdLocalcolheita;

        return $this;
    }

    /**
     * Get fnIdLocalcolheita
     *
     * @return integer 
     */
    public function getFnIdLocalcolheita()
    {
        return $this->fnIdLocalcolheita;
    }

    /**
     * Set fnOperador
     *
     * @param \Application\Sonata\UserBundle\Entity\User $fnOperador
     * @return TAmostras
     */


    /**
     * Get fnOperador
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getFnOperador()
    {

        return $this->fnOperador;
    }

    /**
     * Set fnIdModelo
     *
     * @param integer $fnIdModelo
     * @return TAmostras
     */
    public function setFnIdModelo($fnIdModelo)
    {
        $this->fnIdModelo = $fnIdModelo;

        return $this;
    }

    /**
     * Get fnIdModelo
     *
     * @return integer 
     */
    public function getFnIdModelo()
    {
        return $this->fnIdModelo;
    }

    /**
     * Set fnIdTipoaprovacao
     *
     * @param integer $fnIdTipoaprovacao
     * @return TAmostras
     */
    public function setFnIdTipoaprovacao($fnIdTipoaprovacao)
    {
        $this->fnIdTipoaprovacao = $fnIdTipoaprovacao;

        return $this;
    }

    /**
     * Get fnIdTipoaprovacao
     *
     * @return integer 
     */
    public function getFnIdTipoaprovacao()
    {
        return $this->fnIdTipoaprovacao;
    }

    /**
     * Set fdAutorizacao
     *
     * @param \DateTime $fdAutorizacao
     * @return TAmostras
     */
    public function setFdAutorizacao($fdAutorizacao)
    {
        $this->fdAutorizacao = $fdAutorizacao;

        return $this;
    }

    /**
     * Get fdAutorizacao
     *
     * @return \DateTime 
     */
    public function getFdAutorizacao()
    {
        return $this->fdAutorizacao;
    }

    /**
     * Set fnProduto
     *
     * @param \AppBundle\Entity\TProdutos $fnProduto
     * @return TAmostras
     */
    public function setFnProduto(\AppBundle\Entity\TProdutos $fnProduto = null)
    {
        $this->fnProduto = $fnProduto;

        return $this;
    }

    /**
     * Get fnProduto
     *
     * @return \AppBundle\Entity\TProdutos
     */
    public function getFnProduto()
    {
        return $this->fnProduto;
    }

    /**
     * Set ftOrigem
     *
     * @param string $ftOrigem
     * @return TAmostras
     */
    public function setFtOrigem($ftOrigem)
    {
        $this->ftOrigem = $ftOrigem;

        return $this;
    }

    /**
     * Get ftOrigem
     *
     * @return string 
     */
    public function getFtOrigem()
    {
        return $this->ftOrigem;
    }

    /**
     * Set ftGrupoparametros
     *
     * @param string $ftGrupoparametros
     * @return TAmostras
     */
    public function setFtGrupoparametros($ftGrupoparametros)
    {
        $this->ftGrupoparametros = $ftGrupoparametros;

        return $this;
    }

    /**
     * Get ftGrupoparametros
     *
     * @return string 
     */
    public function getFtGrupoparametros()
    {
        return $this->ftGrupoparametros;
    }

    /**
     * Set fnIdLegislacao
     *
     * @param integer $fnIdLegislacao
     * @return TAmostras
     */
    public function setFnIdLegislacao($fnIdLegislacao)
    {
        $this->fnIdLegislacao = $fnIdLegislacao;

        return $this;
    }

    /**
     * Get fnIdLegislacao
     *
     * @return integer 
     */
    public function getFnIdLegislacao()
    {
        return $this->fnIdLegislacao;
    }

    /**
     * Set ftTipoemissaorelatorio
     *
     * @param string $ftTipoemissaorelatorio
     * @return TAmostras
     */
    public function setFtTipoemissaorelatorio($ftTipoemissaorelatorio)
    {
        $this->ftTipoemissaorelatorio = $ftTipoemissaorelatorio;

        return $this;
    }

    /**
     * Get ftTipoemissaorelatorio
     *
     * @return string 
     */
    public function getFtTipoemissaorelatorio()
    {
        return $this->ftTipoemissaorelatorio;
    }

    /**
     * Set fbRelatorioemitido
     *
     * @param boolean $fbRelatorioemitido
     * @return TAmostras
     */
    public function setFbRelatorioemitido($fbRelatorioemitido)
    {
        $this->fbRelatorioemitido = $fbRelatorioemitido;

        return $this;
    }

    /**
     * Get fbRelatorioemitido
     *
     * @return boolean 
     */
    public function getFbRelatorioemitido()
    {
        return $this->fbRelatorioemitido;
    }

    /**
     * Set fdEmissaorelatorio
     *
     * @param \DateTime $fdEmissaorelatorio
     * @return TAmostras
     */
    public function setFdEmissaorelatorio($fdEmissaorelatorio)
    {
        $this->fdEmissaorelatorio = $fdEmissaorelatorio;

        return $this;
    }

    /**
     * Get fdEmissaorelatorio
     *
     * @return \DateTime 
     */
    public function getFdEmissaorelatorio()
    {
        return $this->fdEmissaorelatorio;
    }

    /**
     * Set fnIdTipo
     *
     * @param integer $fnIdTipo
     * @return TAmostras
     */
    public function setFnIdTipo($fnIdTipo)
    {
        $this->fnIdTipo = $fnIdTipo;

        return $this;
    }

    /**
     * Get fnIdTipo
     *
     * @return integer 
     */
    public function getFnIdTipo()
    {
        return $this->fnIdTipo;
    }

    /**
     * Set ftRefexterna
     *
     * @param string $ftRefexterna
     * @return TAmostras
     */
    public function setFtRefexterna($ftRefexterna)
    {
        $this->ftRefexterna = $ftRefexterna;

        return $this;
    }

    /**
     * Get ftRefexterna
     *
     * @return string 
     */
    public function getFtRefexterna()
    {
        return $this->ftRefexterna;
    }

    /**
     * Set ftConclusao
     *
     * @param string $ftConclusao
     * @return TAmostras
     */
    public function setFtConclusao($ftConclusao)
    {
        $this->ftConclusao = $ftConclusao;

        return $this;
    }

    /**
     * Get ftConclusao
     *
     * @return string 
     */
    public function getFtConclusao()
    {
        return $this->ftConclusao;
    }

    /**
     * Set ftObs
     *
     * @param string $ftObs
     * @return TAmostras
     */
    public function setFtObs($ftObs)
    {
        $this->ftObs = $ftObs;

        return $this;
    }

    /**
     * Get ftObs
     *
     * @return string 
     */
    public function getFtObs()
    {
        return $this->ftObs;
    }

    /**
     * Set fnIdTipocontrolo
     *
     * @param integer $fnIdTipocontrolo
     * @return TAmostras
     */
    public function setFnIdTipocontrolo($fnIdTipocontrolo)
    {
        $this->fnIdTipocontrolo = $fnIdTipocontrolo;

        return $this;
    }

    /**
     * Get fnIdTipocontrolo
     *
     * @return integer 
     */
    public function getFnIdTipocontrolo()
    {
        return $this->fnIdTipocontrolo;
    }

    /**
     * Set fnIdOrcamento
     *
     * @param integer $fnIdOrcamento
     * @return TAmostras
     */
    public function setFnIdOrcamento($fnIdOrcamento)
    {
        $this->fnIdOrcamento = $fnIdOrcamento;

        return $this;
    }

    /**
     * Get fnIdOrcamento
     *
     * @return integer 
     */
    public function getFnIdOrcamento()
    {
        return $this->fnIdOrcamento;
    }

    /**
     * Set ftIdEstado
     *
     * @param string $ftIdEstado
     * @return TAmostras
     */
    public function setFtIdEstado($ftIdEstado)
    {
        $this->ftIdEstado = $ftIdEstado;

        return $this;
    }

    /**
     * Get ftIdEstado
     *
     * @return string 
     */
    public function getFtIdEstado()
    {
        return $this->ftIdEstado;
    }

    /**
     * Set fnIdEspecificacao
     *
     * @param integer $fnIdEspecificacao
     * @return TAmostras
     */
    public function setFnIdEspecificacao($fnIdEspecificacao)
    {
        $this->fnIdEspecificacao = $fnIdEspecificacao;

        return $this;
    }

    /**
     * Get fnIdEspecificacao
     *
     * @return integer 
     */
    public function getFnIdEspecificacao()
    {
        return $this->fnIdEspecificacao;
    }

    /**
     * Set ftCumpreespecificacao
     *
     * @param string $ftCumpreespecificacao
     * @return TAmostras
     */
    public function setFtCumpreespecificacao($ftCumpreespecificacao)
    {
        $this->ftCumpreespecificacao = $ftCumpreespecificacao;

        return $this;
    }

    /**
     * Get ftCumpreespecificacao
     *
     * @return string 
     */
    public function getFtCumpreespecificacao()
    {
        return $this->ftCumpreespecificacao;
    }

    /**
     * Set fdInicioanalise
     *
     * @param \DateTime $fdInicioanalise
     * @return TAmostras
     */
    public function setFdInicioanalise($fdInicioanalise)
    {
        $this->fdInicioanalise = $fdInicioanalise;

        return $this;
    }

    /**
     * Get fdInicioanalise
     *
     * @return \DateTime 
     */
    public function getFdInicioanalise()
    {
        return $this->fdInicioanalise;
    }

    /**
     * Set fbFacturada
     *
     * @param boolean $fbFacturada
     * @return TAmostras
     */
    public function setFbFacturada($fbFacturada)
    {
        $this->fbFacturada = $fbFacturada;

        return $this;
    }

    /**
     * Get fbFacturada
     *
     * @return boolean 
     */
    public function getFbFacturada()
    {
        return $this->fbFacturada;
    }

    /**
     * Set fnIdRequisicaocliente
     *
     * @param integer $fnIdRequisicaocliente
     * @return TAmostras
     */
    public function setFnIdRequisicaocliente($fnIdRequisicaocliente)
    {
        $this->fnIdRequisicaocliente = $fnIdRequisicaocliente;

        return $this;
    }

    /**
     * Get fnIdRequisicaocliente
     *
     * @return integer 
     */
    public function getFnIdRequisicaocliente()
    {
        return $this->fnIdRequisicaocliente;
    }

    /**
     * Set fnCliente
     *
     * @param \AppBundle\Entity\TClientes $fnCliente
     * @return TAmostras
     */
    public function setFnCliente(\AppBundle\Entity\TClientes $fnCliente = null)
    {
        $this->fnCliente = $fnCliente;

        return $this;
    }

    /**
     * Get fnCliente
     *
     * @return \AppBundle\Entity\TClientes 
     */
    public function getFnCliente()
    {
        return $this->fnCliente;
    }

    /**
     * Set fnLocalcolheita
     *
     * @param \AppBundle\Entity\TLocaiscolheita $fnLocalcolheita
     * @return TAmostras
     */
    public function setFnLocalcolheita(\AppBundle\Entity\TLocaiscolheita $fnLocalcolheita = null)
    {
        $this->fnLocalcolheita = $fnLocalcolheita;

        return $this;
    }

    /**
     * Get fnLocalcolheita
     *
     * @return \AppBundle\Entity\TLocaiscolheita
     */
    public function getFnLocalcolheita()
    {
        return $this->fnLocalcolheita;
    }


    /**
     * Set fnTipoaprovacao
     *
     * @param \AppBundle\Entity\TTipoaprovacao $fnTipoaprovacao
     * @return TAmostras
     */
    public function setFnTipoaprovacao(\AppBundle\Entity\TTipoaprovacao $fnTipoaprovacao = null)
    {
        $this->fnTipoaprovacao = $fnTipoaprovacao;

        return $this;
    }

    /**
     * Get fnTipoaprovacao
     *
     * @return \AppBundle\Entity\TTipoaprovacao
     */
    public function getFnTipoaprovacao()
    {
        return $this->fnTipoaprovacao;
    }

    /**
     * Set fnEspecificacao
     *
     * @param \AppBundle\Entity\TEspecificacoes $fnEspecificacao
     * @return TAmostras
     */
    public function setFnEspecificacao(\AppBundle\Entity\TEspecificacoes $fnEspecificacao = null)
    {
        $this->fnEspecificacao = $fnEspecificacao;

        return $this;
    }

    /**
     * Get fnEspecificacao
     *
     * @return \AppBundle\Entity\TEspecificacoes
     */
    public function getFnEspecificacao()
    {
        return $this->fnEspecificacao;
    }

    /**
     * Set fnLegislacao
     *
     * @param \AppBundle\Entity\TLegislacao $fnLegislacao
     * @return TAmostras
     */
    public function setFnLegislacao(\AppBundle\Entity\TLegislacao $fnLegislacao = null)
    {
        $this->fnLegislacao = $fnLegislacao;

        return $this;
    }

    /**
     * Get fnLegislacao
     *
     * @return \AppBundle\Entity\TLegislacao
     */
    public function getFnLegislacao()
    {
        return $this->fnLegislacao;
    }


    /**
     * Set fnModelo
     *
     * @param \AppBundle\Entity\TModelosamostra $fnModelo
     * @return TAmostras
     */
    public function setFnModelo(\AppBundle\Entity\TModelosamostra $fnModelo = null)
    {
        $this->fnModelo = $fnModelo;

        return $this;
    }

    /**
     * Get fnModelo
     *
     * @return \AppBundle\Entity\TModelosamostra
     */
    public function getFnModelo()
    {
        return $this->fnModelo;
    }

    /**
     * Set fnTipo
     *
     * @param \AppBundle\Entity\TTiposamostra $fnTipo
     * @return TAmostras
     */
    public function setFnTipo(\AppBundle\Entity\TTiposamostra $fnTipo = null)
    {
        $this->fnTipo = $fnTipo;

        return $this;
    }

    /**
     * Get fnTipo
     *
     * @return \AppBundle\Entity\TTiposamostra
     */
    public function getFnTipo()
    {
        return $this->fnTipo;
    }

    /**
     * Set fnTipocontrolo
     *
     * @param \AppBundle\Entity\TTiposcontrolo $fnTipocontrolo
     * @return TAmostras
     */
    public function setFnTipocontrolo(\AppBundle\Entity\TTiposcontrolo $fnTipocontrolo = null)
    {
        $this->fnTipocontrolo = $fnTipocontrolo;

        return $this;
    }

    /**
     * Get fnTipocontrolo
     *
     * @return \AppBundle\Entity\TTiposcontrolo
     */
    public function getFnTipocontrolo()
    {
        return $this->fnTipocontrolo;
    }

    /**
     * Set ftEstado
     *
     * @param \AppBundle\Entity\TEstados $ftEstado
     * @return TAmostras
     */
    public function setFtEstado(\AppBundle\Entity\TEstados $ftEstado = null)
    {
        $this->ftEstado = $ftEstado;

        return $this;
    }

    /**
     * Get ftEstado
     *
     * @return \AppBundle\Entity\TEstados
     */
    public function getFtEstado()
    {

        return $this->ftEstado;
    }


    /**
     * Set setFnAmostrasalimentos
     *
     * @param \AppBundle\Entity\TAmostrasalimentos $fnAmostrasalimentos
     * @return TAmostras
     */
    public function setFnAmostrasalimentos(\AppBundle\Entity\TAmostrasalimentos $fnAmostrasalimentos = null)
    {
        $this->fnAmostrasalimentos = $fnAmostrasalimentos;

        return $this;
    }

    /**
     * Get getFnAmostrasalimentos
     *
     * @return \AppBundle\Entity\TEstados
     */
    public function getFnAmostrasalimentos()
    {

        return $this->fnAmostrasalimentos;
    }


    /**
     * Set fnRequisicaocliente
     *
     * @param \AppBundle\Entity\TRequisicoescliente $fnRequisicaocliente
     * @return TAmostras
     */
    public function setFnRequisicaocliente(\AppBundle\Entity\TRequisicoescliente $fnRequisicaocliente = null)
    {
        $this->fnRequisicaocliente = $fnRequisicaocliente;

        return $this;
    }

    /**
     * Get fnRequisicaocliente
     *
     * @return \AppBundle\Entity\TRequisicoescliente
     */
    public function getFnRequisicaocliente()
    {
        return $this->fnRequisicaocliente;
    }
}
