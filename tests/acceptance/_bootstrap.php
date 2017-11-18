<?php
$project_dir = "tests/acceptance/";
$fixtures_dir = $project_dir . "fixtures/";


$fixtures = array_diff(scandir($fixtures_dir), array(".", ".."));
foreach ($fixtures as $fixture) {
	require_once($fixtures_dir . $fixture);
}


