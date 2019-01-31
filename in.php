<?php
function valid_number($phonemas){
	$masre= array(390,391,345,353,861,401,351,855,862,482,877,878,863,381,821,843,302,347,867,343,835,411,385,492,845,342,865,382,491,846,472,487,341,352,421,427,395,384,473,494,423,815,833,871,834,831,818,851,415,817,484,383,842,336,866,301,816,841,811,471,416,814,346,426,812,824,486,485,847,475,483,481,493,844,836,474,496,388,872,879,358,394,413,424,495,848,456,820,800,499);
	$phone=[];
	$phone['mobile']=[];
	$phone['local']=[];
	$phone['novalid']=[];
	if(is_array($phonemas)){
		foreach($phonemas as $s){
			$f=array("-"," ","+",")","(","[","]");
			$s=str_replace($f, "", $s);	
			$testPhone = preg_match_all('/((\d)[\- ]?)(\(?\d{3}\)?[\- ]?)?[\d\- ]{7}/',$s, $outP);
			$ii=0;
			if($outP[0][0][0]==8){
				$outP[0][0][0]=7;
			}
			if($outP[0][0][0]==7){
				if(strlen($s)==11){
					if($outP[0][0]!=''){
						if(strlen($outP[0][0])==11){
							if(strlen($outP[3][0])==3){
								foreach($masre as $item){
									if (preg_match("/$item/",$outP[3][0])){
										//local
										array_push($phone['local'], $outP[0][0]);
										$ii++;
									}
								}
							}
						}
						if($ii==0){
							if(strlen($outP[0][0])==11){
								//mobile
								array_push($phone['mobile'], $outP[0][0]);
							}else{
								//NOVALID
								array_push($phone['novalid'], $s);
							}
						}
					}else{
						//NOVALID
						array_push($phone['novalid'], $s);
					}
				}else{
					//NOVALID
					array_push($phone['novalid'], $s);
				}
			}else{
				//NOVALID
				array_push($phone['novalid'], $s);
			}
		}
		$phone['novalid'] = array_unique($phone['novalid']);
		$phone['mobile'] = array_unique($phone['mobile']);
		$phone['local'] = array_unique($phone['local']);
		$phone = (object)$phone;
		return($phone);
	}else{
		$phone="Требуется массив!";
		return($phone);
	}
}
