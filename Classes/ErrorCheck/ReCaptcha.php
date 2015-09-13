<?php

/**
 * Class Tx_JhCaptcha_ErrorCheck_ReCaptcha
 * EXT:formhandler ErrorCheck for ReCaptcha
 */
class Tx_JhCaptcha_ErrorCheck_ReCaptcha extends Tx_Formhandler_AbstractErrorCheck {

    /**
     * Checks the ReCaptcha
     *
     * @return string
     */
    public function check() {
        $checkFailed = '';
        if (isset($this->gp[$this->formFieldName])) {
            $reCaptchaValidator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator');
            // validate the captcha
            $result = $reCaptchaValidator->validate($this->gp[$this->formFieldName]);
            // check errors
            if(!empty($result->getErrors())) {
                $checkFailed = $this->getCheckFailed();
            }
        }
        return $checkFailed;
    }
}

?>