<?php

namespace Dudlewebs\WPMCS\s3\Aws\Api\ErrorParser;

use Dudlewebs\WPMCS\s3\Aws\Api\Parser\PayloadParserTrait;
use Dudlewebs\WPMCS\s3\Aws\Api\StructureShape;
use Dudlewebs\WPMCS\s3\Psr\Http\Message\ResponseInterface;
/**
 * Provides basic JSON error parsing functionality.
 */
trait JsonParserTrait
{
    use PayloadParserTrait;
    private function genericHandler(ResponseInterface $response)
    {
        $code = (string) $response->getStatusCode();
        return ['request_id' => (string) $response->getHeaderLine('x-amzn-requestid'), 'code' => null, 'message' => null, 'type' => $code[0] == '4' ? 'client' : 'server', 'parsed' => $this->parseJson($response->getBody(), $response)];
    }
    protected function payload(ResponseInterface $response, StructureShape $member)
    {
        $jsonBody = $this->parseJson($response->getBody(), $response);
        if ($jsonBody) {
            return $this->parser->parse($member, $jsonBody);
        }
    }
}
