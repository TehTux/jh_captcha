<?php

defined('TYPO3') or die();

############
# EXT:form #
############
# backend language file
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:form/Resources/Private/Language/Database.xlf'][]
    = 'EXT:jh_captcha/Resources/Private/Language/Backend.xlf';

# reCaptcha icon
$iconRegistry = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$iconRegistry->registerIcon(
    't3-form-icon-jhcaptcha-recaptcha',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:jh_captcha/Resources/Public/Icons/google.svg']
);

# EXT:powermail
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:jh_captcha/Configuration/PageTS/Powermail.typoscript">'
);
