<?php



namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Validation will first run the "fbuzz:required" group constraints to ensure that
 * all required fields are present, and then proceed to run the "fbuzz:rules" group.
 *
 * @Assert\GroupSequence({"fbuzz:required", "fbuzz:rules"´,"fbuzz:abousiveUseLimits"})
 */
readonly class fbuzzRequestDto
{
    /**
     * @Assert\NotNull(message="Limit is an obligatory parameter.", groups={"fbuzz:required"})
     * @Assert\Positive(message="Limit ({{ value }}) must be a positive number.", groups={"fbuzz:rules"})
     * @Assert\LessThanOrEqual(
     *     value=1_000_000_000_000, 
     *     message="Limit ({{ value }}) cannot exceed {{ compared_value }}.", 
     *     groups={"fbuzz:abousiveUseLimits"}
     * )
     */
    public int $limit;

    /**
     * @Assert\NotNull(message="int1 is obligatory.", groups={"fbuzz:required"})
     * @Assert\Positive(message="int1 ({{ value }}) must be a positive number.", groups={"fbuzz:rules"})
     * @Assert\LessThan(
     *     propertyPath="limit", 
     *     message="int1 ({{ value }}) must not exceed the limit ({{ compared_value }}).", 
     *     groups={"fbuzz:rules"}
     * )
     */
    public int $int1;

    /**
     * @Assert\NotNull(message="int2 is obligatory.", groups={"fbuzz:required"})
     * @Assert\Positive(message="int2 ({{ value }}) must be a positive number.", groups={"fbuzz:rules"})
     * @Assert\LessThanOrEqual(
     *     propertyPath="limit", 
     *     message="int2 ({{ value }}) must not exceed the limit ({{ compared_value }}).", 
     *     groups={"fbuzz:rules"}
     * )
     */
    public int $int2;

    /**
     * @Assert\NotBlank(message="str1 cannot be empty.", groups={"fbuzz:required"})
     * @Assert\Length(
     *     max=20, 
     *     maxMessage="str1 ({{ value }}) must be at most {{ limit }} characters long.", 
     *     groups={"fbuzz:rules"}
     * )
     */
    public string $str1;

    /**
     * @Assert\NotBlank(message="str2 cannot be empty.", groups={"fbuzz:required"})
     * @Assert\Length(
     *     max=20, 
     *     maxMessage="str2 ({{ value }}) must be at most {{ limit }} characters long.", 
     *     groups={"fbuzz:rules"}
     * )
     */
    public string $str2;
}
