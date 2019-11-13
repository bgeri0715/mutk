<?php
    // Alkalmazás logika:
    include('config.inc.php');
    $uzenet = array();

    // Űrlap ellenőrzés:
    if (isset($_POST['kuld'])) {
        //print_r($_FILES);
        foreach($_FILES as $fajl) {
            if ($fajl['error'] == 4);   // Nem töltött fel fájlt
            elseif (!in_array($fajl['type'], $MEDIATIPUSOK))
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            elseif ($fajl['error'] == 1   // A fájl túllépi a php.ini -ben megadott maximális méretet
                        or $fajl['error'] == 2   // A fájl túllépi a HTML űrlapban megadott maximális méretet
                        or $fajl['size'] > $MAXMERET)
                $uzenet[] = " Túl nagy állomány: " . $fajl['name'];
            else {
                $vegsohely = $MAPPA.strtolower($fajl['name']);
                if (file_exists($vegsohely))
                    $uzenet[] = " Már létezik: " . $fajl['name'];
                else {
                    move_uploaded_file($fajl['tmp_name'], $vegsohely);
                    $uzenet[] = ' Ok: ' . $fajl['name'];
                }
            }
        }
    }
    // Megjelenítés logika:
?><!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>Heti beosztás - Abstract</title>
	<meta name="description" content="">
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="css/base.css">
   <link rel="stylesheet" href="css/vendor.css">
   <link rel="stylesheet" href="css/main.css">


   <!-- script
   ================================================== -->
	<script src="js/modernizr.js"></script>
	<script src="js/pace.min.js"></script>
  <script src="js/kapcsolat.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

	<!-- header
   ================================================== -->
   <header class="short-header">

   	<div class="gradient-block"></div>

   	<div class="row header-content">

   		<div class="logo">
	         <a href="index.html">Author</a>
	      </div>

        <nav id="main-nav-wrap">
  				<ul class="main-navigation sf-menu">
  					<li><a href="index.html" title="">Kezdőoldal</a></li>
  						<li><a href="beosztas.html" title="">Heti beosztás</a>
              <li><a href="klub.html" title="">A klubról</a>
                <li><a href="kepek.php" title="">Képek</a>
                  <li class="current"><a href="kepek_feltolt.php" title="">Képek feltöltése</a>
  				</ul>
  			</nav> <!-- end main-nav-wrap -->

			<div class="search-wrap">

        <form role="search" method="GET" class="search-form" action="https://www.google.hu/search?hl=en-GB&source=hp&q=">
					<label>
						<span class="hide-content">Keresés:</span>
						<input type="search" class="search-field" placeholder="Keresés..." value="" name="q" id="s" title="Search for:" autocomplete="off">
					</label>
					<input type="submit" class="search-submit" value="Search">
				</form>

				<a href="#" id="close-search" class="close-btn">Close</a>

			</div> <!-- end search wrap -->

			<div class="triggers">
				<a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
				<a class="menu-toggle" href="#"><span>Menu</span></a>
			</div> <!-- end triggers -->

   	</div>

   </header> <!-- end header -->


   <!-- content
   ================================================== -->
   <section id="content-wrap" class="blog-single">
   	<div class="row">
   		<div class="col-twelve">

   			<article class="format-standard">

          <h1>Feltöltés a galériába:</h1>
      <?php
          if (!empty($uzenet))
          {
              echo '<ul>';
              foreach($uzenet as $u)
                  echo "<li>$u</li>";
              echo '</ul>';
          }
      ?>
          <form action="kepek_feltolt.php" method="post"
                      enctype="multipart/form-data">
              <label>Első:
                  <input type="file" name="elso" required>
              </label>
              <label>Második:
                  <input type="file" name="masodik">
              </label>
              <label>Harmadik:
                  <input type="file" name="harmadik">
              </label>
              <input type="submit" name="kuld">
            </form>
				</article>


			</div> <!-- end col-twelve -->
   	</div> <!-- end row -->


   </section> <!-- end content -->


   <!-- footer
   ================================================== -->
   <footer>

   	<div class="footer-main">

   		<div class="row">


	      	<div class="col-two tab-1-3 mob-1-2 social-links">

	      		<h4>Közösségi oldal</h4>

	      		<ul>
						<li><a href="https://www.facebook.com/home.php#!/pages/MÚTK-Martfűi-Úszó-és-Triatlon-Klub/106474766101055">Facebook</a></li>
					</ul>

	      	</div> <!-- end social links -->

	      </div> <!-- end row -->

   	</div> <!-- end footer-main -->

      <div class="footer-bottom">
      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© 2019 Martfűi Úszó és Triatlon Klub.</span>
		         	<span>Design by <a href="http://www.styleshout.com/">styleshout</a></span>
		         </div>

		         <div id="go-top">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon icon-arrow-up"></i></a>
		         </div>
	      	</div>

      	</div>
      </div> <!-- end footer-bottom -->

   </footer>

   <div id="preloader">
    	<div id="loader"></div>
   </div>

   <!-- Java Script
   ================================================== -->
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>

</body>

</html>
