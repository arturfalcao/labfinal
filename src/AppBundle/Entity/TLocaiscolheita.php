<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TLocaiscolheita
 *
 * @ORM\Table(name="t_locaiscolheita", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_locaiscolheita_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_locaiscolheita_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TLocaiscolheita
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
     * @var integer
     *
     * @ORM\Column(name="fn_id_concelho", type="bigint", nullable=false)
     */
    private $fnIdConcelho;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_tipo_localcolheita", type="bigint", nullable=false)
     */
    private $fnIdTipoLocalcolheita;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_sistemaabastecimento", type="bigint", nullable=false)
     */
    private $fnIdSistemaabastecimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_cliente", type="bigint", nullable=false)
     */
    private $fnIdCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_activo", type="boolean", nullable=false)
     */
    private $fbActivo = true;


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
     * @return TLocaiscolheita
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
     * @return TLocaiscolheita
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
     * @return TLocaiscolheita
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
     * Set fnIdConcelho
     *
     * @param integer $fnIdConcelho
     * @return TLocaiscolheita
     */
    public function setFnIdConcelho($fnIdConcelho)
    {
        $this->fnIdConcelho = $fnIdConcelho;

        return $this;
    }

    /**
     * Get fnIdConcelho
     *
     * @return integer 
     */
    public function getFnIdConcelho()
    {
        return $this->fnIdConcelho;
    }

    /**
     * Set fnIdTipoLocalcolheita
     *
     * @param integer $fnIdTipoLocalcolheita
     * @return TLocaiscolheita
     */
    public function setFnIdTipoLocalcolheita($fnIdTipoLocalcolheita)
    {
        $this->fnIdTipoLocalcolheita = $fnIdTipoLocalcolheita;

        return $this;
    }

    /**
     * Get fnIdTipoLocalcolheita
     *
     * @return integer 
     */
    public function getFnIdTipoLocalcolheita()
    {
        return $this->fnIdTipoLocalcolheita;
    }

    /**
     * Set fnIdSistemaabastecimento
     *
     * @param integer $fnIdSistemaabastecimento
     * @return TLocaiscolheita
     */
    public function setFnIdSistemaabastecimento($fnIdSistemaabastecimento)
    {
        $this->fnIdSistemaabastecimento = $fnIdSistemaabastecimento;

        return $this;
    }

    /**
     * Get fnIdSistemaabastecimento
     *
     * @return integer 
     */
    public function getFnIdSistemaabastecimento()
    {
        return $this->fnIdSistemaabastecimento;
    }

    /**
     * Set fnIdCliente
     *
     * @param integer $fnIdCliente
     * @return TLocaiscolheita
     */
    public function setFnIdCliente($fnIdCliente)
    {
        $this->fnIdCliente = $fnIdCliente;

        return $this;
    }

    /**
     * Get fnIdCliente
     *
     * @return integer 
     */
    public function getFnIdCliente()
    {
        return $this->fnIdCliente;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TLocaiscolheita
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
     * Set fbActivo
     *
     * @param boolean $fbActivo
     * @return TLocaiscolheita
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
}
