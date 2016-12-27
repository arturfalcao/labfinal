<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TModelosamostra
 *
 * @ORM\Table(name="t_modelosamostra", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_modelosamostra_descricao", columns={"ft_descricao"})}, indexes={@ORM\Index(name="IDX_C0570C85424C8FD6", columns={"fn_id_cliente"}), @ORM\Index(name="IDX_C0570C8569DB7257", columns={"fn_id_tipoaprovacao"}), @ORM\Index(name="IDX_C0570C85EAFC5D24", columns={"fn_id_produto"}), @ORM\Index(name="IDX_C0570C85B176857A", columns={"fn_id_legislacao"}), @ORM\Index(name="IDX_C0570C8569A409E0", columns={"fn_id_tipoamostra"}), @ORM\Index(name="IDX_C0570C858791DD66", columns={"fn_id_tipocontrolo"}), @ORM\Index(name="IDX_C0570C853730B53D", columns={"fn_id_grupoparametros"})})
 * @ORM\Entity
 */
class TModelosamostra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fnId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_activo", type="boolean", nullable=false)
     */
    private $fbActivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fn_limitedias", type="boolean", nullable=false)
     */
    private $fnLimitedias;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_orcamento", type="bigint", nullable=true)
     */
    private $fnIdOrcamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var \TGruposparametros
     *
     * @ORM\ManyToOne(targetEntity="TGruposparametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_grupoparametros", referencedColumnName="fn_id")
     * })
     */
    private $fnGrupoparametros;

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
     * @var \TTiposamostra
     *
     * @ORM\ManyToOne(targetEntity="TTiposamostra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tipoamostra", referencedColumnName="fn_id")
     * })
     */
    private $fnTipoamostra;

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
     * @var \TTiposcontrolo
     *
     * @ORM\ManyToOne(targetEntity="TTiposcontrolo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tipocontrolo", referencedColumnName="fn_id")
     * })
     */
    private $fnTipocontrolo;

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
     * @var \TProdutos
     *
     * @ORM\ManyToOne(targetEntity="TProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_produto", referencedColumnName="fn_id")
     * })
     */
    private $fnProduto;

    public function __toString()
    {
        return $this->ftDescricao;
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
     * Get fnId
     *
     * @return integer 
     */
    public function getFnId()
    {
        return $this->fnId;
    }

    /**
     * Set fbActivo
     *
     * @param boolean $fbActivo
     * @return TModelosamostra
     */
    public function setFbActivo($fbActivo)
    {
        $this->fbActivo = $fbActivo;

        return $this;
    }

    /**
     * Get fbActivo
     *
     * @return boolean 
     */
    public function getFbActivo()
    {
        return $this->fbActivo;
    }

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TModelosamostra
     */
    public function setFtDescricao($ftDescricao)
    {
        $this->ftDescricao = $ftDescricao;

        return $this;
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
     * Set fnLimitedias
     *
     * @param boolean $fnLimitedias
     * @return TModelosamostra
     */
    public function setFnLimitedias($fnLimitedias)
    {
        $this->fnLimitedias = $fnLimitedias;

        return $this;
    }

    /**
     * Get fnLimitedias
     *
     * @return boolean 
     */
    public function getFnLimitedias()
    {
        return $this->fnLimitedias;
    }

    /**
     * Set fnIdOrcamento
     *
     * @param integer $fnIdOrcamento
     * @return TModelosamostra
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
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TModelosamostra
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
     * Set fnGrupoparametros
     *
     * @param \AppBundle\Entity\TGruposparametros $fnGrupoparametros
     * @return TModelosamostra
     */
    public function setFnGrupoparametros(\AppBundle\Entity\TGruposparametros $fnGrupoparametros = null)
    {
        $this->fnGrupoparametros = $fnGrupoparametros;

        return $this;
    }

    /**
     * Get fnGrupoparametros
     *
     * @return \AppBundle\Entity\TGruposparametros 
     */
    public function getFnGrupoparametros()
    {
        return $this->fnGrupoparametros;
    }

    /**
     * Set fnCliente
     *
     * @param \AppBundle\Entity\TClientes $fnCliente
     * @return TModelosamostra
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
     * Set fnTipoamostra
     *
     * @param \AppBundle\Entity\TTiposamostra $fnTipoamostra
     * @return TModelosamostra
     */
    public function setFnTipoamostra(\AppBundle\Entity\TTiposamostra $fnTipoamostra = null)
    {
        $this->fnTipoamostra = $fnTipoamostra;

        return $this;
    }

    /**
     * Get fnTipoamostra
     *
     * @return \AppBundle\Entity\TTiposamostra 
     */
    public function getFnTipoamostra()
    {
        return $this->fnTipoamostra;
    }

    /**
     * Set fnTipoaprovacao
     *
     * @param \AppBundle\Entity\TTipoaprovacao $fnTipoaprovacao
     * @return TModelosamostra
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
     * Set fnTipocontrolo
     *
     * @param \AppBundle\Entity\TTiposcontrolo $fnTipocontrolo
     * @return TModelosamostra
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
     * Set fnLegislacao
     *
     * @param \AppBundle\Entity\TLegislacao $fnLegislacao
     * @return TModelosamostra
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
     * Set fnProduto
     *
     * @param \AppBundle\Entity\TProdutos $fnProduto
     * @return TModelosamostra
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
}
