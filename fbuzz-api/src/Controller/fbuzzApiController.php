<?php


namespace App\Controller;

use App\Dto\Fbuzz\FizzBuzzRequestDto;
use App\Factory\ApiResponseFactory;
use App\Response\ResponseBuilder;
use App\Service\fbuzzService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class fbuzzApiController extends AbstractController
{
    public function __construct(
        private readonly fbuzzService $fizzBuzzService,
        private readonly ValidatorInterface $validator,
        private readonly ResponseBuilder $apiResponseFactory
    ) {}

    #[Route('/api/fizzbuzz', name: 'api_fbuzz', methods: ['POST'])]
    public function fbuzz(FizzBuzzRequestDto $requestDto): JsonResponse
    {
        try {
            $errors = $this->validator->validate($requestDto);
            if (count($errors) > 0) {
                throw new ValidationFailedException($requestDto, $errors);
            }

            $result = $this->fizzBuzzService->process(
                $requestDto->int1,
                $requestDto->int2,
                $requestDto->limit,
                $requestDto->str1,
                $requestDto->str2
            );

            $apiResponse = $this->apiResponseFactory->createSuccess(
                ['result' => $result],
                'FizzBuzz processed successfully.'
            );

            return ResponseBuilder::build($apiResponse);
        } catch (ValidationFailedException $e) {
            $errorMessages = array_map(
                fn($violation) => $violation->getMessage(), 
                iterator_to_array($e->getViolations())
            );
            $apiResponse = $this->apiResponseFactory->createError(
                $errorMessages,
                'Validation error(s) occurred.',
                400
            );

            return ResponseBuilder::build($apiResponse);
        } catch (\Throwable $e) {
            $apiResponse = $this->apiResponseFactory->createError(
                [$e->getMessage()],
                'Internal server error.',
                500
            );

            return ResponseBuilder::build($apiResponse);
        }
    }
}
