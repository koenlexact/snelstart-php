<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;

final class Bankboeking extends Boeking
{
    /**
     * De klant/debiteur aan wie de factuur is gericht.
     *
     * @var Relatie|null
     */
    private $klant;

    /**
     * Grootboek boekingsregels die bij deze bankboeking horen.
     *
     * @var GrootboekBoekingsregel[]
     */
    private $grootboekBoekingsRegels = [];

    /**
     * Inkoopboeking boekingsregels die bij deze bankboeking horen.
     *
     * @var Boekingsregel[]
     */
    private $inkoopboekingBoekingsRegels = [];

    /**
     * Verkoopboeking boekingsregels die bij deze bankboeking horen.
     *
     * @var Boekingsregel[]
     */
    private $verkoopboekingBoekingsRegels = [];

    /**
     * BTW boekingsregels die bij deze bankboeking horen.
     *
     * @var Boekingsregel[]
     */
    private $btwBoekingsRegels = [];

    /**
     * Het bedrag dat is uitgegeven.
     *
     * @var Money
     */
    private $bedragUitgegeven;

    /**
     * Het bedrag dat is ontvangen.
     *
     * @var Money
     */
    private $bedragOntvangen;

    /**
     * Het dagboek waarin de bankboeking is geboekt.
     *
     * @var Dagboek|null
     */
    private $dagboek;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "datum",
        "klant",
        "grootboekBoekingsRegels",
        "inkoopboekingBoekingsRegels",
        "verkoopboekingBoekingsRegels",
        "btwBoekingsRegels",
        "bedragUitgegeven",
        "bedragOntvangen",
        "dagboek",
    ];

    public static function getEditableAttributes(): array
    {
        return \array_unique(
            \array_merge(parent::$editableAttributes, parent::getEditableAttributes(), static::$editableAttributes, self::$editableAttributes)
        );
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getDatum(): \DateTimeInterface
    {
        return $this->datum;
    }

    public function getKlant(): ?Relatie
    {
        return $this->klant;
    }

    public function setKlant(Relatie $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getGrootboekBoekingsRegels(): array
    {
        return $this->grootboekBoekingsRegels;
    }

    public function setGrootboekBoekingsRegels(array $grootboekBoekingsRegels): self
    {
        $this->grootboekBoekingsRegels = $grootboekBoekingsRegels;

        return $this;
    }

    public function getInkoopboekingBoekingsRegels(): array
    {
        return $this->inkoopboekingBoekingsRegels;
    }

    public function setInkoopboekingBoekingsRegels(array $inkoopboekingBoekingsRegels): self
    {
        $this->inkoopboekingBoekingsRegels = $inkoopboekingBoekingsRegels;

        return $this;
    }

    public function getVerkoopboekingBoekingsRegels(): array
    {
        return $this->verkoopboekingBoekingsRegels;
    }

    public function setVerkoopboekingBoekingsRegels(array $verkoopboekingBoekingsRegels): self
    {
        $this->verkoopboekingBoekingsRegels = $verkoopboekingBoekingsRegels;

        return $this;
    }

    public function getBtwBoekingsRegels(): array
    {
        return $this->btwBoekingsRegels;
    }

    public function setBtwBoekingsRegels(array $btwBoekingsRegels): self
    {
        $this->btwBoekingsRegels = $btwBoekingsRegels;

        return $this;
    }

    public function getBedragUitgegeven(): Money
    {
        return $this->bedragUitgegeven;
    }

    public function setBedragUitgegeven(Money $bedragUitgegeven): self
    {
        $this->bedragUitgegeven = $bedragUitgegeven;

        return $this;
    }

    public function getBedragOntvangen(): Money
    {
        return $this->bedragOntvangen;
    }

    public function setBedragOntvangen(Money $bedragOntvangen): self
    {
        $this->bedragOntvangen = $bedragOntvangen;

        return $this;
    }

    public function getDagboek(): ?Dagboek
    {
        return $this->dagboek;
    }

    public function setDagboek(?Dagboek $dagboek): self
    {
        $this->dagboek = $dagboek;

        return $this;
    }


}