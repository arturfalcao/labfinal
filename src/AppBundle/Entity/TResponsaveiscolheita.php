<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TResponsaveiscolheita
 *
 * @ORM\Table(name="t_responsaveiscolheita", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_responsaveiscolheita_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_responsaveiscolheita_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TResponsaveiscolheita
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
     * @return TResponsaveiscolheita
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
     * @return TResponsaveiscolheita
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
