<?php

class zsI18nApplicationTranslateExtract extends sfI18nApplicationExtract
{
  protected $messages;

  public function saveNewMessages()
  {
    $this->messages = $this->getNewMessages();

    parent::saveNewMessages();
  }

  public function doTranslate($dest, $force_all = false, $orig = null)
  {
  //get translation source
    $source = $this->getTranslationSource();

    $source->load();
    $this->messages = $source->read();
    $this->messages = array_shift($this->messages);

    if (!$orig) $orig = 'en';
    
    if ($this->messages)
    {
      echo "Starting translation\n";

      //loop thru messages
      foreach ($this->messages as $key=>$message)
      {
        $translated = $this->translate($message[0], $orig, $dest);
        $source->update($key, $translated, null);
        echo $message[0]." -- ".$translated;
      }
      echo "\n";
    }

  }

  protected function getTranslationSource()
  {
    $sources = $this->i18n->getMessageSource()->getSource(null);

    return $sources[0][0];
  }

  protected function translate( $sentence, $source, $dest )
  {
    $url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($sentence)."&langpair=".$source."%7C".$dest;

    // sendRequest
    // note how referer is set manually
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, sfConfig::get('app_i18nTranslatePlugin_referer', 'http://livepetitions.com' ));
    $body = curl_exec($ch);
    curl_close($ch);

    // now, process the JSON string
    $json = json_decode($body);
    // now have some fun with the results...
    if ($json->responseStatus == 200)
    {
      return $json->responseData->translatedText;
    } else
    {
      return false;
    }
  }
}