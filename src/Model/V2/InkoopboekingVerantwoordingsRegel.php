<?php
/**
 * @author  Koen Jesse Dekker <mail@kjdekker.com>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwSoort;

final class InkoopboekingVerantwoordingsRegel extends BaseObject
{
    /**
     * De inkoopboeking waarop deze verantwoordingsregel betrekking heeft.
     *
     * @var Inkoopboeking
     */
    private $inkoopBoeking;

    /**
     * De omschrijving van de boekingsregel.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Het kredietbedrag dat aangeeft hoeveel geld ontvangen is.
     *
     * @var Money|null
     */
    private $credit;

    /**
     * Het debetbedrag dat aangeeft hoeveel geld betaald is
     *
     * @var Money|null
     */
    private $debet;

    public static $editableAttributes = [
        "verkoopBoeking",
        "omschrijving",
        "credit",
        "debet",
    ];

    public function getVerkoopboeking(): ?Verkoopboeking
    {
        return $this->verkoopboeking;
    }

    public function setVerkoopboeking(Verkoopboeking $verkoopboeking): self
    {
        $this->verkoopboeking = $verkoopboeking;

        return $this;
    }

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
     * @return Money|null
     */
    public function getCredit(): ?Money
    {
        return $this->credit;
    }

    /**
     * @param Money|null $credit
     * @return Boekingsregel
     */
    public function setCredit(?Money $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getDebet(): ?Money
    {
        return $this->debet;
    }

    /**
     * @param Money|null $debet
     * @return Boekingsregel
     */
    public function setDebet(?Money $debet): self
    {
        $this->debet = $debet;

        return $this;
    }
}