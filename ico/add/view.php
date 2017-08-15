
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="../../coins/design/style.css?<?php echo microtime(true); ?>">
    <link ref='stylesheet' href="../../css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <title>HubMonitor adding</title>

</head>
<body>
    
<div class="content">
    <div class="logo">
        <a href="/">hubcoin</a>
    </div>
    <h2 class="title" style:'
    text-align: center;
    color: blue;
    font-size: 1.2em;'>Add a new coin</h2>
    <hr class="hr">
    <br/> 
<div style='text-align:center'>
 <a href="/coins" class="link">go back!</a><br>
 We will be glad to any feedback <a href='https://bitcointalk.org/index.php?topic=2063349'>https://bitcointalk.org/index.php?topic=2063349</a>
 </div>



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
</div>