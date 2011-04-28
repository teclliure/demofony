<?php


class sfPdoUnionPager extends sfPager
{
  protected
    $sql             = null,
    $objects         = null;

  /**
   * @see sfPager
   */
  public function init()
  {
    $this->resetIterator();

    $conn = Doctrine_Manager::connection();
    $pdo = $conn->execute($this->getSql());
    $this->setNbResults($pdo->rowCount());

    if (0 == $this->getPage() || 0 == $this->getMaxPerPage() || 0 == $this->getNbResults())
    {
      $this->setLastPage(0);
    }
    else
    {
      $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
      $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));
    }
  }

  /**
   * Get the query for the pager.
   *
   * @return Doctrine_Query
   */
  public function getSql()
  {
    return $this->sql;
  }

  /**
   * Set query object for the pager
   *
   * @param Doctrine_Query $query
   */
  public function setSql($sql)
  {
    $this->sql = $sql;
  }

  /**
   * Retrieve the object for a certain offset
   *
   * @param integer $offset
   *
   * @return Doctrine_Record
   */
  protected function retrieveObject($offset)
  {
    $conn = Doctrine_Manager::connection();
    $sql = $this->getSql().' LIMIT  1';
    if ($offset) $sql .= ' OFFSET '.$offset;
    $pdo = $conn->execute($sql);
    $pdo->setFetchMode(Doctrine_Core::FETCH_ASSOC);
    $items = $pdo->fetchAll();
    
    $objects = array();
    foreach ($items as $item) {
      $class = $item['class'];
      unset ($item['class']);
      $object = new $class;
      $object->fromArray($item);
      $objects[] = $object;
    }
    return $objects[0];
  }

  /**
   * Get all the results for the pager instance
   *
   * @param mixed $hydrationMode A hydration mode identifier
   *
   * @return Doctrine_Collection|array
   */
  public function getResults($hydrationMode = null)
  {
    if (!$this->objects) {
      $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
      $conn = Doctrine_Manager::connection();
      $sql = $this->getSql().' LIMIT '.$this->getMaxPerPage();
      if ($offset) $sql .= ' OFFSET '.$offset;
      $pdo = $conn->execute($sql);
      $pdo->setFetchMode(Doctrine_Core::FETCH_ASSOC);
      $items = $pdo->fetchAll();
      
      foreach ($items as $item) {
        $class = $item['class'];
        unset ($item['class']);
        $object = new $class;
        $object->assignIdentifier($item['id']);
        // $object->fromArray($item);
        $this->objects[] = $object;
      }
    }

    return $this->objects;
  }
}