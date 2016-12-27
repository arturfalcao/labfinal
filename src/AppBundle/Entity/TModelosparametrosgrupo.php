<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TModelosparametrosgrupo
 *
 * @ORM\Table(name="t_modelosparametrosgrupo")
 * @ORM\Entity
 */
class TModelosparametrosgrupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_grupo", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fnIdGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_modeloparametro", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fnIdModeloparametro;



    /**
     * Set fnIdGrupo
     *
     * @param integer $fnIdGrupo
     * @return TModelosparametrosgrupo
     */
    public function setFnIdGrupo($fnIdGrupo)
    {
        $this->fnIdGrupo = $fnIdGrupo;

        return $this;
    }

    /**
     * Get fnIdGrupo
     *
     * @return integer 
     */
    public function getFnIdGrupo()
    {
        return $this->fnIdGrupo;
    }

    /**
     * Set fnIdModeloparametro
     *
     * @param integer $fnIdModeloparametro
     * @return TModelosparametrosgrupo
     */
    public function setFnIdModeloparametro($fnIdModeloparametro)
    {
        $this->fnIdModeloparametro = $fnIdModeloparametro;

        return $this;
    }

    /**
     * Get fnIdModeloparametro
     *
     * @return integer 
     */
    public function getFnIdModeloparametro()
    {
        return $this->fnIdModeloparametro;
    }
}
