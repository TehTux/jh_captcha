<?php

namespace Haffner\JhCaptcha\ViewHelpers;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ReCaptchaViewHelper extends AbstractViewHelper
{
    /**
     * As this ViewHelper renders HTML, the output must not be escaped.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManagerInterface $configurationManager
     */
    public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }

    public function initializeArguments()
    {
        $this->registerArgument('uid', 'String', 'reCaptcha uid', false);
        $this->registerArgument('type', 'String', 'form type', false);
    }

    public function render()
    {
        $settings = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');

        $captchaResponseId = 'captchaResponse';
        if ($this->arguments['uid']) {
            $captchaResponseId = $captchaResponseId . '-' . $this->arguments['uid'];
        }

        if ($settings['reCaptcha']['version'] == 2) {
            // render v2
            if ($settings['reCaptcha']['v2']['siteKey']) {
                return $this->renderV2($captchaResponseId, $settings);
            } else {
                return LocalizationUtility::translate('setApiKey', 'jh_captcha');
            }
        } else {
            // render v3
            if ($settings['reCaptcha']['v3']['siteKey']) {
                return $this->renderV3($captchaResponseId, $settings);
            } else {
                return LocalizationUtility::translate('setApiKey', 'jh_captcha');
            }
        }
    }

    private function renderV2($captchaResponseId, $settings)
    {
        $siteKey = htmlspecialchars($settings['reCaptcha']['v2']['siteKey']);
        $theme = htmlspecialchars($settings['reCaptcha']['v2']['theme']);
        $lang = htmlspecialchars($settings['reCaptcha']['v2']['lang']);
        $size = htmlspecialchars($settings['reCaptcha']['v2']['size']);

        $reCaptcha = '<div id="recaptcha' . $this->arguments['uid'] . '"></div>';
        $renderReCaptcha = '<script type="text/javascript">var apiCallback' . str_replace("-", "", $this->arguments['uid']) . ' = function() { reCaptchaWidget' . str_replace("-", "", $this->arguments['uid']) . ' = grecaptcha.render("recaptcha' . $this->arguments['uid'] . '", { "sitekey" : "' . $siteKey .'", "callback" : "captchaCallback' . str_replace("-", "", $this->arguments['uid']) .'", "theme" : "' . $theme . '", "size" : "' . $size . '" }); }</script>';
        $reCaptchaApi = '<script src="https://www.google.com/recaptcha/api.js?onload=apiCallback' . str_replace("-", "", $this->arguments['uid']) . '&hl=' . $lang . '&render=explicit" async defer></script>';
        if (!$this->isPowermail()) {
            $callBack = '<script type="text/javascript">var captchaCallback' . str_replace("-", "", $this->arguments['uid']) . ' = function() { document.getElementById("' . $captchaResponseId . '").value = grecaptcha.getResponse(reCaptchaWidget' . str_replace("-", "", $this->arguments['uid']) . ') }</script>';
        }

        return $reCaptcha . $callBack . $renderReCaptcha . $reCaptchaApi;
    }

    private function renderV3($captchaResponseId, $settings)
    {
        $callBackFunctionName = 'onLoad' .
            $this->arguments['type'] . str_replace("-", "", $this->arguments['uid']);

        $captchaResponseField = '';
        if ($this->isPowermail()) {
            $captchaResponseField = '<input type="hidden" id="' . $captchaResponseId . '" name="g-recaptcha-response">';
        }

        $callBack =
            '<script type="text/javascript">'.
                'var ' . $callBackFunctionName . ' = function() {'.
                    'grecaptcha.execute('.
                        '"' . htmlspecialchars($settings['reCaptcha']['v3']['siteKey']) . '",'.
                        '{action: "' . htmlspecialchars($settings['reCaptcha']['v3']['action']) . '"})'.
                        '.then(function(token) {'.
                            'document.getElementById("' . $captchaResponseId . '").value = token;'.
                        '}'.
                    ');'.
                '};'.
            '</script>';
        $api =
            '<script src="https://www.google.com/recaptcha/api.js?'.
                'render=' . htmlspecialchars($settings['reCaptcha']['v3']['siteKey']) . '&'.
                'onload=' . $callBackFunctionName . '"></script>';

        return $captchaResponseField . $callBack . $api;
    }

    /**
     * @return bool
     */
    private function isPowermail()
    {
        return ($this->arguments['type'] == "powermail" ? true : false);
    }
}
