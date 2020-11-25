<?php

namespace Haffner\JhCaptcha\ViewHelpers;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ReCaptchaViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
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
        $captchaResponseField = '';
        if ($this->isPowermail()) {
            $captchaResponseField = '<input type="hidden" id="' . $captchaResponseId . '" name="g-recaptcha-response">';
        }

        $siteKey = htmlspecialchars($settings['reCaptcha']['v3']['siteKey'], ENT_QUOTES | ENT_HTML5);
        $action = htmlspecialchars($settings['reCaptcha']['v3']['action'], ENT_QUOTES | ENT_HTML5);
        $script = <<<EOT
<script src="https://www.google.com/recaptcha/api.js?render=$siteKey"></script>
<script>
grecaptcha.ready(function () {
  var inputToken = document.getElementById('${captchaResponseId}');
  var renewToken = function (e) {
    grecaptcha.execute('${siteKey}', { action: '${action}' }).then(function (token) {
      inputToken.value = token;
    });
  };
  renewToken();
  window.setTimeout(renewToken, 100000);
});
</script>
EOT;
        return $captchaResponseField . $script;
    }

    /**
     * @return bool
     */
    private function isPowermail()
    {
        return $this->arguments['type'] === 'powermail';
    }
}
