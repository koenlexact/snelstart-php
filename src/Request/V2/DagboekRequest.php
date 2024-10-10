<?php

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Utils;

final class DagboekRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "dagboeken?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "dagboeken/" . $id->toString());
    }
}