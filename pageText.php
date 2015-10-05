<?php

//structure to store field input information
class pageText {
	public $x;
	public $y;
	public $info;
	public function __construct($x, $y, $info) {
		$this->x = $x;
		$this->y = $y;
		$this->info = $info;
	}
}

/*
 *Based on input text file returns an arry of pageText that stores field input information
 *personInfo: is an array (in some cases consisting a person's personal info) where the key is 
 *	the field name and the value is the information corresponding to the field
 *pathToFile: file path to field input text file
 */
function createArray($personInfo, $pathToFile) {

	$myFile = fopen($pathToFile, "r") or die("Unable to open file!");
	$fileLine = fgets($myFile);

	$array = array();
	// for the future (i doubt it) add things to deal with whitespace
	while(!feof($myFile)) {
		$fileLine = fgets($myFile);
		list($page,$x,$y,$info) = sscanf($fileLine, "%i %i %i %s");
		$array[$page][] = new pageText($x,$y,$personInfo[$info]);
	}
	fclose($myFile);
	return $array;
}

