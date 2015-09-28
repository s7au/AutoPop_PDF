<?php

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

//personInfo is an array
function createArray($personInfo, $pathToFile) {

	$myFile = fopen($pathToFile, "r") or die("Unable to open file!");
	$fileLine = fgets($myFile);

	$array = array();
	// add things to reduce whitespace
	while(!feof($myFile)) {
		$fileLine = fgets($myFile);
		list($page,$x,$y,$info) = sscanf($fileLine, "%i %i %i %s");
		$array[$page][] = new pageText($x,$y,$personInfo[$info]);
	}
	fclose($myFile);
	return $array;
}

