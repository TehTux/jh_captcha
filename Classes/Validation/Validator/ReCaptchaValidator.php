<?php
namespace Haffner\JhCaptcha\Validation\Validator;

class ReCaptchaValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
        $this->configurationManager = $configurationManager;
    }

    /**
     * Check if $value is valid. If it is not valid, needs to add an error
     * to Result.
     *
     * @param mixed $value
     * @return void
     */
    protected function isValid($value) {
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');
        $secret = $settings['reCaptcha']['secretKey'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $apiResponse = json_decode(file_get_contents($url.'?secret='.$secret.'&response='.$value), true);
        if($apiResponse['success'] == FALSE) {
            foreach($apiResponse['error-codes'] as $errorCode) {
                switch($errorCode) {
                    case 'missing-input-secret':
                        $this->addError("The secret parameter is missing.", 1426877004);
                        break;
                    case 'invalid-input-secret':
                        $this->addError("The secret parameter is invalid or malformed.", 1426877455);
                        break;
                    case 'missing-input-response':
                        $this->addError("The response parameter is missing.", 1426877525);
                        break;
                    case 'invalid-input-response':
                        $this->addError("The response parameter is invalid or malformed.", 1426877590);
                        break;
                    default:
                        $this->addError("The Captcha is invalid.", 1427031929);
                }
            }
        }
    }
}

?>