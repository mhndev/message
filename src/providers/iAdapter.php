<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/9/16
 * Time: 4:05 PM
 */
namespace mhndev\message\providers;

interface iAdapter
{
    public function send($recipient, $message, $sender = '', array $options = []);

    public function getSmsLines();
}
