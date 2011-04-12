<script>
  $('#opinion_form').load('<?php echo url_for('opinion/opinate?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
</script>
<?php include_partial('opinion/list', array('object'=>$object, 'opinions'=>$object->getOpinions())) ?>