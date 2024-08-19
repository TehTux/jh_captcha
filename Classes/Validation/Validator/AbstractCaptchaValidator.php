<?php

namespace Haffner\JhCaptcha\Validation\Validator;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

abstract class AbstractCaptchaValidator extends AbstractValidator
{
    /**
     * Specifies whether this validator accepts empty values.
     *
     * If this is TRUE, the validators isValid() method is not called in case of an empty value
     * Note: A value is considered empty if it is NULL or an empty string!
     * By default all validators except for NotEmpty and the Composite Validators accept empty values
     *
     * @var bool
     */
    protected $acceptsEmptyValues = false;

    /**
     * @var array Extension TypoScript
     */
    protected array $settings;

    public function __construct(ConfigurationManagerInterface $configurationManager)
    {
//        /** @var ConfigurationManagerInterface $configurationManager */
//        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $this->settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'JhCaptcha',
        );
    }

    /**
     * Creates a new validation error object and adds it to $this->results.
     *
     * @param string $translateKey
     * @param int    $code         The error code (a unix timestamp)
     */
    protected function addTranslatedError(string $translateKey, int $code): void
    {
        $this->addError($this->translateErrorMessage($translateKey, 'jh_captcha'), $code);
    }
}
