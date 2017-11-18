<?php

class PagesTest extends AcceptanceTestCase
{
protected $email = 'cuqotibett-5282@yopmail.com';
protected $password = '123456789';

/**
 * Check main page
 * @test
 * @group smoke
 */
public function checkMainPage()
{
	$this -> screenshot_file_name = $this -> browser . '_' . $this -> toString();

	$this -> tester -> wantTo('open main page');
	$this -> openPage(URLS::$url);

	$this -> tester -> expectTo('see links in header');
	$this -> tester -> seeElement(MainPage::$signin_link);
	$this -> tester -> seeElement(MainPage::$register_link);

	$this -> tester -> expectTo('see content on page');
	$this -> tester -> seeInPageSource('Editing your profile won\'t cost you a cent');
	$this -> tester -> seeInPageSource('Start with the details');
	$this -> tester -> seeInPageSource('Highlight your strengths');

	$this -> tester -> expectTo("see address in footer");
	$this -> tester -> seeElement(MainPage::$footer_info);

}

/**
 * Check registration
 * @test
 * @group smoke
 */
public function checkRegister()
{
	$email = 'fawumiha-9323@yopmail.com';
	$password = '123456789';
	$phone_number = '201 456-7890';

	$this -> screenshot_file_name = $this -> browser . '_' . $this -> toString();

	$this -> tester -> wantTo('Check registration');
	$this -> openPage(URLS::$register_page);
	$this -> tester -> canSee('Find your hotel on trivago and create your account for free', '//h1');

	$this -> tester -> expectTo('see register form');
	$this -> tester -> seeElement(RegisterPage::$register_form);

	$this -> tester -> wantTo('Fill register form');
	$this -> tester -> fillField(RegisterPage::$hotel_name_input, 'Stylish apartment in the city center');
	$this -> tester -> fillField(RegisterPage::$first_name_input, 'Alex');
	$this -> tester -> fillField(RegisterPage::$last_name_input, 'Alex');
	$this -> tester -> selectOption(RegisterPage::$job_position_select, 10);

	$this -> tester -> fillField(RegisterPage::$phone_number_input, $phone_number);

	$this -> tester -> fillField(RegisterPage::$email_input, $email);
	$this -> tester -> fillField(RegisterPage::$password_input, $password);

	$this -> tester -> click(RegisterPage::$subscribe_checkbox);
	$this -> tester -> seeCheckboxIsChecked(RegisterPage::$subscribe_checkbox);

	$this -> tester -> click(RegisterPage::$agreement_checkbox);
	$this -> tester -> seeCheckboxIsChecked(RegisterPage::$agreement_checkbox);

	$this -> tester -> click(RegisterPage::$create_account_button);

	/*
	Далее появляется рекапча.
	Обычно на тестовом окружении ее отключают, иногда отключают для определенного установленного куки.
	https://sqa.stackexchange.com/questions/17022/how-to-fill-captcha-using-test-automation
	Ее можно попытаться автоматизированно пройти, но вся суть в рекапче не позволять такого вмешательства
	 */
	$this -> tester -> expectTo('be registered');
	$this -> tester -> seeInPageSource('Be discovered on trivago');
	$this -> tester -> seeInCurrentUrl('/dashboard/dashboard.html?page-source=registration');

}


/**
* Check log in
* @test
* @group smoke
*/
public function checkLogin()
{
	$this -> screenshot_file_name = $this -> browser . '_' . $this -> toString();

	$this -> tester -> wantTo("Check log in");
	$this -> openPage(URLS::$login_page);
	$this -> tester -> canSee('Log in with your email', '//h2');

	$this -> tester -> expectTo('see log in form');
	$this -> tester -> seeElement(LoginPage::$login_form);

	$this -> tester -> wantTo('fill log in form');
	$this -> tester -> wantTo('submit log in form');
	$this -> logIn($this -> email, $this -> password);

	$this -> tester -> expectTo('be logged in');
	$this -> tester -> seeInCurrentUrl('account/onboarding/assign.html');
	$this -> tester -> seeInPageSource('Welcome!');
}


/**
 * Check addition of hotel
 * @test
 * @group smoke
 */
public function checkAdditionHotel()
{
	$this -> screenshot_file_name = $this -> browser . '_' . $this -> toString();

	$this -> openPage(URLS::$login_page);
	$this -> logIn($this -> email, $this -> password);
	$this -> openPage(URLS::$add_hotel);

	$this -> tester -> seeInPageSource('Hotel data');

	$this -> tester -> fillField(AccountInfo::$hotel_name_input, 'Newest Coolest Hotel');
	$this -> tester -> fillField(AccountInfo::$address_input, '125 Main St.');
	$this -> tester -> fillField(AccountInfo::$city_input, 'New York');
	$this -> tester -> selectOption(AccountInfo::$country_select, 'USA');
	$this -> tester -> fillField(AccountInfo::$phone_number_input, '201 456-7890');
	$this -> tester -> seeElement(AccountInfo::$add_property_button);
	$this -> tester -> click("//input[@id='ReportNewItemForm_sWeb']");
	$this -> tester -> moveMouseOver(MainPage::$footer_info);
	$this -> tester -> click(AccountInfo::$add_property_button);

	$this -> tester -> expectTo('see hotel added');
	sleep(3);
	$this -> tester -> seeInCurrentUrl('/account/add_hotel/success.html');
}


/**
 * Check hotel assignation
 * @test
 * @group smoke
 */
public function checkAssignationHotel()
{
	$this -> screenshot_file_name = $this -> browser . '_' . $this -> toString();

	$this -> openPage(URLS::$login_page);
	$this -> logIn($this -> email, $this -> password);
	$this -> openPage(URLS::$assign_page);

	$hotel_name = 'Test 7';

	$this -> tester -> wantTo('search for hotel');
	$this -> tester -> fillField(AccountInfo::$hotel_search_input, $hotel_name);
	$this -> tester -> waitForElement(AccountInfo::$available_hotels_table);

	$this -> tester -> wantTo('assign hotel');
	sleep(2);
	$this -> tester -> click(AccountInfo::$add_to_assign_button);

	$this -> tester -> seeElement(AccountInfo::$assign_hotel);
	$this -> tester -> click(AccountInfo::$assign_hotel);

	$this -> tester -> expectTo('see terms and conditions');
	$this -> tester -> seeInCurrentUrl('/assign_hotel/assign.html');
	$this -> tester -> click(AccountInfo::$accept_terms_and_conditions);
	$this -> tester -> moveMouseOver(MainPage::$footer_info);
	$this -> tester -> click(AccountInfo::$finish_assignation_button);
	sleep(2);
	$this -> tester -> seeInPageSource('The hotel has been successfully assigned to your account.');
	$this -> tester -> seeInPageSource($hotel_name);
}

protected function logIn($email, $password)
{
	$this -> tester -> fillField(LoginPage::$email_input, $email);
	$this -> tester -> fillField(LoginPage::$password_input, $password);
	$this -> tester -> click(LoginPage::$login_button);
}

}