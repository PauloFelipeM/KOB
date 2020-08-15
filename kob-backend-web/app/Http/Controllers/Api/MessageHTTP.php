<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait MessageHTTP
{
    /**
     * Create JSON Response Success.
     *
     * @param $data
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseSuccess($data, $message = null, $statusCode = Response::HTTP_OK)
    {
        return self::_getResponse($statusCode, $message, true, $data);
    }

    /**
     * Create JSON Response Error.
     *
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseError($message = null, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        $message = __('api_validation.error') . $message;
        return self::_getResponse($statusCode, $message, false);
    }

    /**
     *  Create JSON Response Validation Error.
     *
     * @param $errors
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseValidation($errors, $message, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return self::_getResponse($statusCode, $message, false, $errors);
    }

    /**
     * Return a array with attributes of response.
     *
     * @param $statusCode
     * @param $message
     * @param $success
     * @return array
     */
    private static function _getArrayResponse($statusCode, $message, $success)
    {
        return [
            'status' => $statusCode,
            'success' => $success,
            'message' => $message
        ];
    }

    /**
     * Return JSON Response default.
     *
     * @param $statusCode
     * @param $message
     * @param bool $success
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    private static function _getResponse($statusCode, $message, $success = true, $data = null)
    {
        $response = self::_getArrayResponse($statusCode, $message, $success);

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }
}
