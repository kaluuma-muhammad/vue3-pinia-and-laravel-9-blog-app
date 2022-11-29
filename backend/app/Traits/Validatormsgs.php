<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait Validatormsgs {

	public function valmsgs(){

		$messages = [

		
        //required
         'name.required'=> 'Enter Both Names i.e Emily Manzi',
         'address.required'=> 'Enter your Current Residence i.e Kampala, Ntinda',
         'phone.required'=> 'Enter Phone Number i.e 0786243583',
         'whatsapp.required'=> 'Provide your Whatsapp Number',
         'email.required'=> 'Enter your Email i.e xyz@domain.com',
         'password.required' =>'Enter your Password (Should be more than 8 Characters)',
         'country.required' =>'Select Current Country of Residence',
         'section_id.required' =>'Select your Shopping Choice from the Dropdown',
         'image.required' =>'Please Select an image to continue',
         'about.required' =>'Please write something some information here ',

         //string
         'name.string'=> 'Name should be not more than 255 Characters',
         'address.string'=> 'Address should be not more than 255 Characters',
         'phone.string'=> 'Phone should be not more than 255 Characters',
         'whatsapp.string'=> 'Whatsapp Number should be not more than 255 Characters',
         'email.string'=> 'Email should be not more than 255 Characters',
         'password.string' =>'Password should be not more than 255 Characters',
         'country.string' =>'Country selected should be not more than 255 Characters',
         'section_id.string' =>'Select your Shopping Choice from the Dropdown',

         //unique
         'email.unique' => 'This Email Already Exists',
         'phone.unique' => 'This Phone Number Already Exists',

         //exits
         'section_id.exists' =>'The Shopping Interest Selected does not exists in our database',
         'supplycategory_id.exists' =>'The Shopping Interest Selected does not exists in our database',
         'servicecategory_id.exists' =>'The Shopping Interest Selected does not exists in our database',
         
         //min
         'password.min'=>'Password should be more than 8 Characters Long',

         //others
         'password.confirmed'=>'Password cannot be Confirmed. They do not match',
         'email.email'=>'The email you Entered is not a right email Format',

        ];

        return $messages;
	}

}