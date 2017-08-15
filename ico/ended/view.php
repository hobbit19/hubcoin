
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
    
    <title>HubMonitor - ico statistics</title>
</head>
<body>

<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div>
    <h2 class="title">Finished ICO list</h2><span style='z-index: 10;position:absolute;right:5%;font-size:0.9em;'>contact or edit: <br> 
                                                                                hubcoindev@gmail.com</span>
    
    <hr class="hr">
    <div style="text-align:center">
    <a href="/ico" class="link">Back to list</a>
    </div>
   
    <table class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr style='text-align: center'> 
            <th style='width: 2%'>#</th>
            <th style='width: 8%;'>Name</th>
            <th style='width: 35%;'>description</th>
            <th style='width: 10%;'>Timeleft</th>
            <th style='max-width: 25%'>Whitepaper, source, social</th>
            <th style='width: 10%'>Website</th>
            <th style='width: 5%;'>ICO page</th>
            <th style='width: 5%;'>btctalk</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($finished as $rew): ?>
            <tr data-fruit=<?= $rew['id'];?> id=<?= $rew['id'];?> >

                <td id='id'>   <img src="https://www.google.com/s2/favicons?domain=<?= $rew['source'];?>" alt="<?php  $rew['id']; ?>">  </img></td>
                <td id='name'>   <?=  $rew['name']; ?></td>
                <td id='descr'>  <?=  $rew['description']; ?></td>
                <td>  <?= "ended <br>".$rew['finishing_date']; ?></td>
                <td id='whpaper'>
                <a href="<?= $rew['whitepaper']; ?>"><img src='../wp.png' width='40px' height='40px'> </img></a> 
                <?php if($rew['code']):?> <a href="<?= $rew['code']; ?>"> <img src="../git.png" width='40px' height='40px'/></a> <?php endif;?>
                <a href="<?= $rew['media']; ?>"> <?php if(preg_match('/twitter/', $rew['media'])): ?>
                <img src="../twi.png" width='39px' heaight='39px' alt="<?= $rew['media'];?>"/></a>
                <?php else: ?> <img src="../soc.png" width='40px' heaight='40px' alt="<?= $rew['media'];?>"/></a>
                <?php endif;?>
                </td>
                <td id='source'> <a href="<?=  $rew['source']; ?>"><?=  $rew['source']; ?> </a></td>
                <td id='icopage'><a href="<?= $rew['ico_page'];?>">click</a></td>
                <td id='forum'>  <a style='margin: 0 auto' href="<?=  $rew['forum']; ?>"><img src='../logo.png' width='40px' height='40px'> </img></a> </td> 
            </tr>
       
        <?php endforeach; ?> 
              
        </tbody>
    </table>
</div>
    
<!--chatbox  -->
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