<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TTipoaprovacao
 *
 * @ORM\Table(name="t_tipoaprovacao")
 * @ORM\Entity
 */
class TTipoaprovacao
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
     * @ORM\Column(name="ft_codigo", type="string", length=20, nullable=true)
     */
    private $ftCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=true)
     */
    private $ftDescricao;

    public function __toString()
    {
        return $this->ftCodigo;
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
     * Get fnId
     *
     * @return integer
     */
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;

        return $this;    }

    /**
     * Get fnId
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->fnId;
    }

    /**
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TTipoaprovacao
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
     * @return TTipoaprovacao
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
}
