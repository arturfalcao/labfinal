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
     * @var \TModelosresultados
     *
     * @ORM\ManyToOne(targetEntity="TModelosresultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_modeloresultado", referencedColumnName="fn_id")
     * })
     */
    private $fnModeloresultado;


}
