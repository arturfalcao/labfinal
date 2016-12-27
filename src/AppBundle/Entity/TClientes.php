<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TClientes
 *
 * @ORM\Table(name="t_clientes", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_clientes_nome", columns={"ft_nome"}), @ORM\UniqueConstraint(name="IX_t_clientes_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TClientes
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
     * @ORM\Column(name="ft_nome", type="string", length=100, nullable=false)
     */
    private $ftNome;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_nomeutilizador", type="string", length=100, nullable=false)
     */
    private $ftNomeUtilizador;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_password", type="string", length=100, nullable=false)
     */
    private $ftpassword;


    /**
     * @var string
     *
     * @ORM\Column(name="ft_alias", type="string", length=100, nullable=true)
     */
    private $ftAlias;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_morada", type="string", length=100, nullable=false)
     */
    private $ftMorada;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_codpostal", type="string", length=10, nullable=false)
     */
    private $ftCodpostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_localidade", type="string", length=50, nullable=false)
     */
    private $ftLocalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_pais", type="string", length=20, nullable=false)
     */
    private $ftPais;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_telefone", type="string", length=20, nullable=false)
     */
    private $ftTelefone;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_email", type="string", length=50, nullable=false)
     */
    private $ftEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_observacao", type="string", length=300, nullable=true)
     */
    private $ftObservacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_nomecontacto", type="string", length=100, nullable=true)
     */
    private $ftNomecontacto;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_telefonecontacto", type="string", length=20, nullable=true)
     */
    private $ftTelefonecontacto;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_emailcontacto", type="string", length=100, nullable=true)
     */
    private $ftEmailcontacto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fb_userativo", type="boolean", nullable=true)
     */
    private $fbuserativo;


    
    public function __toString()
    {
        return $this->ftNome;
    }

    public function getFbUserativo()
    {
        return $this->fbuserativo;
    }
    /**
     * Set fnId
     *
     * @param boolean $fbuserativo
     * @return TClientes
     */
    public function setFbuserativo($fbuserativo)
    {
        $this->fbuserativo = $fbuserativo;

        return $this;
    }

    public function getFnId()
    {
        return $this->fnId;
    }
    /**
     * Set fnId
     *
     * @param integer $fnId
     * @return TClientes
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
     * @return TClientes
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
     * Set ftNome
     *
     * @param string $ftNome
     * @return TClientes
     */
    public function setFtNome($ftNome)
    {
        $this->ftNome = $ftNome;

        return $this;
    }


    /**
     * Set ftNomeUtilizador
     *
     * @param string $ftNomeUtilizador
     * @return TClientes
     */
    public function setFtNomeUtilizador($ftNomeUtilizador)
    {
        $this->ftNomeUtilizador = $ftNomeUtilizador;

        return $this;
    }
    /**
     * Set ftpassword
     *
     * @param string $ftpassword
     * @return TClientes
     */
    public function setFtPassword($ftpassword)
    {
        $this->ftpassword = $ftpassword;

        return $this;
    }

    /**
     * Get ftNome
     *
     * @return string
     */
    public function getFtNomeUtilizador()
    {
        return $this->ftNomeUtilizador;
    }
    /**
     * Get ftNome
     *
     * @return string
     */
    public function getFtPassword()
    {
        return $this->ftpassword;
    }
    /**
     * Get ftNome
     *
     * @return string 
     */
    public function getFtNome()
    {
        return utf8_decode($this->ftNome);
    }

    /**
     * Set ftAlias
     *
     * @param string $ftAlias
     * @return TClientes
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
        return utf8_decode($this->ftAlias);
    }

    /**
     * Set ftMorada
     *
     * @param string $ftMorada
     * @return TClientes
     */
    public function setFtMorada($ftMorada)
    {
        $this->ftMorada = $ftMorada;

        return $this;
    }

    /**
     * Get ftMorada
     *
     * @return string 
     */
    public function getFtMorada()
    {
        return utf8_decode($this->ftMorada);
    }

    /**
     * Set ftCodpostal
     *
     * @param string $ftCodpostal
     * @return TClientes
     */
    public function setFtCodpostal($ftCodpostal)
    {
        $this->ftCodpostal = $ftCodpostal;

        return $this;
    }

    /**
     * Get ftCodpostal
     *
     * @return string 
     */
    public function getFtCodpostal()
    {
        return $this->ftCodpostal;
    }

    /**
     * Set ftLocalidade
     *
     * @param string $ftLocalidade
     * @return TClientes
     */
    public function setFtLocalidade($ftLocalidade)
    {
        $this->ftLocalidade = $ftLocalidade;

        return $this;
    }

    /**
     * Get ftLocalidade
     *
     * @return string 
     */
    public function getFtLocalidade()
    {
        return utf8_decode($this->ftLocalidade);
    }

    /**
     * Set ftPais
     *
     * @param string $ftPais
     * @return TClientes
     */
    public function setFtPais($ftPais)
    {
        $this->ftPais = $ftPais;

        return $this;
    }

    /**
     * Get ftPais
     *
     * @return string 
     */
    public function getFtPais()
    {
        return utf8_decode($this->ftPais);
    }

    /**
     * Set ftTelefone
     *
     * @param string $ftTelefone
     * @return TClientes
     */
    public function setFtTelefone($ftTelefone)
    {
        $this->ftTelefone = $ftTelefone;

        return $this;
    }

    /**
     * Get ftTelefone
     *
     * @return string 
     */
    public function getFtTelefone()
    {
        return $this->ftTelefone;
    }
    
    /**
     * Set ftEmail
     *
     * @param string $ftEmail
     * @return TClientes
     */
    public function setFtEmail($ftEmail)
    {
        $this->ftEmail = $ftEmail;

        return $this;
    }

    /**
     * Get ftEmail
     *
     * @return string 
     */
    public function getFtEmail()
    {
        return $this->ftEmail;
    }

    /**
     * Set ftObservacao
     *
     * @param string $ftObservacao
     * @return TClientes
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
     * Set ftNomecontacto
     *
     * @param string $ftNomecontacto
     * @return TClientes
     */
    public function setFtNomecontacto($ftNomecontacto)
    {
        $this->ftNomecontacto = $ftNomecontacto;

        return $this;
    }

    /**
     * Get ftNomecontacto
     *
     * @return string 
     */
    public function getFtNomecontacto()
    {
        return $this->ftNomecontacto;
    }

    /**
     * Set ftTelefonecontacto
     *
     * @param string $ftTelefonecontacto
     * @return TClientes
     */
    public function setFtTelefonecontacto($ftTelefonecontacto)
    {
        $this->ftTelefonecontacto = $ftTelefonecontacto;

        return $this;
    }

    /**
     * Get ftTelefonecontacto
     *
     * @return string 
     */
    public function getFtTelefonecontacto()
    {
        return $this->ftTelefonecontacto;
    }

    /**
     * Set ftEmailcontacto
     *
     * @param string $ftEmailcontacto
     * @return TClientes
     */
    public function setFtEmailcontacto($ftEmailcontacto)
    {
        $this->ftEmailcontacto = $ftEmailcontacto;

        return $this;
    }

    /**
     * Get ftEmailcontacto
     *
     * @return string 
     */
    public function getFtEmailcontacto()
    {
        return $this->ftEmailcontacto;
    }
}
