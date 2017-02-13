.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _developer:

Entwickler Handbuch
===================

Füge das Captcha zu deinem domain model hinzu
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Füge dieses Feld deiner domain model Klasse hinzu:

.. code-block:: php
    :linenos:

    /**
     * @var string
     * @validate NotEmpty, \Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator
     */
    protected $captchaResponse;

und getter und setter Funktionen:

.. code-block:: php
    :linenos:

    /**
     * Sets the captchaResponse
     *
     * @param string $captchaResponse
     * @return void
     */
    public function setCaptchaResponse($captchaResponse) {
        $this->captchaResponse = $captchaResponse;
    }

    /**
     * Returns the captchaResponse
     *
     * @return string
     */
    public function getCaptchaResponse() {
        return $this->captchaResponse;
    }

Füge das Captcha zu deinem Fluid template hinzu
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: fluid
    :linenos:

    {namespace jhcaptcha = Haffner\JhCaptcha\ViewHelpers}

    <jhcaptcha:reCaptcha />
    <f:form.textfield id="captchaResponse" type="hidden" property="captchaResponse" />