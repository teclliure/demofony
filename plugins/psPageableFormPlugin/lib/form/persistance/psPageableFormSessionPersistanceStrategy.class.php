<?php

/**
 * Persistance strategy based on session.
 *
 * This strategy is well for middle length forms (3-6 pages)
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class psPageableFormSessionPersistanceStrategy implements psPageableFormPersistanceStrategy
{
  private
    $user = null,
    $attributeKey,
    $forceClear = false;

  /**
   * @param sfUser $user User object
   * @param string $attributeKey Name of user's attribute contains form values
   * @param boolean $forceClear Force attributes clear even if method sfUser#shutdown won't be called on end of request
   */
  public function __construct(sfUser $user, $attributeKey = 'PageableForm', $forceClear = false)
  {
    $this->user = $user;
    $this->attributeKey = (string) $attributeKey;
    $this->forceClear = (boolean) $forceClear;
  }

  public function persist(psPageableForm $form)
  {
    $values = ((array) $form->getValues()) + $this->getValues();

    $this->user->setAttribute($this->attributeKey, $values);
  }

  public function getValues()
  {
    $values = (array) $this->user->getAttribute($this->attributeKey);
    return $values;
  }

  public function clear()
  {
    $this->user->setAttribute($this->attributeKey, null);

    if($this->forceClear)
    {
      $this->clearImmediately();
    }
  }

  private function clearImmediately()
  {
    $storage = $this->getStorage();

    $storageAttributes = $storage->read(sfUser::ATTRIBUTE_NAMESPACE);

    if(isset($storageAttributes['symfony/user/sfUser/attributes'][$this->getAttributeKey()]))
    {
      $storageAttributes['symfony/user/sfUser/attributes'][$this->getAttributeKey()] = null;
    }
    $storage->write(sfUser::ATTRIBUTE_NAMESPACE, $storageAttributes);
  }

  private function getStorage()
  {
    //break encapsulation principle to retrive storage object from user
    $reflection = new ReflectionObject($this->user);
    $storageProperty = $reflection->getProperty('storage');
    $storageProperty->setAccessible(true);
    $storage = $storageProperty->getValue($this->user);

    return $storage;
  }

  public function setAttributeKey($key)
  {
    $this->attributeKey = (string) $key;
  }

  public function setForceClear($flag)
  {
    $this->forceClear = (boolean) $flag;
  }

  public function isForceClear()
  {
    return $this->forceClear;
  }

  public function getAttributeKey()
  {
    return $this->attributeKey;
  }
}