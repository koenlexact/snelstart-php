<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\V2\VerkooporderMapper;
use SnelstartPHP\Model\V2\Verkooporder;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2\VerkooporderRequest;

final class VerkooporderConnector extends BaseConnector
{
    public function add(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        return $verkooporderMapper->add($this->connection->doRequest($verkooporderRequest->add($verkooporder)));
    }

    public function delete(Verkooporder $verkooporder): void
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        $verkooporderMapper->delete($this->connection->doRequest($verkooporderRequest->delete($verkooporder)));
    }

    public function update(Verkooporder $order): Verkooporder
    {
        if ($order->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        return $verkooporderMapper->map($this->connection->doRequest($verkooporderRequest->update($order)));
    }

    public function findAll(ODataRequestData $data): iterable
    {
        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        return $verkooporderMapper->map($this->connection->doRequest($verkooporderRequest->findAll($data)));
    }
}