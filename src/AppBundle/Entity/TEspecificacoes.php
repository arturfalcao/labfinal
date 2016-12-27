<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\TParametros;



/**
 * TProdutos
 *
 * @ORM\Table(name="t_especificacoes")
 * @ORM\Entity
 */
class TEspecificacoes
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
     * @var string
     *
     * @ORM\Column(name="ft_mensagem_utilizador", type="string", length=300, nullable=true)
     */
    private $ftMensagemUtilizador;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_texto_qd_passa_p", type="string", length=300, nullable=true)
     */
    private $ftTextoQdPassaP;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_texto_qd_nao_passa_p", type="string", length=300, nullable=true)
     */
    private $ftTextoQdNaoPassaP;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_texto_qd_cumpre_a", type="string", length=300, nullable=true)
     */
    private $ftTextoQdCumpreA;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_texto_qd_nao_cumpre_a", type="string", length=300, nullable=true)
     */
    private $ftTextoQdNaoCumpreA;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_emissao_de_relatorio", type="boolean", nullable=false)
     */
    private $fbEmissaoDeRelatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_siglavl", type="string", length=20, nullable=true)
     */
    private $ftSiglavl;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_legendavl", type="string", length=100, nullable=true)
     */
    private $ftLegendavl;

    /**
     * @var integer
     *
     * @ORM\Column(name="fb_activo", type="boolean", nullable=false)
     */
    private $fbActivo;

    /**
     * @var \TLegislacao
     *
     * @ORM\ManyToOne(targetEntity="TLegislacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fn_id_legislacao", referencedColumnName="fn_id")
     * })
     */
    private $fnLegislacao;


    /**
     * @ORM\OneToMany(targetEntity="TParametrosporespecificacao", mappedBy="fnIdEspecificacao", cascade={"persist"}, orphanRemoval=true)
     */
    private $fnParametros;




    /**
     * @ORM\ManyToMany(targetEntity="TProdutos", mappedBy="fnEspecificacoes")
     */
    private $fnProdutos;



    /**
     * Add fnEspecificacoes
     *
     * @param \AppBundle\Entity\TProdutos $fnProdutos
     */
    public function setfnProdutos(\AppBundle\Entity\TProdutos $fnProdutos = null)
    {
        $this->fnProdutos[] = $fnProdutos;
    }
    /**
     * Get fnEspecificacoes
     *
     * @return \AppBundle\Entity\TProdutos
     */
    public function getfnProdutos()
    {
        return $this->fnProdutos;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fnProdutos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fnParametros = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
     * Add projectMedia
     *
     * @param \AppBundle\Entity\TParametrosporespecificacao
     * @return TParametrosporespecificacao
     */
    public function addfnParametros(\AppBundle\Entity\TParametrosporespecificacao $fnParametros)
    {
        $this->fnParametros[] = $fnParametros;
        return $this;
    }
    /**
     * Remove projectMedia
     *
     * @param \AppBundle\Entity\TParametrosporespecificacao
     */
    public function removefnParametros(\AppBundle\Entity\TParametrosporespecificacao $fnParametros)
    {
        $this->fnParametros->remove($fnParametros);
    }
    /**
     * Get projectMedia
     *
     * @return \AppBundle\Entity\TParametrosporespecificacao
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
            $m->setFnIdEspecificacao($this);
            $this->addfnParametros($m);
        }
        return $this;
    }


    public function __toString()
    {
        return $this->ftDescricao;
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
     * @param string $fnId
     * @return TProdutos
     */
    public function setFnId($fnId)
    {
        $this->fnId = $fnId;

        return $this;
    }

    /**
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TEspecificacoes
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
     * @return TEspecificacoes
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
     * @return TEspecificacoes
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
     * Set ftMensagemUtilizador
     *
     * @param string $ftMensagemUtilizador
     * @return TEspecificacoes
     */
    public function setFtMensagemUtilizador($ftMensagemUtilizador)
    {
        $this->ftMensagemUtilizador = $ftMensagemUtilizador;

        return $this;
    }

    /**
     * Get ftMensagemUtilizador
     *
     * @return string
     */
    public function getFtMensagemUtilizador()
    {
        return $this->ftMensagemUtilizador;
    }

    /**
     * Set ftTextoQdPassaP
     *
     * @param string $ftTextoQdPassaP
     * @return TEspecificacoes
     */
    public function setFtTextoQdPassaP($ftTextoQdPassaP)
    {
        $this->ftTextoQdPassaP = $ftTextoQdPassaP;

        return $this;
    }

    /**
     * Get ftTextoQdPassaP
     *
     * @return string
     */
    public function getFtTextoQdPassaP()
    {
        return $this->ftTextoQdPassaP;
    }

    /**
     * Set ftTextoQdNaoPassaP
     *
     * @param string $ftTextoQdNaoPassaP
     * @return TEspecificacoes
     */
    public function setFtTextoQdNaoPassaP($ftTextoQdNaoPassaP)
    {
        $this->ftTextoQdNaoPassaP = $ftTextoQdNaoPassaP;

        return $this;
    }

    /**
     * Get ftTextoQdNaoPassaP
     *
     * @return string
     */
    public function getFtTextoQdNaoPassaP()
    {
        return $this->ftTextoQdNaoPassaP;
    }

    /**
     * Set ftTextoQdCumpreA
     *
     * @param string $ftTextoQdCumpreA
     * @return TEspecificacoes
     */
    public function setFtTextoQdCumpreA($ftTextoQdCumpreA)
    {
        $this->ftTextoQdCumpreA = $ftTextoQdCumpreA;

        return $this;
    }

    /**
     * Get ftTextoQdCumpreA
     *
     * @return string
     */
    public function getFtTextoQdCumpreA()
    {
        return $this->ftTextoQdCumpreA;
    }

    /**
     * Set ftTextoQdNaoCumpreA
     *
     * @param string $ftTextoQdNaoCumpreA
     * @return TEspecificacoes
     */
    public function setFtTextoQdNaoCumpreA($ftTextoQdNaoCumpreA)
    {
        $this->ftTextoQdNaoCumpreA = $ftTextoQdNaoCumpreA;

        return $this;
    }

    /**
     * Get ftTextoQdNaoCumpreA
     *
     * @return string
     */
    public function getFtTextoQdNaoCumpreA()
    {
        return $this->ftTextoQdNaoCumpreA;
    }

    /**
     * Set fbEmissaoDeRelatorio
     *
     * @param integer $fbEmissaoDeRelatorio
     * @return TEspecificacoes
     */
    public function setFbEmissaoDeRelatorio($fbEmissaoDeRelatorio)
    {
        $this->fbEmissaoDeRelatorio = $fbEmissaoDeRelatorio;

        return $this;
    }

    /**
     * Get fbEmissaoDeRelatorio
     *
     * @return integer
     */
    public function getFbEmissaoDeRelatorio()
    {
        return $this->fbEmissaoDeRelatorio;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TEspecificacoes
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
     * Set ftSiglavl
     *
     * @param string $ftSiglavl
     * @return TEspecificacoes
     */
    public function setFtSiglavl($ftSiglavl)
    {
        $this->ftSiglavl = $ftSiglavl;

        return $this;
    }

    /**
     * Get ftSiglavl
     *
     * @return string
     */
    public function getFtSiglavl()
    {
        return $this->ftSiglavl;
    }

    /**
     * Set ftLegendavl
     *
     * @param string $ftLegendavl
     * @return TEspecificacoes
     */
    public function setFtLegendavl($ftLegendavl)
    {
        $this->ftLegendavl = $ftLegendavl;

        return $this;
    }

    /**
     * Get ftLegendavl
     *
     * @return string
     */
    public function getFtLegendavl()
    {
        return $this->ftLegendavl;
    }

    /**
     * Set fbActivo
     *
     * @param integer $fbActivo
     * @return TEspecificacoes
     */
    public function setFbActivo($fbActivo)
    {
        $this->fbActivo = $fbActivo;

        return $this;
    }

    /**
     * Get fbActivo
     *
     * @return integer
     */
    public function getFbActivo()
    {
        return $this->fbActivo;
    }

    /**
     * Set fnLegislacao
     *
     * @param \AppBundle\Entity\TLegislacao $fnLegislacao
     * @return TEspecificacoes
     */
    public function setFnLegislacao(\AppBundle\Entity\TLegislacao $fnLegislacao = null)
    {
        $this->fnLegislacao = $fnLegislacao;

        return $this;
    }

    /**
     * Get fnLegislacao
     *
     * @return \AppBundle\Entity\TLegislacao
     */
    public function getFnLegislacao()
    {
        return $this->fnLegislacao;
    }

    /**
     * Add parametros
     *
     * @param \AppBundle\Entity\TParametros $parametros
     * @return TEspecificacoes
     */
    public function addParametro(\AppBundle\Entity\TParametros $parametros)
    {
        $this->parametros[] = $parametros;

        return $this;
    }

    /**
     * Remove parametros
     *
     * @param \AppBundle\Entity\TParametros $parametros
     */
    public function removeParametro(\AppBundle\Entity\TParametros $parametros)
    {
        $this->parametros->removeElement($parametros);
    }

    /**
     * Get parametros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParametros()
    {
        return $this->parametros;
    }
}
