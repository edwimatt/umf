@include('includes.header')
<body id="page-top">
   <!-- Navigation-->
   @include('includes.nav')
   <!-- Masthead-->
  <br>
  <br>
  <br>
  <br>
   <!-- About-->
   <section class="page-section" id="about">
      <div class="container">
         <div class="text-center">
            <h2 class="section-heading">Understanding My Facility</h2>
            <p>Healthcare facilities are extremely complex, costly to operate, heavily regulated. They contain
                multiple utility systems that provide safety and the required environment of care for all patients,
                visitors and associates. Unfortunately, most healthcare associates lack the necessary understanding
                of these critical systems which put your facility at a higher risk of: non-compliance, increasing your
                operating budget and decreasing your patient, associates and visitor’s safety and satisfaction.
                WE UNDERSTAND THAT KNOWLEDGE IS POWER. Our experts created UMF a unique and simple tool
                to enhance the knowledge of all healthcare associates. With the use of our unique and innovated
                APP you can educate and engage all your associates so you can achieve significant savings on your
                facility operating budget and improve the communication, safety and satisfaction of your patients,
                employees and everyone else who enters your facilities</p>
         </div>
      </div>
   </section>
   <!-- Features-->

   <!-- Testimonials-->

   @include('includes.footer')
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
   <script>
      $(document).ready(function(){
          $("#testimonial-slider").owlCarousel({
              items:2,
              itemsDesktop:[1000,2],
              itemsDesktopSmall:[980,2],
              itemsTablet:[768,2],
              itemsMobile:[650,1],
              pagination:true,
              navigation:false,
              slideSpeed:1000,
              autoPlay:true
          });
          document.getElementById("year").innerHTML = new Date().getFullYear();
      });
      
   </script>
</body>
</html>