<?php

class AcceptanceTestCase extends \Codeception\TestCase\Test
{
/**
 * @var \AcceptanceTester
 */
protected $tester;

protected $screenshot_file_name;
protected $browser;
protected $split = NULL;


protected function _before()
{
	parent::_before();
	$scenario = new Codeception\Scenario($this);
	$this -> tester = new AcceptanceTester($scenario);
}

protected function _after()
{
	if($this->hasFailed()) {

		$this->tester->makeScreenshot($this->screenshot_file_name);

	}
}

/**
 * @param $url
 * @param $subdomain
 */
public function openPage($url)
{
	$this -> tester -> amOnPage($url);

}


} 