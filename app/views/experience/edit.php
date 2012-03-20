<div id="edit-experience" class="popup">
  <h2>编辑经历</h2>
  <form id="edit-experience-form" method="POST" action="<?php echo SITE_BASE; ?>/experience/<?php echo $this->experience->getId(); ?>">
    <div class="field">
      <label>开始年月：</label>
      <select name="start_year">
        <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->experience->getStartYear()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>年
      <select name="start_month">
        <option value=""></option>
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->experience->getStartMonth()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>月
    </div>
    <div class="field">
      <label>结束年月：</label>
      <select name="end_year">
        <option value="">至今</option>
        <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->experience->getEndYear()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>年
      <select name="end_month">
        <option value=""></option>
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->experience->getEndMonth()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>月
    </div>
    <div class="field">
      <label>地点：</label>
      <input type="text" name="location" maxlength="200" value="<?php echo $this->experience->getLocation(); ?>"/>
    </div>
    <div class="field">
      <label>描述：</label>
      <input type="text" name="description" maxlength="200" value="<?php echo $this->experience->getDescription(); ?>"/>
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
<script type="text/javascript">window.experienceId = '<?php echo $this->experience->getId(); ?>';</script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/experience/edit.js"></script>