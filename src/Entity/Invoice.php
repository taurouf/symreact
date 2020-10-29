<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(
 * denormalizationContext={"disable_type_enforcement"=true},
 * attributes={
 *     "pagination_enabled"=true
 * }
 * )
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message = "le montant de la facture est obligatoire")
     * @Assert\Type(type="numeric", message = "le montant de la facture doit etre numerique !")
     *
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime(message= "le format de la date doit etre au format YYYY-MM-DD")
     * @Assert\NotBlank(message = "la date d'envoi doit être renseigné")
     */
    private $sentAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "le status de la facture est obligatoire")
     * @Assert\Choice(choices={"SENT", "PAID", "CANCELLED"}, message= "le status doit être sent paid ou cancelled")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message = "le client de la facture doit etre renseigné")
     */
    private $customer;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "il faut absolument un chrono pour la facture")
     * @Assert\Type(type="integer", message = "le chrono doit etre un nombre !")
     */
    private $chrono;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono($chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }
}
