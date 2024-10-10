<?php

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwRegelTarief;
use SnelstartPHP\Model\Type\BtwRegelType;
use SnelstartPHP\Model\Type\BtwSoort;

final class BtwBoekingRegel extends BaseObject
{
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

    /**
     * Mag leeg worden gelaten of met de juiste waarde worden ingevuld behalve als de grootboek een
     * grootboekfunctie 30 (Inkopen kosten alle btwtarieven) of 34 (inkopen vraagposten) heeft.
     *
     * @var BtwSoort
     */
    private BtwRegelType $type;

    /**
     * Tarief van de BTW.
     *
     * @ var string
     */
    private BtwSoort $tarief;

    public static $editableAttributes = [
        "credit",
        "debet",
        "type",
        "tarief",
    ];

    public function getCredit(): ?Money
    {
        return $this->credit;
    }

    public function getDebet(): ?Money
    {
        return $this->debet;
    }

    public function getType(): ?BtwRegelType
    {
        return $this->type;
    }

    public function getTarief(): ?BtwSoort
    {
        return $this->tarief;
    }

    public function setCredit(?Money $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function setDebet(?Money $debet): self
    {
        $this->debet = $debet;

        return $this;
    }

    public function setType(BtwRegelType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setTarief(BtwSoort $tarief): self
    {
        $this->tarief = $tarief;

        return $this;
    }
}