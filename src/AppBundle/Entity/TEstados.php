<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TEstados
 *
 * @ORM\Table(name="t_estados", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_estados_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_estados_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TEstados
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
     * @ORM\Column(name="ft_id", type="string", length=1, nullable=false)
     */

    private $ftId;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_codigo", type="string", length=10, nullable=false)
     */
    private $ftCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    public function __toString()
    {
        return $this->ftDescricao;
    }

    /**
     * Get fnId
     *
     * @return string
     */
    public function getFnId()
    {
        return $this->fnId;
    }

    /**
     * Get ftId
     *
     * @return string 
     */
    public function getFtId()
    {
        return $this->ftId;
    }

    /**
     * Get ftId
     *
     * @return string
     */
    public function setFtId($ftId)
    {

        $this->ftId = $ftId;

        return $this;
    }

    /**
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TEstados
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
     * @return TEstados
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
