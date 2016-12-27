<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TRequisicoes
 *
 * @ORM\Table(name="t_requisicoes")
 * @ORM\Entity
 */
class TRequisicoes
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
     * @ORM\Column(name="fn_id_laboratorio", type="bigint", nullable=true)
     */
    private $fnIdLaboratorio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fd_ultimaemissao", type="datetime", nullable=true)
     */
    private $fdUltimaemissao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_ultimoutilizador", type="string", length=100, nullable=true)
     */
    private $ftUltimoutilizador;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_anulada", type="boolean", nullable=true)
     */
    private $fbAnulada;

    /**
     * @var string
     *
     * @ORM\Column(name="fn_desconto", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $fnDesconto;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_tipopagamento", type="string", length=100, nullable=true)
     */
    private $ftTipopagamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_prazoentrega", type="string", length=100, nullable=true)
     */
    private $ftPrazoentrega;



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
     * Set fnIdLaboratorio
     *
     * @param integer $fnIdLaboratorio
     * @return TRequisicoes
     */
    public function setFnIdLaboratorio($fnIdLaboratorio)
    {
        $this->fnIdLaboratorio = $fnIdLaboratorio;

        return $this;
    }

    /**
     * Get fnIdLaboratorio
     *
     * @return integer 
     */
    public function getFnIdLaboratorio()
    {
        return $this->fnIdLaboratorio;
    }

    /**
     * Set fdUltimaemissao
     *
     * @param \DateTime $fdUltimaemissao
     * @return TRequisicoes
     */
    public function setFdUltimaemissao($fdUltimaemissao)
    {
        $this->fdUltimaemissao = $fdUltimaemissao;

        return $this;
    }

    /**
     * Get fdUltimaemissao
     *
     * @return \DateTime 
     */
    public function getFdUltimaemissao()
    {
        return $this->fdUltimaemissao;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TRequisicoes
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
     * Set ftUltimoutilizador
     *
     * @param string $ftUltimoutilizador
     * @return TRequisicoes
     */
    public function setFtUltimoutilizador($ftUltimoutilizador)
    {
        $this->ftUltimoutilizador = $ftUltimoutilizador;

        return $this;
    }

    /**
     * Get ftUltimoutilizador
     *
     * @return string 
     */
    public function getFtUltimoutilizador()
    {
        return $this->ftUltimoutilizador;
    }

    /**
     * Set fbAnulada
     *
     * @param boolean $fbAnulada
     * @return TRequisicoes
     */
    public function setFbAnulada($fbAnulada)
    {
        $this->fbAnulada = $fbAnulada;

        return $this;
    }

    /**
     * Get fbAnulada
     *
     * @return boolean 
     */
    public function getFbAnulada()
    {
        return $this->fbAnulada;
    }

    /**
     * Set fnDesconto
     *
     * @param string $fnDesconto
     * @return TRequisicoes
     */
    public function setFnDesconto($fnDesconto)
    {
        $this->fnDesconto = $fnDesconto;

        return $this;
    }

    /**
     * Get fnDesconto
     *
     * @return string 
     */
    public function getFnDesconto()
    {
        return $this->fnDesconto;
    }

    /**
     * Set ftTipopagamento
     *
     * @param string $ftTipopagamento
     * @return TRequisicoes
     */
    public function setFtTipopagamento($ftTipopagamento)
    {
        $this->ftTipopagamento = $ftTipopagamento;

        return $this;
    }

    /**
     * Get ftTipopagamento
     *
     * @return string 
     */
    public function getFtTipopagamento()
    {
        return $this->ftTipopagamento;
    }

    /**
     * Set ftPrazoentrega
     *
     * @param string $ftPrazoentrega
     * @return TRequisicoes
     */
    public function setFtPrazoentrega($ftPrazoentrega)
    {
        $this->ftPrazoentrega = $ftPrazoentrega;

        return $this;
    }

    /**
     * Get ftPrazoentrega
     *
     * @return string 
     */
    public function getFtPrazoentrega()
    {
        return $this->ftPrazoentrega;
    }
}
