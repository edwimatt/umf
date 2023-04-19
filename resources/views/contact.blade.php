@include('includes.header')
<body id="page-top">
   <!-- Navigation-->
   @include('includes.nav')
   <section class="section">
      <div class="container">
         <div class="text-left">
            <h2 class="section-heading mb-4">Contact Us</h2>
         </div>
         <div class="row">
            <div class="col-md-12">
               <?PHP
               if(isset($_GET['s'])){
               ?>
               <div class="alert alert-info" role="alert">
                  Thank you for your email. We will look into it and get back to you soon.
               </div>
                  <?PHP } ?>
               <form enctype="multipart/form-data" method="post" action="{{url('/post-contact')}}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="exampleInputEmail1">Name</label>
                     <input type="text" name="name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                     <input type="email" name="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Message</label>
                     <textarea class="form-control" rows="5" name="message" id="comment" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </section>
   @include('includes.footer')
</body>
</html>