<?php
namespace LSAPI\Traits;

trait LsapiException
{
  private function handleLsapiException($request,$exception)
  {
      //$exception = $this->prepareException($exception);
      if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
          $exception = $exception->getResponse();
      }

      if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
          $exception = $this->unauthenticated($request, $exception);
      }

      if ($exception instanceof \Illuminate\Validation\ValidationException) {
          $exception = $this->convertValidationExceptionToResponse($exception, $request);
      }

      return $this->customApiResponse($exception);
  }

  private function customApiResponse($exception)
  {
      if (method_exists($exception, 'getStatusCode')) {
          $statusCode = $exception->getStatusCode();
      } else {
          $statusCode = 500;
      }

      $response = [];

      switch ($statusCode) {
          case 401:
              $response['message'] = 'Unauthorized';
              break;
          case 403:
              $response['message'] = 'Forbidden';
              break;
          case 404:
              $response['message'] = 'Not Found';
              break;
          case 405:
              $response['message'] = 'Method Not Allowed';
              break;
          case 422:
              $response['message'] = $exception->original['message'];
              $response['errors'] = $exception->original['errors'];
              break;
          default:
              $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
              break;
      }

      if (config('app.debug')) {
          //$response['trace'] = $exception->getTrace();
          //$response['code'] = $exception->getCode();
      }

      $response['status'] = $statusCode;

      return response()->json($response, $statusCode);
  }
}
