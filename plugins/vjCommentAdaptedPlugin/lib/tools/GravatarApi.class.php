<?php
/**
 * This API Enable auto caching gravatar image
 * It is inspired by these two scripts :
 * - http://fucoder.com/code/gravatar-cache/
 * - http://svn.hiddenloop.com/public/plugins/mephisto_gravatar_cache/
 *
 * TODO :
 *  - automatically remove cached gravatar through a cron OR with phptask
 *  - add unit tests
 *
 * @package  Symfony Plugin
 * @author   Mickael Kurmann
 * @author   Xavier Lacot <xavier@lacot.org>
 * @see      http://www.symfony-project.com/trac/wiki/sfPropelActAsCommentableBehaviorPlugin
 * @license  MIT
 **/
class GravatarApi
{
  // default cached gravatar img
  protected $default_image;

  // possible to put : 3 days, 1 week, and whatever you want according to php strtotime function
  protected $expire_ago;

  protected $image_size, $rating, $cache_dir;
  protected $cache_dir_name;
  protected $default_dir_name;

  protected $base_url = "http://www.gravatar.com";
  // gravatar ratings are only : G | PG | R | X
  protected $base_ratings = array('G', 'PG', 'R', 'X');

  public function __construct($image_size = null, $rating = null)
  {
    $this->default_image = sfConfig::get('app_gravatar_default_image', sfConfig::get('sf_plugins_dir').'/vjCommentPlugin/web/images/gravatar_default.png');
    $this->setDirectories();
    if (!is_dir($this->cache_dir))
    {
      if (false === @mkdir($this->cache_dir, 0777, true))
      {
        throw new sfCacheException(sprintf('Failed to make cache directory "%s" while generating gravatar image.', dirname($this->cache_dir)));
      }
    }

    $this->expire_ago = sfConfig::get('app_gravatar_cache_expiration', '3 days');

    if (is_null($image_size) || $image_size > 80 || $image_size < 1)
    {
      $this->image_size = sfConfig::get('app_gravatar_default_size', 80);
    }
    else
    {
      $this->image_size = $image_size;
    }

    if (is_null($rating) || !in_array($rating, $this->base_ratings))
    {
      $this->rating = sfConfig::get('app_gravatar_default_rating', 'G');
    }
    else
    {
      $this->rating = $rating;
    }
  }


  /**
   * constructs path to gravatar (with size, rating, md5 email and a default image to redirect to (if not found))
   *
   * @return String
   * @author Mickael Kurmann
   **/
  protected function buildGravatarPath($md5_email)
  {
    return $this->base_url.'/avatar.php?gravatar_id='.$md5_email.
                           '&size='.$this->image_size.
                           '&rating='.$this->rating.
                           '&default=http://www.default.com';
  }

  /**
   * Check if a gravatar is avaible on gravatar.com
   *
   * @return boolean
   * @author Mickael Kurmann
   **/
  public function hasGravatar($md5_email)
  {
    // TODO try cache !
    $ch = curl_init($this->buildGravatarPath($md5_email));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    //--- Start buffering : HIDE CURL EXEC RETURN ...
    ob_start();
    curl_exec($ch);
    ob_end_clean();
    //--- End buffering and clean output

    $session_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // 200 == page with no error, else 301 == redirect (no gravatar) or 404... or whatever
    if ($session_code == 200)
    {
      return true;
    }

    return false;
  }

  /**
   * check for a cache hit - if found check if file is within expiry time
   *
   * @return void
   * @author Mickael Kurmann
   **/
  protected function isCacheValid($file_path)
  {
    if (file_exists($file_path))
    {
      if (filectime($file_path) < strtotime("+".$this->expire_ago))
      {
        // file exists and cache is valid
        return true;
      }
      else
      {
        // file exists but cache has expired
        unlink($file_path);
      }
    }

    // no file
    return false;
  }

  // get the gravatar to the cache, if email has a gravatar and it does not
  // already exist (or has expired)
  public function getGravatar($email)
  {
    $md5_email = md5($email);
    $file = $this->cache_dir.$md5_email.'.png';

    // the cache is valid, return the cached image
    $to_return = $md5_email;

    // check the cache
    if (!$this->isCacheValid($file))
    {
      // no image in cache
      if ($this->hasGravatar($md5_email))
      {
        $path = $this->buildGravatarPath($md5_email);
      }
      else
      {
        // no gravatar --> get the plugin default one
        $path = realpath($this->default_image);
        if($path === false)
        {
          return false;
        }
        $dir = dirname($path).DIRECTORY_SEPARATOR;
        $to_return = str_replace($dir, '', $path);
        $file = $this->cache_dir.$to_return;
      }

      $new_file = fopen($file, 'w+b');
      $gravatar_img = file_get_contents($path, 'rb');
      // image on gravatar.com --> save it in cache
      fwrite($new_file, $gravatar_img);
    }

    return str_replace(DIRECTORY_SEPARATOR, '/', $this->cache_dir_name).$to_return;
  }

  protected function setDirectories()
  {
    $gravatar_cache_dir_name = sfConfig::get('app_gravatar_cache_dir_name', 'g_cache');

    $this->cache_dir = $this->clearPath(sfConfig::get('sf_web_dir')
                        .DIRECTORY_SEPARATOR
                        .$this->getGravatarUploadDir()
                        .DIRECTORY_SEPARATOR
                        .$gravatar_cache_dir_name
                        .DIRECTORY_SEPARATOR);
    $this->cache_dir_name = str_replace(sfConfig::get('sf_web_dir'), '', $this->cache_dir);
  }

  protected function hasGravatarUploadDir()
  {
    return !is_null(sfConfig::get('app_gravatar_upload_dir'));
  }

  protected function getGravatarUploadDir()
  {
    return $this->clearPath(sfConfig::get('app_gravatar_upload_dir', str_replace(sfConfig::get('sf_web_dir'), '', sfConfig::get('sf_upload_dir'))));
  }

  protected function clearPath($path)
  {
    return str_replace("//", "/", $path);
  }
}