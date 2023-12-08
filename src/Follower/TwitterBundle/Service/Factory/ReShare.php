<?php
/**
 * Created by PhpStorm.
 * User: hursit_topal
 * Date: 12/11/16
 * Time: 01:04
 */

namespace Follower\TwitterBundle\Service\Factory;

use Follower\CoreBundle\Interfaces\FollowInterface;
use Follower\TwitterBundle\Parser\ProfileParser;
use Follower\TwitterBundle\Service\AbstractService;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReShare extends AbstractService
{
    CONST HEADER_BLOCKED= '429 Too Many Requests';

    public function share($itemId, $extras = [])
{
        $formData = array(
            'authenticity_token' => $this->getCookieJar()->get('auth_token')->getValue(),
            'id' => $itemId,
            'tweet_stat_count' => $extras['tweet_share_stat_count']
        );

        $this->client->setHeader('accept', 'application/json, text/javascript, */*; q=0.01');
        $this->client->setHeader('accept-encoding', 'gzip, deflate, br');
        $this->client->setHeader('accept-language', 'en-US,en;q=0.8,tr;q=0.6');
        $this->client->setHeader('content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
//        $this->client->setHeader('referer', $referer);
        $this->client->setHeader('user-agent', $this->getUserAgent());
        $this->client->setHeader('x-requested-with', 'XMLHttpRequest');

        $this->client->request('POST',$this->getReShareUrl(), $formData, array(), array(
            'HTTP_USER_AGENT' => $this->getUserAgent()
        ));

        /** @var Response $response */
        $response = $this->client->getResponse();

        if($response->getHeader('status') === self::HEADER_BLOCKED)
            throw new BadRequestHttpException(self::HEADER_BLOCKED);

        if($response->getStatus() != 200)
            throw new BadRequestHttpException(
                'Invalid response code: ' . $response->getStatus() . ', headers: ' . json_encode($response->getHeaders())
            );

        return true;
    }
}