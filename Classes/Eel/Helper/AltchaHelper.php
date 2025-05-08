<?php
declare(strict_types=1);

namespace NeosRulez\Neos\Form\AltchaCaptcha\Eel\Helper;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\I18n\Translator;
use NeosRulez\Neos\Form\AltchaCaptcha\Domain\Service\AltchaService;

class AltchaHelper implements ProtectedContextAwareInterface
{
    #[Flow\Inject]
    protected AltchaService $altchaService;

    #[Flow\Inject]
    protected Translator $translator;

    public function getChallengeJson(): string
    {
        return json_encode($this->altchaService->createChallenge());
    }

    public function getContentJson(): string {
        $strings = [
            'ariaLinkLabel' => $this->translator->translateById('content.ariaLinkLabel', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'error' => $this->translator->translateById('content.error', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'expired' => $this->translator->translateById('content.expired', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'footer' => $this->translator->translateById('content.footer', ['altchaLink' => '<a href="https://altcha.org" target="_blank">ALTCHA</a>'], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'label' => $this->translator->translateById('content.label', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'verified' => $this->translator->translateById('content.verified', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'verifying' => $this->translator->translateById('content.verifying', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'waitAlert' => $this->translator->translateById('content.waitAlert', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha')

        ];

        return json_encode($strings);
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
