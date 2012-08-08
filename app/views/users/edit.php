<div id="edit-users">
    <h1>编辑用户</h1>
  <form id="edit-users-form" method="POST" action="<?php echo SITE_BASE; ?>/manage_users/<?php echo $this->users->getId(); ?>">
      <input type="hidden" name="type" value="post"/>
      <div class="field">
        <label for="realname">真实姓名</label>

        <input class="monofont" type="text" id="realname" name="realname" maxlength="200" value="<?php echo $this->users->getRealname(); ?>"/>
      </div>
      <div class="field">
        <label for="stuid">学号</label>
        <input class="monofont" type="text" id="stuid" name="stuid" maxlength="200" value="<?php echo $this->users->getStudentNumber(); ?>"/>
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
<script type="text/javascript">window.userId = '<?php echo $this->users->getId(); ?>';</script>
<script type="text/javascript" src="<?php echo SITE_BASE; ?>/js/users/edit.min.js"></script>
