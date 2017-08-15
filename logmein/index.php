<form action="#" method="post">
<div>
        <label for="log">log:</label>
        <input type="text" id="log" name="log">
    </div>
    <div>
        <label for="pswd">pswd:</label>
        <input type="text" id="pswd" name="pswd">
    </div>
    <div>
     <input type="submit" name='submit' value='send'></input>     </div>
</form>


<?php if(isset($_POST['submit'])){
    if ($_POST['log'] == 'admin' && $_POST['pswd'] == 'rt84hn91') {
        session_start();
        session_set_cookie_params(3600);
        $_SESSION['role'] = 'adm';
        if($_SESSION['role'] == 'adm') header("Location: /");
    }
}
?>