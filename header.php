<header class="header">
  <div class="header_logo"><img src="/agency/site/templates/img/logo.jpg"></div>
  <div class="header_links">
      <a class="social_links" href="https://www.facebook.com/elbedroom/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a class="social_links" href="https://www.facebook.com/elbedroom/"><i class="fa fa-twitter" aria-hidden="true"></i></a>
      <a class="social_links" href="https://www.facebook.com/elbedroom/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      <a class="social_links" href="https://www.facebook.com/elbedroom/"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
      <?  if (($user->isLoggedin())) {  ?>
        <a class="social_links" href="https://www.facebook.com/elbedroom/"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
      <?  } ?>
  </div>
</header>