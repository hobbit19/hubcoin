<?php

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `news` ORDER BY `id` DESC");
?>
<?php $x = 0;?>

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
   <header style='top:0px;'>

   	<div class="row">

   		<div class="logo">
	         <a href="/">HubCoin</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul style='font-size:1.5rem;' class="main-navigation">
                <li><a class=""  href="http://hubcoin.io/releases/1.php" title="">What is hubcoin?</a></li>
                <li><a href="https://etherscan.io/address/0x563383b56367Ff2afFFE5c6BCF9187bBE52d40Ad" title="">Source</a></li>
					<li><a href="/ico" title="">Ico tracking</a></li>
                    <li><a href="/newcoins" title="">Coins list</a></li>
                    <li><a  href="/roadmap.php" title="">Roadmap</a></li>
                    <li><a  href="https://bitcointalk.org/index.php?topic=2022789" title="">BitcoinTalk</a></li>
                    <li><a  href="https://www.coinexchange.io/market/HUB/BTC" title="">CoinExchange</a></li>
                 
				</ul>
			</nav>

			<a class="menu-toggle" href="#"><span>Menu</span></a>
   		
   	</div>   	
   	<span style='position:absolute; right:5%; top:100%;font-size:1rem'>contact us: hubcoindev@gmail.com</span>
   </header> <!-- /header -->



   <!-- Process Section
   ================================================== -->
   <section id="process" style="height: 100%;">  
	<div class="intro-content" style='padding-top:3%'>


   	<div style='margin-left:0px;width:100%' class="row process-content">

   		<div style='left:3%!important; padding-top: 70px;'class="left-side">
            <?php while ($row = $query->fetch_assoc()): ?>
   			<div class="item" data-item="<?= $row['id'];?>">

   				<h5><?= $row['title'];?></h5>

   				<p><?php 
                   if(mb_strlen($row['text'], 'utf-8') > (200 + 3)){
                       $sub_str = mb_substr($row['text'], 0, 200, 'utf-8');
                       $result_str = trim($sub_str) . "...";
                       print $result_str;
                   }
                   else print $row['text'];
                   ?>
                   <br><span style="float: right;"<?php if($row['add_file'] != 1) : ?>><a href="http://hubcoin.io/releases/<?= $row['id'];?>.php">Click to read announce</span></a><?php endif;?><br/><span style='float:right;'>Added: <?= $row['date_added'];?></span></p>
   					
   			</div>
        <?php endwhile?>
   			
            
   		</div> <!-- /left-side -->
   		 <?php   require_once "ico/add/database.php"; 
                $db = new Database();
                $result = $db->showAllMain();
                $unrdctd = $db->coinslist();
        ?>
             <?php foreach($result as $row): ?>
        <?php 
         $dif = strtotime(date('Y-m-d')) - strtotime($row['starting_date']); // today vs start
        // print $dif;
        $diff = strtotime(date('Y-m-d')) - strtotime($row['finishing_date']); // today vs fin
        if ($diff < 0) $value = 1; else $value = 0;
        if ($value == 0 ) {
            continue;
        }
        
        $x +=1;?>
     <?php endforeach;?>
   		<div style='right:-33%!important;width:100%' class="right-side">
   				<h4 style='text-align: center;line-height:1'>Hubcoin ICO tracker is ready.<br> 
It is the most complete ICO list in the world for now: <?= $x;?> live+upcoming ICO<br>
You can read the announce and comparsion with another trackers <a href='https://bitcointalk.org/index.php?topic=2063349'>in our thread</a></h4>
   			<div class="item" data-item="4">
                   <div class='mob'><span><a href='/ico'>click to see full list</a>(<?= $x;?> ICO)</span><br>
          <span><a  href='/ico/add'>add your ICO for free</a>(no premoderation or any fees)</span></div>
            <div style='margin-bottom:0!important;max-width:100vw!important; width:67vw!important;float:left' class="row section-intro desk">
   		<span style='display:inline-block; float:left;'><h2 style='margin-bottom:0!important'>ICO:</h2></span> <span style='display:inline-block;'>
           <a href='/ico'>click to see full list</a>(<?= $x;?> ICO)</span>
          <span style='display:inline-block; float:right'><a  href='/ico/add'>add your ICO for free</a>(no premoderation or any fees)</span>
       




    <table style='width: 100%;' id='table_id' class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr style='text-align: center'> 
            <th style='width: 5%'>#</th>
            <th style='width: 20%;'>Name</th>
            <th style='width: 28%;'>Timeleft</th>
            <th style='width: 15%'>links</th>
            <th style='width: 15%'>Website</th>
            <th style='width: 12%;'>ICO page</th>
            <th style='width: 5%;'>BitcoinTalk</th>
            
           
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
                        elseif ($value == 1 && $dif == 0 ) print "Starting today!";
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
   				
   			</div>



   		</div> <!-- /right-side -->  


   	</div> <!-- /process-content --> 
 	</div> 





	      
            
            



   </section> <!-- /process-->    


   <!-- features Section
   ================================================== -->

	

	



    

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
            "paging": false,
            'searching': false,
            "pageLength": 15,
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