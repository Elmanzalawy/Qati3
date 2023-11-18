<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * jsonResponse
     *
     * @param  integer $status
     * @param  mixed $data
     * @param  string $message
     * @param  integer $code
     * @param  mixed $meta
     * @param  array $errors
     * @param  array $headers
     * @return Response
     */
    protected function jsonResponse($status, $data = null, $message = 'Success', $code = 200, $meta = [], $errors = [], $headers = []): Response
    {
        $content = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
            'meta' => $meta
        ];

        return response($content, $code, $headers);
    }

    /**
     * success
     *
     * @param  string $message
     * @param  mixed $data
     * @param  integer $code
     * @param  mixed $meta
     * @param  array $headers
     * @return Response
     */
    protected function success($message = 'Success', $data = [], $code = 200, $meta = [], $headers = []): Response
    {
        return $this->jsonResponse(status: 1, message:$message, data:$data, code:$code , meta:$meta, headers:$headers);
    }

    /**
     * error
     *
     * @param  string $message
     * @param  array $errors
     * @param  integer $code
     * @return Response
     */
    protected function error($message = 'An error has occured', $errors = [], $code = 400): Response
    {
        return $this->jsonResponse(status: 0, message:$message, errors:$errors, code:$code );
    }
}
