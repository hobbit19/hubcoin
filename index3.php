<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>HubCoin</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="css/base.min.css">  
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vendor.min.css">     
    <link rel="stylesheet" href="coins/design/style.css?<?php echo microtime(true); ?>">
    

   <!-- script
   ================================================== -->
	<script src="js/modernizr.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/png" href="favicon.png">

</head>

<body id="top">

	<!-- header 
   ================================================== -->
   <header>

   	<div class="row">

   		<div class="logo">
	         <a href="/">HubCoin</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul style='font-size:1.5rem;' class="main-navigation">
					<li><a class="smoothscroll"  href="#process" title="">Home</a></li>
					<li><a href="/ico" title="">Ico tracking</a></li>
					<li><a href="/newcoins" title="">Coins list</a></li>				
				</ul>
			</nav>

			<a class="menu-toggle" href="#"><span>Menu</span></a>
   		
   	</div>   	
   	
   </header> <!-- /header -->



   <!-- Process Section
   ================================================== -->
   <section id="process" style="height: 100%;">  
	<div class="intro-content">
   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>HubCoin team</h5>
   			<h1>News</h1>
   		</div>   		
   	</div>

   	<div class="row process-content">

   		<div class="left-side">

   			<div class="item" data-item="2">

   				<h5>News block1</h5>

   				<p>blah blahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblah<br/><br/></p>
   					
   			</div>

   			<div class="item" data-item="6">

	   			<h5>News block 2</h5>

	   			<p>blahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblah</p>
   					
   			</div>
            
   		</div> <!-- /left-side -->
   		
   		<div class="right-side">
   				
   			<div class="item" data-item="4">

   				<h5>News block 3</h5>

   				<p>blahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblah</p>
   					
   			</div>

   			<div class="item" data-item="4">

   				<h5>News block 4 </h5>

   				<p>Pblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblah</p>
   					
   			</div>
            
            




   		</div> <!-- /right-side -->  

   		<div class="image-part"></div>  			

   	</div> <!-- /process-content --> 
 	</div> 
   </section> <!-- /process-->    


   <!-- features Section
   ================================================== -->
	<section id="tracker" style='background-color:whitesmoke;height:100%!important;max-height:105%!important;'>

		<div style='margin-bottom:0!important;max-width:65%!important' class="row section-intro">
   		<div class="col-twelve with-bottom-line">
        
   			<h5>trackers</h5>
               <h1>ICO live tracker</h1>
               </div>
<?php   require_once "ico/add/database.php"; 
        $db = new Database();
        $result = $db->showAll();
        $unrdctd = $db->coinslist();
