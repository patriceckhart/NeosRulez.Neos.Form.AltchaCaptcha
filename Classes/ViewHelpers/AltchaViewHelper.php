<?php
namespace NeosRulez\Neos\Form\AltchaCaptcha\ViewHelpers;

use Neos\Flow\Annotations as Flow;
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
        return $this->renderChildren();
    }

}
