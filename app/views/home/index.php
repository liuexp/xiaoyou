<?php
$title = '首页';
include(__DIR__ . '/../layout/header.php');
?>

<section>
  <p>Redis is an open source, advanced <strong>key-value store</strong>.  It
  is often referred to as a <strong>data structure server</strong> since
  keys can contain <a href="/topics/data-types#strings">strings</a>,
  <a href="/topics/data-types#hashes">hashes</a>, <a href="/topics/data-types#lists">lists</a>,
  <a href="/topics/data-types#sets">sets</a> and <a href="/topics/data-types#sorted-sets">sorted
  sets</a>.</p>
  <p>
    <a href='/topics/introduction'>Learn more →</a>
  </p>
  <div class='columns'>
    <section>
      <h2>Try it</h2>
      <p>
        Ready for a test drive? Check this
        <a href='http://try.redis-db.com'>interactive tutorial</a>
        that will walk you through the most important features of
        Redis.
      </p>
    </section>
    <section>
      <h2>Download it</h2>
      <p>
        <a href='http://redis.googlecode.com/files/redis-2.4.9.tar.gz'>Redis 2.4.9 is the latest stable version.</a>
        Interested in release candidates or unstable versions?
        <a href='/download'>Check the downloads page.</a>
      </p>
    </section>
  </div>
</section>
<aside>
  <section data-limit='5' id='buzz'>
    <h2>What people are saying</h2>
    <ul></ul>
    <a href='/buzz'>More...</a>
  </section>
</aside>

<?php
include(__DIR__ . '/../layout/footer.php');
