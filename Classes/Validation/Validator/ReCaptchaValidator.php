<?php

namespace Haffner\JhCaptcha\Validation\Validator;

class ReCaptchaValidator extends \Haffner\JhCaptcha\Validation\Validator\AbstractCaptchaValidator
{
    /**
     * Check if $value is valid. If it is not valid, needs to add an error
     * to Result.
     *
     * @param mixed $value
     */
    protected function isValid($value)
    {
        $extensionName = 'jh_captcha';
        $secret = htmlspecialchars($this->settings['reCaptcha']['secretKey']);
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $apiResponse = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url.'?secret='.$secret.'&response='.$value), true);
        if ($apiResponse['success'] == false) {
            if (is_array($apiResponse['error-codes'])) {
                foreach ($apiResponse['error-codes'] as $errorCode) {
                    switch ($errorCode) {
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
}
