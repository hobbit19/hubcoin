

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="../../shoutbox/assets/css/styles.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="../../coins/design/style.css?<?php echo microtime(true); ?>">
    <link ref='stylesheet' href="../../css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <title>HubMonitor - Coin statistics</title>


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
  </head>
</head>
<body>

<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div>
    <h2 class="title">ICO list</h2><span style='z-index: 10;position:absolute;right:5%;font-size:0.9em;'>contact or edit: <br> 
                                                                                hubcoindev@gmail.com</span>
    
    <hr class="hr">
    <div style="text-align:center">
    <a href="/ico/add" class="link">Add new ico</a><br><a href='/ico'>Go back</a>
    </div>
    <br>

<!--redacting form  -->
<div class="bootstrap-iso formclass">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12 center">
    <form action='#' method="post">
    
     <div class="form-group ">
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
       ICO finishing date(leave same as start if project not started)
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
       Social media
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


<!--table with ico  -->
    <table class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr style='text-align: center'>
            <th style='width: 20px;'>#</th>
            <th style='width: 140px;'>Name</th>
            <th style='width: 110px;'>description</th>
            <th style='width: 110px;'>Project indexed</th>
            <th style='width: 140px;'>Whitepaper</th>
            <th style='width: 110px;'>source</th>
            <th style='width: 100px;'>ICO page</th>
            <th style='width: 65px;'>forum</th>
            <th style='width: 60px;'>Add</th>
            <!-- <th style='width: 140px;'>Algo</th>
            <th class='forum'>Forum</th>
            <th style='width: 140px;'>Website</th>
            <th style='width: 110px;'>Stage</th> -->
        </tr>
        </thead>
        <tbody><?php $y = 0;?>
        <?php while ($row = $query->fetch_assoc()): ?>
        <?php $y+=1;?>
            <tr data-fruit=<?= $row['id'];?> id=<?= $row['id'];?> >
                <td id='id'>     <?=  $row['id']; ?></td>
                <td id='name'>   <?=  $row['name']; ?></td>
                <td id='descr'>  <?=  $row['description']; ?></td>
                <td>             <?=  gmdate("Y-m-d", $row['UNIXTIME']); ?></td>
                <!--text above should be with date_finishing but its empty atm  -->

                <td id='whpaper'><a href="<?= $row['whitepaper']; ?>"><?= $row['whitepaper']; ?></a></td>
                <td id='source'> <a href="<?=  $row['source']; ?>"><?=  $row['source']; ?> </a></td>
                <td id='icopage'><a href='#'></a></td>
                <td id='forum'>  <a style='margin: 0 auto' href="<?=  $row['urly']; ?>"><img src='../logo.png' width='45px' height='45px'> </img></a> </td> 
                
                <td>             <a class='addun' href="#" data-fruit="<?=  $row['id']; ?>"><img src='change.png' width='45px' height='45px' /></a></td>
                <!-- <td>        <?=  $row['algo']; ?></td>
                 
                <td><a href="<?= $row['website'];?>"> <?= $row['website'];?></a></td>
                <td><?=  $row['stage']; ?></td>  -->
            </tr>
            
        <?php endwhile; ?>
        </tbody>
        <?php file_put_contents('unred.txt', $y);?>
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
<!--chatbox   -->







<script>
    $(document).ready(function(){
        $('.formclass').hide();
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






<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="http://cdn.jsdelivr.net/emojione/1.3.0/lib/js/emojione.min.js"></script>
 <script src="../../shoutbox/assets/js/script.js"></script>

</body>
</html>