<!DOCTYPE html>
<html>
    <head>
    <body>
  <!-- <?php if (isset($_SESSION['auth'])) { ?> -->
     
        <header>
 




 <div class="navbar">
  <div class="navbar-inner">
    <div class="container">
 
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="<?php echo $this->url->get('/'); ?>">HelpBro</a>
       
      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse">


 <ul class="nav nav-tabs">
        <ul class="nav">
        <li><a href="<?php echo $this->url->get('mail/in'); ?>">Входящие  </a></li>
        <li><a href="<?php echo $this->url->get('mail/out'); ?>">Отправленные  </a></li>
        <li><a href="<?php echo $this->url->get('avto/all'); ?>">Подвезут  </a></li>
        <li><a href="<?php echo $this->url->get('pass/all'); ?>">Подвезти  </a></li>
        <li>    <a href="<?php echo $this->url->get('/avto/my/'); ?>"> Мой Профиль</a>     </li>
      
        <!-- .nav, .navbar-search, .navbar-form, etc -->
      </div>
 
    </div>
  </div>
</div>



            <!-- end navigation-block -->
        </header>
 <!-- <?php } ?> -->



