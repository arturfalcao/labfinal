<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TResultados
 *
 * @ORM\Table(name="t_resultados", indexes={@ORM\Index(name="IX_t_resultados_estado", columns={"ft_id_estado"}), @ORM\Index(name="IX_t_resultados_parametro", columns={"fn_id_parametro"}), @ORM\Index(name="IX_t_resultados_unidades", columns={"fn_id_unidade"}), @ORM\Index(name="resultado_modelo", columns={"fn_id_modeloresultado"})})
 * @ORM\Entity
 */
class TResultados
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
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_formatado", type="string", length=255, nullable=false)
     */
    private $ftFormatado;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_original", type="string", length=255, nullable=false)
     */
    private $ftOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_prefixo", type="string", length=1, nullable=false)
     */
    private $ftPrefixo;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_valor", type="decimal", precision=18, scale=5, nullable=true)
     */
    private $fnValor;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_calculado", type="decimal", precision=18, scale=5, nullable=true)
     */
    private $fnCalculado;

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
     * @var boolean
     *
     * @ORM\Column(name="fb_incluirnorelatorio", type="boolean", nullable=false)
     */
    private $fbIncluirnorelatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_maximo", type="decimal", precision=18, scale=5, nullable=false)
     */
    private $fnMaximo;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_minimo", type="decimal", precision=18, scale=5, nullable=false)
     */
    private $fnMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_limitequantificacao", type="decimal", precision=10, scale=5, nullable=false)
     */
    private $fnLimitequantificacao;

    /**
     * @var \TModelosresultados
     *
     * @ORM\ManyToOne(targetEntity="TModelosresultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_modeloresultado", referencedColumnName="fn_id")
     * })
     */
    private $fnModeloresultado;

    /**
     * @var \TAmostra
     *
     * @ORM\ManyToOne(targetEntity="TAmostras")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_amostra", referencedColumnName="fn_id")
     * })
     */
    private $fnAmostra;


    /**
     * @var \TParametros
     *
     * @ORM\OneToOne(targetEntity="TParametrosamostra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_parametro", referencedColumnName="id")
     * })
     */
    private $fnParametro;

    /**
     * @var \TUnidadesmedida
     *
     * @ORM\ManyToOne(targetEntity="TUnidadesmedida")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_unidade", referencedColumnName="fn_id")
     * })
     */
    private $fnUnidade;

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
     * Get fnId
     *
     * @return integer 
     */
    public function getFnId()
    {

        return $this->fnId;
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

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TResultados
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
     * Set ftFormatado
     *
     * @param string $ftFormatado
     * @return TResultados
     */
    public function setFtFormatado($ftFormatado)
    {
        $this->ftFormatado = $ftFormatado;

        return $this;
    }

    /**
     * Get ftFormatado
     *
     * @return string 
     */
    public function getFtFormatado()
    {
        return $this->ftFormatado;
    }

    /**
     * Set ftOriginal
     *
     * @param string $ftOriginal
     * @return TResultados
     */
    public function setFtOriginal($ftOriginal)
    {
        $this->ftOriginal = $ftOriginal;

        return $this;
    }

    /**
     * Get ftOriginal
     *
     * @return string 
     */
    public function getFtOriginal()
    {
        return $this->ftOriginal;
    }

    /**
     * Set ftPrefixo
     *
     * @param string $ftPrefixo
     * @return TResultados
     */
    public function setFtPrefixo($ftPrefixo)
    {
        $this->ftPrefixo = $ftPrefixo;

        return $this;
    }

    /**
     * Get ftPrefixo
     *
     * @return string 
     */
    public function getFtPrefixo()
    {
        return $this->ftPrefixo;
    }

    /**
     * Set fnValor
     *
     * @param string $fnValor
     * @return TResultados
     */
    public function setFnValor($fnValor)
    {
        $this->fnValor = $fnValor;

        return $this;
    }

    /**
     * Get fnValor
     *
     * @return string 
     */
    public function getFnValor()
    {
        return $this->fnValor;
    }

    /**
     * Set fnCalculado
     *
     * @param string $fnCalculado
     * @return TResultados
     */
    public function setFnCalculado($fnCalculado)
    {
        $this->fnCalculado = $fnCalculado;

        return $this;
    }

    /**
     * Get fnCalculado
     *
     * @return string 
     */
    public function getFnCalculado()
    {
        return $this->fnCalculado;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TResultados
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
     * @return TResultados
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
     * @return TResultados
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
     * @return TResultados
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
     * Set fbIncluirnorelatorio
     *
     * @param boolean $fbIncluirnorelatorio
     * @return TResultados
     */
    public function setFbIncluirnorelatorio($fbIncluirnorelatorio)
    {
        $this->fbIncluirnorelatorio = $fbIncluirnorelatorio;

        return $this;
    }

    /**
     * Get fbIncluirnorelatorio
     *
     * @return boolean 
     */
    public function getFbIncluirnorelatorio()
    {
        return $this->fbIncluirnorelatorio;
    }

    /**
     * Set fnMaximo
     *
     * @param string $fnMaximo
     * @return TResultados
     */
    public function setFnMaximo($fnMaximo)
    {
        $this->fnMaximo = $fnMaximo;

        return $this;
    }

    /**
     * Get fnMaximo
     *
     * @return string 
     */
    public function getFnMaximo()
    {
        return $this->fnMaximo;
    }

    /**
     * Set fnMinimo
     *
     * @param string $fnMinimo
     * @return TResultados
     */
    public function setFnMinimo($fnMinimo)
    {
        $this->fnMinimo = $fnMinimo;

        return $this;
    }

    /**
     * Get fnMinimo
     *
     * @return string 
     */
    public function getFnMinimo()
    {
        return $this->fnMinimo;
    }

    /**
     * Set fnLimitequantificacao
     *
     * @param string $fnLimitequantificacao
     * @return TResultados
     */
    public function setFnLimitequantificacao($fnLimitequantificacao)
    {
        $this->fnLimitequantificacao = $fnLimitequantificacao;

        return $this;
    }

    /**
     * Get fnLimitequantificacao
     *
     * @return string 
     */
    public function getFnLimitequantificacao()
    {
        return $this->fnLimitequantificacao;
    }

    /**
     * Set fnModeloresultado
     *
     * @param \AppBundle\Entity\TModelosresultados $fnModeloresultado
     * @return TResultados
     */
    public function setFnModeloresultado(\AppBundle\Entity\TModelosresultados $fnModeloresultado = null)
    {
        $this->fnModeloresultado = $fnModeloresultado;

        return $this;
    }

    /**
     * Get fnModeloresultado
     *
     * @return \AppBundle\Entity\TModelosresultados 
     */
    public function getFnModeloresultado()
    {
        return $this->fnModeloresultado;
    }

    /**
     * Set fnParametro
     *
     * @param \AppBundle\Entity\TParametrosamostra $fnParametro
     * @return TParametrosamostra
     */
    public function setFnParametro(\AppBundle\Entity\TParametrosamostra $fnParametro = null)
    {

        $this->fnParametro = $fnParametro;
        return $this;
    }

    /**
     * Get fnParametro
     *
     * @return \AppBundle\Entity\TParametrosamostra
     */
    public function getFnParametro()
    {
        return $this->fnParametro;
    }


    /**
     * Set fnAmostra
     *
     * @param \AppBundle\Entity\TAmostras $fnAmostra
     * @return TResultados
     */
    public function setFnAmostra(\AppBundle\Entity\TAmostras $fnAmostra = null)
    {
        $this->fnAmostra = $fnAmostra;

        return $this;
    }

    /**
     * Get fnAmostra
     *
     * @return \AppBundle\Entity\TAmostras
     */
    public function getFnAmostra()
    {
        return $this->fnAmostra;
    }


    /**
     * Set fnUnidade
     *
     * @param \AppBundle\Entity\TUnidadesmedida $fnUnidade
     * @return TResultados
     */
    public function setFnUnidade(\AppBundle\Entity\TUnidadesmedida $fnUnidade = null)
    {
        $this->fnUnidade = $fnUnidade;

        return $this;
    }

    /**
     * Get fnUnidade
     *
     * @return \AppBundle\Entity\TUnidadesmedida 
     */
    public function getFnUnidade()
    {
        return $this->fnUnidade;
    }

    /**
     * Set ftEstado
     *
     * @param \AppBundle\Entity\TEstados $ftEstado
     * @return TResultados
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
