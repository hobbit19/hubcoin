<?php

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `coinslist` WHERE enlisted != 1 ORDER BY `id` DESC");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="../design/style.css?<?php echo microtime(true); ?>">
    <link ref='stylesheet' href="../../../css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="http://stevenlevithan.com/assets/misc/date.format.js"> </script>
    <!--   -->
    <title>HubMonitor - Coin statistics</title>
</head>
<body>

<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div><?php if(isset($_GET['id'])) echo "hey!";?>
    <h2 class="title">New coins list</h2><span style='z-index: 10;position:absolute;right:6%;font-size:0.7em;'>contact or redact: <br> 
                                                                                hubcoindev@gmail.com</span>
    
    <hr class="hr">
    <div style="text-align:center">
    </div>
    <br>
    
<div class="bootstrap-iso formclass">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12 center">
    <form action='#' method="post">
     <div class="form-group ">
      <label class="control-label requiredField" for="text">
       Coin name
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="text" name="name" type="text" value=''/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="textarea">
       Description
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="form-control" cols="30" id="textarea" name="description" rows="5"></textarea>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="text1">
       Topic Date
       <span class="asteriskField">
        * 
       </span>
      </label>
      <input placeholder='yyyy-mm-dd' class="form-control" id="text1" name="datel" type="date" value="<?php echo date("Y-m-d");?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="text2">
       Algorithm
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="text2" name="algo" type="text"/>
     </div>
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text3">
       Forum
      </label>
      <input class="form-control" id="text3" name="forum" type="text"/>
     </div>
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       Website
      </label>
      <input class="form-control" id="text4" name="site" type="text"/>
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


    <table class="table table-striped table-bordered table-hover table-condensed table_block">
        <thead>
        <tr>
            <th style='width: 20px;'>#</th>
            <th style='width: 140px;'>Name</th>
            <th style='width: 150px;'>topic date</th>
            <th style='width: 110px;'>forum url</th>
            <th style='width: 20px;'> change</th>

        </tr>
        </thead>
        <tbody>
        <?php while ($row = $query->fetch_assoc()): ?>
            <tr data-fruit=<?= $row['id'];?> id=<?= $row['id'];?> >
                <td id="id"><?=  $row['id']; ?></td>
                <td id="name"><?=  $row['name']; ?></td>
                <td id='dob' data-stamp=<?= $row['UNIXTIME'];?>><?=  $row['dob']; ?></td>
                <td id='urly' ><a href="<?=  $row['urly']; ?>"> <?=  $row['urly']; ?></a></td>
                <td> <a class='addun' href="#" data-fruit="<?=  $row['id']; ?>">change and add to list</a></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $('.formclass').hide();
        $('.addun').click(function(Event){
            let self = $(this);
            Event.preventDefault() ;
            let number = self.data('fruit');
            $('.formclass').show();
            let name = $('tr[id='+number+'] td[id=name]').text();
            let dob = $('tr[id='+number+'] td[id=dob]').data('stamp');
            let urly = $('tr[id='+number+'] td[id=urly]').text();
            name =  name.replace(/	+(?= )/g,'');
            dob = new Date(dob*1000);
            dob = dateFormat(dob, 'yyyy-mm-dd')
            $('input[id=text]').val(name);
            $('input[id=text1]').val(dob);
            $('input[id=text3]').val(urly);
            $("html, body").animate({ scrollTop: 0 }, "fast");});
        
    });
    </script>

</body>
</html>