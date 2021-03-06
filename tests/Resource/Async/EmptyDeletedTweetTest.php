<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter\Resource\Async;

use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;
use ApiClients\Client\Twitter\Resource\Async\EmptyDeletedTweet;

final class EmptyDeletedTweetTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Async';
    }
    public function getClass() : string
    {
        return EmptyDeletedTweet::class;
    }
}
