<?php

return [
  // single page access data by owner (spa) / or ajax Middleware
  "spa" => [
    // barear token use only for admin/owner
    // barearTokenName that will be your <header> name (axios , guzzle)
    "barearTokenName" => "Authorization",
    // define your desired secret token
    // set header in axios or guzzle . example <Authorization =  bearer barearToken>
    "barearToken" => "mysecret122",

    "throttle" => "60"
  ]
];
