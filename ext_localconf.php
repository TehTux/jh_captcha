<?php

// SignalSlot for powermail
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\SignalSlot\Dispatcher');
$signalSlotDispatcher->connect(
    'In2code\Powermail\Domain\Validator\CustomValidator',
    'isValid',
    'Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator',
    'validateCaptchaInPowermail',
    false
);
