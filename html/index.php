
<?php


    require("top.inc.php");
?>
<div class="container" id="home">
<section class="home" >

    <div class="image">
        <img src="images/veggies.jpg" alt="">
    </div>

    <div class="content">
        <span>fresh and organic</span>
        <h3>your daily need products</h3>
       
    </div>

</section>

</div>
<section class="top-container">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam laborum reiciendis enim odio excepturi laudantium repellendus. Ex culpa libero facere tempore accusantium Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui blanditiis totam, eligendi similique fugit minus est ipsum quod nam id officia unde quo.</p>

</section>

<section class="banner-container">

    <div class="banner">
        <img src="images/Milk.jpg" alt="">
        <div class="content">
            <h3>special offer</h3>
            <p>upto 45% off</p>
           
        </div>
    </div>

    <div class="banner">
        <img src="images/fruits.jpg" alt="">
        <div class="content">
            <h3>limited offer</h3>
            <p>upto 50% off</p>
          
        </div>
    </div>

</section>
<section class="top-container">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam laborum reiciendis enim odio excepturi laudantium repellendus. Ex culpa libero facere tempore accusantium Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui blanditiis totam, eligendi similique fugit minus est ipsum quod nam id officia unde quo. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem quaerat illo eum quae velit voluptatum eaque quam ducimus cupiditate tenetur fugit, earum cum assumenda porro incidunt quidem. Aliquid, repudiandae! Error minima necessitatibus corrupti porro.</p>

</section>

<section class="category" id="category">

    <h1 class="heading">shop by <span>category</span></h1>
    
    <div class="box-container" id="box"> 
      
      </div>

</section>
</div>
<section class="product" id="product" >

    <h1 class="heading">latest <span>products</span></h1>

    <div class="box-container" id="latest">
  

</div> 
</section>

<!-- product section ends -->



<!-- deal section ends -->

<section class="testimonials">
  <div class="container">
      <h1>What our Customer says </h1>
      <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus aperiam illo inventore ipsam ex voluptatibus dolor molestias minima nobis commodi!</p>
      <div class="row">
          <div class="col-md-4 text-center">
              <div class="profile">
                  <img src="images/delivery.jpeg" alt="" class="user">
                  <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, doloremque fugiat 
                 </blockquote>
                 <h3>Avni <span>Xyz at delhi</span></h3>
              </div>
          </div>
          <div class="col-md-4 text-center">
              <div class="profile">
                  <img src="images/spinach.jpeg" alt="" class="user">
                  <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, doloremque fugiat 
                 </blockquote>
                 <h3>Avni <span>Xyz at delhi</span></h3>
              </div>
          </div>
          <div class="col-md-4 text-center">
              <div class="profile">
                  <img src="images/tomato.jpeg" alt="" class="user" >
                  <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, doloremque fugiat 
                 </blockquote>
                 <h3>Avni <span>Xyz at delhi</span></h3>
              </div>
          </div>
      </div>
  </div> 
</section>

<!-- contact section starts  -->




<section class="contact" id="contact" >

    <h1 class="heading"> <span>contact</span> us </h1>

    <!-- <form method="post" id="contactform">

    

        <div class="inputBox">
           
            <input type="text" placeholder="name" name="name" id="name" required>
            
          
            <input type="email" placeholder="email" name="email" id="email" data-parsley-checkemail required>
          
        </div>

        <div class="inputBox">
            <input type="text" placeholder="contact number" name="contact" id="contact" required>
            <input type="text" placeholder="subject" name="sub"  id="sub" required>
        </div>

        <textarea placeholder="message"  id="msg" cols="30" rows="10" name="msg" required></textarea>

        <input type="submit" value="send message" class="btn">
        <input type="hidden" name="page"value="contact" value="contact" class="btn">
        <input type="hidden" name="action" value="contact" value="contact" class="btn">

    </form> -->
    <form class="row g-3" method="post" id="contactform">
  <div class="col-md-6">
    <label for="name" class="form-label">Enter your Name</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Enter email</label>
    <input type="email"  class="form-control" name="email" id="email" data-parsley-checkemail required>
  </div>
  <div class="col-md-6">
    <label for="contact" class="form-label">Contact</label>
    <input type="text" class="form-control" name="contact" id="contact" value="" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-minlength-message="please enter 10 digit number" data-parsley-validation-threshold="10" required/>
  </div>
  <div class="col-md-6">
    <label for="sub" class="form-label">Subject</label>
    <input type="text" class="form-control" id="sub" name="sub" required>
  </div>
  
  <div class="col-12">
  <label for="message">Message (20 chars min, 100 max) :</label>
  <textarea id="msg" class="form-control" name="msg" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character message.." data-parsley-validation-threshold="10"></textarea>
      </div>
  <div class="col-12">
  <input type="submit" value="send message" class="btn">
        <input type="hidden" name="page"value="contact"  value="contact" class="btn">
        <input type="hidden" name="action" value="contact" value="contact" class="btn">
  </div>
