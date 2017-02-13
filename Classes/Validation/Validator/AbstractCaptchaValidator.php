<?php

namespace Haffner\JhCaptcha\Validation\Validator;

abstract class AbstractCaptchaValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{

    /**
     * @var array Extension TypoScript
     */
    protected $settings;

    public function __construct(array $options = array())
    {
        parent::__construct($options);
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $configurationManager = $objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
        $this->settings = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');
    }

    /**
     * Validate function for the powermail extension.
     *
     * @param \In2code\Powermail\Domain\Model\Mail                $mail            the form field
     * @param \In2code\Powermail\Domain\Validator\CustomValidator $customValidator the validator from powermail
     */
    abstract public function validateCaptchaInPowermail($mail, $customValidator);
}
