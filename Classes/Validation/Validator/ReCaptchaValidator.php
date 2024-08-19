<?php

namespace Haffner\JhCaptcha\Validation\Validator;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class ReCaptchaValidator extends AbstractCaptchaValidator
{
    /**
     * Check if $value is valid. If it is not valid, needs to add an error
     * to Result.
     *
     * @param mixed $value
     */
    protected function isValid(mixed $value): void
    {
        if ($this->settings['reCaptcha']['version'] == 2) {
            $secret = htmlspecialchars($this->settings['reCaptcha']['v2']['secretKey']);
        } else {
            $secret = htmlspecialchars($this->settings['reCaptcha']['v3']['secretKey']);
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $apiResponse = json_decode(
            GeneralUtility::getUrl($url.'?secret='.$secret.'&response='.$value),
            true
        );

        if ($apiResponse['success'] == false) {
            if (is_array($apiResponse['error-codes'])) {
                foreach ($apiResponse['error-codes'] as $errorCode) {
                    switch ($errorCode) {
                        case 'missing-input-secret':
                            $this->addTranslatedError('missingInputSecret', 1426877004);
                            break;
                        case 'invalid-input-secret':
                            $this->addTranslatedError('invalidInputSecret', 1426877455);
                            break;
                        case 'missing-input-response':
                            $this->addTranslatedError('missingInputResponse', 1426877525);
                            break;
                        case 'invalid-input-response':
                            $this->addTranslatedError('invalidInputResponse', 1426877590);
                            break;
                        case 'bad-request':
                            $this->addTranslatedError('badRequest', 1426877490);
                            break;
                        case 'timeout-or-duplicate':
                            $this->addTranslatedError('timeoutOrDuplicate', 1426877420);
                            break;
                        default:
                            $this->addTranslatedError('defaultError', 1427031929);
                    }
                }
            } else {
                $this->addTranslatedError('defaultError', 1427031929);
            }
        } else {
            if ($this->settings['reCaptcha']['version'] != 2 && isset($apiResponse['score'])) {
                if ($apiResponse['score'] < $this->settings['reCaptcha']['v3']['minimumScore']) {
                    $this->addTranslatedError('scoreError', 1541173838);
                }
            }
        }
    }
}
