<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TParametros
 *
 * @ORM\Table(name="t_parametrosamostra_log", indexes={@ORM\Index(name="IX_t_parametros_amostra", columns={"fn_id_amostra"}), @ORM\Index(name="IX_t_parametros_estado", columns={"ft_id_estado"}), @ORM\Index(name="IX_t_parametros_familiaparametro", columns={"fn_id_familiaparametro"}), @ORM\Index(name="IX_t_parametros_laboratorio", columns={"fn_id_laboratorio"})})
 * @ORM\Entity
 */
class TParametrosamostraLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id", type="bigint", nullable=false)
     */
    private $fnId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var \TMetodos
     *
     * @ORM\ManyToOne(targetEntity="TMetodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_metodo", referencedColumnName="fn_id")
     * })
     */
    private $fnMetodo;

    /**
     * @var \TAreasensaio
     *
     * @ORM\ManyToOne(targetEntity="TAreasensaio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_areaensaio", referencedColumnName="fn_id")
     * })
     */
    private $fnAreaensaio;

    /**
     * @var \TModelosparametro
     *
     * @ORM\ManyToOne(targetEntity="TModelosparametro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_modeloparametro", referencedColumnName="fn_id")
     * })
     */
    private $fnModeloparametro;

    /**
     * @var \TFamiliasparametros
     *
     * @ORM\ManyToOne(targetEntity="TFamiliasparametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_familiaparametro", referencedColumnName="fn_id")
     * })
     */
    private $fnFamiliaparametro;

    /**
     * @var \TFrascos
     *
     * @ORM\ManyToOne(targetEntity="TFrascos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_frasco", referencedColumnName="fn_id")
     * })
     */
    private $fnFrasco;

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
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_metodo", type="bigint", nullable=false)
     */
    private $fnIdMetodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_tecnica", type="bigint", nullable=false)
     */
    private $fnIdTecnica;

    /**
     * @var \TTecnicas
     *
     * @ORM\ManyToOne(targetEntity="TTecnicas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tecnica", referencedColumnName="fn_id")
     * })
     */
    private $fnTecnica;
    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_amostra", type="bigint", nullable=false)
     */
    private $fnIdAmostra;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_areaensaio", type="bigint", nullable=false)
     */
    private $fnIdAreaensaio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_limiterealizacao", type="datetime", nullable=false)
     */
    private $fdLimiterealizacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_cumpreespecificacao", type="string", length=1, nullable=true)
     */
    private $ftCumpreespecificacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_conclusao", type="string", length=300, nullable=false)
     */
    private $ftConclusao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_modeloparametro", type="bigint", nullable=false)
     */
    private $fnIdModeloparametro;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=false)
     */
    private $ftObservacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_criacao", type="datetime", nullable=false)
     */
    private $fdCriacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_conclusao", type="datetime", nullable=true)
     */
    private $fdConclusao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_autorizacao", type="datetime", nullable=true)
     */
    private $fdAutorizacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_laboratorio", type="bigint", nullable=false)
     */
    private $fnIdLaboratorio;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_precocompra", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $fnPrecocompra;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_precovenda", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $fnPrecovenda;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_factorcorreccao", type="decimal", precision=10, scale=5, nullable=false)
     */
    private $fnFactorcorreccao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_acreditado", type="boolean", nullable=false)
     */
    private $fbAcreditado;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_limitelegal", type="decimal", precision=10, scale=5, nullable=false)
     */
    private $fnLimitelegal;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_familiaparametro", type="bigint", nullable=false)
     */
    private $fnIdFamiliaparametro;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_formulaquimica", type="string", length=50, nullable=true)
     */
    private $ftFormulaquimica;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_frasco", type="bigint", nullable=true)
     */
    private $fnIdFrasco;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_volumeminimo", type="integer", nullable=true)
     */
    private $fnVolumeminimo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_confirmacao", type="integer", nullable=false)
     */
    private $fbConfirmacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_id_estado", type="string", length=1, nullable=true)
     */
    private $ftIdEstado;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_contraanalise", type="integer", nullable=true)
     */
    private $fbContraanalise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_Realizacao", type="datetime", nullable=false)
     */
    private $fdRealizacao;

    /**
     * @ORM\ManyToMany(targetEntity="TEspecificacoes", mappedBy="fnEspecificacoes")
     */
    private $especificacoes;


    /**
     * @var \TLaboratorios
     *
     * @ORM\ManyToOne(targetEntity="TLaboratorios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_laboratorio", referencedColumnName="fn_id")
     * })
     */
    private $fnLaboratorio;


    /**
     * @var integer
     *
     * @ORM\Column(name="fb_amostrainterno", type="boolean", nullable=true)
     */
    private $fbAmostrainterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_amostraexterno", type="boolean", nullable=true)
     */
    private $fbAmostraexterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_determinacaoexterno", type="boolean", nullable=true)
     */
    private $fbDeterminacaoexterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_determinacaointerno", type="boolean", nullable=true)
     */
    private $fbDeterminacaointerno;

    /**
     * Set fbContraanalise
     *
     * @param integer $fbContraanalise
     * @return TParametros
     */
    public function setFbAmostrainterno($fbAmostrainterno)
    {
        $this->fbAmostrainterno = $fbAmostrainterno;

        return $this;
    }

    /**
     * Get fbContraanalise
     *
     * @return integer
     */
    public function getFbAmostrainterno()
    {
        return $this->fbAmostrainterno;
    }

    /**
     * Set fbContraanalise
     *
     * @param integer $fbContraanalise
     * @return TParametros
     */
    public function setFbAmostraexterno($fbAmostraexterno)
    {
        $this->fbAmostraexterno = $fbAmostraexterno;

        return $this;
    }

    /**
     * Get fbContraanalise
     *
     * @return integer
     */
    public function getFbAmostraexterno()
    {
        return $this->fbAmostraexterno;
    }


    /**
     * Set fbContraanalise
     *
     * @param integer $fbContraanalise
     * @return TParametros
     */
    public function setFbDeterminacaoexterno($fbDeterminacaoexterno)
    {
        $this->fbDeterminacaoexterno = $fbDeterminacaoexterno;

        return $this;
    }

    /**
     * Get fbContraanalise
     *
     * @return integer
     */
    public function getFbDeterminacaoexterno()
    {
        return $this->fbDeterminacaoexterno;
    }


    /**
     * Set fbContraanalise
     *
     * @param integer $fbContraanalise
     * @return TParametros
     */
    public function setFbDeterminacaointerno($fbDeterminacaointerno)
    {
        $this->fbDeterminacaointerno = $fbDeterminacaointerno;

        return $this;
    }

    /**
     * Get fbContraanalise
     *
     * @return integer
     */
    public function getFbDeterminacaointerno()
    {
        return $this->fbDeterminacaointerno;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->especificacoes = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get fnId
     *
     * @return integer
     */
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;
        return $this;
    }



    public function getId()
    {

        return $this->id ;
    }


    /**
     * Add fnEspecificacoes
     *
     * @param \AppBundle\Entity\TEspecificacoes $fnProdutos
     */
    public function setespecificacoes(\AppBundle\Entity\TEspecificacoes $especificacoes = null)
    {
        $this->especificacoes[] = $especificacoes;

    }
    /**
     * Get fnEspecificacoes
     *
     * @return \AppBundle\Entity\TProdutos
     */
    public function getfnProdutos()
    {
        return $this->fnProdutos;
    }




    public function __toString()
    {
        return $this->ftDescricao;
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

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TParametros
     */
    public function setFtDescricao($ftDescricao)
    {
        $this->ftDescricao = $ftDescricao;

        return $this;
    }

    /**
     * Set fnLaboratorio
     *
     * @param \AppBundle\Entity\TLaboratorios $fnLaboratorio
     * @return TParametros
     */
    public function setFnLaboratorio(\AppBundle\Entity\TLaboratorios $fnLaboratorio = null)
    {
        $this->fnLaboratorio = $fnLaboratorio;

        return $this;
    }

    /**
     * Get fnLaboratorio
     *
     * @return \AppBundle\Entity\TLaboratorios
     */
    public function getFnLaboratorio()
    {
        return $this->fnLaboratorio;
    }


    /**
     * Get ftDescricao
     *
     * @return string 
     */
    public function getFtDescricao()
    {
        return $this->ftDescricao;
    }
    /**
     * Set fnTecnica
     *
     * @param \AppBundle\Entity\TTecnicas $fnTecnica
     * @return TParametros
     */
    public function setFnTecnica(\AppBundle\Entity\TTecnicas $fnTecnica = null)
    {
        $this->fnTecnica = $fnTecnica;

        return $this;
    }

    /**
     * Get fnTecnica
     *
     * @return \AppBundle\Entity\TTecnicas
     */
    public function getFnTecnica()
    {
        return $this->fnTecnica;
    }

    /**
     * Set fnIdMetodo
     *
     * @param integer $fnIdMetodo
     * @return TParametros
     */
    public function setFnIdMetodo($fnIdMetodo)
    {
        $this->fnIdMetodo = $fnIdMetodo;

        return $this;
    }

    /**
     * Get fnIdMetodo
     *
     * @return integer 
     */
    public function getFnIdMetodo()
    {
        return $this->fnIdMetodo;
    }

    /**
     * Set fnIdTecnica
     *
     * @param integer $fnIdTecnica
     * @return TParametros
     */
    public function setFnIdTecnica($fnIdTecnica)
    {
        $this->fnIdTecnica = $fnIdTecnica;

        return $this;
    }

    /**
     * Get fnIdTecnica
     *
     * @return integer 
     */
    public function getFnIdTecnica()
    {
        return $this->fnIdTecnica;
    }

    /**
     * Set fnIdAmostra
     *
     * @param integer $fnIdAmostra
     * @return TParametros
     */
    public function setFnIdAmostra($fnIdAmostra)
    {
        $this->fnIdAmostra = $fnIdAmostra;

        return $this;
    }

    /**
     * Get fnIdAmostra
     *
     * @return integer 
     */
    public function getFnIdAmostra()
    {
        return $this->fnIdAmostra;
    }

    /**
     * Set fnIdAreaensaio
     *
     * @param integer $fnIdAreaensaio
     * @return TParametros
     */
    public function setFnIdAreaensaio($fnIdAreaensaio)
    {
        $this->fnIdAreaensaio = $fnIdAreaensaio;

        return $this;
    }

    /**
     * Get fnIdAreaensaio
     *
     * @return integer 
     */
    public function getFnIdAreaensaio()
    {
        return $this->fnIdAreaensaio;
    }

    /**
     * Set fdLimiterealizacao
     *
     * @param \DateTime $fdLimiterealizacao
     * @return TParametros
     */
    public function setFdLimiterealizacao($fdLimiterealizacao)
    {
        $this->fdLimiterealizacao = $fdLimiterealizacao;

        return $this;
    }

    /**
     * Get fdLimiterealizacao
     *
     * @return \DateTime 
     */
    public function getFdLimiterealizacao()
    {
        return $this->fdLimiterealizacao;
    }

    /**
     * Set ftCumpreespecificacao
     *
     * @param string $ftCumpreespecificacao
     * @return TParametros
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
     * Set ftConclusao
     *
     * @param string $ftConclusao
     * @return TParametros
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
     * Set fnIdModeloparametro
     *
     * @param \AppBundle\Entity\TModelosparametro $fnIdModeloparametro
     * @return TParametros
     */
    public function setFnIdModeloparametro(\AppBundle\Entity\TModelosparametro $fnIdModeloparametro = null)
    {
        $this->fnIdModeloparametro = $fnIdModeloparametro;

        return $this;
    }

    /**
     * Get TModelosparametro
     *
     * @return \AppBundle\Entity\TModelosparametro
     */
    public function getFnIdModeloparametro()
    {
        return $this->fnIdModeloparametro;
    }



    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TParametros
     */
    public function setFtObservacao($ftObservacao)
    {
        $this->ftObservacao = $ftObservacao;

        return $this;
    }

    /**
     * Get ftObservacao
     *
     * @return string 
     */
    public function getFtObservacao()
    {
        return $this->ftObservacao;
    }

    /**
     * Set fdCriacao
     *
     * @param \DateTime $fdCriacao
     * @return TParametros
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
     * Set fdConclusao
     *
     * @param \DateTime $fdConclusao
     * @return TParametros
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
     * Set fdAutorizacao
     *
     * @param \DateTime $fdAutorizacao
     * @return TParametros
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
     * Set fnIdLaboratorio
     *
     * @param integer $fnIdLaboratorio
     * @return TParametros
     */
    public function setFnIdLaboratorio($fnIdLaboratorio)
    {
        $this->fnIdLaboratorio = $fnIdLaboratorio;

        return $this;
    }

    /**
     * Get fnIdLaboratorio
     *
     * @return integer 
     */
    public function getFnIdLaboratorio()
    {
        return $this->fnIdLaboratorio;
    }

    /**
     * Set fnPrecocompra
     *
     * @param string $fnPrecocompra
     * @return TParametros
     */
    public function setFnPrecocompra($fnPrecocompra)
    {
        $this->fnPrecocompra = $fnPrecocompra;

        return $this;
    }

    /**
     * Get fnPrecocompra
     *
     * @return string 
     */
    public function getFnPrecocompra()
    {
        return $this->fnPrecocompra;
    }

    /**
     * Set fnPrecovenda
     *
     * @param string $fnPrecovenda
     * @return TParametros
     */
    public function setFnPrecovenda($fnPrecovenda)
    {
        $this->fnPrecovenda = $fnPrecovenda;

        return $this;
    }

    /**
     * Get fnPrecovenda
     *
     * @return string 
     */
    public function getFnPrecovenda()
    {
        return $this->fnPrecovenda;
    }

    /**
     * Set fnFactorcorreccao
     *
     * @param string $fnFactorcorreccao
     * @return TParametros
     */
    public function setFnFactorcorreccao($fnFactorcorreccao)
    {
        $this->fnFactorcorreccao = $fnFactorcorreccao;

        return $this;
    }

    /**
     * Get fnFactorcorreccao
     *
     * @return string 
     */
    public function getFnFactorcorreccao()
    {
        return $this->fnFactorcorreccao;
    }

    /**
     * Set fbAcreditado
     *
     * @param boolean $fbAcreditado
     * @return TParametros
     */
    public function setFbAcreditado($fbAcreditado)
    {
        $this->fbAcreditado = $fbAcreditado;

        return $this;
    }

    /**
     * Get fbAcreditado
     *
     * @return boolean 
     */
    public function getFbAcreditado()
    {
        return $this->fbAcreditado;
    }

    /**
     * Set fnLimitelegal
     *
     * @param string $fnLimitelegal
     * @return TParametros
     */
    public function setFnLimitelegal($fnLimitelegal)
    {
        $this->fnLimitelegal = $fnLimitelegal;

        return $this;
    }

    /**
     * Get fnLimitelegal
     *
     * @return string 
     */
    public function getFnLimitelegal()
    {
        return $this->fnLimitelegal;
    }

    /**
     * Set fnIdFamiliaparametro
     *
     * @param integer $fnIdFamiliaparametro
     * @return TParametros
     */
    public function setFnIdFamiliaparametro($fnIdFamiliaparametro)
    {
        $this->fnIdFamiliaparametro = $fnIdFamiliaparametro;

        return $this;
    }

    /**
     * Get fnIdFamiliaparametro
     *
     * @return integer 
     */
    public function getFnIdFamiliaparametro()
    {
        return $this->fnIdFamiliaparametro;
    }

    /**
     * Set ftFormulaquimica
     *
     * @param string $ftFormulaquimica
     * @return TParametros
     */
    public function setFtFormulaquimica($ftFormulaquimica)
    {
        $this->ftFormulaquimica = $ftFormulaquimica;

        return $this;
    }

    /**
     * Get ftFormulaquimica
     *
     * @return string 
     */
    public function getFtFormulaquimica()
    {
        return $this->ftFormulaquimica;
    }

    /**
     * Set fnIdFrasco
     *
     * @param integer $fnIdFrasco
     * @return TParametros
     */
    public function setFnIdFrasco($fnIdFrasco)
    {
        $this->fnIdFrasco = $fnIdFrasco;

        return $this;
    }

    /**
     * Get fnIdFrasco
     *
     * @return integer 
     */
    public function getFnIdFrasco()
    {
        return $this->fnIdFrasco;
    }

    /**
     * Set fnVolumeminimo
     *
     * @param integer $fnVolumeminimo
     * @return TParametros
     */
    public function setFnVolumeminimo($fnVolumeminimo)
    {
        $this->fnVolumeminimo = $fnVolumeminimo;

        return $this;
    }

    /**
     * Get fnVolumeminimo
     *
     * @return integer 
     */
    public function getFnVolumeminimo()
    {
        return $this->fnVolumeminimo;
    }

    /**
     * Set fbConfirmacao
     *
     * @param integer $fbConfirmacao
     * @return TParametros
     */
    public function setFbConfirmacao($fbConfirmacao)
    {
        $this->fbConfirmacao = $fbConfirmacao;

        return $this;
    }

    /**
     * Get fbConfirmacao
     *
     * @return integer 
     */
    public function getFbConfirmacao()
    {
        return $this->fbConfirmacao;
    }

    /**
     * Set ftIdEstado
     *
     * @param string $ftIdEstado
     * @return TParametros
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
     * Set fbContraanalise
     *
     * @param integer $fbContraanalise
     * @return TParametros
     */
    public function setFbContraanalise($fbContraanalise)
    {
        $this->fbContraanalise = $fbContraanalise;

        return $this;
    }

    /**
     * Get fbContraanalise
     *
     * @return integer 
     */
    public function getFbContraanalise()
    {
        return $this->fbContraanalise;
    }

    /**
     * Set fdRealizacao
     *
     * @param \DateTime $fdRealizacao
     * @return TParametros
     */
    public function setFdRealizacao($fdRealizacao)
    {
        $this->fdRealizacao = $fdRealizacao;

        return $this;
    }

    /**
     * Get fdRealizacao
     *
     * @return \DateTime 
     */
    public function getFdRealizacao()
    {
        return $this->fdRealizacao;
    }

    /**
     * Add especificacoes
     *
     * @param \AppBundle\Entity\TEspecificacoes $especificacoes
     * @return TParametros
     */
    public function addEspecificaco(\AppBundle\Entity\TEspecificacoes $especificacoes)
    {
        $this->especificacoes[] = $especificacoes;

        return $this;
    }

    /**
     * Remove especificacoes
     *
     * @param \AppBundle\Entity\TEspecificacoes $especificacoes
     */
    public function removeEspecificaco(\AppBundle\Entity\TEspecificacoes $especificacoes)
    {
        $this->especificacoes->removeElement($especificacoes);
    }

    /**
     * Get especificacoes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEspecificacoes()
    {
        return $this->especificacoes;
    }

    /**
     * Set fnMetodo
     *
     * @param \AppBundle\Entity\TMetodos $fnMetodo
     * @return TParametros
     */
    public function setFnMetodo(\AppBundle\Entity\TMetodos $fnMetodo = null)
    {
        $this->fnMetodo = $fnMetodo;

        return $this;
    }

    /**
     * Get fnMetodo
     *
     * @return \AppBundle\Entity\TMetodos
     */
    public function getFnMetodo()
    {
        return $this->fnMetodo;
    }

    /**
     * Set fnAreaensaio
     *
     * @param \AppBundle\Entity\TAreasensaio $fnAreaensaio
     * @return TParametros
     */
    public function setFnAreaensaio(\AppBundle\Entity\TAreasensaio $fnAreaensaio = null)
    {
        $this->fnAreaensaio = $fnAreaensaio;

        return $this;
    }

    /**
     * Get fnAreaensaio
     *
     * @return \AppBundle\Entity\TAreasensaio
     */
    public function getFnAreaensaio()
    {
        return $this->fnAreaensaio;
    }

    /**
     * Set fnModeloparametro
     *
     * @param \AppBundle\Entity\TModelosparametro $fnModeloparametro
     * @return TParametros
     */
    public function setFnModeloparametro(\AppBundle\Entity\TModelosparametro $fnModeloparametro = null)
    {
        $this->fnModeloparametro = $fnModeloparametro;

        return $this;
    }

    /**
     * Get fnModeloparametro
     *
     * @return \AppBundle\Entity\TModelosparametro
     */
    public function getFnModeloparametro()
    {
        return $this->fnModeloparametro;
    }

    /**
     * Set fnFamiliaparametro
     *
     * @param \AppBundle\Entity\TFamiliasparametros $fnFamiliaparametro
     * @return TParametros
     */
    public function setFnFamiliaparametro(\AppBundle\Entity\TFamiliasparametros $fnFamiliaparametro = null)
    {
        $this->fnFamiliaparametro = $fnFamiliaparametro;

        return $this;
    }

    /**
     * Get fnFamiliaparametro
     *
     * @return \AppBundle\Entity\TFamiliasparametros
     */
    public function getFnFamiliaparametro()
    {
        return $this->fnFamiliaparametro;
    }

    /**
     * Set fnFrasco
     *
     * @param \AppBundle\Entity\TFrascos $fnFrasco
     * @return TParametros
     */
    public function setFnFrasco(\AppBundle\Entity\TFrascos $fnFrasco = null)
    {
        $this->fnFrasco = $fnFrasco;

        return $this;
    }

    /**
     * Get fnFrasco
     *
     * @return \AppBundle\Entity\TFrascos
     */
    public function getFnFrasco()
    {
        return $this->fnFrasco;
    }

    /**
     * Set ftEstado
     *
     * @param \AppBundle\Entity\TEstados $ftEstado
     * @return TParametros
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
}
