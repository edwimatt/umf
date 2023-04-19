@include('includes.header')
<body id="page-top">
   <!-- Navigation-->
   @include('includes.nav')
   <section class="section">
      <div class="container">
         <div class="text-left">
            <h2 class="section-heading mb-4">Hospital Registration</h2>
         </div>
         <div class="row">
            <div class="col-md-12">
               <form enctype="multipart/form-data" method="post" action="{{url('/post-contact')}}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="exampleInputEmail1">First Name</label>
                     <input type="text" name="first_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Last Name</label>
                     <input type="text" name="last_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Hospital Name</label>
                     <input type="text" name="hospital_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                     <input type="email" name="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Password</label>
                     <input type="password" name="password" class="form-control" required>
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