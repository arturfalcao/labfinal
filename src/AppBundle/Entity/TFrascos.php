<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TFrascos
 *
 * @ORM\Table(name="t_frascos", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_frascos_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_frascos_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TFrascos
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
     * @ORM\Column(name="ft_codigo", type="string", length=20, nullable=false)
     */
    private $ftCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_alias", type="string", length=100, nullable=true)
     */
    private $ftAlias;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_capacidade", type="integer", nullable=true)
     */
    private $fnCapacidade;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_tipomaterial", type="bigint", nullable=true)
     */
    private $fnIdTipomaterial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_esteril", type="boolean", nullable=true)
     */
    private $fbEsteril;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_aditivo", type="bigint", nullable=true)
     */
    private $fnIdAditivo;


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
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TFrascos
     */
    public function setFtCodigo($ftCodigo)
    {
        $this->ftCodigo = $ftCodigo;

        return $this;
    }

    /**
     * Get ftCodigo
     *
     * @return string 
     */
    public function getFtCodigo()
    {
        return $this->ftCodigo;
    }

    /**
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TFrascos
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
     * Set ftAlias
     *
     * @param string $ftAlias
     * @return TFrascos
     */
    public function setFtAlias($ftAlias)
    {
        $this->ftAlias = $ftAlias;

        return $this;
    }

    /**
     * Get ftAlias
     *
     * @return string 
     */
    public function getFtAlias()
    {
        return $this->ftAlias;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TFrascos
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
     * Set fnCapacidade
     *
     * @param integer $fnCapacidade
     * @return TFrascos
     */
    public function setFnCapacidade($fnCapacidade)
    {
        $this->fnCapacidade = $fnCapacidade;

        return $this;
    }

    /**
     * Get fnCapacidade
     *
     * @return integer 
     */
    public function getFnCapacidade()
    {
        return $this->fnCapacidade;
    }

    /**
     * Set fnIdTipomaterial
     *
     * @param integer $fnIdTipomaterial
     * @return TFrascos
     */
    public function setFnIdTipomaterial($fnIdTipomaterial)
    {
        $this->fnIdTipomaterial = $fnIdTipomaterial;

        return $this;
    }

    /**
     * Get fnIdTipomaterial
     *
     * @return integer 
     */
    public function getFnIdTipomaterial()
    {
        return $this->fnIdTipomaterial;
    }

    /**
     * Set fbEsteril
     *
     * @param boolean $fbEsteril
     * @return TFrascos
     */
    public function setFbEsteril($fbEsteril)
    {
        $this->fbEsteril = $fbEsteril;

        return $this;
    }

    /**
     * Get fbEsteril
     *
     * @return boolean 
     */
    public function getFbEsteril()
    {
        return $this->fbEsteril;
    }

    /**
     * Set fnIdAditivo
     *
     * @param integer $fnIdAditivo
     * @return TFrascos
     */
    public function setFnIdAditivo($fnIdAditivo)
    {
        $this->fnIdAditivo = $fnIdAditivo;

        return $this;
    }

    /**
     * Get fnIdAditivo
     *
     * @return integer 
     */
    public function getFnIdAditivo()
    {
        return $this->fnIdAditivo;
    }
}
