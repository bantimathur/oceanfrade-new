<style>
.topnav { width: 100%; background: #0075be; display: block; float: left; }
.topnav nav > ul { float: right; }
.topnav nav > ul > li { text-align: center; line-height: 40px; margin-left: 70px; list-style-type: none; }
.topnav nav > ul li ul li { width: 100%; text-align: left; }
.topnav nav ul li:hover { cursor: pointer; position: relative; }
.topnav nav ul li:hover > ul { display: block; }
.topnav nav ul li:hover > a { color: #777; }
.topnav nav > ul > li > a { cursor: pointer; display: block; outline: none; width: 100%; text-decoration: none; }
.topnav nav > ul > li { float: left; }
.topnav nav a { color: white; }
.topnav nav > ul li ul { display: none; position: absolute; left: 0; top: 100%; width: 100%; z-index: 2000; }
.topnav nav > ul li ul li > a { text-decoration: none; }
.topnav [type="checkbox"], .topnav label { display: none; }
@media only screen and (min-width:200px) and (max-width:767px) {
.topnav nav ul { display: none; }
.topnav label { display: block; background: #fff; width:50px; height: 40px; cursor: pointer; position: absolute; right: 17px; top:10px;border-radius: 0px;border: 1px solid #0075be;}
.topnav label:after { content: ''; display: block; width:40px; height: 3px; background: #0075be; margin:9px 5px 15px 5px; box-shadow: 0px 10px 0px #0075be, 0px 20px 0px #0075be }
.topnav [type="checkbox"]:checked ~ ul { display: block; z-index: 9999; position: absolute; right:0px; left:0px; }
.topnav nav a {color: #fff;background: #0075be;padding: 5px; }
.topnav nav ul li { display: block; float: none; width: 100%; text-align: left; background: #0075be; text-indent: 20px; }
.topnav nav > ul > li { margin-left: 0px; }
.topnav nav > ul li ul li { display: block; float: none; }
.topnav nav > ul li ul { display: block; position: relative; width: 100%; z-index: 9999; float: none; }
}
</style>
<div class="topnav">
  <nav>
    <div class="fix-content">
      <input type="checkbox" id="nav" />
      <label for="nav"></label>
      <ul>
        <li><a title="" href="<?php echo $this->config->site_url()?>">Home</a></li>
        <li><a href="<?php echo $this->config->site_url()?>about-us">About</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>services">Services</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>incoterms">INCOTERMS</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>glossary">GLOSSARY</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>important-link">IMPORTANT LINKS</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>education">EDUCATION</a></li>
        <li><a href="<?php echo $this->config->site_url()?>">QUOTE</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>documents">DOCUMENTS</a></li>
        <li><a  href="<?php echo $this->config->site_url()?>faq">FAQ</a></li>
        <li><a   href="<?php echo $this->config->site_url()?>how-lcl-works">HOW LCL WORKS</a></li>
        <li><a   href="<?php echo $this->config->site_url()?>contact-us">Contact Us</a></li>
        <?php if($username != "") { ?>
        <li><a href="<?php echo $this->config->site_url()?>secure/logout">Logout</a></li>
        <?php } else  { ?>
        <li><a  class='logincc' href="<?php echo $this->config->site_url()?>login">Login</a></li>
        <li><a  class='logincc' href="<?php echo $this->config->site_url()?>register">Signup</a></li>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92786622-1', 'auto');
  ga('send', 'pageview');

</script>