<?php



namespace App\Response;

use App\Dto\ApiResponseDto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseFactory
{
    /**
     * Builds a JsonResponse 
     *
     * @param ApiResponseDto $apiResponseDto The DTO containing status, data, errors, message, and code.
     * @return JsonResponse
     */
    public static function build(ApiResponseDto $apiResponseDto): JsonResponse
    {
        $responseData = [
            'status'  => $apiResponseDto->status,
            'data'    => $apiResponseDto->data,
            'errors'  => $apiResponseDto->errors,
            'message' => $apiResponseDto->message,
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        return new JsonResponse($responseData, $apiResponseDto->code, $headers);
    }
}
