<?php



namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ApiResponseDto
{
    /**
     * @Assert\NotBlank(message="Status is required.")
     */
    public string $status;

    /**
     * Data array.
     */
    public array $data;

    /**
     * Errors array.
     */
    public array $errors;

    /**
     * Optional message.
     */
    public ?string $message;

    /**
     * @Assert\Range(
     *      min=100,
     *      max=599,
     *      notInRangeMessage="Code ({{ value }}) must be a valid HTTP status code."
     * )
     */
    public int $code;

    public function __construct(
        string $status,
        array $data = [],
        array $errors = [],
        ?string $message = null,
        int $code = 200
    ) {
        $this->status = $status;
        $this->data = $data;
        $this->errors = $errors;
        $this->message = $message;
        $this->code = $code;
    }
}
