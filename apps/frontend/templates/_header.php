    <div id="header" class="misc misc-header-bar">
        <?php echo link_to ('&nbsp;','@homepage',array('class'=>'logo misc misc-logo'))?>
        <ul>
          <li class="link">
            <a href="#"><?php echo __('Last') ?></a>
          </li>
          <li class="link">
            <a href="#"><?php echo __('More viewed') ?></a>
          </li>
          
          <li class="filter">
          <script type="text/javascript">
          $(document).ready(function () {
            $('#filter select').change(function () {
              var myform = $(this).parent();
              myform.submit();
            });
          });
          </script>
            <?php $filterForm = new FilterByCategoryOrRegionForm () ?>
            <form action="<?php echo url_for('content/filter') ?>" method="post" style="margin: 0" id="filter">
            <?php echo $filterForm['regions']->render() ?>
            <?php echo $filterForm['categories']->render() ?>
            <?php echo $filterForm->renderHiddenFields() ?>
            </form>
          </li>
          <li class="search">
            <form action="#" class="misc misc-search">
              <input name="q" />
            </form>
          </li>
        </ul>
      </div>
