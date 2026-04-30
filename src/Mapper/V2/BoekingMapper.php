<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V2;

use DateTimeImmutable;
use function array_map;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Model\Type as Type;

final class BoekingMapper extends AbstractMapper
{
    public function findBankboeking(ResponseInterface $response): Model\Bankboeking
    {
        $this->setResponseData($response);
        return $this->mapBankboekingResult(new Model\Bankboeking());
    }

    public function findInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public function findVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    public function findAllBankboekingen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers(Model\Bankboeking::class);
    }

    public function findAllInkoopboekingen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers(Model\Inkoopboeking::class);
    }

    public function findAllInkoopfacturen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Model\Inkoopfactuur::class);
    }

    public function findAllVerkoopboekingen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers(Model\Verkoopboeking::class);
    }

    public function findAllVerkoopfacturen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Model\Verkoopfactuur::class);
    }

    public function addBankboeking(ResponseInterface $response): Model\Bankboeking
    {
        $this->setResponseData($response);
        return $this->mapBankboekingResult(new Model\Bankboeking());
    }

    public function updateBankboeking(ResponseInterface $response): Model\Bankboeking
    {
        $this->setResponseData($response);
        return $this->mapBankboekingResult(new Model\Bankboeking());
    }

    protected function mapBankboekingResult(Model\Bankboeking $bankboeking, array $data = []): Model\Bankboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Bankboeking $bankboeking
         */
        $bankboeking = $this->mapBoekingResult($bankboeking, $data);

        if (isset($data['datum'])) {
            $bankboeking->setDatum(new DateTimeImmutable($data['datum']));
        }

        if (isset($data['klant']['id'])) {
            $bankboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data['klant']['id'])));
        }

        if (isset($data['dagboek']['id'])) {
            $bankboeking->setDagboek(Model\Dagboek::createFromUUID(Uuid::fromString($data['dagboek']['id'])));
        }

        if (isset($data['bedragUitgegeven'])) {
            $bankboeking->setBedragUitgegeven($this->getMoney($data['bedragUitgegeven']));
        }

        if (isset($data['bedragOntvangen'])) {
            $bankboeking->setBedragOntvangen($this->getMoney($data['bedragOntvangen']));
        }

        if (isset($data['grootboekBoekingsRegels'])) {
            $bankboeking->setGrootboekBoekingsRegels(...array_map(function(array $boekingsregel): Model\GrootboekBoekingsregel {
                $boekingsregelObject = new Model\GrootboekBoekingsregel();

                if (isset($boekingsregel['omschrijving'])) {
                    $boekingsregelObject->setOmschrijving($boekingsregel['omschrijving']);
                }

                if (isset($boekingsregel['grootboek']['id'])) {
                    $boekingsregelObject->setGrootboek(Model\Grootboek::createFromUUID(Uuid::fromString($boekingsregel['grootboek']['id'])));
                }

                if (isset($boekingsregel['kostenplaats']['id'])) {
                    $boekingsregelObject->setKostenplaats(Kostenplaats::createFromUUID(Uuid::fromString($boekingsregel['kostenplaats']['id'])));
                }

                if (array_key_exists('debet', $boekingsregel)) {
                    $boekingsregelObject->setDebet($this->getMoney((string) $boekingsregel['debet']));
                }

                if (array_key_exists('credit', $boekingsregel)) {
                    $boekingsregelObject->setCredit($this->getMoney((string) $boekingsregel['credit']));
                }

                if (isset($boekingsregel['btwSoort'])) {
                    $boekingsregelObject->setBtwSoort(new Type\BtwSoort($boekingsregel['btwSoort']));
                }

                return $boekingsregelObject;
            }, $data['grootboekBoekingsRegels']));
        }

        if (isset($data['verkoopboekingBoekingsRegels'])) {
            $bankboeking->setVerkoopboekingBoekingsRegels(...array_map(function(array $boekingsregel): Model\VerkoopboekingVerantwoordingsRegel {
                $boekingsregelObject = new Model\VerkoopboekingVerantwoordingsRegel();

                if (isset($boekingsregel['boekingId']['id'])) {
                    $boekingsregelObject->setBoekingId(Model\Verkoopboeking::createFromUUID(Uuid::fromString($boekingsregel['boekingId']['id'])));
                }

                if (array_key_exists('omschrijving', $boekingsregel) && $boekingsregel['omschrijving'] !== null) {
                    $boekingsregelObject->setOmschrijving($boekingsregel['omschrijving']);
                }

                if (array_key_exists('debet', $boekingsregel)) {
                    $boekingsregelObject->setDebet($this->getMoney((string) $boekingsregel['debet']));
                }

                if (array_key_exists('credit', $boekingsregel)) {
                    $boekingsregelObject->setCredit($this->getMoney((string) $boekingsregel['credit']));
                }

                return $boekingsregelObject;
            }, $data['verkoopboekingBoekingsRegels']));
        }

        if (isset($data['inkoopboekingBoekingsRegels'])) {
            $bankboeking->setInkoopboekingBoekingsRegels(...array_map(function(array $boekingsregel): Model\InkoopboekingVerantwoordingsRegel {
                $boekingsregelObject = new Model\InkoopboekingVerantwoordingsRegel();

                if (isset($boekingsregel['boekingId']['id'])) {
                    $boekingsregelObject->setBoekingId(Model\Inkoopboeking::createFromUUID(Uuid::fromString($boekingsregel['boekingId']['id'])));
                }

                if (array_key_exists('omschrijving', $boekingsregel) && $boekingsregel['omschrijving'] !== null) {
                    $boekingsregelObject->setOmschrijving($boekingsregel['omschrijving']);
                }

                if (array_key_exists('debet', $boekingsregel)) {
                    $boekingsregelObject->setDebet($this->getMoney((string) $boekingsregel['debet']));
                }

                if (array_key_exists('credit', $boekingsregel)) {
                    $boekingsregelObject->setCredit($this->getMoney((string) $boekingsregel['credit']));
                }

                return $boekingsregelObject;
            }, $data['inkoopboekingBoekingsRegels']));
        }

        return $bankboeking;
    }

    public function addInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public function updateInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public function updateVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    public function addVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    protected function mapDocumentResult(array $data = []): Model\Document
    {
        $data = empty($data) ? $this->responseData : $data;
        return $this->mapArrayDataToModel(new Model\Document(), $data);
    }

    protected function mapInkoopboekingResult(Model\Inkoopboeking $inkoopboeking, array $data = []): Model\Inkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Inkoopboeking $inkoopboeking
         */
        $inkoopboeking = $this->mapBoekingResult($inkoopboeking, $data);

        if (isset($data["leverancier"])) {
            $inkoopboeking->setLeverancier(Model\Relatie::createFromUUID(Uuid::fromString($data["leverancier"]["id"])));
        }

        return $inkoopboeking;
    }

    protected function mapVerkoopboekingResult(Model\Verkoopboeking $verkoopboeking, array $data = []): Model\Verkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Verkoopboeking $verkoopboeking
         */
        $verkoopboeking = $this->mapBoekingResult($verkoopboeking, $data);

        if (isset($data["klant"])) {
            $verkoopboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        } else if (isset($data["relatie"])) {
            $verkoopboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])));
        }

        if (isset($data["doorlopendeIncassoMachtiging"]["id"])) {
            $doorlopendeIncassoMachtiging = IncassoMachtiging::createFromUUID(Uuid::fromString($data["doorlopendeIncassoMachtiging"]["id"]));
            $verkoopboeking->setDoorlopendeIncassoMachtiging($doorlopendeIncassoMachtiging);
        }

        if (isset($data["eenmaligeIncassoMachtiging"]["datum"])) {
            $incassomachtiging = (new IncassoMachtiging())
                ->setDatum(new \DateTimeImmutable($data["eenmaligeIncassoMachtiging"]["datum"]));

            if ($data["eenmaligeIncassoMachtiging"]["kenmerk"] !== null) {
                $incassomachtiging->setKenmerk($data["eenmaligeIncassoMachtiging"]["kenmerk"]);
            }

            if (isset($data["eenmaligeIncassoMachtiging"]["omschrijving"])) {
                $incassomachtiging->setOmschrijving($data["eenmaligeIncassoMachtiging"]["omschrijving"]);
            }

            $verkoopboeking->setEenmaligeIncassoMachtiging($incassomachtiging);
        }

        return $verkoopboeking;
    }

    protected function mapVerkoopfactuurResult(Model\Verkoopfactuur $verkoopfactuur, array $data = []): Model\Verkoopfactuur
    {
        $data = empty($data) ? $this->responseData : $data;

        // This maps "id", "uri", "modifiedOn" and "factuurnummer".
        $verkoopfactuur = $this->mapArrayDataToModel($verkoopfactuur, $data);

        if (isset($data['relatie'])) {
            $verkoopfactuur->setRelatie(Model\Relatie::createFromUUID(Uuid::fromString($data['relatie']['id'])));
        }
        if (isset($data['verkoopBoeking'])) {
            $verkoopfactuur->setVerkoopBoeking(Model\Verkoopboeking::createFromUUID(Uuid::fromString($data['verkoopBoeking']['id'])));
        }

        if (isset($data['factuurDatum'])) {
            $verkoopfactuur->setFactuurDatum(new DateTimeImmutable($data['factuurDatum']));
        }
        if (isset($data['factuurBedrag'])) {
            $verkoopfactuur->setFactuurBedrag($this->getMoney($data['factuurBedrag']));
        }
        if (isset($data['openstaandSaldo'])) {
            $verkoopfactuur->setOpenstaandSaldo($this->getMoney($data['openstaandSaldo']));
        }
        if (isset($data['vervalDatum'])) {
            $verkoopfactuur->setVervalDatum(new DateTimeImmutable($data['vervalDatum']));
        }

        return $verkoopfactuur;
    }

    protected function mapInkoopfactuurResult(Model\Inkoopfactuur $inkoopfactuur, array $data = []): Model\Inkoopfactuur
    {
        $data = empty($data) ? $this->responseData : $data;

        // This maps "id", "uri", "modifiedOn" and "factuurnummer".
        $inkoopfactuur = $this->mapArrayDataToModel($inkoopfactuur, $data);

        if (isset($data['relatie'])) {
            $inkoopfactuur->setRelatie(Model\Relatie::createFromUUID(Uuid::fromString($data['relatie']['id'])));
        }
        if (isset($data['inkoopBoeking'])) {
            $inkoopfactuur->setInkoopboeking(Model\Inkoopboeking::createFromUUID(Uuid::fromString($data['inkoopBoeking']['id'])));
        }

        if (isset($data['factuurDatum'])) {
            $inkoopfactuur->setFactuurDatum(new DateTimeImmutable($data['factuurDatum']));
        }
        if (isset($data['factuurBedrag'])) {
            $inkoopfactuur->setFactuurBedrag($this->getMoney($data['factuurBedrag']));
        }
        if (isset($data['openstaandSaldo'])) {
            $inkoopfactuur->setOpenstaandSaldo($this->getMoney($data['openstaandSaldo']));
        }
        if (isset($data['vervalDatum'])) {
            $inkoopfactuur->setVervalDatum(new DateTimeImmutable($data['vervalDatum']));
        }

        return $inkoopfactuur;
    }

    protected function mapBoekingResult(Model\Boeking $boeking, array $data = []): Model\Boeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Boeking $boeking
         */
        $boeking = $this->mapArrayDataToModel($boeking, $data);

        if (isset($data["modifiedOn"])) {
            $boeking->setModifiedOn(new \DateTimeImmutable($data["modifiedOn"]));
        }

        if (isset($data["factuurDatum"])) {
            $boeking->setFactuurdatum(new \DateTimeImmutable($data["factuurDatum"]));
        }

        if (isset($data["vervalDatum"])) {
            $boeking->setVervaldatum(new \DateTimeImmutable($data["vervalDatum"]));
        }

        if (isset($data["factuurBedrag"])) {
            $boeking->setFactuurbedrag($this->getMoney($data["factuurBedrag"]));
        }

        if (isset($data["boekingsregels"])) {
            $boeking->setBoekingsregels(...array_map(function(array $boekingsregel): Model\Boekingsregel {
                $boekingsregelObject = (new Model\Boekingsregel())
                    ->setBedrag($this->getMoney($boekingsregel["bedrag"]))
                    ->setBtwSoort(new Type\BtwSoort($boekingsregel["btwSoort"]));

                if (isset($boekingsregel["omschrijving"])) {
                    $boekingsregelObject->setOmschrijving($boekingsregel["omschrijving"]);
                }

                if (isset($boekingsregel["grootboek"])) {
                    $boekingsregelObject
                        ->setGrootboek(Model\Grootboek::createFromUUID(Uuid::fromString($boekingsregel["grootboek"]["id"])));
                }

                if (isset($boekingsregel["kostenplaats"])) {
                    $boekingsregelObject->setKostenplaats(
                        Kostenplaats::createFromUUID(Uuid::fromString($boekingsregel["kostenplaats"]["id"]))
                    );
                }

                return $boekingsregelObject;
            }, $data["boekingsregels"]));
        }

        if (isset($data["btw"])) {
            $boeking->setBtw(...array_map(function(array $btw): Model\Btwregel {
                return new Model\Btwregel(
                    new Type\BtwRegelSoort($btw["btwSoort"]),
                    $this->getMoney($btw["btwBedrag"])
                );
            }, $data["btw"]));
        }

        if (isset($data["documents"])) {
            foreach ($data["documents"] as $document) {
                $boeking->addDocument($this->mapDocumentResult($document));
            }

        }

        return $boeking;
    }

    public function mapManyResultsToSubMappers(string $className): \Generator
    {
        foreach ($this->responseData as $boekingData) {
            if ($className === Model\Inkoopboeking::class) {
                yield $this->mapInkoopboekingResult(new $className, $boekingData);
            } else if ($className === Model\Verkoopboeking::class) {
                yield $this->mapVerkoopboekingResult(new $className, $boekingData);
            } else if ($className === Model\Verkoopfactuur::class) {
                yield $this->mapVerkoopfactuurResult(new $className, $boekingData);
            } else if ($className === Model\Inkoopfactuur::class) {
                yield $this->mapInkoopfactuurResult(new $className, $boekingData);
            }
        }
    }
}
