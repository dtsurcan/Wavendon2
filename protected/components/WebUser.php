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
	
	/**
	 * Check if user is admin.
	 */
	public function isAdmin()
	{
		if ($this->getUser()->type_id == 4)
			return true;
		return false;
	}

	/**
	 * Check if user is Landlord.
	 */
	public function isLandlord()
	{
		if ($this->getUser()->type_id == 3)
			return true;
		return false;
	}

	/**
	 * Check if user is Guarantor.
	 */
	public function isGuarantor()
	{
		if ($this->getUser()->type_id == 2)
			return true;
		return false;
	}

	/**
	 * Check if user is Tenant.
	 */
	public function isTenant()
	{
		if ($this->getUser()->type_id == 1)
			return true;
		return false;
	}

	/**
	 * Check if user is simple user.
	 */	
	public function isUser()
	{
		if (is_null($this->getUser()->type_id))
			return true;
		return false;
	}
}