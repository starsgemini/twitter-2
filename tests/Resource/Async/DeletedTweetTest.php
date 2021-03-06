<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\ApiSettings;
use ApiClients\Client\Twitter\Resource\DeletedTweet;
use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;

class DeletedTweetTest extends AbstractResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Async';
    }
    public function getClass() : string
    {
        return DeletedTweet::class;
    }
    public function getNamespace() : string
    {
        return Apisettings::NAMESPACE;
    }
}
