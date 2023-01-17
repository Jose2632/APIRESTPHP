<?php 

function CHAIN($mysqli, $FILE, $WHERE) {
	$query= "SELECT * FROM ".$FILE." where ".$WHERE;
	$result = mysqli_query($mysqli, $query);
	if ($result == null) {
		return null;
	} else {
		if ($row = mysqli_fetch_assoc($result)) {   
			return $row;
		} else {return false;}
	}
}

function RTVPARM($BUFIN, $VALPARM) {
	$VAL=$VALPARM;
	$VALPARM='*NULL';
	if ($VAL<>" ") {
		if (strpos($BUFIN,trim($VAL).'=')<>0) {
			$VAL=substr($BUFIN,strpos($BUFIN,trim($VAL).'='));
			if (strpos($VAL,'=')<>0) {
				$VAL=substr($VAL,strpos($VAL,'='));
			}
			$X=strpos($VAL,'&');
			
			if ($X<>0) {
				$VAL=substr($VAL,1,$X-1);
			}
			else {
				$VAL=substr($VAL,1);
			}
			if (strpos($VAL,'%')<>0) {
				CVTPARM($VAL);
			}
			$VALPARM=$VAL;
		}
	}
	return $VALPARM;
} 

function valparm($PARMS) {
foreach ($PARMS as $key => $value) {
	if ($value == "" || $value == null) {
		$varmsg = false;
		break;
	}
	else {
		$varmsg = true;
	}
}
return $varmsg;
}

function sanparm ($PARMS) {	
	$PARMSAN = "";
	$SANPARM = "";
	foreach ($PARMS as $key => $value) {
		$value = trim(strip_tags($value));
		$value = str_replace(" ", "", $value);
			if ($PARMSAN != "") {
				$arraytemp = [$key => $value];
				$SANPARM = array_merge($PARMSAN, $arraytemp);
				$PARMSAN = $SANPARM;
			}
			else {
				$PARMSAN = [$key => $value];
			}
	}
	return $SANPARM;
}

function valemail($str)
{
  return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}

function valemailmx($str)
{
  $result = (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
  
  if ($result)
  {
    list($user, $domain) = split('@', $str);
    
    $result = checkdnsrr($domain, 'MX');
  }
  
  return $result;
}