<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TRegrasformatacao
 *
 * @ORM\Table(name="t_regrasformatacao", indexes={@ORM\Index(name="IDX_1B930EB42B686C80", columns={"fn_id_modeloresultado"})})
 * @ORM\Entity
 */
class TRegrasformatacao
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
     * @ORM\Column(name="fn_ordem", type="integer", nullable=true)
     */
    private $fnOrdem;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=true)
     */
    private $ftDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_limiteinferior", type="decimal", precision=10, scale=5, nullable=true)
     */
    private $fnLimiteinferior;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_limitesuperior", type="decimal", precision=10, scale=5, nullable=true)
     */
    private $fnLimitesuperior;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_casasdecimais", type="integer", nullable=true)
     */
    private $fnCasasdecimais;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_formatoexponencial", type="boolean", nullable=true)
     */
    private $fbFormatoexponencial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_formatoutilizador", type="boolean", nullable=true)
     */
    private $fbFormatoutilizador;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_expressaoutilizador", type="string", length=20, nullable=true)
     */
    private $ftExpressaoutilizador;

    /**
     *
     * @ORM\ManyToOne(targetEntity="TModelosresultados", inversedBy="RegasFormatacao")
     * @ORM\JoinColumn(name="fn_modeloresultado_id", referencedColumnName="fn_id")
     */
    private $fnModeloresultado;


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
     * Set fnOrdem
     *
     * @param integer $fnOrdem
     * @return TRegrasformatacao
     */
    public function setFnOrdem($fnOrdem)
    {
        $this->fnOrdem = $fnOrdem;

        return $this;
    }

    /**
     * Get fnOrdem
     *
     * @return integer 
     */
    public function getFnOrdem()
    {
        return $this->fnOrdem;
    }

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TRegrasformatacao
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
     * Set fnLimiteinferior
     *
     * @param string $fnLimiteinferior
     * @return TRegrasformatacao
     */
    public function setFnLimiteinferior($fnLimiteinferior)
    {
        $this->fnLimiteinferior = $fnLimiteinferior;

        return $this;
    }

    /**
     * Get fnLimiteinferior
     *
     * @return string 
     */
    public function getFnLimiteinferior()
    {
        return $this->fnLimiteinferior;
    }

    /**
     * Set fnLimitesuperior
     *
     * @param string $fnLimitesuperior
     * @return TRegrasformatacao
     */
    public function setFnLimitesuperior($fnLimitesuperior)
    {
        $this->fnLimitesuperior = $fnLimitesuperior;

        return $this;
    }

    /**
     * Get fnLimitesuperior
     *
     * @return string 
     */
    public function getFnLimitesuperior()
    {
        return $this->fnLimitesuperior;
    }

    /**
     * Set fnCasasdecimais
     *
     * @param integer $fnCasasdecimais
     * @return TRegrasformatacao
     */
    public function setFnCasasdecimais($fnCasasdecimais)
    {
        $this->fnCasasdecimais = $fnCasasdecimais;

        return $this;
    }

    /**
     * Get fnCasasdecimais
     *
     * @return integer 
     */
    public function getFnCasasdecimais()
    {
        return $this->fnCasasdecimais;
    }

    /**
     * Set fbFormatoexponencial
     *
     * @param boolean $fbFormatoexponencial
     * @return TRegrasformatacao
     */
    public function setFbFormatoexponencial($fbFormatoexponencial)
    {
        $this->fbFormatoexponencial = $fbFormatoexponencial;

        return $this;
    }

    /**
     * Get fbFormatoexponencial
     *
     * @return boolean 
     */
    public function getFbFormatoexponencial()
    {
        return $this->fbFormatoexponencial;
    }

    /**
     * Set fbFormatoutilizador
     *
     * @param boolean $fbFormatoutilizador
     * @return TRegrasformatacao
     */
    public function setFbFormatoutilizador($fbFormatoutilizador)
    {
        $this->fbFormatoutilizador = $fbFormatoutilizador;

        return $this;
    }

    /**
     * Get fbFormatoutilizador
     *
     * @return boolean 
     */
    public function getFbFormatoutilizador()
    {
        return $this->fbFormatoutilizador;
    }

    /**
     * Set ftExpressaoutilizador
     *
     * @param string $ftExpressaoutilizador
     * @return TRegrasformatacao
     */
    public function setFtExpressaoutilizador($ftExpressaoutilizador)
    {
        $this->ftExpressaoutilizador = $ftExpressaoutilizador;

        return $this;
    }

    /**
     * Get ftExpressaoutilizador
     *
     * @return string 
     */
    public function getFtExpressaoutilizador()
    {
        return $this->ftExpressaoutilizador;
    }

    /**
     * Set fnModeloresultado
     *
     * @param \AppBundle\Entity\TModelosresultados $fnModeloresultado
     * @return TRegrasformatacao
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
}
