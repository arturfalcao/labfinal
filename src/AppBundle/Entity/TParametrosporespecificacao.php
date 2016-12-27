<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TParametrosporespecificacao
 *
 * @ORM\Table(name="t_parametrosporespecificacao")
 * @ORM\Entity
 */
class TParametrosporespecificacao
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
     * @ORM\Column(name="fn_id_especificacao", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */


    /**
     * @ORM\ManyToOne(targetEntity="TEspecificacoes", inversedBy="fnParametros")
     * @ORM\JoinColumn(name="fn_id_especificacao", referencedColumnName="fn_id")
     */
    private $fnIdEspecificacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_familiaparametro", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */

    /**
     * @ORM\ManyToOne(targetEntity="TParametros", inversedBy="fnId")
     * @ORM\JoinColumn(name="fn_id_familiaparametro", referencedColumnName="fn_id")
     */
    private $fnIdFamiliaparametro;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_maximo", type="decimal", precision=11, scale=5, nullable=false)
     */
    private $fnMaximo;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_minimo", type="decimal", precision=11, scale=5, nullable=false)
     */
    private $fnMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_texto_relatorio", type="string", length=300, nullable=true)
     */
    private $ftTextoRelatorio;



    /**
     * Get ftTextoRelatorio
     *
     * @return string
     */
    public function __toString()
    {
        return $this->ftTextoRelatorio;
    }
    /**
     * Set ftMensagemUtilizador
     *
     * @param string $ftTextoRelatorio
     * @return TEspecificacoes
     */
    public function setFtTextoRelatorio($ftTextoRelatorio)
    {
        $this->ftTextoRelatorio = $ftTextoRelatorio;

        return $this;
    }

    /**
     * Get ftMensagemUtilizador
     *
     * @return string
     */
    public function getFtTextoRelatorio()
    {
        return $this->ftTextoRelatorio;
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
     * Set fnIdEspecificacao
     *
     * @param integer $fnIdEspecificacao
     * @return TParametrosporespecificacao
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
     * Set fnIdFamiliaparametro
     *
     * @param integer $fnIdFamiliaparametro
     * @return TParametrosporespecificacao
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
     * Set fnMaximo
     *
     * @param string $fnMaximo
     * @return TParametrosporespecificacao
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
     * @return TParametrosporespecificacao
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
}
