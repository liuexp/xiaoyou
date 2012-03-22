<div id="edit-paper" class="popup">
  <h2>编辑论文</h2>
  <form id="edit-paper-form" class="longlabel" method="POST" action="<?php echo SITE_BASE; ?>/paper/<?php echo $this->paper->getId(); ?>">
    <div class="field">
      <label>标题：</label>
      <input type="text" name="title" maxlength="200" value="<?php echo $this->paper->getTitle(); ?>"/>
    </div>
    <div class="field">
      <label>作者列表：</label>
      <input type="text" name="authors" maxlength="200" value="<?php echo $this->paper->getAuthors(); ?>"/>
    </div>
    <div class="field">
      <label>是否第一作者：</label>
      <input type="checkbox" name="is_first_author"<?php if ($this->paper->getIsFirstAuthor()) echo ' checked'; ?>/>
    </div>  
    <div class="field">
      <label>是否在交大期间发表：</label>
      <input type="checkbox" name="is_at_sjtu"<?php if ($this->paper->getIsAtSjtu()) echo ' checked'; ?>/>
    </div>  
    <div class="field">
      <label>是否最佳论文：</label>
      <input type="checkbox" name="is_best_paper"<?php if ($this->paper->getIsBestPAper()) echo ' checked'; ?>/>
    </div>
    <div class="field">
      <label>发表在：</label>
      <input type="text" name="publish_place" maxlength="200" value="<?php echo $this->paper->getPublishPlace(); ?>"/>
    </div>
    <div class="field">
      <label>发表年份：</label>
      <select name="publish_year">
        <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->paper->getPublishYear()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="failure" style="display:none"></div>
    <div class="action">
      <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
        <span>提交</span>
      </button>
    </div>
    <p class="clear"></p>
  </form>
</div>
<script type="text/javascript">window.paperId = '<?php echo $this->paper->getId(); ?>';</script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/paper/edit.js"></script>