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
     * @var string
     *
     * @ORM\Column(name="ft_id", type="string", length=1, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}
