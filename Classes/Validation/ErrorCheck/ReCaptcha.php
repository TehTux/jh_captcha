<?php

namespace Haffner\JhCaptcha\Validation\ErrorCheck;

/**
 * EXT:formhandler ErrorCheck for ReCaptcha.
 */
class ReCaptcha extends \Typoheads\Formhandler\Validator\ErrorCheck\AbstractErrorCheck
{
    /**
     * Checks the ReCaptcha.
     *
     * @return string
     */
    public function check()
    {
        $checkFailed = '';
        if (isset($this->gp[$this->formFieldName])) {
            $reCaptchaValidator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator');
            // validate the captcha
            $result = $reCaptchaValidator->validate($this->gp[$this->formFieldName]);
            // check errors
            if ($result->getErrors()) {
                $checkFailed = $this->getCheckFailed();
            }
        }

        return $checkFailed;
    }
}
