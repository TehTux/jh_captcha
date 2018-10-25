<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Google reCAPTCHA v2.0',
    'description' => 'Use Google reCAPTCHA v2.0 in your own TYPO3 extensions, EXT:form, EXT:powermail and EXT:formhandler as spam protection.',
    'category' => 'fe',
    'author' => 'Jan Haffner',
    'author_email' => 'info@jan-haffner.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '2.1.0-dev',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-8.7.99',
        ),
    ),
);
