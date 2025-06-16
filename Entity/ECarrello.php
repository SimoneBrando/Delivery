<?php 

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="carrello")
 */
class ECarrello
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="data_creazione")
     */
    private $dataCreazione;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\ECliente", inversedBy="carrelli")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Entity\EItemCarrello", mappedBy="carrello", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $carrelloItems;

    public function __construct()
    {

    }

    // Getter 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataCreazione(): \DateTime
    {
        return $this->dataCreazione;
    }

    public function getCliente(): ?ECliente
    {
        return $this->cliente;
    }

    public function getCarrelloItems()
    {
        return $this->carrelloItems;
    }

    // Setter
    public function setCarrello(?ECarrello $carrello): void
    {
        $this->carrello = $carrello;
    }

    public function setCliente(ECliente $cliente): this
    {
        $this->cliente = $cliente;
        return $this;
    }

    
    public function setDataCreazione(\DateTime $data): this
    {
        $this->dataCreazione = $data;
        return $this;
    }

}
