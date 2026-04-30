<?php
/**
 * @author  Koen Jesse Dekker <mail@kjdekker.com>
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
     * @var InkoopboekingVerantwoordingsRegel[]
     */
    private $inkoopboekingBoekingsRegels = [];

    /**
     * Verkoopboeking boekingsregels die bij deze bankboeking horen.
     *
     * @var VerkoopboekingVerantwoordingsRegel[]
     */
    private $verkoopboekingBoekingsRegels = [];

    /**
     * BTW boekingsregels die bij deze bankboeking horen.
     *
     * @var BtwBoekingRegel[]
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

    /**
     * @param \DateTimeInterface $datum
     * @return $this
     */
    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDatum(): \DateTimeInterface
    {
        return $this->datum;
    }

    /**
     * @return Relatie|null
     */
    public function getKlant(): ?Relatie
    {
        return $this->klant;
    }

    /**
     * @param Relatie $klant
     * @return $this
     */
    public function setKlant(Relatie $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    /**
     * @return GrootboekBoekingsregel[]
     */
    public function getGrootboekBoekingsRegels(): array
    {
        return $this->grootboekBoekingsRegels;
    }

    /**
     * @param GrootboekBoekingsregel ...$grootboekBoekingsRegels
     * @return $this
     */
    public function setGrootboekBoekingsRegels(GrootboekBoekingsregel ...$grootboekBoekingsRegels): self
    {
        $this->grootboekBoekingsRegels = $grootboekBoekingsRegels;

        return $this;
    }

    /**
     * @return InkoopboekingVerantwoordingsRegel[]
     */
    public function getInkoopboekingVerantwoordingsRegels(): array
    {
        return $this->inkoopboekingBoekingsRegels;
    }

    /**
     * @param InkoopboekingVerantwoordingsRegel ...$inkoopboekingVerantwoordingsRegels
     * @return $this
     */
    public function setInkoopboekingVerantwoordingsRegels(InkoopboekingVerantwoordingsRegel ...$inkoopboekingVerantwoordingsRegels): self
    {
        $this->inkoopboekingBoekingsRegels = $inkoopboekingVerantwoordingsRegels;

        return $this;
    }

    /**
     * @return InkoopboekingVerantwoordingsRegel[]
     */
    public function getInkoopboekingBoekingsRegels(): array
    {
        return $this->inkoopboekingBoekingsRegels;
    }

    /**
     * @param InkoopboekingVerantwoordingsRegel ...$inkoopboekingBoekingsRegels
     * @return $this
     */
    public function setInkoopboekingBoekingsRegels(InkoopboekingVerantwoordingsRegel ...$inkoopboekingBoekingsRegels): self
    {
        $this->inkoopboekingBoekingsRegels = $inkoopboekingBoekingsRegels;

        return $this;
    }

    /**
     * @return VerkoopboekingVerantwoordingsRegel[]
     */
    public function getVerkoopboekingVerantwoordingsRegels(): array
    {
        return $this->verkoopboekingBoekingsRegels;
    }

    /**
     * @param VerkoopboekingVerantwoordingsRegel ...$verkoopboekingVerantwoordingsRegels
     * @return $this
     */
    public function setVerkoopboekingVerantwoordingsRegels(VerkoopboekingVerantwoordingsRegel ...$verkoopboekingVerantwoordingsRegels): self
    {
        $this->verkoopboekingBoekingsRegels = $verkoopboekingVerantwoordingsRegels;

        return $this;
    }

    /**
     * @return VerkoopboekingVerantwoordingsRegel[]
     */
    public function getVerkoopboekingBoekingsRegels(): array
    {
        return $this->verkoopboekingBoekingsRegels;
    }

    /**
     * @param VerkoopboekingVerantwoordingsRegel ...$verkoopboekingBoekingsRegels
     * @return $this
     */
    public function setVerkoopboekingBoekingsRegels(VerkoopboekingVerantwoordingsRegel ...$verkoopboekingBoekingsRegels): self
    {
        $this->verkoopboekingBoekingsRegels = $verkoopboekingBoekingsRegels;

        return $this;
    }

    /**
     * @return BtwBoekingRegel[]
     */
    public function getBtwBoekingsRegels(): array
    {
        return $this->btwBoekingsRegels;
    }

    /**
     * @param BtwBoekingRegel ...$btwBoekingsRegels
     * @return $this
     */
    public function setBtwBoekingsRegels(BtwBoekingRegel ...$btwBoekingsRegels): self
    {
        $this->btwBoekingsRegels = $btwBoekingsRegels;

        return $this;
    }

    /**
     * @return Money
     */
    public function getBedragUitgegeven(): Money
    {
        return $this->bedragUitgegeven;
    }

    /**
     * @param Money $bedragUitgegeven
     * @return $this
     */
    public function setBedragUitgegeven(Money $bedragUitgegeven): self
    {
        $this->bedragUitgegeven = $bedragUitgegeven;

        return $this;
    }

    /**
     * @return Money
     */
    public function getBedragOntvangen(): Money
    {
        return $this->bedragOntvangen;
    }

    /**
     * @param Money $bedragOntvangen
     * @return $this
     */
    public function setBedragOntvangen(Money $bedragOntvangen): self
    {
        $this->bedragOntvangen = $bedragOntvangen;

        return $this;
    }

    /**
     * @return Dagboek|null
     */
    public function getDagboek(): ?Dagboek
    {
        return $this->dagboek;
    }

    /**
     * @param Dagboek|null $dagboek
     * @return $this
     */
    public function setDagboek(?Dagboek $dagboek): self
    {
        $this->dagboek = $dagboek;

        return $this;
    }


}
