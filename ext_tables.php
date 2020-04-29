<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'jh_captcha',
    'Configuration/TypoScript',
    'Google reCAPTCHA (v2/v3)'
);

# EXT:powermail
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:jh_captcha/Configuration/PageTS/Powermail.typoscript">'
);
