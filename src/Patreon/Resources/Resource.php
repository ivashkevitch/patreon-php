<?php declare(strict_types=1);

namespace Squid\Patreon\Resources;

use Squid\Patreon\Api\Client;
use Squid\Patreon\Entities\Entity;
use Squid\Patreon\Entities\User;
use Squid\Patreon\Hydrator\EntityHydrator;
use WoohooLabs\Yang\JsonApi\Response\JsonApiResponse;

abstract class Resource
{
    /**
    * Map Resources to Entities.
    *
    * @var array
    */
    const ENTITY_MAP = [
        'user' => User::class,
    ];

    /**
     * Constructs a new Resource.
     *
     * @param \Squid\Patreon\Api\Client $client Patreon API Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Hydrate a JSON API Response
     *
     * @param \WoohooLabs\Yang\JsonApi\Response\JsonApiResponse $response Response
     *
     * @return \Squid\Patreon\Entities\Entity
     */
    protected function hydrateJsonApiResponse(JsonApiResponse $response): Entity
    {
        $hydrator = new EntityHydrator($response->document(), self::ENTITY_MAP);

        return $hydrator->hydrate();
    }
}