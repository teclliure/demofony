<?php include_partial('opinion/list', array('object'=>$object, 'opinions'=>$object->getNonSelectedOpinions(),'numOpinions'=>$object->countOpinions())) ?>