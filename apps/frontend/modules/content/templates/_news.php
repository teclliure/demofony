       <div id="news_box" class="box has-title noticias">
            <h1 class="hdr"><span class="inline icon-news"></span><?php echo __('News') ?></h1>
            <div class="box-content">
                <?php foreach ($contents as $new): ?>
                  <?php include_partial('content/newDivSmall',array('new'=>$new))?>
                <?php endforeach ?>
                
                <?php if(isset($pager)): ?><?php include_partial('home/doctrinePager',array('pager'=>$pager,'id'=>'news_box','url'=>url_for('content/showPage?class=GovermentNew&partial=news&limit=4'))) ?><?php endif; ?>
            </div>
        </div>