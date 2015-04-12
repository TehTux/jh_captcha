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
        $extensionName = 'jh_captcha';
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');
        $secret = $settings['reCaptcha']['secretKey'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $apiResponse = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url.'?secret='.$secret.'&response='.$value), true);
        if($apiResponse['success'] == FALSE) {
            if(is_array($apiResponse['error-codes'])){
                foreach($apiResponse['error-codes'] as $errorCode) {
                    switch($errorCode) {
                        case 'missing-input-secret':
                            $this->addError($this->translateErrorMessage('missingInputSecret', $extensionName), 1426877004);
                            break;
                        case 'invalid-input-secret':
                            $this->addError($this->translateErrorMessage('invalidInputSecret', $extensionName), 1426877455);
                            break;
                        case 'missing-input-response':
                            $this->addError($this->translateErrorMessage('missingInputResponse', $extensionName), 1426877525);
                            break;
                        case 'invalid-input-response':
                            $this->addError($this->translateErrorMessage('invalidInputResponse', $extensionName), 1426877590);
                            break;
                        default:
                            $this->addError($this->translateErrorMessage('defaultError', $extensionName), 1427031929);
                    }
                }
            } else {
                $this->addError($this->translateErrorMessage('defaultError', $extensionName), 1427031929);
            }
        }
    }

    /**
     * Validate function for the powermail extension
     *
     * @param \In2code\Powermail\Domain\Model\Mail $mail the form field
     * @param \In2code\Powermail\Domain\Validator\CustomValidator $customValidator the validator from powermail
     */
    public function validateCaptchaInPowermail($mail, $customValidator) {
        foreach ($mail->getAnswers() as $answer) {
            if($answer->getField()->getType() == 'jhcaptcharecaptcha') {
                // validate the captcha
                $result = $this->validate($answer->getValue());
                // set error messages if necessary
                $errors = $result->getErrors();
                if(!empty($errors)) {
                    foreach($errors as $error) {
                        $customValidator->setErrorAndMessage($answer->getField(), $error->getMessage());
                    }
                }
                // remove captcha field from the mail
                $mail->removeAnswer($answer);
            }
        }
    }
}

?>