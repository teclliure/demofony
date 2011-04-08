<?php
/**
 * Library that holds all helping methods for coding
 *
 * @author fizyk
 */
class vjComment
{
  /**
   * Checks if the form is the one posted
   * @return boolean
   * @author jp_morvan
   */
  static function isPostedForm($values, $form)
  {
    return self::getFormName($values['record_model'].$values['record_id']) == $form->getName();
  }

  /**
   * Get the name of the form generated with hash
   * @return string
   * @author jp_morvan
   */
  static function getFormName($values)
  {
    return 'comment_'.self::hashTo8($values);
  }

  /**
   * Generate md5 value cut to 8 characters
   * @return string
   * @author jp_morvan
   */
  static function hashTo8($value)
  {
    return substr(hash('md5', $value), 0, 8);
  }

  /**
   * Checks wheter user is authenticated, and the sfGuardPlugin bound to commentable
   * @return boolean
   * @author fizyk
   */
  static function isUserBoundAndAuthenticated($user)
  {
    return $user->isAuthenticated();
  }

  /**
   * Check wheter or not the comment form can be accessed
   * @return boolean
   */
  static function checkAccessToForm($user)
  {
      if( sfConfig::get( 'app_vjCommentPlugin_restricted' ) )
      {
          return vjComment::isUserBoundAndAuthenticated($user);
      }
      else
      {
          return true;
      }
  }

  /**
   *
   * @return boolean
   * @author jp_morvan
   */
  static function isCaptchaEnabled()
  {
    return sfConfig::get('app_recaptcha_enabled');
  }

  /**
   *
   * @return boolean
   * @author jp_morvan
   */
  static function isPaginationEnabled()
  {
    return sfConfig::get('app_vjCommentPlugin_pagination_active', false);
  }

  /**
   * Get the number of comments to be displayed on each page
   *
   * @return integer
   * @author jp_morvan
   */
  static function getMaxPerPage(Doctrine_Query $query)
  {
    if(self::isPaginationEnabled())
    {
      return sfConfig::get('app_vjCommentPlugin_max_per_page', 10);
    }
    return $query->execute()->count();
  }

  /**
   * Get the list order for the comments (ASC by default)
   *
   * @return string
   * @author jp_morvan
   */
  static function getListOrder()
  {
    return sfConfig::get('app_vjCommentPlugin_list_order', 'ASC');
  }

  /**
   *
   * @return boolean
   * @author jp_morvan
   */
  static function hasProfileInformations()
  {
    return sfConfig::has('app_vjCommentPlugin_profile');
  }


  /**
   * Get the profile information selected if exist, else return false
   *
   * @return mixed
   * @author jp_morvan
   */
  static function getProfileInformation($key)
  {
    if(!self::hasProfileInformations())
    {
      return false;
    }
    $informations = sfConfig::get('app_vjCommentPlugin_profile');
    return (isset($informations[$key]))? $informations[$key]: false;
  }
}
?>
