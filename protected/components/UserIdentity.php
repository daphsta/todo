<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * @var integer user id
     */
    private $_id;

    /**
    * Authenticates a user.
    * @return boolean whether authentication succeeds.
    */
   public function authenticate()
   {
           $record=Members::model()->findByAttributes(array('username'=>$this->username));
           
            if ($record===null)
                 $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if ($record->password!==md5($this->password))
                 $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id=$record->id;
                $this->setState('id', $record->id);
                $this->setState('name', $record->username);
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
   }
   
   /**
    * Getter method
    * @return integer the user's id
    */
   public function getId()
   {
        return $this->_id;
   }
   
}