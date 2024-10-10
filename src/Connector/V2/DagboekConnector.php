<?php

namespace SnelstartPHP\Connector\V2;

use AppendIterator;
use Iterator;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2 as Request;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class DagboekConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Model\Dagboek
    {
        try {
            $mapper = new Mapper\DagboekMapper();
            $request = new Request\DagboekRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return iterable<Model\Dagboek>
     */
    public function findAll(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null): iterable
    {
        $mapper = new Mapper\DagboekMapper();
        $request = new Request\DagboekRequest();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $hasItems = false;

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData))) as $Dagboek) {
            $hasItems = true;
            yield $Dagboek;
        }

        if ($fetchAll && $hasItems) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            yield from $this->findAll($ODataRequestData, true, []);
        }
    }

    public function findByNumber(string $number): ?Model\Dagboek
    {
        $criteria = (new ODataRequestData())->setFilter([
            sprintf("Nummer eq %s", $number)
        ]);

        $mapper = new Mapper\DagboekMapper();
        $request = new Request\DagboekRequest();

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($criteria))) as $Dagboek) {
            return $Dagboek;
        }

        return null;
    }
}