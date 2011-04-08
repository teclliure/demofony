<?php

/**
 * sfValidatorSchemaReCaptcha validates a reCAPTCHA (recaptcha.net).
 *
 * @author Arthur Koziel <arthur@arthurkoziel.com>
 */
class sfValidatorSchemaReCaptcha extends sfValidatorSchema
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * challange_field:    The challange field name
   *  * response_field:     The response field name
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the response field
   *
   * @param string $challengeField The challange field name
   * @param string $responseField The response field name
   * @param array  $options An array of options
   * @param array  $messages An array of error messages
   *
   * @see sfValidatorBase
   */
  public function __construct($challengeField, $responseField, $options = array(), $messages = array())
  {
    $this->addOption('challenge_field', $challengeField);
    $this->addOption('response_field', $responseField);

    $this->addOption('throw_global_error', false);

    parent::__construct(null, $options, $messages);
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }

    sfProjectConfiguration::getActive()->loadHelpers('recaptcha');

    $challengeValue = $values[$this->getOption('challenge_field')];
    $responseValue = $values[$this->getOption('response_field')];

    $resp = recaptcha_check_answer(sfConfig::get('app_recaptcha_privatekey'),
                                   $_SERVER['REMOTE_ADDR'],
                                   $challengeValue,
                                   $responseValue
    );

    if (!$resp->is_valid)
    {
      $error = new sfValidatorError($this, $resp->error, array(
        'challenge_field' => $this->getOption('challenge_field'),
        'response_field'  => $this->getOption('response_field'),
      ));
      if ($this->getOption('throw_global_error'))
      {
        throw $error;
      }

      throw new sfValidatorErrorSchema($this,
        array($this->getOption('response_field') => $error)
      );
    }

    return $values;
  }

  /**
   * @see sfValidatorBase
   */
  public function asString($indent = 0)
  {
    throw new Exception('Unable to convert a sfValidatorSchemaReCaptcha to string.');
  }
}
