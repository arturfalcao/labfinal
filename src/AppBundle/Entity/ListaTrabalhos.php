<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListaTrabalhos
 *
 * @ORM\Table(name="lista_trabalhos")
 * @ORM\Entity
 */
    class ListaTrabalhos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_fecho", type="datetime", nullable=true)
     */
    private $datafecho;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_emissao", type="datetime", nullable=true)
     */
    private $dataemissao;

    /**
     * @var integer
     *
     * @ORM\Column(name="concluido", type="integer")
     */

    private $concluido=0;


    /**
     * @ORM\OneToMany(targetEntity="TParametrosamostra", mappedBy="fnIdlista")
     */
    protected $id_parametro_amostra;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id_parametro_amostra = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datafecho
     *
     * @param \DateTime $datafecho
     * @return ListaTrabalhos
     */
    public function setDatafecho($datafecho)
    {
        $this->datafecho = $datafecho;
    
        return $this;
    }

    /**
     * Get datafecho
     *
     * @return \DateTime 
     */
    public function getDatafecho()
    {
        return $this->datafecho;
    }

    /**
     * Set dataemissao
     *
     * @param \DateTime $dataemissao
     * @return ListaTrabalhos
     */
    public function setDataemissao($dataemissao)
    {
        $this->dataemissao = $dataemissao;
    
        return $this;
    }

    /**
     * Get dataemissao
     *
     * @return \DateTime 
     */
    public function getDataemissao()
    {
        return $this->dataemissao;
    }

    /**
     * Set concluido
     *
     * @param integer $concluido
     * @return ListaTrabalhos
     */
    public function setConcluido($concluido)
    {
        $this->concluido = $concluido;
    
        return $this;
    }

    /**
     * Get concluido
     *
     * @return integer 
     */
    public function getConcluido()
    {
        return $this->concluido;
    }

    /**
     * Add id_parametro_amostra
     *
     * @param \AppBundle\Entity\TParametrosAmostra $idParametroAmostra
     * @return ListaTrabalhos
     */
    public function addIdParametroAmostra(\AppBundle\Entity\TParametrosamostra $idParametroAmostra)
    {
        $this->id_parametro_amostra[] = $idParametroAmostra;
    
        return $this;
    }

    /**
     * Remove id_parametro_amostra
     *
     * @param \AppBundle\Entity\TParametrosamostra $idParametroAmostra
     */
    public function removeIdParametroAmostra(\AppBundle\Entity\TParametrosamostra $idParametroAmostra)
    {
        $this->id_parametro_amostra->removeElement($idParametroAmostra);
    }

    /**
     * Get id_parametro_amostra
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdParametroAmostra()
    {
        return $this->id_parametro_amostra;
    }
}
