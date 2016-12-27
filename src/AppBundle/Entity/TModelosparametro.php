<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TModelosparametro
 *
 * @ORM\Table(name="t_modelosparametro", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_modelosparametro_descricao", columns={"ft_descricao"})}, indexes={@ORM\Index(name="IDX_D04F739D8A7894DE", columns={"fn_id_laboratorio"}), @ORM\Index(name="IDX_D04F739D1909E299", columns={"fn_id_metodo"}), @ORM\Index(name="IDX_D04F739D5D2AB5F4", columns={"fn_id_tecnica"}), @ORM\Index(name="IDX_D04F739D63E11BFC", columns={"fn_id_areaensaio"}), @ORM\Index(name="IDX_D04F739DE5DC4C23", columns={"fn_id_familiaparametro"}), @ORM\Index(name="IDX_D04F739D2B686C80", columns={"fn_id_modeloresultado"}), @ORM\Index(name="IDX_D04F739D9CB432B6", columns={"fn_id_frasco"})})
 * @ORM\Entity
 */
class TModelosparametro
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
     * @var integer
     *
     * @ORM\Column(name="fb_activo", type="boolean", nullable=true)
     */
    private $fbActivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_formulaquimica", type="string", length=50, nullable=true)
     */
    private $ftFormulaquimica;

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
     * @ORM\Column(name="fn_nrdiasparaexecucao", type="boolean", nullable=false)
     */
    private $fnNrdiasparaexecucao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_acreditado", type="boolean", nullable=false)
     */
    private $fbAcreditado;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_volumeminimo", type="integer", nullable=true)
     */
    private $fnVolumeminimo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

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
     * @var \TMetodos
     *
     * @ORM\ManyToOne(targetEntity="TMetodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_metodo", referencedColumnName="fn_id")
     * })
     */
    private $fnMetodo;

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
     * @var \TTecnicas
     *
     * @ORM\ManyToOne(targetEntity="TTecnicas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tecnica", referencedColumnName="fn_id")
     * })
     */
    private $fnTecnica;

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
     * @var \TLaboratorios
     *
     * @ORM\ManyToOne(targetEntity="TLaboratorios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_laboratorio", referencedColumnName="fn_id")
     * })
     */
    private $fnLaboratorio;

    /**
     * @var \TFamiliasparametros
     *
     * @ORM\ManyToOne(targetEntity="TFamiliasparametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_familiaparametro", referencedColumnName="fn_id")
     * })
     */
    private $fnFamiliaparametro;


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
     * Set fbActivo
     *
     * @param integer $fbActivo
     * @return TModelosparametro
     */
    public function setFbActivo($fbActivo)
    {
        $this->fbActivo = $fbActivo;

        return $this;
    }

    /**
     * Get fbActivo
     *
     * @return integer 
     */
    public function getFbActivo()
    {
        return $this->fbActivo;
    }

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TModelosparametro
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
     * Set ftFormulaquimica
     *
     * @param string $ftFormulaquimica
     * @return TModelosparametro
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
     * Set fnPrecocompra
     *
     * @param string $fnPrecocompra
     * @return TModelosparametro
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
     * @return TModelosparametro
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
     * @return TModelosparametro
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
     * Set fnNrdiasparaexecucao
     *
     * @param boolean $fnNrdiasparaexecucao
     * @return TModelosparametro
     */
    public function setFnNrdiasparaexecucao($fnNrdiasparaexecucao)
    {
        $this->fnNrdiasparaexecucao = $fnNrdiasparaexecucao;

        return $this;
    }

    /**
     * Get fnNrdiasparaexecucao
     *
     * @return boolean 
     */
    public function getFnNrdiasparaexecucao()
    {
        return $this->fnNrdiasparaexecucao;
    }

    /**
     * Set fbAcreditado
     *
     * @param boolean $fbAcreditado
     * @return TModelosparametro
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
     * Set fnVolumeminimo
     *
     * @param integer $fnVolumeminimo
     * @return TModelosparametro
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
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TModelosparametro
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
     * Set fnFrasco
     *
     * @param \AppBundle\Entity\TFrascos $fnFrasco
     * @return TModelosparametro
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
     * Set fnMetodo
     *
     * @param \AppBundle\Entity\TMetodos $fnMetodo
     * @return TModelosparametro
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
     * Set fnModeloresultado
     *
     * @param \AppBundle\Entity\TModelosresultados $fnModeloresultado
     * @return TModelosparametro
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
     * Set fnTecnica
     *
     * @param \AppBundle\Entity\TTecnicas $fnTecnica
     * @return TModelosparametro
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
     * Set fnAreaensaio
     *
     * @param \AppBundle\Entity\TAreasensaio $fnAreaensaio
     * @return TModelosparametro
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
     * Set fnLaboratorio
     *
     * @param \AppBundle\Entity\TLaboratorios $fnLaboratorio
     * @return TModelosparametro
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
     * Set fnFamiliaparametro
     *
     * @param \AppBundle\Entity\TFamiliasparametros $fnFamiliaparametro
     * @return TModelosparametro
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
}
