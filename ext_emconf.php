<?php

$EM_CONF[$_EXTKEY] = array(
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
    'version' => '4.0.0',
    'constraints' => array(
        'depends' => array(
            'typo3' => '9.5.0-11.5.99',
        ),
    ),
);
