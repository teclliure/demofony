<?php
/**
 * vjCommentPlugin routing.
 *
 * @package    vjCommentPlugin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 */
class vjCommentRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   * @static
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    $r->prependRoute(
            'comment_reported',
            new sfRoute(
                    '/comment-reported',
                    array('module' => 'comment', 'action' => 'reported')
            )
    );
    $r->prependRoute(
            'comment_reporting',
            new sfRoute(
                    '/report-a-comment/:id/:num',
                    array('module' => 'comment', 'action' => 'reporting'),
                    array('id' => '\d+', 'num' => '\d+')
            )
    );
  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage comments.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForAdminComments(sfEvent $event)
  {
    $event->getSubject()->prependRoute('commentAdmin', new sfDoctrineRouteCollection(array(
      'name'                => 'commentAdmin',
      'model'               => 'Comment',
      'module'              => 'commentAdmin',
      'prefix_path'         => 'admin-for-comments',
      'with_wildcard_routes' => true,
      'requirements'        => array(),
    )));
  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage reported comments.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForAdminReportedComments(sfEvent $event)
  {
    $event->getSubject()->prependRoute('commentReportAdmin', new sfDoctrineRouteCollection(array(
      'name'                => 'commentReportAdmin',
      'model'               => 'CommentReport',
      'module'              => 'commentReportAdmin',
      'prefix_path'         => 'admin-for-reported-comments',
      'with_wildcard_routes' => true,
      'requirements'        => array(),
    )));
  }
}