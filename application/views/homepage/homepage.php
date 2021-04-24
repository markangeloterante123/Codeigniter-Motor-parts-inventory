<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Denver's Cycle Motorparts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/aos.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/style.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/userProfile/logo.png">
    
  </head>


  <body  data-spy="scroll" data-target=".site-navbar-target" data-offset="300" >
 

  <div id="overlayer"></div>

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header style="" class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class=""><img style="border: solid 5px darkorange; border-radius: 50%; width: 15vh; height: 15vh;" src="<?php echo base_url(); ?>assets/userProfile/logo.png"></div>
          <div class=""><h4 style="margin-left:5px;"> Denver Cycle Motorparts</h4></div>
          <div>
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-xl-block">
                <!-- <li><a href="#work-section" class="nav-link">Product</a></li>
                <li><a href="#contact-section" class="nav-link">Contact Us</a></li> -->
                
              </ul>
            </nav>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-xl-block">
                <li class="cta"><a class="nav-link" ><span class="border bg-success rounded text-white border-danger" data-toggle="modal" data-target="#myModal">Log In</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-xl-none site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div  class="site-section section-2" id="work-section" data-aos="fade">
      
      <div class="owl-carousel nonloop-block-13 ">

        <?php 
          foreach ($this->load->model_users->display() as  $value) {
            $pic = $value->pic;
            $name= $value->name;
            $brand=$value->brand;
        ?>
          <a   class="work-thumb" href="<?php echo base_url(); ?>assets/uploadPic/<?php echo $pic; ?>" data-fancybox="gallery">
            <div class="work-text">
              <h3><?php echo $name ?></h3>
              <span class="category"><?php echo $brand; ?></span>
            </div>
            <img style="width: 400px; height: 350px;" src="<?php echo base_url(); ?>assets/uploadPic/<?php echo $pic; ?>" alt="Image" class="img-fluid">
          </a> 
        <?php } ?>
          
      </div>

    </div>

   <!--  <div class="site-section" id="contact-section"  data-aos="fade">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-md-6 mr-auto order-2 order-md-1">
            
            <h2 class="section-title mb-3">Contact Us</h2>
            <p class="mb-5">For More Information about our Products just sent a message in these forn</p>
          
            <form method="post">
              <div class="form-group row">
                <div class="col-md-6 mb-4">
                  <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Contact No.">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" id="" cols="30" rows="5" placeholder="Write your message here."></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <input type="submit" class="btn btn-success py-3 px-5 btn-block" value="Send Message">
                </div>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </div> -->

  
     
    <footer>
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --><!-- 
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a> -->
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
    </footer>


<style type="text/css">
    
<style> 
    /*set border to the form*/ 
      
    form { 
        border: 3px solid #f1f1f1; 
    } 
    /*assign full width inputs*/ 
      
    input[type=text], 
    input[type=password] { 
        color:black;
        background: none;
        border: none;
        border-bottom: 5px solid green;
        padding: 10px;
        width: 100%; 
        padding: 12px 20px; 
        margin: 8px 0; 
        display: inline-block; 
        box-sizing: border-box; 
    } 
    /*set a style for the buttons*/ 
      
    button { 
        background-color: #4CAF50; 
        color: white; 
        padding: 14px 20px; 
        margin: 8px 0; 
        border: none; 
        cursor: pointer; 
        width: 100%; 
    } 
    /* set a hover effect for the button*/ 
      
   /* button:hover { 
        opacity: 0.8; 
    } */
    input[type=submit]:hover{
        opacity: 0.8;
        color:black;
       background: white;   
    }
    /*set extra style for the cancel button*/ 
     .container a:hover { 
       opacity: 0.8;
       color:black;
       background: white;   
    } 
    .cancelbtn { 
        width: auto; 
        padding: 10px 18px; 
        background-color: #f44336; 
    } 
    /*centre the display image inside the container*/ 
      
    .imgcontainer { 
        text-align: center; 
        margin: 24px 0 12px 0; 
    } 
    /*set image properties*/ 
      
    img.avatar { 
        width: 40%; 
        border-radius: 50%; 
        border: 3px solid green;
    } 
    /*set padding to the container*/ 
      
    .container { 
        padding: 16px; 
        color:black;
      } 
    /*set the forgot password text*/ 
      
    span.psw { 
        float: right; 
        padding-top: 16px; 
    } 
    /*set styles for span and cancel button on small screens*/ 
      
    @media screen and (max-width: 300px) { 
        span.psw { 
            display: block; 
            float: none; 
        } 
        .cancelbtn { 
            width: 100%; 
        } 
    } 
</style> 
</style>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div  class="modal-content">
            <form action="<?php echo base_url(); ?>User/login" method="post">
                    <div class="imgcontainer"> 
                      <img src="<?php echo base_url(); ?>assets/userProfile/logo.png"alt="Avatar" class="avatar"> 
                    </div> 
              
                    <div class="container"> 
                       
                        <input type="text" placeholder="Enter Username" id="users" name="users" required> 
              
                      
                        <input type="password" placeholder="Enter Password" id="pass" name="pass" required> 
                        <input style="border-radius:25px; height: 8vh; font-size: 24px;" type="submit" class="btn btn-block btn-success" value="Log In"> 
                        <a data-toggle="modal" data-target="#createAccount" data-dismiss="modal" aria-label="Close" style="margin-top: 25px;" href="#" class="btn btn-block btn-info">Create Account</a>
                    </div> 
            </form>
        </div>
    </div>
</div>

<div id="createAccount" class="modal fade">
    <div class="modal-dialog modal-login">
        <div  class="modal-content">
            <form action="<?php echo base_url(); ?>pages/create_users" method="post">
               <div class="container"> 
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" required="required" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="contact" name="contact" required="required" placeholder="Contact No.">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="users" name="users" required="required" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <div class="clearfix">
                        </div>
                        <input type="password" id="pass" name="pass" class="form-control" required="required" placeholder="Password">
                    </div> 
                    <input style="border-radius:25px; height: 8vh; font-size: 24px;" type="submit" class="btn btn-block btn-success" value="Create Account"> 
                    <a data-toggle="modal" data-target="#myModal" data-dismiss="modal" aria-label="Close" style="margin-top: 25px;" href="#" class="btn btn-block btn-info">Already have account</a>
                </div> 
            </form>
        </div>
    </div>
</div>

  </div> <!-- .site-wrap -->

  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery-ui.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/aos.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.fancybox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.sticky.js"></script>
  <script src="<?php echo base_url(); ?>assets/homepage/js/main.js"></script>
    
  
  </body>
</html>