</form>

</section>



<section class="footer">

<div class="box-container">

    <div class="box">
        <a href="#" class="logo"><i class="fas fa-shopping-basket"></i>Milk-Island</a>
        <p>As Indians, everyone wants pure and fresh milk and other dairy products everyday. We "Milk-Isand" fullfill our customer demands with pure & fresh products with discount over market price.</p>
        <div class="share">
            <a href="#" class="btn fab fa-facebook-f"></a>
            <a href="#" class="btn fab fa-twitter"></a>
            <a href="#" class="btn fab fa-instagram"></a>
            <a href="#" class="btn fab fa-linkedin"></a>
        </div>
    </div>
    
    <div class="box">
        <h3>our location</h3>
        <div class="links">
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
        </div>
    </div>

    <div class="box">
        <h3>quick links</h3>
        <div class="links">
            <a href="#">home</a>
            <a href="#">category</a>
            <a href="#">product</a>
            <a href="#">deal</a>
            <a href="#">contact</a>
        </div>
    </div>

   

</div>

<h1 class="credit"> created by <span> Milk-Island Web Developer </span> | all rights reserved! </h1>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>

function manage_cart(pid,type)
{
   
    var qty = $("#qty").val();
    
    $.ajax({
        url:'ajax_action.php',
        type:'post',
        data:{page:'cart',pid:pid,qty:qty,action:type},
        success:function(data){
          $('.icon-button__badge').html(data)
        }
    })
}
  
$(document).ready(function(){
  

 displayData();
 latestProduct();

  setInterval(() => {
    displayData()   
  }, 30000);



  function displayData(){
         $.ajax({
             url:'manage_index.php',
             type:'post',
             success:function(response){
                 $('#box').html(response);
             }
         });
       }
    
   
    setInterval(() => {
        latestProduct()   
  }, 30000);

         function latestProduct(){
             $.ajax({
                 url:'Latestproduct.php',
                
                 type:"post",
                 success:function(response){
                     $('#latest').html(response);
                 }
             });
         }  
 
    function validatePhone(txtPhone) {
    var a = document.getElementById(txtPhone).value;
    var filter = /^[0-9-+]+$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}

  
$('#contactform').parsley();

$('#contactform').on('submit', function(event){

event.preventDefault();
$('#name').attr('required', 'required');

$('#name').attr('data-parsley-pattern', '^[a-zA-Z ]+$');
$('#email').attr('required', 'required');

$('#email').attr('data-parsley-type', 'email');

$('#sub').attr('required', 'required');

$('#sub').attr('data-parsley-pattern', '^[a-zA-Z ]+$');

$('#msg').attr('required', 'required');

$('#msg').attr('data-parsley-pattern', '^[a-zA-Z ]+$');

$('#contact').attr('required', 'required');






if($('#contactform').parsley().isValid())
{
    $.ajax({
      url:"ajax_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
     
      success:function(data)
      {
        
      if(data.success)
      {
        alert("Thank You");
        $('#contactform')[0].reset();
     
         
      }
         
        

      }
    });
}

 
  });
});
  
</script>
<script src="script.js"></script>
</body>
</html>