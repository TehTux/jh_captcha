<?php

$EM_CONF['jh_captcha'] = [
    'title' => 'Google reCAPTCHA (v2/v3)',
    'description' => 'Use Google reCAPTCHA (v2/v3) in your own TYPO3 extensions, EXT:form, EXT:powermail and EXT:formhandler as spam protection.',
    'category' => 'fe',
    'author' => 'Jan Haffner',
    'author_email' => 'info@jan-haffner.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '3.0.3',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.5.99',
        ],
    ],
];
