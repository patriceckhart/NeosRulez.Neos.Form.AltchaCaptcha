<?php
namespace NeosRulez\Neos\Form\AltchaCaptcha\ViewHelpers;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\I18n\Translator;
use Neos\FluidAdaptor\ViewHelpers\Form\AbstractFormFieldViewHelper;
use NeosRulez\Neos\Form\AltchaCaptcha\Domain\Service\AltchaService;

class AltchaViewHelper extends AbstractFormFieldViewHelper
{

    /**
     * @Flow\InjectConfiguration(package="NeosRulez.Neos.Form.AltchaCaptcha", path="view")
     * @var array
     */
    protected $viewSettings;

    /**
     * @Flow\Inject
     * @var AltchaService
     */
    protected $altchaService;

    /**
     * @Flow\Inject
     * @var Translator
     */
    protected $translator;

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * Initialize the arguments.
     *
     * @return void
     * @throws \Neos\FluidAdaptor\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('id', 'string', 'Identifier of the field', true);
        $this->registerArgument('class', 'string', 'HTML Class for the field', true);
    }

    /**
     * @return string the rendered form values
     */
    public function render(): string
    {
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $challenge = $this->altchaService->createChallenge();
        $container = $this->templateVariableContainer;
        $container->add('name', $name);
        $container->add('challenge', $challenge);
        $container->add('settings', $this->viewSettings);

        $container->add('strings', [
            'ariaLinkLabel' => $this->translator->translateById('content.ariaLinkLabel', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'error' => $this->translator->translateById('content.error', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'expired' => $this->translator->translateById('content.expired', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'footer' => $this->replaceLink($this->translator->translateById('content.footer', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha')),
            'label' => $this->translator->translateById('content.label', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'verified' => $this->translator->translateById('content.verified', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'verifying' => $this->translator->translateById('content.verifying', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha'),
            'waitAlert' => $this->translator->translateById('content.waitAlert', [], null, null, $sourceName = 'Captcha', $packageKey = 'NeosRulez.Neos.Form.AltchaCaptcha')
        ]);
        return $this->renderChildren();
    }

    /**
     * @param string $string
     * @return string
     */
    private function replaceLink(string $string): string
    {
        return str_replace('{altchaLink}', '<a href="https://altcha.org" target="_blank">ALTCHA</a>', $string);
    }

}