?>



    <table style='' id='table_id' class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr style='text-align: center'> 
            <th style='width: 5%'>#</th>
            <th style='width: 20%;'>Name</th>
            <th style='width: 28%;'>Timeleft</th>
            <th style='width: 15%'>links</th>
            <th style='width: 15%'>Website</th>
            <th style='width: 12%;'>ICO page</th>
            <th style='width: 5%;'>btctalk</th>
            
           
            <!-- <th style='width: 120px;'>Algo</th>
            <th class='forum'>Forum</th>
            <th style='width: 120px;'>Website</th>
            <th style='width: 110px;'>Stage</th> -->
        </tr>
        </thead>
        <tbody>
        <?php foreach($result as $row): ?>
        <?php 
        $dif = strtotime(date('Y-m-d')) - strtotime($row['starting_date']); // today vs start
        // print $dif;
        $diff = strtotime(date('Y-m-d')) - strtotime($row['finishing_date']); // today vs fin
        if ($diff < 0) $value = 1; else $value = 0;
        if ($value == 0 ) {
            continue;
        }
        ?>            
            <tr data-fruit=<?= $row['id'];?> id=<?= $row['id'];?> >

                <td id='id'>   <img src="https://www.google.com/s2/favicons?domain=<?= $row['source'];?>" alt="<?php  $row['id']; ?>">  </img></td>
                <td id='name'>   <?=  $row['name']; ?>
                <?php 
                // print "<br>".$token;?></td>
                
                <td>  <?php 
                        if ($row['starting_date'] == $row['finishing_date'] || $dif<0 ) print "Starting: ".$row['starting_date'];
                        else {
                        $diff = date_diff(date_create(date('Y-m-d')),date_create($row['finishing_date'])); 
                        if ($value == 1 && $dif>0) echo $diff->d.' days';
                        elseif ($value == 1 && $dif<0) print "Starting: ".$row['starting_date'];
                        elseif ($value == 1 && $dif == 0 ) print "Starting today! Finishing: ".$row['finishing_date'];
                        else print $row['starting_date']." ".$row['finishing_date'];
                        }
                        ?></td>
               

                <td id='whpaper'><a href="<?= $row['whitepaper']; ?>"><img src='ico/wp.png' width='20px' height='20px'> </img></a> 
                <?php if($row['code']):?> <a href="<?= $row['code']; ?>"> <img src="ico/git.png" width='20px' height='20px'/></a> <?php endif;?>
                <a href="<?= $row['media']; ?>"> <?php if(preg_match('/twitter/', $row['media'])): ?>
                <img src="ico/twi.png" width='17px' heaight='17px' alt="<?= $row['media'];?>"/></a>
                <?php else: ?> <img src="ico/soc.png" width='20px' heaight='20px' alt="click"/></a>
                <?php endif;?>
                </td>
                <td id='source'> <a href="<?=  $row['source']; ?>"><?=  $row['source']; ?> </a></td>
                <td id='icopage'><a href="<?= $row['ico_page'];?>">click</a></td>
                <td id='forum'>  <a style='margin: 0 auto' href="<?=  $row['forum']; ?>"><?php if(preg_match('/bitcointalk/', $row['forum'])): ?><img src='ico/logo.png' width='20px' height='20px'> </img><?php endif;?></a> </td> 
            </tr>
       
        <?php endforeach; ?>



        
        </tbody>
    </table>








	      </div> <!-- features-list -->
   		
   	</div> <!-- features-content -->
		
	</section> <!-- /features -->
	

	



    

         </div> <!-- /pricing-tables --> 

      </div> <!-- /pricing-content --> 

   </section> <!-- /pricing --> 


   <!-- Testimonials Section
   ================================================== -->
   <section id="testimonials">

   	<div class="row">
   		<div class="col-twelve">
   			<h2 class="h01">Our team for now:</h2>
   		</div>   		
   	</div>   	

      <div class="row flex-container">
    
         <div id="testimonial-slider" class="flexslider">

            <ul class="slides">

               <li>
               	<div class="testimonial-author">
                    	<img src="images/avatars/1.png" alt="Author image">
                    	<div class="author-info">
                    		Topaz coin
                    		<span class="position">Saracenis</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/2.png" alt="Author image">
                    	<div class="author-info">
                    		BenjiRolls
                    		<span>Belligerent Fool</span>
                    	</div>
                  </div> 
				   <li>
               	<div class="testimonial-author">
                    	<img src="images/avatars/3.png" alt="Author image">
                    	<div class="author-info">
                    		PartyCoin
                    		<span class="position">UsuallyHappens</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/4.png" alt="Author image">
                    	<div class="author-info">
                    		FidgetCoin
                    		<span>PhoenixWarrior333</span>
                    	</div>
                  </div> 
				   <li>
               	<div class="testimonial-author">
                    	<img src="images/avatars/7.png" alt="Author image">
                    	<div class="author-info">
                    		Turbostake
                    		<span class="position">CryptoWiz420</span>
                    	</div>
                  </div>
					</li>
				 <!-- /slide -->

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/8.png" alt="Author image">
                    	<div class="author-info">
                    		Evotion
                    		<span>mbmagnat</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
                                       
             	</li> <!-- /slide -->

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/9.png" alt="Author image">
                    	<div class="author-info">
                    		BumbaCoin
                    		<span>BumbaCoin</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
                                         
             	</li> <!-- /slide -->

               <li> 
				  
						<div class="testimonial-author">
                    	<img src="images/avatars/10.png" alt="Author image">
                    	<div class="author-info">
                    		Victoriouscoin
                    		<span>victoriouscoin </span>
                    	</div>
                  </div> 
				   <li>
               	<div class="testimonial-author">
                    	<img src="images/avatars/11.png" alt="Author image">
                    	<div class="author-info">
                    		Deutsche eMark
                    		<span class="position">Bzzzum</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->

           

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/14.png" alt="Author image">
                    	<div class="author-info">
                    		TrollCoins
                    		<span>TrollCoins</span>
                    	</div>
                  </div> 
				</li>
						      <li> 
               	<div class="testimonial-author">
                    	<img src="images/avatars/111.png" alt="Author image">
                    	<div class="author-info">
                    		Acp
                    		<span class="position">Anarchists Prime</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->



				   <li>
               	<div class="testimonial-author">
                    	<img src="images/avatars/15.jpg" alt="Author image">
                    	<div class="author-info">
                    		Qibuck Asset
                    		<span class="position">qiwoman2</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->

               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/16.png" alt="Author image">
                    	<div class="author-info">
                    		AmsterdamCoin
                    		<span>keesdewit</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->

               <li> 
               	<div class="testimonial-author">
                    	<img src="images/avatars/17.png" alt="Author image">
                    	<div class="author-info">
                    		VGINA
                    		<span class="position">vginacoindev</span>
                    	</div>
                  </div>

                  <p>					
                  </p>                  
             	</li> <!-- /slide -->
               <li> 

               	<div class="testimonial-author">
                    	<img src="images/avatars/18.jpg" alt="Author image">
                    	<div class="author-info">
                    		GPU Coin
                    		<span>Whitey92d15b7</span>
                    	</div>
                  </div> 
                  <p>
                  </p>
                                         
               </li> <!-- /slide -->

            </ul> <!-- /slides -->

         </div> <!-- /testimonial-slider -->         
        
      </div> <!-- /flex-container -->

   </section> <!-- /testimonials -->


		
	      	           	
	      	</div> <!-- /subscribe -->         

	      </div> <!-- /row -->

   	</div> <!-- /footer-main -->


      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright Hub Coin community</span> 
		         	         	
		         </div>

		         <div id="go-top" style="display: block;">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon ion-android-arrow-up"></i></a>
		         </div>         
	      	</div>

      	</div> <!-- /footer-bottom -->     	

      </div>

   </footer>  
 
