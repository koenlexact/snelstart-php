<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwSoort;

final class GrootboekBoekingsregel extends BaseObject
{
    /**
     * De omschrijving van de boekingsregel.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * De grootboekrekening waarop de mutatie (omzet) wordt geboekt.
     *
     * @var Grootboek
     */
    private $grootboek;

    /**
     * De kostenplaats waarop deze mutatie (omzet) is geregistreerd.
     *
     * @var Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * Het kredietbedrag dat aangeeft hoeveel geld ontvangen is.
     *
     * @var Money
     */
    private $credit;

    /**
     * Het debetbedrag dat aangeeft hoeveel geld betaald is
     *
     * @var Money
     */
    private $debet;

    /**
     * Mag leeg worden gelaten of met de juiste waarde worden ingevuld behalve als de grootboek een
     * grootboekfunctie 30 (Inkopen kosten alle btwtarieven) of 34 (inkopen vraagposten) heeft.
     *
     * @var BtwSoort
     */
    private $btwSoort;

    public static $editableAttributes = [
        "omschrijving",
        "grootboek",
        "kostenplaats",
        "credit",
        "debet",
        "btwSoort",
    ];

    /**
     * @return string
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     * @return Boekingsregel
     */
    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return Grootboek
     */
    public function getGrootboek(): Grootboek
    {
        return $this->grootboek;
    }

    /**
     * @param Grootboek $grootboek
     * @return Boekingsregel
     */
    public function setGrootboek(Grootboek $grootboek): self
    {
        $this->grootboek = $grootboek;

        return $this;
    }

    /**
     * @return Kostenplaats
     */
    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    /**
     * @param Kostenplaats $kostenplaats
     * @return Boekingsregel
     */
    public function setKostenplaats(Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return Money
     */
    public function getCredit(): Money
    {
        return $this->credit;
    }

    /**
     * @param Money $credit
     * @return Boekingsregel
     */
    public function setCredit(Money $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @return Money
     */
    public function getDebet(): Money
    {
        return $this->debet;
    }

    /**
     * @param Money $debet
     * @return Boekingsregel
     */
    public function setDebet(Money $debet): self
    {
        $this->debet = $debet;

        return $this;
    }

    /**
     * @return BtwSoort
     */
    public function getBtwSoort(): BtwSoort
    {
        return $this->btwSoort;
    }

    /**
     * @param BtwSoort $btwSoort
     * @return Boekingsregel
     */
    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }
}