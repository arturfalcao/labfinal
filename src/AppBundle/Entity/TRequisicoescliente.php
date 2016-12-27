<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TRequisicoescliente
 *
 * @ORM\Table(name="t_requisicoescliente")
 * @ORM\Entity
 */
class TRequisicoescliente
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
     * @ORM\Column(name="fn_id_cliente", type="bigint", nullable=false)
     */
    private $fnIdCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_codigo", type="string", length=50, nullable=false)
     */
    private $ftCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_datarequisicao", type="datetime", nullable=false)
     */
    private $fdDatarequisicao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_activa", type="boolean", nullable=false)
     */
    private $fbActiva;

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
     * Set fnIdCliente
     *
     * @param integer $fnIdCliente
     * @return TRequisicoescliente
     */
    public function setFnIdCliente($fnIdCliente)
    {
        $this->fnIdCliente = $fnIdCliente;

        return $this;
    }

    /**
     * Get fnIdCliente
     *
     * @return integer 
     */
    public function getFnIdCliente()
    {
        return $this->fnIdCliente;
    }

    /**
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TRequisicoescliente
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
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TRequisicoescliente
     */
    public function setFtObservacao($ftObservacao)
    {
        $this->ftObservacao = $ftObservacao;

        return $this;
    }

    /**
     * Get ftObservacao
     *
     * @return string 
     */
    public function getFtObservacao()
    {
        return $this->ftObservacao;
    }

    /**
     * Set fdDatarequisicao
     *
     * @param \DateTime $fdDatarequisicao
     * @return TRequisicoescliente
     */
    public function setFdDatarequisicao($fdDatarequisicao)
    {
        $this->fdDatarequisicao = $fdDatarequisicao;

        return $this;
    }

    /**
     * Get fdDatarequisicao
     *
     * @return \DateTime 
     */
    public function getFdDatarequisicao()
    {
        return $this->fdDatarequisicao;
    }

    /**
     * Set fbActiva
     *
     * @param boolean $fbActiva
     * @return TRequisicoescliente
     */
    public function setFbActiva($fbActiva)
    {
        $this->fbActiva = $fbActiva;

        return $this;
    }

    /**
     * Get fbActiva
     *
     * @return boolean 
     */
    public function getFbActiva()
    {
        return $this->fbActiva;
    }
}
