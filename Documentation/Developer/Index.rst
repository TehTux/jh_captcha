.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

.. note::

    This section is outdated & may no longer work. Due to time constraints it is currently not planned to
    to update this section. Create a PR if necessary.

Add the Captcha to your domain model
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add this field to your domain model class:

.. code-block:: php
    :linenos:

    /**
     * @var string
     * @validate NotEmpty, \Haffner\JhCaptcha\Validation\Validator\ReCaptchaValidator
     */
    protected $captchaResponse;

and getter and setter functions:

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

Add the Captcha to your Fluid template
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: fluid
    :linenos:

    {namespace jhcaptcha = Haffner\JhCaptcha\ViewHelpers}

    <jhcaptcha:reCaptcha />
    <f:form.textfield id="captchaResponse" type="hidden" property="captchaResponse" />