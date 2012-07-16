<?php
$title = '创建个人信息';
$stylesheets = array('new-profile');
include(__DIR__ . '/../layout/header.php');
?>
<section>
  <h1>创建个人信息</h1>
  <form id="new-profile" method="POST" action="<?php echo SITE_BASE; ?>/profiles">
    <fieldset>
      <legend>基本信息</legend>
      <blockquote>
        <p class="prolog">
          浮云游子意，落日故人情<br/>
          亲爱的校友，欢迎回家<br/>
          请提供真实信息，以便更密切的联系
        </p>
      </blockquote>
      <div class="field">
        <label for="start_year">入学年份：</label>
        <select id="start_year" name="start_year">
          <option></option>
          <?php for ($i = 1901; $i <= date('Y'); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="field">
        <label for="class_number">班级号(选填)：</label>
        <input class="textfield monofont" type="text" id="class_number" name="class_number" maxlength="4"/>
      </div>

      <div class="field">
        <label for="student_number">本科学号：</label>
        <input class="textfield monofont" type="text" id="student_number" name="student_number" maxlength="20"/>
      </div>
      <div class="field">
        <label for="birthday">生日：</label>
        <input class="textfield monofont Wdate" type="text" id="birthday" name="birthday" maxlength="10" onclick="WdatePicker()" placeholder="yyyy-mm-dd"/>
      </div>
      <div class="field">
        <label>性别：</label>
        <input type="radio" name="gender" value="M" id="genderM"/><label class="radio" for="genderM">男</label>
        <input type="radio" name="gender" value="F" id="genderF"/><label class="radio" for="genderF">女</label>
      </div>
      <div class="field">
        <label for="location">现居住地（详细地址）：</label>
        <input class="textfield monofont" type="text" id="location" name="location" maxlength="200"/>
      </div>
      <div class="field">
        <label for="post_number">邮政编码：</label>
        <input class="textfield monofont" type="text" id="post_number" name="post_number" maxlength="200"/>
      </div>
    </fieldset>
    <fieldset>
      <legend>联系方式</legend>
      <blockquote>
        <p class="prolog">
          联系方式只有登录用户可见<br/>
          请放心填写，方便其他同学与您联系 :-)<br/>
          这一部分是选填内容，稍后也可以修改
        </p>
      </blockquote>

      <div class="field">
        <label for="tele">固定电话：</label>
        <input class="textfield monofont" type="text" id="tele" name="tele" maxlength="200"/>
      </div>

      <div class="field">
        <label for="mobile">移动电话：</label>
        <input class="textfield monofont" type="text" id="mobile" name="mobile" maxlength="200"/>
      </div>

      <div class="field">
        <label for="mobile">MSN：</label>
        <input class="textfield monofont" type="text" id="mobile" name="mobile" maxlength="200"/>
      </div>


      <div class="field">
        <label for="email">常用Email：</label>
        <input class="textfield monofont" type="text" id="email" name="email" maxlength="200"/>
      </div>
      <div class="field">
        <label for="qq">QQ：</label>
        <input class="textfield monofont" type="text" id="qq" name="qq" maxlength="200"/>
      </div>
      <div class="field">
        <label for="renren">人人网主页地址：</label>
        <input class="textfield monofont" type="text" id="renren" name="renren" maxlength="200"/>
      </div>
      <div class="field">
        <label for="weibo">新浪微博ID：</label>
        <input class="textfield monofont" type="text" id="weibo" name="weibo" maxlength="200"/>
      </div>
	<div class="field">
        <label >隐私安全(查看权限)：</label>
          <input type="radio" name="privacy" value="0" id="privacy0" /><label class="radio2" for="privacy0">所有同学</label>
          <input type="radio" name="privacy" value="1" id="privacy1" /><label class="radio2" for="privacy1">相同年级</label>
          <input type="radio" name="privacy" value="2" id="privacy2" /><label class="radio2" for="privacy2">相同班级</label>
      </div>

    </fieldset>
    <fieldset>
      <legend>感恩·梦想</legend>
      <blockquote>
        <p class="prolog">
          无忘饮水思源意，有待乘风破浪时
        </p>
      </blockquote>
	<div class="field">
        <label for="subscription">希望校友频道提供</label>
        <select id="subscription" name="subscription" style="font-size: 15px;width: 130px;">
          <option></option>
          <option value=1>校友刊物</option>
          <option value=2>校友信息</option>
          <option value=3>学术研讨会信息</option>
          <option value=4>相关法律出版物目录</option>
        </select>
      </div>

      <div class="field">
        <span class="label">您对校友频道有何希望和建议</span>
        <textarea name="advices" class="monofont" rows="2" cols="44"></textarea>
      </div>
      <blockquote>
        <p class="prolog">
          感谢您耐心完成这份问卷！<br/>
          提交之后，除基本信息和联系方式外都不能更改<br/>
          请确认上述信息无误，然后“提交我的个人信息”
        </p>
      </blockquote>
    </fieldset>
    <div class="failure" style="display:none"></div>
    <div class="action">
      <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
        <span>提交我的个人信息</span>
      </button>
    </div>
    <p class="clear"></p>
  </form>
</section>
<aside>
  <h2>填写说明</h2>
  <ul>
    <li>学号如果记不住可以不填</li>
    <li>生日可以手工输入，格式类似2012-06-09</li>
    <li>提交之后，除基本信息和联系方式外都不能更改</li>
    <li>联系方式只有登录用户可见，不会泄露，请放心填写，方便其他同学与您联系</li>
  </ul>
</aside>
<?php
$javascripts = array('datepicker/WdatePicker', 'jquery-1.7.1.min', 'profile/new.min');
include(__DIR__ . '/../layout/footer.php');