<!-- <script>
window['CboxReady'] = function (Cbox) {
	Cbox('button', '7-833984-C8R86d');
}
</script>
<script src="https://static.cbox.ws/embed/1.js" async></script>
	 -->
<!--    
   <div id="preloader"> 
    	<div id="loader"></div>
   </div>   -->



 <div class="shoutbox hidden-xs">
                 <h1><span id='reftb'>Hubbox</span><span class="close-thik"></span></h1>    
            <ul class="shoutbox-content"></ul>
            
            <div class="shoutbox-form">
                <h2 id="shoth">Write a message</h2>
                
                <form id='formy' action="./shoutbox/publish.php" method="post">
                    <label for="shoutbox-name">nickname </label> <input type="text" id="shoutbox-name" name="name"/>
                    <label class="shoutbox-comment-label" for="shoutbox-comment">message </label> <textarea id="shoutbox-comment" name="comment" maxlength='240'></textarea>
                    <input type="submit" value="Shout!"/>
                </form>
            </div>
            
        </div>



   <!-- Java Script
   ================================================== --> 
	<link rel="stylesheet" href="http://cdn.jsdelivr.net/emojione/1.3.0/assets/css/emojione.min.css"/>
    <link rel="stylesheet" href="./shoutbox/assets/css/styles.css" />
	
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
   <script src="js/jquery-migrate-1.2.1.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>
   <script src="./shoutbox/assets/js/script.js"></script>
   <script src="http://cdn.jsdelivr.net/emojione/1.3.0/lib/js/emojione.min.js"></script>
       <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script type="text/javascript" 	src="coins/design/scripts/short.min.js"></script>
