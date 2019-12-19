<?php

namespace App\Api\V1\Handler;

use Tomaj\NetteApi\Handlers\BaseHandler;
use Tomaj\NetteApi\Params\InputParam;
use Tomaj\NetteApi\Response\JsonApiResponse;

class TestHandler extends BaseHandler
{
    public function params(): array
    {
        return [
            new InputParam(InputParam::TYPE_GET, 'get_param', InputParam::REQUIRED),
            new InputParam(InputParam::TYPE_POST, 'post_param', InputParam::OPTIONAL, null, true),
        ];
    }

    public function handle($params)
    {
        return new JsonApiResponse(200, $params);
    }
}
