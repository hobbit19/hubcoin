

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="../shoutbox/assets/css/styles.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="./design/style.css?<?php echo microtime(true); ?>">
    <link ref='stylesheet' href="../../css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" 	src="design/scripts/short.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <title>HubMonitor - Coin statistics</title>
</head>
<body>

<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div>
    <h2 class="title">New coins list</h2><span style='z-index: 10;position:absolute;right:5%;font-size:0.9em;'>contact or edit: <br> 
                                                                                hubcoindev@gmail.com</span>
    
    <hr class="hr">
    <div style="text-align:center">
    <a href="/coins/unredacted/" class=""> See our unredacted list</a> 
    <br><span class='belka'>show ICOs   </span><span class='belka2'>   show algo</span>
    </div>
    <br><span><?= $x;?> Coins listred now </span>

    <table id='table_id' class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr>
            <th id='id' style='width: 20px;'>#</th>
            <th id='name' style='width: 140px;'>Name</th>
            <th class='description' style='width: 260px;'>Description</th>
            <th id='datel' style='width: 110px;'>Launch Date</th>
            <th id='algo' class='algo' style='width: 140px;'>Algo <span class='strelka2'> <- </span></th>
            <th class='forum'>Forum</th>
            <th style='width: 140px;'>Website</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($result as $row): ?>
            <tr>
                <td><?=  $row['id']; ?></td>
                <td><?=  $row['name']; ?></td>
                <td class='description'><?=  $row['description']; ?></td>
                <td><?=  $row['date_launched']; ?></td>
                <td class='algo'><?=  $row['algo']; ?></td>
                <td><a href="<?= $row['forum'];?>"><img src='design/images/logo.png' width='40px' height='40px'></img></a></td>
                <td><a href="<?= $row['website'];?>"> <img src='design/images/soc.png' width='40px' height='40px'></img></a></td>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>



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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103454174-1', 'auto');
  ga('send', 'pageview');

</script>


<script>

    jQuery(function ($){ 
        $('.belka').hide();
        $('.belka2').hide();
        $(".description").shorten();
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
        $('.strelka').on('click', function(){
            $('.ico').each(function(){
                $(this).fadeOut();    
            })
            $('.belka').fadeIn();
        })
        $('.belka').on('click', function(){
            $('.ico').each(function(){
                $(this).fadeIn();
            })
            $('.belka').fadeOut();
        })

        $('.strelka2').on('click', function(){
            $('.algo').each(function(){
                $(this).fadeOut();    
            })
            $('.belka2').fadeIn();
        })
        $('.belka2').on('click', function(){
            $('.algo').each(function(){
                $(this).fadeIn();
            })
            $('.belka2').fadeOut();
        })



        $('#table_id').DataTable({
            paging: true,
            "columnDefs": [ {
                "targets": [ 0, 5, 6 ],
                 "orderable": false
            } ]
        });
         
    
    
	     
});
    
   
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="http://cdn.jsdelivr.net/emojione/1.3.0/lib/js/emojione.min.js"></script>
 <script src="../shoutbox/assets/js/script.js"></script>

</body>
</html>