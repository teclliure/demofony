<?php

/**
 * PluginCommentReport table.
 *
 * @package    vjCommentPlugin
 * @subpackage model
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class PluginCommentTable extends Doctrine_Table
{

    public function getAllModels()
    {
        $q = Doctrine_Query::create()
                        ->select('record_model')
                        ->from('Comment')
                        ->groupBy('record_model')
                        ->execute(array(), Doctrine::HYDRATE_ARRAY);
        return $q;
    }

    public function getAdminQuery(Doctrine_Query $q)
    {
        $ra = $q->getRootAlias($q);
        $q->leftJoin($ra . '.User u');
        return $q;
    }

}
