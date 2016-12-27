<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TGruposparametros
 *
 * @ORM\Table(name="t_gruposparametros", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_gruposparametros_descricao", columns={"ft_descricao"}), @ORM\UniqueConstraint(name="IX_t_gruposparametros_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TGruposparametros
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
     * @ORM\Column(name="ft_codigo", type="string", length=20, nullable=false)
     */
    private $ftCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_descricao", type="string", length=100, nullable=false)
     */
    private $ftDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_alias", type="string", length=100, nullable=true)
     */
    private $ftAlias;

    /**
     * @var integer
     *
     * @ORM\Column(name="fn_id_produto", type="bigint", nullable=false)
     */
    private $fnIdProduto;


    /**
     * @ORM\ManyToMany(targetEntity="TParametros")
     * @ORM\JoinTable(name="t_parametrosgrupo",
     *      joinColumns={@ORM\JoinColumn(name="t_grupo", referencedColumnName="fn_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="t_parametro", referencedColumnName="fn_id")}
     *      )
     */
    public $fnParametros;


    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;


    /**
     * Add projectMedia
     *
     * @param \AppBundle\Entity\TParametros
     * @return TParametros
     */
    public function addfnParametros(\AppBundle\Entity\TParametros $fnParametros)
    {
        $this->fnParametros[] = $fnParametros;
        return $this;
    }

    public function __construct()
    {
        $this->fnParametros = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Remove projectMedia
     *
     * @param \AppBundle\Entity\TParametros
     */
    public function removefnParametros(\AppBundle\Entity\TParametros $fnParametros)
    {
        $this->fnParametros->remove($fnParametros);
    }
    /**
     * Get projectMedia
     *
     * @return \AppBundle\Entity\TParametros
     */
    public function getfnParametros()
    {
        return $this->fnParametros;
    }
    /**
     * Set projectMedia
     *
     * @param array
     * @return TParametros
     */
    public function setfnParametros($fnParametros)
    {
        $this->fnParametros = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($fnParametros as $m) {
            $this->addfnParametros($m);
        }
        return $this;
    }


    public function __toString()
    {
        return $this->ftCodigo;
    }

    /**
     * Set ftCodigo
     *
     * @param string $fnId
     * @return TProdutos
     */
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;

        return $this;
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
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TGruposparametros
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
     * Set ftDescricao
     *
     * @param string $ftDescricao
     * @return TGruposparametros
     */
    public function setFtDescricao($ftDescricao)
    {
        $this->ftDescricao = $ftDescricao;

        return $this;
    }

    /**
     * Get ftDescricao
     *
     * @return string 
     */
    public function getFtDescricao()
    {
        return $this->ftDescricao;
    }

    /**
     * Set ftAlias
     *
     * @param string $ftAlias
     * @return TGruposparametros
     */
    public function setFtAlias($ftAlias)
    {
        $this->ftAlias = $ftAlias;

        return $this;
    }

    /**
     * Get ftAlias
     *
     * @return string 
     */
    public function getFtAlias()
    {
        return $this->ftAlias;
    }

    /**
     * Set fnIdProduto
     *
     * @param integer $fnIdProduto
     * @return TGruposparametros
     */
    public function setFnIdProduto($fnIdProduto)
    {
        $this->fnIdProduto = $fnIdProduto;

        return $this;
    }

    /**
     * Get fnIdProduto
     *
     * @return integer 
     */
    public function getFnIdProduto()
    {
        return $this->fnIdProduto;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TGruposparametros
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
}
