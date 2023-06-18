<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="transactions")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tradesman")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tradesman;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    // Add getters and setters for the properties
}
