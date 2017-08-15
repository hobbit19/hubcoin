
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
    <script src="../scripts/parallax.js"></script>
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
 <a href="/coins" class="link">go back!</a>
 </div>

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
     <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       ICO
      </label>
      <input class="form-control" id="ico" name="ico" type="text"/>
     </div>
       <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       Starting ICO
      </label>
      <input placeholder='yyyy-mm-dd' class="form-control" id="startico" name="icost" type="date" value="<?php echo date("Y-m-d");?>"/>
     </div>
       <div class="form-group ">
      <label title='will be replaced with "-" if empty' class="control-label " for="text4">
       Finishing ICO
      </label>
      <input placeholder='yyyy-mm-dd' class="form-control" id="finishico" name="icof" type="date" value="<?php echo date("Y-m-d");?>"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="textarea">
       Whitepaper, Roadmap, Source code, Social media links
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="form-control" cols="30" id="icons" name="icons" rows="5"></textarea>
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