<?php

class psPageableFormPersistanceTable extends Doctrine_Table
{
  public static function deleteExpired()
  {
    $q = Doctrine::getTable('psPageableFormPersistance')->createQuery('p');
    $q->delete()
      ->addWhere('p.updated_at<?', date('Y-m-d H:i:s', time()-7200));

    return $q->execute();
  }

  public static function getOneById($id)
  {
    return Doctrine::getTable('psPageableFormPersistance')->findOneById($id);
  }
}