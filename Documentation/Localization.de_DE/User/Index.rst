.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _user-manual:

Benutzer Handbuch
=================

Erforderliche Konfiguration
^^^^^^^^^^^^^^^^^^^^^^^^^^^

1) Du musst deine Seite registrieren um ein API-Schlüsselpaar für reCAPTCHA zu erhalten: http://www.google.com/recaptcha/admin

2) Trage diese Schlüssel in TypoScript ein:

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 4, 5

    plugin.tx_jhcaptcha {
        settings {
            reCaptcha {
                siteKey =
                secretKey =
            }
        }
    }


Optionale Konfiguration
^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 7, 11, 15, 19

    plugin.tx_jhcaptcha {
        settings {
            reCaptcha {
                # Beschreibung: Farbe des Captchas
                # Optionen: dark | light
                # Standard: light
                theme = light
                # Beschreibung: Die Sprache des Captchas
                # Optionen: https://developers.google.com/recaptcha/docs/language
                # Standard: en
                lang = en
                # Beschreibung: Die Größe des Captchas
                # Optionen: normal | compact
                # Standard: normal
                size = normal
            }
        }
    }

Verwendung in Form (EXT:form)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Core Erweiterung Form`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Core Erweiterung Form: hhttps://docs.typo3.org/typo3cms/extensions/form/

.. note::

    Bitte beachte, dass die Verwendung erst ab TYPO3 v8 möglich ist.

Erstelle dazu in deinem Formular ein neues Feld reCAPTCHA (JhCaptchaRecaptcha) und speichere das Formular.
Jetzt ist das reCAPTCHA einsatzbereit!

Verwendung in Powermail (EXT:powermail)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Powermail`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Powermail: http://typo3.org/extensions/repository/view/powermail

.. note::

    Bitte beachte, dass die Verwendung nur in den Powermail Versionen 3.9 - 4.4 getestet wurde!
    Höchstwahrscheinlich läuft es auch mit neueren Versionen.

Erstelle dazu in deinem Formular ein neues Feld, vergebe eine Bezeichnung (z.B. "Captcha") und wähle den Typ "reCAPTCHA (jh_captcha)" aus.
Jetzt ist das reCAPTCHA einsatzbereit!

Verwendung in Formhandler (EXT:formhandler)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Formhandler`_ (oder `phorax/formhandler`_ für TYPO3 v8) verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Formhandler: http://typo3.org/extensions/repository/view/formhandler
.. _phorax/formhandler: https://github.com/PHORAX/formhandler

.. note::

    Bitte beachte, dass die Verwendung nur in den formhandler Versionen 2.3 - 2.4 und 3.0 (phorax/formhandler) getestet wurde!
    Höchstwahrscheinlich läuft es auch mit neueren Versionen.

1. Mastertemplate
-----------------

Zuerst muss das Captcha im Mastertemplate aufgenommen werden. Beispiel:

.. code-block:: html
    :linenos:

    <!-- ###master_spamprotection-jh_captcha_recaptcha### -->
    <div class="row">
    	<div class="large-3 columns">
    		<label class="###is_error_jh_captcha_recaptcha###">###LLL:jh_captcha_recaptcha### ###required_jh_captcha_recaptcha###</label>
    	</div>
    	<div class="large-9 columns">
    		###jh_captcha_recaptcha###
    		###error_jh_captcha_recaptcha###
    	</div>
    </div>
    <!-- ###master_spamprotection-jh_captcha_recaptcha### -->

2. Template
-----------

Jetzt kann der Marker im Formular-Template verwendet werden:

.. code-block:: html
    :linenos:

    ###master_spamprotection-jh_captcha_recaptcha###

3. TypoScript
-------------

Danach müssen die Validatoren für das Captcha-Feld zugewiesen werden:

.. code-block:: typoscript
    :linenos:

        [...]
        validators.1.config.fieldConf {
            jh_captcha_recaptcha.errorCheck {
                1 = required
                2 = \Haffner\JhCaptcha\Validation\ErrorCheck\ReCaptcha
            }
        }
        [...]

4. Sprachdatei
--------------

Zum Schluss muss noch das Label sowie die Fehlermeldungen definiert werden. Beispiel:

.. code-block:: xml
    :linenos:

    <label index="jh_captcha_recaptcha">reCAPTCHA</label>
    <label index="error_jh_captcha_recaptcha_required">reCAPTCHA ist ein Pflichtfeld.</label>
    <label index="error_jh_captcha_recaptcha_Tx_JhCaptcha_ErrorCheck_ReCaptcha">Fehler beim Validieren des reCAPTCHA.</label>

Anschließend ist das reCAPTCHA einsatzbereit.
