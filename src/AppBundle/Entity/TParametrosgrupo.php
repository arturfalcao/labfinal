<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TParametrosgrupo
 *
 * @ORM\Table(name="t_parametrosgrupo")
 * @ORM\Entity
 */
class TParametrosgrupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="t_parametro", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tparametro;

    /**
     * @var integer
     *
     * @ORM\Column(name="t_grupo", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tgrupo;


    /**
     * Set fnIdEspecificacao
     *
     * @param integer $tparametro
     * @return TParametrosporespecificacao
     */
    public function setTparametro($tparametro)
    {
        $this->tparametro = $tparametro;

        return $this;
    }

    /**
     * Get fnIdEspecificacao
     *
     * @return integer
     */
    public function getTparametro()
    {
        return $this->tparametro;
    }

    /**
     * Set fnIdFamiliaparametro
     *
     * @param integer $tgrupo
     * @return TParametrosporespecificacao
     */
    public function setTgrupo($tgrupo)
    {
        $this->tgrupo = $tgrupo;

        return $this;
    }

    /**
     * Get fnIdFamiliaparametro
     *
     * @return integer
     */
    public function getTgrupo()
    {
        return $this->tgrupo;
    }

}
