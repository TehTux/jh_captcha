<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Google reCAPTCHA v2.0',
    'description' => 'With this extension you can use reCAPTCHA v2.0 from Google in your own TYPO3 extensions as spam protection. Moreover, this extension can be easily used in powermail and formhandler forms.',
    'category' => 'fe',
    'author' => 'Jan Haffner',
    'author_email' => 'info@jan-haffner.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '2.0.0-dev',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-8.7.99',
        ),
    ),
);
