<?php

############
# EXT:form #
############
if (version_compare(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version(),
        "8", ">=")) {
    # backend language file
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:form/Resources/Private/Language/Database.xlf'][]
        = 'EXT:jh_captcha/Resources/Private/Language/Backend.xlf';

    # reCaptcha icon
    $iconRegistry = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        't3-form-icon-jhcaptcha-recaptcha',
        \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
        ['name' => 'google']
    );
}
