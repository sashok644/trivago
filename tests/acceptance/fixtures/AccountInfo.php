<?php

class AccountInfo
{
// let's get started button from personal account
public static $letsgetstarted_button = "//span[@id='js-show-assign-content']";

public static $add_hotel_link = "//div[@class='onboarding__search-hint'][1]/a";

// Add new property
public static $hotel_name_input = "//input[@id='ReportNewItemForm_sHotelname']";
public static $address_input = "//input[@id='ReportNewItemForm_sAddress']";
public static $city_input = "//input[@id='ReportNewItemForm_sCity']";
public static $country_select = "//select[@id='ReportNewItemForm_iCountry']";
public static $phone_number_input = "//input[@id='ReportNewItemForm_phone_number']";
public static $add_property_button = "//input[@value='Send']";

// assign hotel
public static $hotel_search_input = "//input[@type='search']";
public static $available_hotels_table = "//table[@id='js_search_table']";
public static $add_to_assign_button = "//input[@type='checkbox']";
public static $assign_hotel = "//div[@id='js_config_table_actions']/input";
public static $accept_terms_and_conditions = "//input[@id='AssignForm_bTermsAccepted']";

public static $finish_assignation_button = "//input[@type='submit']";
}