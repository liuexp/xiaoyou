<?php
$title = '邀请同学';
$stylesheets = array('invite');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <h1>邀请同学</h1>
  <form id="invite" method="POST">
    <fieldset>
      <legend>邀请列表</legend>
      <div class="field">
        <label for="emails">请填入您要邀请的同学的邮件地址（每行一个）</label>
        <textarea class="monofont" tabindex="1" id="emails" name="emails" rows="10" cols="45"></textarea>
      </div>
    </fieldset>  
    <div class="action">
      <button type="submit" class="classy primary" data-afterclick="正在提交邀请⋯⋯">
        <span>发送邀请邮件</span>
      </button>
    </div>
  </form>
</section>
<aside>
  <h2>填写说明</h2>
  <ul>
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
    <li>鹅鹅鹅</li>
  </ul>
</aside>
<?php
include(__DIR__ . '/../layout/footer.php');
