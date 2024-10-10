<?php
/**
 * @author  Koen Jesse Dekker <mail@kjdekker.com>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use function \array_map;
use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2 as Model;

final class DagboekMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): Model\Dagboek
    {
        $this->setResponseData($response);
        return $this->mapResultToDagboekModel(new Model\Dagboek());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers();
    }

    protected function mapResultToDagboekModel(Model\Dagboek $dagboek, array $data = []): Model\Dagboek
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Dagboek $dagboek
         */
        $dagboek = $this->mapArrayDataToModel($dagboek, $data);

        return $dagboek;
    }

    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $dagboekData) {
            yield $this->mapResultToDagboekModel(new Model\Dagboek(), $dagboekData);
        }
    }
}