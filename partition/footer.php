

<footer>
  <div class="row footer">
    <div class="col-lg-3 col-xs-12">
      <img src="image/gambung.png" alt="logo" height="120px">
    </div>
    <div class="col-lg-3 col-xs-12">
      <h5>Kontak</h5>
      <p>Mekarsari Gambung, Pasir Jambu, Kab. Bandung</p>
      <p>Telephone : +62</p>
      <p>email : contact@gambung.com</p>
    </div>
    <div class="col-lg-3 col-xs-12">
      <h5>Menu</h5>
      <p>Tentang Kami</p>
      <p>Product</p>
      <p>Contact Us</p>
      <p>Daftar / Masuk</p>
    </div>
    <div class="col-lg-3 col-xs-12">
      <h5>Ikuti Kami</h5>
      <a href="#"><img src="https://i2.wp.com/gofit.co.id/wp-content/uploads/2018/10/facebook-icon-white-on-black.png?ssl=1" alt="" height="40px"></a>
      <a href="#"><img src="https://image.flaticon.com/icons/png/512/39/39379.png" alt="" height="40px"></a>
      <a href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkRcsAuB4t7RaRNgcGUixcjoj9LUVYXVBkKgkPWYQwnJ67VQmi" alt="" height="40px"></a>
      <a href="#"><img src="https://www.pngkey.com/png/detail/43-432818_ig-logo-logo-ig-dog-crate-cover-png.png" alt="" height="40px"></a>
    </div>

  </div>

</footer>



<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
  $(document).ready(function(){

   function load_unseen_notification(view = '')
   {
    $.ajax({
     url:"fetch.php",
     method:"POST",
     data:{view:view},
     dataType:"json",
     success:function(data)
     {
      $('.notif').html(data.notification);
      if(data.unseen_notification > 0)
      {
       $('.count').html(data.unseen_notification);
     }
   }
 });
  }

  load_unseen_notification();
  
  $(document).on('click', '.dropdown-toggle', function(){
    $('.count').html('');
    load_unseen_notification('yes');
  });
  
  setInterval(function(){ 
    load_unseen_notification();; 
  }, 5000);
  
});
</script>
