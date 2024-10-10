<?php

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

final class Dagboek extends SnelstartObject
{
    /**
     * De omschrijving van het dagboek.
     *
     * @var string
     */
    private string $omschrijving;

    /**
     * Het soort dagboek.
     *
     * @var string
     */
    private string $soort;

    /**
     * Een vlag die aangeeft of het dagboek niet meer actief is binnen de administratie.
     * Indien waar, kan het dagboek als "verwijderd" worden beschouwd.
     * @var bool
     */
    private bool $nonactief;

    /**
     * Het nummer van het dagboek.
     *
     * @var int
     */
    private int $nummer;

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getSoort(): string
    {
        return $this->soort;
    }

    public function setSoort(string $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function isNonactief(): bool
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getNummer(): int
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }
}