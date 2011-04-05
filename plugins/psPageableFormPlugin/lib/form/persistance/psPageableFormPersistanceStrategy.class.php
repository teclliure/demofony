<?php

/**
 * Interface of persistance strategy
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
interface psPageableFormPersistanceStrategy
{
  /**
   * Persist form data
   *
   * @param psPageableForm $form Pageable form
   * @return mixed
   */
  public function persist(psPageableForm $form);

  /**
   * Get form values from strategy
   * @return array
   */
  public function getValues();
  

  /**
   * Clear values from strategy
   */
  public function clear();
}