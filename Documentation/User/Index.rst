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

1) To use reCAPTCHA, you need to sign up for an API key pair (v2 and/or v3) for your site: http://www.google.com/recaptcha/admin

2) Set your API key pair in TypoScript constants (v2 and/or v3) and the reCAPTCHA version (2 or 3):

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


Optional Configuration
^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: typoscript
    :linenos:
    :emphasize-lines: 6, 10, 14, 19, 21

    plugin.tx_jhcaptcha.settings.reCaptcha {
        v2 {
            # Description: The color theme of the widget
            # Options: dark | light
            # Default: light
            theme = light
            # Description: The language of the widget
            # Options: https://developers.google.com/recaptcha/docs/language
            # Default: en
            lang = en
            # Description: The size of the widget
            # Options: normal | compact
            # Default: normal
            size = normal
        }
        v3 {
            # Description: Minimum Score (0.0 - 1.0)
            # Default: 0.5
            minimumScore = 0.5
            # Description: See https://developers.google.com/recaptcha/docs/v3
            action = homepage
        }
    }

Usage in Form (EXT:form)
^^^^^^^^^^^^^^^^^^^^^^^^

The reCAPTCHA can easy be used in the `core extension form`_. The following steps are necessary:

.. _core extension form: hhttps://docs.typo3.org/typo3cms/extensions/form/

Create a new field in your form reCAPTCHA (JhCaptchaRecaptcha) and save your form.
Now the reCAPTCHA is ready!

Usage in powermail (EXT:powermail)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The reCAPTCHA can easy be used in the `extension powermail`_. The following steps are necessary:

.. _extension powermail: http://typo3.org/extensions/repository/view/powermail

.. note::

    Note that the usage has only been tested in the powermail versions 8.2 and 10.4!
    Most likely it will also work with other versions.

Create a new field in your form, set a title ("Captcha" for example) and select the type "reCAPTCHA (jh_captcha)".
Now the reCAPTCHA is ready!

Usage in Formhandler (EXT:formhandler)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The reCAPTCHA can easy be used in the `extension formhandler`_ (Fork: `phorax/formhandler`_ for TYPO3 v10).
The following steps are necessary:

.. _extension formhandler: http://typo3.org/extensions/repository/view/formhandler
.. _phorax/formhandler: https://github.com/PHORAX/formhandler

1. Mastertemplate
-----------------

First the captcha needs to be included in the master template. Example:

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

Now the marker can be used in the Form Template:

.. code-block:: html
    :linenos:

    ###master_spamprotection-jh_captcha_recaptcha###

3. TypoScript
-------------

Then the validators need to be assigned to the captcha field:

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

4. Language file
----------------

Finally, the label and the error messages must be defined. Example:

.. code-block:: xml
    :linenos:

    <label index="jh_captcha_recaptcha">reCAPTCHA</label>
    <label index="error_jh_captcha_recaptcha_required">reCAPTCHA is a mandatory field.</label>
    <label index="error_jh_captcha_recaptcha_recaptcha">reCAPTCHA validation error</label>

Now the reCAPTCHA is ready!
