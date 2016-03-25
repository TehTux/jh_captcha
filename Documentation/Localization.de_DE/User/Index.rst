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
                # Beschreibung: Der Typ des Captchas
                # Optionen: audio | image
                # Standard: image
                type = image
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

Verwendung in Powermail
^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Powermail`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Powermail: http://typo3.org/extensions/repository/view/powermail

.. note::

    Bitte beachte, dass die Verwendung nur in den Powermail Versionen 2.2.0 - 2.25.0 getestet wurde!
    Höchstwahrscheinlich läuft es auch mit neueren Versionen.

1. Seiten-TSconfig
------------------

Zuerst muss ein neues Feld in Powermail für das reCAPTCHA erstellt werden.
Füge dazu folgende Zeile im Seiten-TSconfig ein.

.. code-block:: typoscript
    :linenos:

    tx_powermail.flexForm.type.addFieldOptions.jhcaptcharecaptcha = reCAPTCHA (jh_captcha)

2. TypoScript
-------------

Nun muss Powermail noch mitgeteilt werden, wo das zugehörige Partial gefunden werden kann:

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 5

    plugin.tx_powermail.view {
        partialRootPath >
        partialRootPaths {
            10 = EXT:powermail/Resources/Private/Partials/
            20 = EXT:jh_captcha/Resources/Private/Powermail/Partials/Jhcaptcharecaptcha
        }
    }

3. Formular
-----------

Jetzt kannst du das reCAPTCHA in deinem Formular verwenden.

1. Erstelle dazu in deinem Formular ein neues Feld, vergebe eine Bezeichnung (z.B. "Captcha") und wähle den Typ "reCAPTCHA (jh_captcha)" aus.

.. image:: ../Images/Powermail/Form1.jpg

2. Wechsel nun in den Reiter "Erweitert". Setze im Bereich "Feldüberprüfung" einen Haken bei "Pflichtfeld" und lasse das Feld "Überprüfung" leer.

.. image:: ../Images/Powermail/Form2.jpg

Jetzt ist das reCAPTCHA einsatzbereit!

Verwendung in Formhandler
^^^^^^^^^^^^^^^^^^^^^^^^^

Das reCAPTCHA kann leicht in der `Erweiterung Formhandler`_ verwendet werden.
Folgende Schritte sind dafür notwendig:

.. _Erweiterung Formhandler: http://typo3.org/extensions/repository/view/formhandler

.. note::

    Bitte beachte, dass die Verwendung nur in den Formhandler Versionen 2.0.x getestet wurde!
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
            2 = Tx_JhCaptcha_ErrorCheck_ReCaptcha
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
