<!-- Footer-->
<footer class="footer py-4">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6 pb-2 text-left center">Copyrights © <span id="year"></span>.  All rights reserved</div>
         <div class="col-md-6 pb-2">
            <p class="app-btns">
               <a href="<?php echo env("ANDROID_URL"); ?>"><img src="<?PHP echo asset('assets/img/google-btn.png') ?>" alt="google button"></a>
               <a href="<?php echo env("IOS_URL"); ?>" ><img src="<?PHP echo asset('assets/img/apple-btn.png') ?>" alt="google button"></a>
            </p>
         </div>
      </div>
   </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="<?PHP echo asset('assets/new-css/js/scripts.js') ?>"></script>
</body>
</html>