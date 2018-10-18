<?php

namespace Haffner\JhCaptcha\ViewHelpers;

class ReCaptchaViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * As this ViewHelper renders HTML, the output must not be escaped.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
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
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');

        if ($settings['reCaptcha']['siteKey']) {
            $siteKey = $settings['reCaptcha']['siteKey'];
            $theme = $settings['reCaptcha']['theme'];
            $lang = $settings['reCaptcha']['lang'];
            $size = $settings['reCaptcha']['size'];
            $uid = $this->arguments['uid'];
            if ($uid) {
                $captchaResponseId = 'captchaResponse-' . $uid;
            } else {
                $captchaResponseId = 'captchaResponse';
            }

            $reCaptcha = '<div id="recaptcha' . $uid . '"></div>';
            $renderReCaptcha = '<script type="text/javascript">var apiCallback' . str_replace("-", "", $this->arguments['uid']) . ' = function() { reCaptchaWidget' . str_replace("-", "", $this->arguments['uid']) . ' = grecaptcha.render("recaptcha' . $uid . '", { "sitekey" : "' . $siteKey .'", "callback" : "captchaCallback' . str_replace("-", "", $this->arguments['uid']) .'", "theme" : "' . $theme . '", "size" : "' . $size . '" }); }</script>';
            $reCaptchaApi = '<script src="https://www.google.com/recaptcha/api.js?onload=apiCallback' . str_replace("-", "", $this->arguments['uid']) . '&hl=' . $lang . '&render=explicit" async defer></script>';
            if (!$this->arguments['type'] == "powermail") {
                $callBack = '<script type="text/javascript">var captchaCallback' . str_replace("-", "", $this->arguments['uid']) . ' = function() { document.getElementById("' . $captchaResponseId . '").value = grecaptcha.getResponse(reCaptchaWidget' . str_replace("-", "", $this->arguments['uid']) . ') }</script>';
            }

            return $reCaptcha . $callBack . $renderReCaptcha . $reCaptchaApi;
        } else {
            return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('setApiKey', null, null);
        }
    }
}
