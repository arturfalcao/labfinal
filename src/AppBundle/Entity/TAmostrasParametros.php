<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="t_amostrasparametros")
 * @ORM\Entity
 */
class TAmostrasParametros
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var integer
     *
     * @ORM\Column(name="id_amostra", type="bigint", nullable=false)
     */
    private $idamostra;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_parametro", type="bigint", nullable=false)

     */
    private $idparametro;



    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdparametro($idparametro)
    {
        $this->idparametro = $idparametro;

        return $this;
    }

    public function getIdparametro()
    {
        return $this->idparametro;
    }



    public function setIdamostra($idamostra)
    {
        $this->idamostra = $idamostra;

        return $this;
    }

    public function getIdamostra()
    {
        return $this->idamostra;
    }


}
