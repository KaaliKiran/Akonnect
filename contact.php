<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact - Modern Business - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
          <a class="navbar-brand" href="index.html">SKN Global Foundation</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="About.html">About</a>
                    </li>                     
                    <li class="dropdown">
                        <a href="Admissions.html">Admissions</a>                       
                    </li>                    
					<li><a href="#contact">Faculty</a>
                    </li>
					<li><a href="#contact">Events</a>
                    </li>
					<li><a href="#contact">Gallery</a>					 
                    </li>
					<li><a href="#contact">Prospectus</a>					 
                    </li>
					 <li><a href="Contact.php">Contact Us</a>
                    </li>
   		</ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

    <!-- Page Content -->

    <div class="container">
      
      <div class="row">
      
        <div class="col-lg-12">
          <h1 class="page-header">Contact</h1>
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Contact</li>
          </ol>
        </div>
        
        <div class="col-lg-12">
          <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;hl=12.3343461&amp;spn=76.6062059&amp;t=m&amp;z=17&amp;output=embed"></iframe>
        </div>

      </div><!-- /.row -->
  
      <div class="row">

        <div class="col-sm-8">
          <h3>Let's Get In Touch!</h3>
          <p>For Any Further queries and information. Please leave us with your information.</p>
			<?php  

                // check for a successful form post  
                if (isset($_GET['s'])) echo "<div class=\"alert alert-success\">".$_GET['s']."</div>";  
          
                // check for a form error  
                elseif (isset($_GET['e'])) echo "<div class=\"alert alert-danger\">".$_GET['e']."</div>";  

			?>
            <form role="form" method="POST" action="contact-form-submission.php">
	            <div class="row">
	              <div class="form-group col-lg-4">
	                <label for="input1">Name</label>
	                <input type="text" name="contact_name" class="form-control" id="input1">
	              </div>
	              <div class="form-group col-lg-4">
	                <label for="input2">Email Address</label>
	                <input type="email" name="contact_email" class="form-control" id="input2">
	              </div>
	              <div class="form-group col-lg-4">
	                <label for="input3">Phone Number</label>
	                <input type="phone" name="contact_phone" class="form-control" id="input3">
	              </div>
	              <div class="clearfix"></div>
	              <div class="form-group col-lg-12">
	                <label for="input4">Message</label>
	                <textarea name="contact_message" class="form-control" rows="6" id="input4"></textarea>
	              </div>
	              <div class="form-group col-lg-12">
	                <input type="hidden" name="save" value="contact">
	                <button type="submit" class="btn btn-primary">Submit</button>
	              </div>
              </div>
            </form>
        </div>

        <div class="col-sm-4">
          <h4>Mr. Jagadish B.K</h4>
			<h5>Managing Director.</h5>
			<h5>Sree Kalanikethana School of Art</h5>
			<h5>GLOBAL FOUNDATION
		  </h5>
          <h4>Address</h4>
          <p>
            <br>
           Vijayanagara II Stage, Mysore
          </p>
          <p><i class="fa fa-phone"></i> <abbr title="Phone">P</abbr>: 9535382999</p>
          <p><i class="fa fa-envelope-o"></i> <abbr title="Email">E</abbr>: <a href="mailto:feedback@startbootstrap.com">feedback@startbootstrap.com</a></p>
          <p><i class="fa fa-clock-o"></i> <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
          <ul class="list-unstyled list-inline list-social-icons">
            <li class="tooltip-social facebook-link"><a href="#facebook-page" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
            <li class="tooltip-social linkedin-link"><a href="#linkedin-company-page" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
            <li class="tooltip-social twitter-link"><a href="#twitter-profile" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
            <li class="tooltip-social google-plus-link"><a href="#google-plus-page" data-toggle="tooltip" data-placement="top" title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
          </ul>
        </div>
 <div class="row">

            <div class="col-lg-12">
                <h2 class="page-header">Our Study Centers</h2>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <img class="img-responsive img-customer" src="http://placehold.it/500x300">
            </div>

        </div>

    </div>
      </div><!-- /.row -->

    </div><!-- /.container -->
     
    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Company 2013</p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>
