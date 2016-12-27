<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TProdutosespecificacoes
 *
 * @ORM\Table(name="t_produtosespecificacoes", indexes={@ORM\Index(name="dsasdsadsadsad", columns={"fn_id_especificacao"}), @ORM\Index(name="sadasdsadsaddd", columns={"fn_id_produto"})})
 * @ORM\Entity
 */
class TProdutosespecificacoes
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
     * @var boolean
     *
     * @ORM\Column(name="fb_master", type="boolean", nullable=true)
     */
    private $fbMaster = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_ordem", type="integer", nullable=true)
     */
    private $fnOrdem;

    /**
     * @var \TEspecificacoes
     *
     * @ORM\ManyToOne(targetEntity="TEspecificacoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_especificacao", referencedColumnName="fn_id")
     * })
     */
    private $fnEspecificacao;

    /**
     * @var \TProdutos
     *
     * @ORM\ManyToOne(targetEntity="TProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_produto", referencedColumnName="fn_id")
     * })
     */
    private $fnProduto;



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
     * Set fbMaster
     *
     * @param boolean $fbMaster
     * @return TProdutosespecificacoes
     */
    public function setFbMaster($fbMaster)
    {
        $this->fbMaster = $fbMaster;

        return $this;
    }

    /**
     * Get fbMaster
     *
     * @return boolean
     */
    public function getFbMaster()
    {
        return $this->fbMaster;
    }

    /**
     * Set fnOrdem
     *
     * @param integer $fnOrdem
     * @return TProdutosespecificacoes
     */
    public function setFnOrdem($fnOrdem)
    {
        $this->fnOrdem = $fnOrdem;

        return $this;
    }

    /**
     * Get fnOrdem
     *
     * @return integer
     */
    public function getFnOrdem()
    {
        return $this->fnOrdem;
    }

    /**
     * Set fnEspecificacao
     *
     * @param \AppBundle\Entity\TEspecificacoes $fnEspecificacao
     * @return TProdutosespecificacoes
     */
    public function setFnEspecificacao(\AppBundle\Entity\TEspecificacoes $fnEspecificacao = null)
    {
        $this->fnEspecificacao = $fnEspecificacao;

        return $this;
    }

    /**
     * Get fnEspecificacao
     *
     * @return \AppBundle\Entity\TEspecificacoes
     */
    public function getFnEspecificacao()
    {
        return $this->fnEspecificacao;
    }

    /**
     * Set fnProduto
     *
     * @param \AppBundle\Entity\TProdutos $fnProduto
     * @return TProdutosespecificacoes
     */
    public function setFnProduto(\AppBundle\Entity\TProdutos $fnProduto = null)
    {
        $this->fnProduto = $fnProduto;

        return $this;
    }

    /**
     * Get fnProduto
     *
     * @return \AppBundle\Entity\TProdutos
     */
    public function getFnProduto()
    {
        return $this->fnProduto;
    }
}
