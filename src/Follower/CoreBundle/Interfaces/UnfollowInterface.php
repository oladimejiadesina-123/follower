<?php

namespace Follower\CoreBundle\Interfaces;

/**
 * Created by PhpStorm.
 * User: hursit_topal
 * Date: 12/11/16
 * Time: 01:32
 */
interface UnfollowInterface
{
    public function unfollow($userId);
}