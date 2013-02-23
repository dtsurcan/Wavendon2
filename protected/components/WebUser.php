<?php

/**
 * Overload of CWebUser to add more methods.
 */
class WebUser extends CWebUser
{
	private $user;
		
	/**
	 * Returns user object.
	 */
	public function getUser()
	{
		if ($this->isGuest)
			return null;

		if (!isset($this->user))
		{
			$this->user = Users::model()->findByPk($this->id);

			if ($this->user == null)
			{
				Yii::app()->user->logout();
				return null;
			}

			$this->user->date_last_activity = Yii::app()->dateFormatter->format('yyyy-MM-dd H:m:ss', time());			
			$this->user->save(false);
		}	

		return $this->user;
    }
	
	/**
	 * Checks if user have one of $roles.
	 */
	public function hasRole($roles)
	{	
		$user = $this->getUser();
					
		if ($user == null)
			return false;
		
		return $user->hasRole($roles);		
    }
}