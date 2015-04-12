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
    :emphasize-lines: 7, 11, 15

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
            }
        }
    }
