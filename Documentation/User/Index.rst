.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _user-manual:

Users Manual
============

Required Configuration
^^^^^^^^^^^^^^^^^^^^^^

1) To use reCAPTCHA, you need to sign up for an API key pair for your site: http://www.google.com/recaptcha/admin

2) Set your API key pair in TypoScript:

.. code-block:: typoscript
    :linenos:

    plugin.tx_jhcaptcha {
        settings {
            reCaptcha {
                siteKey =
                secretKey =
            }
        }
    }


Optional Configuration
^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: typoscript
    :linenos:

    plugin.tx_jhcaptcha {
        settings {
            reCaptcha {
                # Description: The color theme of the widget
                # Options: dark | light
                # Default: light
                theme = light
                # Description: The type of CAPTCHA to serve.
                # Options: audio | image
                # Default: image
                type = image
                # Description: The language of the widget
                # Options: https://developers.google.com/recaptcha/docs/language
                # Default: en
                lang = en
            }
        }
    }
