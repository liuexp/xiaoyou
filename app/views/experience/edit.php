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
      <label>类型：</label>
      <select name="type">
        <option value="bachelor"<?php if ($this->experience->getType() == 'bachelor') echo ' selected'; ?>>本科</option>
        <option value="master"<?php if ($this->experience->getType() == 'master') echo ' selected'; ?>>硕士</option>
        <option value="doctor"<?php if ($this->experience->getType() == 'doctor') echo ' selected'; ?>>博士</option>
        <option value="postdoc"<?php if ($this->experience->getType() == 'postdoc') echo ' selected'; ?>>博士后</option>
        <option value="work"<?php if ($this->experience->getType() == 'work') echo ' selected'; ?>>工作</option>
      </select>
    </div>
    <div class="field">
      <label>学校/单位：</label>
      <input type="text" name="location" maxlength="200" value="<?php echo htmlspecialchars($this->experience->getLocation()); ?>"/>
    </div>
    <div class="field">
      <label>专业/方向：</label>
      <input type="text" name="major" maxlength="200" value="<?php echo htmlspecialchars($this->experience->getMajor()); ?>"/>
    </div>
    <div class="field">
      <label>导师：</label>
      <input type="text" name="mentor" maxlength="200" value="<?php echo htmlspecialchars($this->experience->getMentor()); ?>"/>
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
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/experience/edit.min.js"></script>