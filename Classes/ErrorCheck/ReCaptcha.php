<?php

/**
 * Class Tx_JhCaptcha_ErrorCheck_ReCaptcha
 * EXT:formhandler ErrorCheck for ReCaptcha
 */
class Tx_JhCaptcha_ErrorCheck_ReCaptcha extends Tx_Formhandler_AbstractErrorCheck {

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

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
            $errors = $result->getErrors();
            \TYPO3\CMS\Core\Utility\DebugUtility::debug($errors);
            if(empty($errors)) {
                $checkFailed = $this->getCheckFailed();
            }
        }
        return $checkFailed;

        /*
        $checkFailed = '';
        if (isset($this->gp[$this->formFieldName])) {

            # Hier euren Secret Key eintragen!
            $secret = '6LdfpQITAAAAANEmVbNfr0s2Y9fumewQVINvb8jV';
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $apiResponse = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url.'?secret='.$secret.'&response='.$this->gp[$this->formFieldName]), true);
            if($apiResponse['success'] == FALSE) {
                $checkFailed = $this->getCheckFailed();
            }
        } else if($this->gp[$this->formFieldName]=='') {
            $checkFailed = $this->getCheckFailed();
        }
        return $checkFailed;
        */
    }
}

?>