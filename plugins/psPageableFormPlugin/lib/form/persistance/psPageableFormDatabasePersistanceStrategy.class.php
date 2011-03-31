<?php

/**
 * Persistance strategy based on database.
 *
 * This strategy is well for long forms (more than 6 pages).
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class psPageableFormDatabasePersistanceStrategy implements psPageableFormPersistanceStrategy
{  
  private 
    $user = null,
    $key,
    $exists = true,
    $model = null,
    $attributeKey;

  public function __construct(sfUser $user, $attributeKey = 'psPageableFormKey')
  {
    $this->user = $user;
    $this->attributeKey = (string) $attributeKey;

    $key = $this->user->getAttribute($this->attributeKey);
    $this->key = $key ? $key : $this->generateKey();
  }

  public function persist(psPageableForm $form)
  {
    $model = $this->getPersistanceObject();
    $values = $model->cleanValues;
    $values = ((array) $form->getValues() + (array) $values);

    $model->cleanValues = $values;
    $model->save();
  }

  private function generateKey()
  {
    $key = md5(time().rand(1000, 99999));
    $this->user->setAttribute($this->attributeKey, $key);
    $this->exists = false;
    return $key;
  }

  private function getPersistanceObject()
  {
    if(!$this->model)
    {
      if($this->exists)
      {
        if(!($this->model = psPageableFormPersistanceTable::getOneById($this->key)))
        {
          $this->model = $this->createNewPersistanceObject();;
        }
      }
      else
      {
        $this->model = $this->createNewPersistanceObject();
      }
    }

    return $this->model;
  }

  private function createNewPersistanceObject()
  {
    $model = new psPageableFormPersistance();
    $model->set('id', $this->key);

    return $model;
  }

  public function getValues()
  {
    return ((array) $this->getPersistanceObject()->get('cleanValues'));
  }

  public function clear()
  {
    $this->getPersistanceObject()->delete();
    $this->user->setAttribute($this->attributeKey, null);
  }
}