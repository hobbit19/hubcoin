<?php $x = 0;?>
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
     <?php endforeach;?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="../shoutbox/assets/css/styles.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="../coins/design/style.css?<?php echo microtime(true); ?>">
    <link ref='stylesheet' href="../css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
<script type="text/javascript" 	src="../coins/design/scripts/short.min.js"></script>
<style> .hiddenform{display: none;}.moveup{display:none;}</style>
    <script>
       function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(500 - len);
        }
       }
    </script>
    
    <title>Ultimate list of <?=$x?> ICO </title>
</head>
<body>

<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div>
    <h2 class="title">The most complete ICO list in the world</h2><span style='z-index: 10;position:absolute;right:5%;font-size:0.9em;'>contact or edit: <br> 
                                                                                hubcoindev@gmail.com<br><a href='https://bitcointalk.org/index.php?topic=2063349'>Read the announce</a></span>
    <?php $unrdctd = file_get_contents('unredacted/unred.txt');?>
    <hr class="hr">
    <div style="text-align:center">
    <a href="#" class="link">Add new ico</a><br>
    <a href="unredacted" class="">Unredacted list</a><br>
    <a href="ended" class="">Ended ICOs</a>
    </div>
    <br>
    
<!--redacting form  -->
<div class="bootstrap-iso formclass hiddenform">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12 center">
    <form action='#' method="post">
    
     <div class="form-group">
      <label class="control-label requiredField" for="text">
       ICO name
      </label>
      <input class="form-control" id="text" name="name" type="text" value=''/>
     </div>
      <div class="form-group ">
      <label class="control-label requiredField" for="textarea">
       Description
      </label>
      <textarea class="form-control" cols="30" id="textarea" name="description" rows="5" onkeyup="countChar(this)"></textarea>
         <div id="charNum"></div>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="text1">
       ICO starting date
      </label>
      <input placeholder='yyyy-mm-dd' class="form-control" id="text1" name="start" type="date" value="<?php echo date("Y-m-d");?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="text1">
       ICO finishing date
      </label>
      <input placeholder='yyyy-mm-dd' class="form-control" id="text1" name="finish" type="date" value="<?php echo date("Y-m-d");?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label" for="text2">
       Whitepaper
      </label>
      <input class="form-control" id="text2" name="whpaper" type="text"/>
     </div>
     <div class="form-group ">
     <label class="control-label" for="text2">
       Source code
      </label>
      <input class="form-control" id="text2" name="code" type="text"/>
     </div>
     <div class="form-group ">
     <label class="control-label" for="text2">
       Social media(twitter preferable), one link only
      </label>
      <input class="form-control" id="text2" name="media" type="text"/>
     </div>
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text3">
       website
      </label>
      <input class="form-control" id="text3" name="source" type="text"/>
     </div>
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       ICO page
      </label>
      <input class="form-control" id="text4" name="site" type="text"/>
     </div>
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       forum
      </label>
      <input class="form-control" id="ico" name="forum" type="text"/>
     </div>
          <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       From where did you know about us?
      </label>
      <input class="form-control" id="indexation" name="indexation" type="text"/>
     </div>
      
     <div class="form-group">
      <div style='text-align:center'>
       <input class="btn btn-primary centered" type='submit' name="submit" value='Add'>
        
       </input>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
<!--redacting form  -->
<div id="hideme" class="overlayico">
	<div class="popupico">
		<a class="closeico" href="#">&times;</a>
		<div class="contentico">
            
		</div>
	</div>
</div>
<span style='float:left;'>
     <?= $x." upcoming + live ICOs listed.<br/>".$unrdctd." more ICOs will be added on next days.";?><br>
     <a href='https://bitcointalk.org/index.php?topic=2063349'>We will be glad to any feedback</a>
</span>


