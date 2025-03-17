<?php
namespace NeosRulez\Neos\Form\AltchaCaptcha\Validation\Captcha;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Validation\Validator\AbstractValidator;
use NeosRulez\Neos\Form\AltchaCaptcha\Domain\Service\AltchaService;

/**
 * @api
 * @Flow\Scope("singleton")
 */
class CaptchaValidator extends AbstractValidator
{

    /**
     * @var boolean
     */
    protected $acceptsEmptyValues = false;

    /**
     * @Flow\Inject
     * @var AltchaService
     */
    protected $altchaService;

    /**
     * @param mixed $value The value that should be validated
     * @return void
     * @api
     */
    protected function isValid($value): void
    {
        if(!$value) {
            $this->addError('This field is required.', 1742223415);
        }
        if ($this->altchaService->validate($value) === false) {
            $this->addError('Value was not validated correctly.', 1742223424);
        }
    }
}
