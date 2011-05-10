<?php

/**
 * Content
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Content extends BaseContent
{
  protected $possibilities = false, $possibilitiesSearched = false;
  
  public function addView() {
    $this->setViews($this->getViews() + 1);
    $this->save();
  }
  
  public function hasOpinated($user) {
    $query = Doctrine::getTable('OpinionLike')->createQuery('ol')->leftJoin('ol.Opinion o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('ol.user_id = ?',$user->getId());
    $opinionLike = $query->count();
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('o.user_id = ?',$user->getId());
    $opinion = $query->count();
    
    if ($opinion || $opinionLike) {
      return true;
    }
    else {
      return false;
    }
  }

  public function getOpinion($user) {
    $query = Doctrine::getTable('OpinionLike')->createQuery('ol')->leftJoin('ol.Opinion o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('ol.user_id = ?',$user->getId());
    $opinion = $query->execute()->getFirst();
    if (!$opinion) {
      $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('o.user_id = ?',$user->getId());
      $opinion = $query->execute()->getFirst();
    }
    
    if ($opinion) {
      return $opinion;
    }
    else {
      return false;
    }
  }
  
  public function getNonSelectedOpinions() {
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('o.selected = 0 OR o.selected IS NULL');
    return $query->execute();
  }
  
  public function getSelectedOpinions() {
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('o.selected = 1');
    return $query->execute();
  }
  
  public function countOpinions() {
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId());
    return $query->count();
  }
  
  public function countAllOpinions() {
    $query = Doctrine::getTable('OpinionLike')->createQuery('ol')->leftJoin('ol.Opinion o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId());
    $numOpinions = $query->count();
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId());
    $numOpinions += $query->count();
    return $numOpinions;
  }
  
  public function getOpinionsLocated() {
    $q =  Doctrine::getTable('Opinion')->createQuery('o')
    ->leftJoin('o.sfGuardUser u')
    ->leftJoin('u.Profile up')
    ->where('o.object_class = ?',get_class($this))
    ->andWhere('o.object_id = ?',$this->getId())
    ->andWhere('up.latitude != \'\' AND up.latitude IS NOT NULL');
    return  $q->execute();
  }

  public function getOpinionsLikeLocated() {
    $q = Doctrine::getTable('OpinionLike')->createQuery('ol')
    ->leftJoin('ol.Opinion o')
    ->leftJoin('ol.sfGuardUser u')
    ->leftJoin('u.Profile up')
    ->where('o.object_class = ?',get_class($this))
    ->andWhere('o.object_id = ?',$this->getId())
    ->andWhere('up.latitude != \'\' AND up.latitude IS NOT NULL');
    
    return $q->execute();
  }
  
  public function getCategories() {
    $query = $this->getCategoriesQuery();
    return $query->execute();
  }
  
  public function getRegions() {
    $query = $this->getRegionsQuery();
    return $query->execute();
  }
  
  public function getRegionsQuery() {
    return Doctrine::getTable('Region')->createQuery('r')->innerJoin('r.ContentHasRegion cr')->where('cr.type = ?',get_class($this))->andWhere('cr.content_id = ?',$this->getId());
  }
  
  public function getCategoriesQuery() {
    return Doctrine::getTable('Category')->createQuery('c')->innerJoin('c.ContentHasCategory cc')->where('cc.type = ?',get_class($this))->andWhere('cc.content_id = ?',$this->getId());
  }
  
  public function getRelatedContent($limit = 5) {
    $inheritedClasses = array('GovermentNew','CitizenProposal','GovermentProposal','GovermentConsultation','Workshop','CitizenAction');
    $sql = '';
    $selectFieldsQuery = Doctrine::getTable('Content')->getColumns();
    $select = '';
    foreach ($selectFieldsQuery as $key=>$selectField) {
      $select .= ','.$key;
    }
    foreach ($inheritedClasses as $key=>$class) {
      if ($key) $sql .= ' UNION ';
      $sql .= "( SELECT '$class' as class".$select.' FROM '.Doctrine::getTable($class)->getTableName();
      if ($class == get_class($this)) {
        $sql .= ' where id != '.$this->getId();
      }
      $sql .= ')';
    }

    $conn = Doctrine_Manager::connection();
    $pdo = $conn->execute($sql.' order by created_at desc limit '.$limit);
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
    return $objects;
  }
  
  public function getStrippedBody($length = 255) {
    return substr($this->getBody(),0,$length). ' ...';
  }
  
  public function hasJoinBox () {
    return is_subclass_of($this,'Action');
  }
  
  public function hasGraphBox() {
    if ($this->getPossibilities() && $this->getPossibilities()->count() > 1) {
      return true;
    }
    else return false;
  }
  
  public function hasCountBox() {
    if ($this->getPossibilities() && $this->getPossibilities()->count() == 1) return true;
    else return false;
  }
  
  public function countNumPossibilitiesAdded($possibility) {
    $query = Doctrine::getTable('OpinionLike')->createQuery('ol')->leftJoin('ol.Opinion o')->where('o.object_class = ?',get_class($this))->andWhere('o.opinion_possibility_id = ?',$possibility->getId())->andWhere('o.object_id = ?',$this->getId());
    $num = $query->count();
    $query = Doctrine::getTable('Opinion')->createQuery('o')->where('o.object_class = ?',get_class($this))->andWhere('o.object_id = ?',$this->getId())->andWhere('o.opinion_possibility_id = ?',$possibility->getId());
    $num += $query->count();
    return $num;
  }
  
  public function getPossibilityPercent($possibility) {
    return round($this->countNumPossibilitiesAdded($possibility)/$this->countAllOpinions()*100,2);
  }
  
  public function getPossibilities() {
    if (!$this->possibilitiesSearched) {
      $this->possibilitiesSearched = true;
      $className = get_class($this);
      
      $data = sfYaml::load(sfConfig::get('sf_root_dir').'/config/opinion.yml');
      if (isset($data['class'])) {
        foreach ($data['class'] as $key => $config) {
          if ($key == $className) {
            $group = Doctrine::getTable('OpinionPossibilityGroup')->findOneBy('slug',$config['group']);
            if ($group) {
              $query = Doctrine::getTable('OpinionPossibility')->createQuery('o')->innerJoin('o.OpinionPossibilityGroup g')->where('g.id = ?',$group->getId());
              $this->possibilities = $query->execute();
            }
          }
        }
      }
    }
    return $this->possibilities;
  }
  
  public function hasRegistered($user) {
    $query = Doctrine::getTable('ActionHasUser')->createQuery('au')->where('au.type = ?',get_class($this))->andWhere('au.action_id = ?',$this->getId())->andWhere('au.user_id = ?',$user->getId());
    return $query->count();
  }
  
  public function getGmapHtml() {
    SfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','I18N','Url'));
    return link_to($this->getSfGuardUser(),'user/showProfile?username='.$this->getSfGuardUser()->getUsername()).' '.__('added').' '.link_to ($this->getTitle(),'content/show?class='.get_class($this).'&slug='.$this->getSlug());
  }
  
  public function getGmapIcon() {
    return null;
  }
  
  public function getGmap() {
    if ($this->getLatitude() && $this->getLongitude()) {
      return GMap::loadMap('100%',100,array($this));
    }
    else return null;
  }
  
  public function getGmapOpinions() {
    return GMap::loadMapOpinions('100%',250,$this);
  }
}
