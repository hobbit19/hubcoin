<?php

$all['keesdewit'] = 199.6;
$all['vginacoindev'] = 70.7;
$all['Whitey92d15b7'] = 313.6;
$all['Reaper301'] = 175.3;
$all['SolarFlareProject']  = 241.6;
$all['ACP'] =  160.4;
$all['OBAViJEST']  = 70.7;
$all['soulgate']  = 1058.7;
$all['joshafest']  = 170.0;
$all['EFLFoundation']  = 907.5;
$all['LiftOff1969']  = 70.7;
$all['pallas']  = 2052.4;
$all['OSMIUMCOIN']  =  92.0;
$all['vashshawn']  =  300.7;
$all['DreamCrusherFTW']  = 70.7;
$all['notnormals']  = 1539.1;
$all['Saracenis'] = 70.7;
$all['BelligerentFool']  = 226.0;
$all['UsuallyHappens']  = 70.;
$all['PhoenixWarrior333']  = 70.7;
$all['cryptostiltskin']  = 205.0;
$all['CryptoWiz420']  = 13.8;
$all['findblocks.com'] = 70.7;
$all['AtomicProject'] = 359.1;
$all['mbmagnat'] = 220.8;
$all['bumbacoin']  = 298.0;
$all['victoriouscoin']= 70.7;
$all['Bzzzum'] = 521.7;
$all['ohforf'] = 1067.8;
$all['TrollCoins'] = 621.3;
$all['qiwoman2'] = 102.4;

foreach ($all as $k=>$v){
    $final+=$v;
}

print "Sum of radicals: $final<br/><br/>";

$check=0;

foreach ($all as $k=>$v){
    $orig=$v*$v;
    $part= round($v / $final * 210000, 6);
    $part= $part + 1935.483870;
    print "$k: <b>$orig cap</b>;          radical(sqrt) is <b>$v</b>; final premine is   $v / $final * 210.000 + 1935, it is <b>$part</b>";
    
    $check += $part;
    
    //print "c $check ;;;";
    
    print "<br/>";
    
}


print "<br/>check $check";