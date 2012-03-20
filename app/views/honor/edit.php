<div id="edit-honor" class="popup">
  <h2>添加荣誉</h2>
  <form id="edit-honor-form" method="POST" action="<?php echo SITE_BASE; ?>/honor/<?php echo $this->honor->getId(); ?>">
    <div class="field">
      <label>获得荣誉年月：</label>
      <select name="year">
        <?php for ($i = 2002; $i <= Util::currentYear(); $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->honor->getYear()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>年
      <select name="month">
        <option value=""></option>
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <option value="<?php echo $i; ?>"<?php if ($i == $this->honor->getMonth()) echo ' selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>月
    </div>
    <div class="field">
      <label>描述：</label>
      <input type="text" name="description" maxlength="200" value="<?php echo $this->honor->getDescription(); ?>"/>
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
<script type="text/javascript">window.honorId = '<?php echo $this->honor->getId(); ?>';</script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/honor/edit.js"></script>