<!--table with ico  -->
    <table id='table_id' class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr style='text-align: center'> 
            <th style='width: 2%!important'>#</th>
            <th style='width: 8%!important;'>Name</th>
            <th style='width: 5%!important;'>times listed on trackers</th>
            <th style='width: 35%!important;'>description</th>
            <th style='width: 10%!important;'>Timeleft</th>
            <th style='width: 25%!important;'>Whitepaper, source, social</th>
            <th style='width: 5%!important;'>Website</th>
            <th style='width: 5%!important;'>ICO page</th>
            <th style='width: 5%!important;'>btctalk</th>
            <th style='width: 2%!important;'>Move up</th>
            
           
            <!-- <th style='width: 140px;'>Algo</th>
            <th class='forum'>Forum</th>
            <th style='width: 140px;'>Website</th>
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
                <td> <?= $row['listed_times'];?> </td>
                <?php 
                // print "<br>".$token;?></td>
                <td id='descr' class='description'>  <?=  $row['description']; ?></td>
                <td>  <?php 
                        if ($row['starting_date'] == $row['finishing_date'] || $dif<0 ) print "Starting:<br>".$row['starting_date'];
                        else {
                        $diff = date_diff(date_create(date('Y-m-d')),date_create($row['finishing_date'])); 
                        if ($value == 1 && $dif>0) echo $diff->d.' days';
                        elseif ($value == 1 && $dif<0) print "Starting:<br>".$row['starting_date'];
                        elseif ($value == 1 && $dif == 0 ) print "Starting today! Finishing: <br>".$row['finishing_date'];
                        else print $row['starting_date']." ".$row['finishing_date'];
                        }
                        ?></td>
               

                <td id='whpaper'><a href="<?= $row['whitepaper']; ?>"><img src='wp.png' width='40px' height='40px'> </img></a> 
                <?php if($row['code']):?> <a href="<?= $row['code']; ?>"> <img src="git.png" width='40px' height='40px'/></a> <?php endif;?>
                <a href="<?= $row['media']; ?>"> <?php if(preg_match('/twitter/', $row['media'])): ?>
                <img src="twi.png" width='39px' heaight='39px' alt="<?= $row['media'];?>"/></a>
                <?php else: ?> <img src="soc.png" width='40px' heaight='40px' alt="<?= $row['media'];?>"/></a>
                <?php endif;?>
                </td>
                <td id='source'> <a href="<?=  $row['source']; ?>">
                <?php if(preg_match('/bitcointalk/', $row['source'])): ?><img src='logo.png' width='40px' height='40px'></img>
                <?php else: ?> <?=  $row['source']; ?> </a>
                <?php endif;?></td>
                <td id='icopage'><a href="<?= $row['ico_page'];?>">click</a></td>
                <td id='forum'>  <a style='margin: 0 auto' href="<?=  $row['forum']; ?>"><?php if(preg_match('/bitcointalk/', $row['forum'])): ?>
                <img src='logo.png' width='40px' height='40px'> </img><?php endif;?></a> </td> 
                <td id=''><a data-fruit=<?= $row['wallet'];?> href='#' class='upvote' href="#hideme">green arrow</a></td>
            </tr>
       
        <?php endforeach; ?>

        
        </tbody>
    </table>
</div>
<!--table with ico  -->

<!-- chatbox  -->
 <div class="shoutbox hidden-xs">
                 <h1><span id='reftb'>Hubbox</span><span class="close-thik" id="clth" style="display:block">.</span></h1>    
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
<!--chatbox  -->





<script>
jQuery(function ($){
    jQuery('.hiddenform').removeClass('.hiddenform') 
    $(".description").shorten({
        showChars: 75,

    });
    $('#table_id').DataTable({
            paging: false,
            "columnDefs": [ {
                "targets": [ 3, 5, 6, 7 ],
                 "orderable": false
            } ]
        });
})
</script>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function(){
        $('.upvote').on({
            "click": function(Event) {
                Event.preventDefault();
                let number      = $(this).data('fruit');
                $('.contentico').text('You can vote for your ico and move it up by sending HUB coins to this wallet: \n'+number);
                $('.hideme').show();
            }
        });
        $('.link').click(function(Event){
            Event.preventDefault();
            if ($(this).hasClass('link')) {
                $('.formclass').show();
                $(this).addClass('clse');
                $(this).removeClass('link');
            }
            else {
                $('.formclass').hide();
                $(this).addClass('link');
                $(this).removeClass('clse');
            }
        });
        $('.addun').click(function(Event){
            Event.preventDefault();
            $('.link').addClass('clse');
            $('.link').removeClass('link');
            let number      = $(this).data('fruit');
            let name        = $('tr[id='+number+'] td[id=name]').text();
            let description = $('tr[id='+number+'] td[id=descr]').text()
            let whitepaper  = $('tr[id='+number+'] td[id=whpaper]').attr('href');
            let source      = $('tr[id='+number+'] td[id=source] a').attr('href');
            let icopage     = $('tr[id='+number+'] td[id=ico] a').attr('href');
            let forum       = $('tr[id='+number+'] td[id=forum] a').attr('href');

            name =  name.replace(/	+(?= )/g,'');
            
          
            $('input[id=text]').val(name);
            $('input[id=textarea]').val(description);
            $('input[id=text2]').val(whitepaper);
            $('input[id=text3]').val(source);
            $('input[id=text4]').val(icopage);
            $('input[id=ico]').val(forum);

            $("html, body").animate({ scrollTop: 0 }, "fast");
            $('.formclass').show();
            });
        
     
    
    });
   

    </script>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103454174-1', 'auto');
  ga('send', 'pageview');

</script>







 <script src="http://cdn.jsdelivr.net/emojione/1.3.0/lib/js/emojione.min.js"></script>
 <script src="../shoutbox/assets/js/script.js"></script>

</body>
</html>