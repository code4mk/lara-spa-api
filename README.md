# lara-spa-api
Laravel SPA api for Vue | React | Angular


# installation

```bash
composer require code4mk/lara-spa-api
```

## vendor publish

```bash
php artisan vendor:publish --provider="LSAPI\LSAPIServiceProvider" --tag=config
```
=> config/lsapi.php



# Middleware `lsapi` group

```php
Route::group(['middleware' => ['lsapi']], function () {
  // spa  routes
});

//or

Route::get('spa',function(){

})->middleware('lsapi');
```

#  `exceptions/Handler.php`
* delete all code inside `Handler.php` and paste below code

```php
<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
  use \LSAPI\Traits\LsapiException;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {  
            return $this->handleLsapiException($request, $exception);
        } else {
            return parent::render($request, $exception);
        }
    }

}
```

# axios | guzzle header

you can change header name `Authorization` to `Anything` in `lsapi` config file.

```js
Authorization: Bearer xxxxx
Accept: application/json
```
