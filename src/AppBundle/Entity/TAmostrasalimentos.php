<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TClientes
 *
 * @ORM\Table(name="t_amostrasalimentos" )
 * @ORM\Entity
 */
class TAmostrasalimentos
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
     * @ORM\Column(name="ft_Lote", type="string", length=50, nullable=false)
     */
    private $ftLote;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_acondicionamento", type="string", length=100, nullable=false)
     */
    private $ftAcondicionamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_validade", type="string", length=50, nullable=false)
     */
    private $ftValidade;
    /**
     * @var string
     *
     * @ORM\Column(name="ft_temperatura", type="string", length=50, nullable=false)
     */
    private $ftTemperatura;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_faseprocesso", type="string", length=100, nullable=false)
     */
    private $ftFaseprocesso;


    /**
     * Get fnId
     *
     * @return string
     */
    public function __toString()
    {
        return $this->ftLote;
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
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;

        return $this;
    }
    /**
     * Set ftLote
     *
     * @param string $ftLote
     * @return TAmostrasalimentos
     */
    public function setFtLote($ftLote)
    {
        $this->ftLote = $ftLote;
    
        return $this;
    }

    /**
     * Get ftLote
     *
     * @return string 
     */
    public function getFtLote()
    {
        return $this->ftLote;
    }

    /**
     * Set ftAcondicionamento
     *
     * @param string $ftAcondicionamento
     * @return TAmostrasalimentos
     */
    public function setFtAcondicionamento($ftAcondicionamento)
    {
        $this->ftAcondicionamento = $ftAcondicionamento;
    
        return $this;
    }

    /**
     * Get ftAcondicionamento
     *
     * @return string 
     */
    public function getFtAcondicionamento()
    {
        return $this->ftAcondicionamento;
    }

    /**
     * Set ftValidade
     *
     * @param string $ftValidade
     * @return TAmostrasalimentos
     */
    public function setFtValidade($ftValidade)
    {
        $this->ftValidade = $ftValidade;
    
        return $this;
    }

    /**
     * Get ftValidade
     *
     * @return string 
     */
    public function getFtValidade()
    {
        return $this->ftValidade;
    }

    /**
     * Set ftTemperatura
     *
     * @param string $ftTemperatura
     * @return TAmostrasalimentos
     */
    public function setFtTemperatura($ftTemperatura)
    {
        $this->ftTemperatura = $ftTemperatura;
    
        return $this;
    }

    /**
     * Get ftTemperatura
     *
     * @return string 
     */
    public function getFtTemperatura()
    {
        return $this->ftTemperatura;
    }

    /**
     * Set ftFaseprocesso
     *
     * @param string $ftFaseprocesso
     * @return TAmostrasalimentos
     */
    public function setFtFaseprocesso($ftFaseprocesso)
    {
        $this->ftFaseprocesso = $ftFaseprocesso;
    
        return $this;
    }

    /**
     * Get ftFaseprocesso
     *
     * @return string 
     */
    public function getFtFaseprocesso()
    {
        return $this->ftFaseprocesso;
    }
}
