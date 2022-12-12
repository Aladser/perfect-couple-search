<?php

function getPercent($value){return round($value, 4) * 100;} // получить процент
function formatName($value){return mb_strtoupper(mb_substr($value, 0, 1)).mb_strtolower(mb_substr($value, 1));} // форматирование имени
// *******  Разбиение и объединение ФИО *******
function getPartsFromFullname($fullName){  return $fullName==='' ? null : explode(' ', $fullName); };
function getFullnameFromParts($nameParts){ return $nameParts===null ? '' : implode(' ', $nameParts); };
// *******  Сокращение ФИО *******
function getShortName($fullName){
	if ($fullName === '') return '';

	$nameParts = getPartsFromFullname($fullName);
	$name = $nameParts[1];
	$surname = mb_substr($nameParts[0], 0, 1);

	return "$name $surname.";
}
// ******* Функция определения пола по ФИО *******
function getGenderFromName($fullName){
	if ($fullName === '') return 0;

	$nameParts = getPartsFromFullname($fullName);
	$genderFeature = 0;
	
	if(mb_substr($nameParts[0], -2) === 'ва') $genderFeature--;
	else if(mb_substr($nameParts[0], -1) === 'в') $genderFeature++;
	
	$nameEnding = mb_substr($nameParts[1], -1);
	if($nameEnding === 'й' || $nameEnding === 'н') 	$genderFeature++;
	else if($nameEnding === 'а') $genderFeature--;
	
	$patronymEnding = mb_substr($nameParts[2], -3);
	if($patronymEnding === 'вна') $genderFeature--;
	else if($patronymEnding === 'вич') $genderFeature++;
	
	if($genderFeature>0) return 1;
	elseif($genderFeature<0) return -1;
	else return 0;
}

// ******* Определение возрастно-полового состава *******
function getGenderDescription($database){
	$size = count($database);
	$men = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == 1);
	$women = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == -1);
	$undefined = array_filter($database, fn($person) => getGenderFromName($person['fullname']) == 0);
	
	$menPart = getPercent(count($men)/$size);
	$womenPart = getPercent(count($women)/$size);
	$undefindePart = getPercent(count($undefined)/$size);
	
	return <<<_TEXT_
	------------------------------------------<br>
	Мужчины - $menPart%<br>
	Женщины - $womenPart%<br>
	Не удалось определить - $undefindePart%<br>
	------------------------------------------<br>
	_TEXT_;
}

// ******* Идеальный подбор пары *******
function getPerfectPartner($surname, $name, $patronym, $database){
	if($surname==='' || $name==='' || $patronym==='') return '';

	$partner1 = getFullnameFromParts([$surname, $name, $patronym]);
	$gender = getGenderFromName($partner1);

	if($gender != 0){
		$candidates = array_values( array_filter($database, fn($person) => getGenderFromName($person['fullname']) == -$gender) );
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

	$rslt = <<<_TEXT_
	$partner1 + $partner2 =<br> 
	♡ Идеально на $success% ♡<br>
	_TEXT_;

	return $rslt;
}

?>