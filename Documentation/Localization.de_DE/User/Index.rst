.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _user-manual:

Benutzer Handbuch
=================

Erforderliche Konfiguration
^^^^^^^^^^^^^^^^^^^^^^^^^^^

1) Du musst deine Seite registrieren um ein API-Schlüsselpaar für reCAPTCHA (v2 und/oder v3) zu erhalten: http://www.google.com/recaptcha/admin

2) Trage diese Schlüssel (v2 und/oder v3) und die Version in TypoScript ein:

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 2, 4, 5, 8, 9

    plugin.tx_jhcaptcha.settings.reCaptcha {
        version =
        v2 {
            siteKey =
            secretKey =
        }
        v3 {
            siteKey =
            secretKey =
        }
    }


Optionale Konfiguration
^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 6, 10, 14, 19, 21

    plugin.tx_jhcaptcha.settings.reCaptcha {
        v2 {
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
        v3 {
            # Beschreibung: Mindestpunktzahl (0.0 - 1.0)
            # Standard: 0.5
            minimumScore = 0.5
            # Beschreibung: Siehe https://developers.google.com/recaptcha/docs/v3
            action = homepage
        }
    }

Verwendung in Form (EXT:form)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Core Erweiterung Form`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Core Erweiterung Form: hhttps://docs.typo3.org/typo3cms/extensions/form/

Erstelle dazu in deinem Formular ein neues Feld reCAPTCHA (JhCaptchaRecaptcha) und speichere das Formular.
Jetzt ist das reCAPTCHA einsatzbereit!

Verwendung in Powermail (EXT:powermail)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Powermail`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Powermail: http://typo3.org/extensions/repository/view/powermail

.. note::

    Bitte beachte, dass die Verwendung nur in den Powermail Versionen 8.2 und 10.4 getestet wurde!
    Wahrscheinlich läuft es auch mit anderen Versionen.

Erstelle dazu in deinem Formular ein neues Feld, vergebe eine Bezeichnung (z.B. "Captcha") und wähle den Typ "reCAPTCHA (jh_captcha)" aus.
Jetzt ist das reCAPTCHA einsatzbereit!

Verwendung in Formhandler (EXT:formhandler)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Formhandler`_ (Fork: `phorax/formhandler`_ für TYPO3 v10) verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Formhandler: http://typo3.org/extensions/repository/view/formhandler
.. _phorax/formhandler: https://github.com/PHORAX/formhandler

1. Mastertemplate
-----------------

Zuerst muss das Captcha im Mastertemplate aufgenommen werden. Beispiel:

.. code-block:: html
    :linenos:

    <!-- ###master_spamprotection-jh_captcha_recaptcha### -->
    <div class="row">
    	<div class="large-12 columns">
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
    <label index="error_jh_captcha_recaptcha_recaptcha">Fehler beim Validieren des reCAPTCHA.</label>

Anschließend ist das reCAPTCHA einsatzbereit.
