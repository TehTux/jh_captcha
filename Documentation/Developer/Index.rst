.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Add the Captcha to your domain model
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add this field to your domain model class:

.. code-block:: php

    /**
     * @var string
     * @validate NotEmpty, \Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator
     */
    protected $captchaResponse;

and getter and setter functions:

.. code-block:: php

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

Add the Captcha to your Fluid template
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: fluid

    {namespace jhcaptcha = Haffner\JhCaptcha\ViewHelpers}

    <jhcaptcha:reCaptcha />
    <f:form.textfield id="captchaResponse" type="hidden" property="captchaResponse" />