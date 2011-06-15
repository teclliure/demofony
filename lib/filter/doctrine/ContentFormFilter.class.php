<?php

/**
 * Content filter form.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContentFormFilter extends BaseContentFormFilter
{
  public function configure()
  {
    unset($this['slug'],$this['latitude'],$this['longitude'],$this['image'],$this['video'],$this['image_x1'],$this['image_y1'],$this['image_x2'],$this['image_y2'],$this['views'],$this['updated_at']);
  }
}
