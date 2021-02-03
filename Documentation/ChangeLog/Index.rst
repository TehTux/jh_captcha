.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _changelog:

ChangeLog
=========

4.0.x
-----

4.0.0
^^^^^

* [FEATURE] Make necessary adjustments for TYPO3 v10 (Issue #20)
* [TASK] Extend callback function to prevent token timeout (Issue #21)
* [TASK] Add additional error responses (PR #24)
* [TASK] Fix deprecated TypoScript condition syntax (Issue #17)

3.0.x
-----

3.0.3
^^^^^

* [SECURITY] Escape TypoScript vars to prevent XSS

3.0.2
^^^^^

* [TASK] Add configuration for Travis CI
* [BUGFIX] Fix german translation (PR #12)
* [TASK] Update documentation configuration (Issue #15)
* [BUGFIX] Fix powermail on case sensitive file systems (Issue #10)

3.0.1
^^^^^

* [BUGFIX] EXT:form: Fix validator definition in yaml configuration https://github.com/TehTux/jh_captcha/issues/7
* [TASK] Remove obsolete TYPO3 version check

3.0.0
^^^^^

* [FEATURE] Add reCAPTCHA v3 support https://github.com/TehTux/jh_captcha/issues/4
* [TASK] Update extension icon
* [FEATURE] Support TYPO3 9 https://github.com/TehTux/jh_captcha/issues/3
* [TASK] Support powermail 7 https://github.com/TehTux/jh_captcha/issues/5
* [TASK] Support powermail 6 https://github.com/TehTux/jh_captcha/issues/5
* [!!!][TASK] Support powermail 5 (Revise partial) https://github.com/TehTux/jh_captcha/issues/5
* [TASK] Drop support for powermail 3.9-4.4

2.1.x
-----

2.1.3
^^^^^

* [BUGFIX] EXT:form: Fix validator definition in yaml configuration https://github.com/TehTux/jh_captcha/issues/7

2.1.2
^^^^^

* [DOC] Fix formhandler instruction
* [TASK] Update extension icon

2.1.1
^^^^^

* [DOC] Fix bugs in the documentation
* [DOC] Migrate settings file to the new format

2.1.0
^^^^^

* [BUGFIX] Fix EXT:powermail validation
* [FEATURE] Add support for EXT:form (TYPO3 v8)

2.0.0
-----

* Drop support for TYPO3 6.2
* Add support for TYPO3 8
* Add support for formhandler 3.0 (phorax/formhandler) (TYPO3 v8)
* [FEATURE] Multiple reCAPTCHAs on one site
* Remove obsolete recaptcha setting type
* Drop support for powermail <3.9
* Add support for powermail 4
* [FEATURE] Rewrite powermail support (Now validation works with confirmation page)

1.3.x
-----

1.3.1
^^^^^

* Support for formhandler 2.3-2.4
* Support for powermail 3.x
* Bugfix formhandler error check (PHP 5.3)

1.3.0
^^^^^

* reCAPTCHA data-size attribute added: https://forge.typo3.org/issues/73642
* composer.json added: https://forge.typo3.org/issues/72675#note-3

1.2.x
-----

1.2.1
^^^^^

* Support for TYPO3 CMS 7.6.x
* Revised documentation
* Comments for Constant Editor added

1.2.0
^^^^^

* Support for formhandler: https://forge.typo3.org/issues/66829

1.1.x
-----

1.1.1
^^^^^

* Support for TYPO3 CMS 7.4.x
* Revised documentation

1.1.0
^^^^^

* Support for powermail: https://forge.typo3.org/issues/66301
* Support for TYPO3 CMS 7.1.x
* Revised documentation

1.0.x
-----

1.0.2
^^^^^

* Bug fix: https://forge.typo3.org/issues/66010
* Corrections in German documentation
* Extension category changed to "Frontend"

1.0.1
^^^^^

* Extension description changed
* Bug fix: https://forge.typo3.org/issues/65968
