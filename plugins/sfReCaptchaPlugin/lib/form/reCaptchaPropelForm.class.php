<?php
/**
 * reCaptchaPropelForm
 *
 * Adds widgets and validators for reCaptcha to a Propel form.
 * Also, binds extra fields
 *
 * @package    symfony
 * @subpackage form
 * @author     Massimiliano Arione <garakkio@gmail.com>
 */
class reCaptchaPropelForm extends BaseFormPropel
{
  public function configure()
  {
    if (sfConfig::get('app_recaptcha_active', false))
    {
      $this->widgetSchema['response'] = new sfWidgetFormInput();

      // be gentle and don't overwrite possible existing postValidator
      $postValidator = $this->validatorSchema->getPostValidator();
      if ($postValidator)
      {
        $postValidators = array($postValidator, new sfValidatorSchemaReCaptcha('challenge', 'response'));
        $this->validatorSchema->setPostValidator(
          new sfValidatorAnd($postValidators)
        );
      }
      else
      {
        $this->validatorSchema->setPostValidator(
          new sfValidatorSchemaReCaptcha('challenge', 'response')
        );
      }

      $this->validatorSchema->setOption('allow_extra_fields', true);
      $this->validatorSchema->setOption('filter_extra_fields', false);
    }
  }

  /**
   * Binds the form with input values, adding recaptcha values
   * @param array $taintedValues  An array of input values
   * @param array $taintedFiles   An array of uploaded files (in the $_FILES or $_GET format)
   */
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    if (sfConfig::get('app_recaptcha_active', false))
    {
      $request = sfContext::getInstance()->getRequest();
      $taintedValues['challenge'] = $request->getParameter('recaptcha_challenge_field');
      $taintedValues['response'] = $request->getParameter('recaptcha_response_field');
    }
    parent::bind($taintedValues, $taintedFiles);
  }

  public function getModelName()
  {
  }

}