<script>
jQuery(function ($){ 
   
    $('#table_id').DataTable({
            'searching': false,
            "pageLength": 16,
            "lengthChange": false,
            "columnDefs": [ {
                "targets": [0, 1, 2, 3, 4, 5, 6],
                 "orderable": false
            } ]
        });
})
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103454174-1', 'auto');
  ga('send', 'pageview');

</script>

</body>

</html>

<section style='visibility:hidden' id="features">

		<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>Features</h5>
   			<h1>Premine size - 10%</h1>

   			<p class="lead">First Hubcoin goal is to create extremly strong development team. Premine will be distributed between all altcoin developers.</p>

   		</div>   		
   	</div>

   	<div class="row features-content">

   		<div class="features-list block-1-3 block-s-1-2 block-tab-full group">

	      	<div class="bgrid feature">	

	      		<span class="icon"><i class="icon-window"></i></span>            

	            <div class="service-content">	

	            	 <h3 class="h05">Capitalization</h3>

		            <p>7% of the coins will be distributed between the developers of the altcoins (or assets/tokens) already existing at one of the exchangers, in proportion to their capitalization.
	         		</p>
	         		
	         	</div> 	         	 

				</div> <!-- /bgrid -->

				<div class="bgrid feature">	

					<span class="icon"><i class="icon-eye"></i></span>                          

	            <div class="service-content">	
	            	<h3 class="h05">Distributed </h3>  

		            <p>2% of the coins will be equally distributed between all the altcoin developers who have a wallet, a block explorer, and a topic at this forum.
	         		</p>

	         		
	            </div>	                          

			   </div> <!-- /bgrid -->

			   <div class="bgrid feature">

			   	<span class="icon"><i class="icon-paint-brush"></i></span>		            

	            <div class="service-content">
	            	<h3 class="h05">Promotion</h3>

		            <p>1% of the coins is my premine. I have a few bitcoins for the project development, so I am not going to spend it until the coin reaches high capitalization.
	        			</p> 

	        			
	            </div> 	            	               

			   </div> <!-- /bgrid -->

				<div class="bgrid feature">

					<span class="icon"><i class="icon-file"></i></span>	              

	            <div class="service-content">
	            	<h3 class="h05">Nem</h3>

		            <p>This is the key Hubcoin idea, inspired by <a href="https://bitcointalk.org/index.php?topic=422129.0">NEM</a> (2 biilion capitalization for now).NEM has proven that experiments with fair coins distribution have great potential.
	         		</p> 

	         		
	            </div>                

				</div> <!-- /bgrid -->

			   <div class="bgrid feature">

			   	<span class="icon"><i class="icon-layers"></i></span>	            

	            <div class="service-content">	
	            	<h3 class="h05">Idea</h3>

		            <p>While NEM distributes premine between all comers, we only give it to other coin developers.
Any developer of altcoins is much more skilled in their improvement and promotion than an ordinary user.

	        			</p> 

	        			
	            </div>	               

			   </div> <!-- /bgrid -->

			   <div class="bgrid feature">

			   	<span class="icon"><i class="icon-gift"></i></span>	   	           

	            <div class="service-content">
	            	 
	        			
	            </div>	               

			   </div> <!-- /bgrid -->

	      </div> <!-- features-list -->
   		
   	</div> <!-- features-content -->
		
	</section> <!-- /features -->