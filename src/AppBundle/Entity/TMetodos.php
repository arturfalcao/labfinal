<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TMetodos
 *
 * @ORM\Table(name="t_metodos", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_metodos_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_metodos_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TMetodos
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
     * @var \TTecnicas
     *
     * @ORM\ManyToOne(targetEntity="TTecnicas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_tecnica", referencedColumnName="fn_id")
     * })
     */
    private $fnTecnica;

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

    public function __toString()
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
     * @return TMetodos
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
     * @return TMetodos
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
     * @return TMetodos
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
     * @return TMetodos
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
}
