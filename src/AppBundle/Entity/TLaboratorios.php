<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TLaboratorios
 *
 * @ORM\Table(name="t_laboratorios", uniqueConstraints={@ORM\UniqueConstraint(name="IX_t_laboratorios_nrcontribuinte", columns={"ft_nclaboratorio"}), @ORM\UniqueConstraint(name="IX_t_laboratorios_nome", columns={"ft_nome"}), @ORM\UniqueConstraint(name="IX_t_laboratorios_codigo", columns={"ft_codigo"})})
 * @ORM\Entity
 */
class TLaboratorios
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
     * @ORM\Column(name="ft_nclaboratorio", type="string", length=12, nullable=false)
     */
    private $ftNclaboratorio;

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
     * @ORM\Column(name="ft_email", type="string", length=100, nullable=false)
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


    public function __toString()
    {
        return $this->ftNome;
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
     * Set ftNclaboratorio
     *
     * @param string $ftNclaboratorio
     * @return TLaboratorios
     */
    public function setFtNclaboratorio($ftNclaboratorio)
    {
        $this->ftNclaboratorio = $ftNclaboratorio;

        return $this;
    }

    /**
     * Get ftNclaboratorio
     *
     * @return string 
     */
    public function getFtNclaboratorio()
    {
        return $this->ftNclaboratorio;
    }

    /**
     * Set ftCodigo
     *
     * @param string $ftCodigo
     * @return TLaboratorios
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
     * @return TLaboratorios
     */
    public function setFtNome($ftNome)
    {
        $this->ftNome = $ftNome;

        return $this;
    }

    /**
     * Get ftNome
     *
     * @return string 
     */
    public function getFtNome()
    {
        return $this->ftNome;
    }

    /**
     * Set ftAlias
     *
     * @param string $ftAlias
     * @return TLaboratorios
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
     * Set ftMorada
     *
     * @param string $ftMorada
     * @return TLaboratorios
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
        return $this->ftMorada;
    }

    /**
     * Set ftCodpostal
     *
     * @param string $ftCodpostal
     * @return TLaboratorios
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
     * @return TLaboratorios
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
        return $this->ftLocalidade;
    }

    /**
     * Set ftPais
     *
     * @param string $ftPais
     * @return TLaboratorios
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
        return $this->ftPais;
    }

    /**
     * Set ftTelefone
     *
     * @param string $ftTelefone
     * @return TLaboratorios
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
     * @return TLaboratorios
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
     * @return TLaboratorios
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
     * @return TLaboratorios
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
     * @return TLaboratorios
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
     * @return TLaboratorios
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
