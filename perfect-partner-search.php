<?php

// *******  Разбиение и объединение ФИО *******
function getPartsFromFullname($fullName){ return explode(' ', $fullName); };
function getFullnameFromParts($nameParts){ return implode(' ', $nameParts); };
// *******  Сокращение ФИО *******
function getShortName($fullName){
	$nameParts = getPartsFromFullname($fullName);
	$name = $nameParts[1];
	$surname = mb_substr($nameParts[0], 0, 1);
	return "$name $surname.";
}
// ******* Функция определения пола по ФИО *******
function getGenderFromName($fullName){
	$nameParts = getPartsFromFullname($fullName);
	$genderFeature = 0;
	
	if(mb_substr($nameParts[0], -2) === 'ва') $genderFeature--;
	else if(mb_substr($nameParts[0], -1) === 'в') $genderFeature++;
	
	$nameEnding = mb_substr($nameParts[1], -1);
	if($nameEnding === 'й' || $nameEnding === 'н') 	$genderFeature++;
	else if($nameEnding === 'а') $genderFeature--;
	
	if(mb_substr($nameParts[2], -3) === 'вна') $genderFeature--;
	else if(mb_substr($nameParts[2], -2) === 'ич') $genderFeature++;
	
	if($genderFeature>0) return 1;
	elseif($genderFeature<0) return -1;
	else return 0;
}

// ******* Определение возрастно-полового состава *******
function getGenderDescription($database){
	$size = count($database);
	$men = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == 1 ? true : false);
	$women = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == -1 ? true : false);
	$undefined = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == 0 ? true : false);
	
	$menPart = round(count($men)/$size, 4) * 100;
	$womenPart = round(count($women)/$size, 4) * 100;
	$undefindePart = round(count($undefined)/$size, 4) * 100;
	
	return <<<_TEXT_
	Гендерный состав аудитории:<br>
	---------------------------<br>
	Мужчины - $menPart%<br>
	Женщины - $womenPart%<br>
	Не удалось определить - $undefindePart%<br>
	_TEXT_;
}

// ******* Идеальный подбор пары *******
function getPerfectPartner($surname, $name, $patronym, $database){
	$surname = mb_strtoupper(mb_substr($surname, 0, 1)).mb_strtolower(mb_substr($surname, 1));
	$name = mb_strtoupper(mb_substr($name, 0, 1)).mb_strtolower(mb_substr($name, 1));
	$patronym = mb_strtoupper(mb_substr($patronym, 0, 1)).mb_strtolower(mb_substr($patronym, 1));
	$partner1 = getFullnameFromParts([$surname, $name, $patronym]);
	
	$gender = getGenderFromName($partner1);
	if($gender != 0){
		$candidates = array_values( array_filter($database, fn($person) => getGenderFromName($person['fullname']) == -$gender ? true : false) );
		$index = rand(0, count($candidates)-1);
		$partner2 = $candidates[$index]['fullname'];
	}
	else{
		$index = rand(0, count($database)-1);
		$partner2 = $database[$index]['fullname'];
	}
	
	$partner1 = getShortName($partner1);
	$partner2 = getShortName($partner2);
	$success = rand(5000, 10000)/100;
	
	return <<<_TEXT_
			$partner1 + $partner2 =<br> 
			♡ Идеально на $success% ♡<br>
			_TEXT_;
}

?>