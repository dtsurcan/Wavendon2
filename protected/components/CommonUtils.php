<?php
/**
 * CommonUtils class.
 * Contains common utilites.
 */
class CommonUtils
{
	/**
	 * Sends JSON data to response and ends application.
	 * @param array $data Optional reponse data.
	 */
	public static function ajaxOK($data=array())
	{
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	/**
	 * Sends JSON error data to response and ends application.
	 * @param string $message Error message string.
	 */
	public static function ajaxError($message)
	{
		echo CJSON::encode(array('errorMsg' => $message));
		Yii::app()->end();
	}

	/**
	 * Sends JSON "Not Logged In" message to response and ends application.
	 */
	public static function ajaxNotLoggedIn()
	{
		self::ajaxError('You are currently not logged in. Please login and try again.');
	}

	/**
	 * Sends JSON "Incorrect request" message to response and ends application.
	 */
	public static function ajaxIncorrectRequest()
	{
		self::ajaxError('Incorrect request.');
	}
}