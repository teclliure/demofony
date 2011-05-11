<?php

class Gmap {
  public static function loadMap ($width = 600, $height = 600, $contents = array()) {
    $map = new simpleGMapAPI();
    $geo = new simpleGMapGeocoder();

    $map->setWidth($width);
    $map->setHeight($height);
    $map->setBackgroundColor('#d0d0d0');
    $map->setMapDraggable(true);
    $map->setDoubleclickZoom(false);
    $map->setScrollwheelZoom(true);

    $map->showDefaultUI(false);
    $map->setMapType('HYBRID');
    $map->showMapTypeControl(false,'HORIZONTAL_BAR');
    $map->showNavigationControl(true, 'DEFAULT');
    $map->showScaleControl(false);
    $map->showStreetViewControl(false);

    // $map->setZoomLevel(14); // not really needed because showMap is called in this demo with auto zoom
    $map->setInfoWindowBehaviour('SINGLE_CLOSE_ON_MAPCLICK');
    $map->setInfoWindowTrigger('CLICK');
    
    if ($contents) {
      foreach ($contents as $content) {
        $map->addMarker($content->getLatitude(), $content->getLongitude(), $content, $content->getGmapHtml(), $content->getGmapIcon());
      }
    }
    else {
      $map->setCenterCoords('38.9102', '1.4324');
    }
    $map->setZoomLevel(13);
      
    return $map;
  }
  
  public static function loadMapOpinions ($width = 600, $height = 600, $content) {
    $ops = $content->getOpinionsLocated();
    $opsLike = $content->getOpinionsLikeLocated();
    $joins = $content->getJoinsLocated();
    
    $map = new simpleGMapAPI('map_opinions');
    $geo = new simpleGMapGeocoder();

    $map->setWidth($width);
    $map->setHeight($height);
    $map->setBackgroundColor('#d0d0d0');
    $map->setMapDraggable(true);
    $map->setDoubleclickZoom(false);
    $map->setScrollwheelZoom(true);

    $map->showDefaultUI(false);
    $map->setMapType('HYBRID');
    $map->showMapTypeControl(false,'HORIZONTAL_BAR');
    $map->showNavigationControl(true, 'DEFAULT');
    $map->showScaleControl(false);
    $map->showStreetViewControl(false);

    // $map->setZoomLevel(14); // not really needed because showMap is called in this demo with auto zoom
    $map->setInfoWindowBehaviour('SINGLE_CLOSE_ON_MAPCLICK');
    $map->setInfoWindowTrigger('CLICK');
    
    foreach ($ops as $op) {
      $map->addMarker($op->getSfGuardUser()->getProfile()->getLatitude(), $op->getSfGuardUser()->getProfile()->getLongitude(), $op, $op->getGmapHtml(), $op->getGmapIcon());
    }
    
    foreach ($opsLike as $op) {
      $map->addMarker($op->getSfGuardUser()->getProfile()->getLatitude(), $op->getSfGuardUser()->getProfile()->getLongitude(), $op, $op->getGmapHtml(), $op->getGmapIcon());
    }
    
    foreach ($joins as $join) {
      $map->addMarker($join->getSfGuardUser()->getProfile()->getLatitude(), $join->getSfGuardUser()->getProfile()->getLongitude(), $join, $join->getGmapHtml(), $join->getGmapIcon());
    }
    
    if (!count($ops) && !count($opsLike) && !count($joins)) {
      $map->setCenterCoords('38.9102', '1.4324');
      $map->setZoomLevel(13);
    }
  
    return $map;
  }
}