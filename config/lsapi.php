<?php

/**
* @author    @code4mk <hiremostafa@gmail.com>
* @author    @0devco <with@0dev.co>
* @since     2019
* @copyright 0dev.co (https://0dev.co)
*/

return [
  // single page access data by owner (spa) / or ajax Middleware
  "spa" => [
    // barear token use only for admin/owner
    // barearTokenName that will be your <header> name (axios , guzzle)
    "barearTokenName" => "Authorization",
    // define your desired secret token
    // set header in axios or guzzle . example <Authorization =  bearer barearToken>
    "barearToken" => "mysecret122",
    // set throttle per min request
    "throttle" => "60"
  ]
];
