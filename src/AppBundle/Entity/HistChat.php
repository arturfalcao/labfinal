<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistChat
 *
 * @ORM\Table(name="histchat")
 * @ORM\Entity
 */
class HistChat
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
     * @var integer
     *
     * @ORM\Column(name="id_emissor", type="bigint")
     */
    private $id_emissor; 


    /**
     * @var integer
     *
     * @ORM\Column(name="id_receptor", type="bigint")
     */
    private $id_receptor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_escrita_mensagem", type="datetime")
     */
    private $data_escrita_mensagem;


    /**
    * @var integer
    *
    * @ORM\Column(name="lida", type="integer")
    */

    private $lida;

    /**
     * @var string
     *
     * @ORM\Column(name="mensagem", type="string", length=300)
     */
    private $mensagem;



    /**
     * Set id_emissor
     *
     * @param integer $idEmissor
     * @return HistChat
     */
    public function setIdEmissor($idEmissor)
    {
        $this->id_emissor = $idEmissor;
    
        return $this;
    }

    /**
     * Get id_emissor
     *
     * @return integer 
     */
    public function getIdEmissor()
    {
        return $this->id_emissor;
    }

    /**
     * Set id_receptor
     *
     * @param integer $idReceptor
     * @return HistChat
     */
    public function setIdReceptor($idReceptor)
    {
        $this->id_receptor = $idReceptor;
    
        return $this;
    }

    /**
     * Get id_receptor
     *
     * @return integer 
     */
    public function getIdReceptor()
    {
        return $this->id_receptor;
    }

    /**
     * Set data_escrita_mensagem
     *
     * @param \DateTime $dataEscritaMensagem
     * @return HistChat
     */
    public function setDataEscritaMensagem($dataEscritaMensagem)
    {
        $this->data_escrita_mensagem = $dataEscritaMensagem;
    
        return $this;
    }

    /**
     * Get data_escrita_mensagem
     *
     * @return \DateTime 
     */
    public function getDataEscritaMensagem()
    {
        return $this->data_escrita_mensagem;
    }

    /**
     * Set lida
     *
     * @param integer $lida
     * @return HistChat
     */
    public function setLida($lida)
    {
        $this->lida = $lida;
    
        return $this;
    }

    /**
     * Get lida
     *
     * @return integer 
     */
    public function getLida()
    {
        return $this->lida;
    }

    /**
     * Set mensagem
     *
     * @param string $mensagem
     * @return HistChat
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    
        return $this;
    }

    /**
     * Get mensagem
     *
     * @return string 
     */
    public function getMensagem()
    {
        return $this->mensagem;
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
}
