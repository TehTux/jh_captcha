<?php
namespace Haffner\JhCaptcha\ViewHelpers;

class ReCaptchaViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

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

    public function render() {
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'JhCaptcha');
        $siteKey = $settings['reCaptcha']['siteKey'];
        $theme = $settings['reCaptcha']['theme'];
        $type = $settings['reCaptcha']['type'];
        $lang = $settings['reCaptcha']['lang'];

        $reCaptchaApi = '<script src="https://www.google.com/recaptcha/api.js?hl='.$lang.'" async defer></script>';
        $reCaptcha = '<div class="g-recaptcha" data-sitekey="'.$siteKey.'" data-theme="'.$theme.'" data-type="'.$type.'"></div>';

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($settings);

        if($siteKey) {
            return $reCaptchaApi.$reCaptcha;
        } else {
            return 'Set API Key! See https://www.google.com/recaptcha/admin';
        }
    }
}