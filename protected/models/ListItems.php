<?php

/**
 * This is the model class for table "list_items".
 *
 * The followings are the available columns in table 'list_items':
 * @property integer $id
 * @property string $content
 * @property integer $member_id
 * @property string $completed
 * @property string $deleted
 * @property date $created_at
 * @property date $updated_at
 */
class ListItems extends CActiveRecord
{
    /**
     * Definition of model constants
     */
    const DELETED_NO        = 0;
    const DELETED_YES       = 1;
    const COMPLETED_NO      = 0;
    const COMPLETED_YES     = 1;
    const STATUS_DELETED    = 'deleted';
    const STATUS_COMPLETED  = 'completed';
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ListItems the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'list_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('content', 'required'),
                    array('member_id', 'numerical', 'integerOnly'=>true),
                    array('completed', 'in', 'range'=>self::optsCompleted()),
                    array('deleted', 'in', 'range'=>self::optsDeleted()),
                    // The following rule is used by search().
                    array('id, content, member_id, completed, deleted, created_at, updated_at', 'safe', 'on'=>'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            return array(
                'member' => array(self::BELONGS_TO,'Members','member_id') 
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'content' => 'Content',
                    'member_id' => 'User',
                    'completed' => 'Completed',
                    'deleted' => 'Deleted',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
            );
    }
    
    /**
     * Before saving we set variables according to scenario
     */
    public function beforeSave(){
        if ($this->isNewRecord) {
            $this->created_at   = new CDbExpression('NOW()');
            $this->deleted      = self::DELETED_NO;
            $this->completed    = self::COMPLETED_NO;
            $this->member_id    = Yii::app()->user->id;
        } else
            $this->updated_at = new CDbExpression('NOW()');
        
        
        return parent::beforeSave();
    }
    
    /**
     * Named Parameterized Scope: postedBy
     * Filters list items posted by selected member
     * 
     * @param integer $member Member Id
     * @return CActiveRecord ListItems
     */
    public function postedBy($member) {
        
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "{$this->tableAlias}.member_id = :member",
            'params'    => array(':member' => (int)$member)
        ));
            
        return $this;
    }
    
    /**
     * Named Parameterized Scope: completed
     * Filters list items and returns completed or not depending on input
     * 
     * @param boolean $completed default FALSE 
     * @return CActiveRecord ListItems
     */
    public function completed($completed=false) {
        
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "{$this->tableAlias}.completed = :completed",
            'params'    => array(':completed' => $completed ? self::COMPLETED_YES : self::COMPLETED_NO)
        ));
            
        return $this;
    }
    
    /**
     * Named Parameterized Scope: deleted
     * Filters list items and returns deleted or not depending on input
     * 
     * @param boolean $deleted default FALSE 
     * @return CActiveRecord ListItems
     */
    public function deleted($deleted=false) {
        
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "{$this->tableAlias}.deleted = :deleted",
            'params'    => array(':deleted' => $deleted ? self::DELETED_YES : self::DELETED_NO)
        ));
            
        return $this;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * Currently we only apply the general sorting condition since all filtering is done through scopes
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->order = "{$this->tableAlias}.created_at ASC";
            $criteria->mergeWith($this->getDbCriteria());

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
    
    /**
     * Produces array with deleted options
     * @return array
     */
    public static function optsDeleted(){
        return array(
            self::DELETED_NO,
            self::DELETED_YES
        );
    }
    
    /**
     * Produces array with completed options
     * @return array
     */
    public static function optsCompleted(){
        return array(
            self::COMPLETED_NO,
            self::COMPLETED_YES
        );
    }
    
    /**
     * Sets record completed
     * @return boolean (true on success, false on failure)
     */
    public function setCompleted(){
        return $this->saveAttributes(array(
            'completed' => self::COMPLETED_YES
        ));
    }
    
    /**
     * Sets record deleted
     * @return boolean (true on success, false on failure)
     */
    public function setDeleted(){
        return $this->saveAttributes(array(
            'deleted' => self::DELETED_YES
        ));
    }
}