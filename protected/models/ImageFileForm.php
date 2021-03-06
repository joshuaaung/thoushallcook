<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ImageFileForm extends CFormModel
{
	public $image;
	public $name;
	public $path;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, gif, png'),
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array();
	}
}