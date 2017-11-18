<?php

class RegisterPage
{
// register form
public static $register_form = "//form[contains(@class, 'os-registration__form')]";

public static $hotel_name_input = "//input[@id='registration[hotel_input]']";

public static $first_name_input = "//input[@id='RegistrationForm_personalData_firstName']";
public static $last_name_input = "//input[@id='RegistrationForm_personalData_lastName']";

public static $job_position_select = "//select[@id='RegistrationForm_personalData_position']";

public static $phone_number_input = "//input[@id='RegistrationForm_personalData_phone_number']";

public static $email_input = "//input[@id='RegistrationForm_personalData_email']";
public static $password_input = "//input[@id='RegistrationForm_personalData_password']";

public static $subscribe_checkbox = "//input[@id='RegistrationForm_personalData_newsletter']";
public static $agreement_checkbox = "//input[@id='RegistrationForm_personalData_terms']";

public static $create_account_button = "//button[@class='btn btn--primary']";

public static $welcome_popup = "//div[@id='js-welcome-init']";
}