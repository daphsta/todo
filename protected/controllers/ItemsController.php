<?php

class ItemsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','setCompleted','setDeleted'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ListItems();

		if(isset($_POST['ListItems']))
		{
			$model->attributes=$_POST['ListItems'];
			if($model->save())
				$this->redirect('/items/index');
		}

		$this->render('create',array(
                    'model'=>$model
                ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['ListItems']))
		{
			$model->attributes=$_POST['ListItems'];
			if($model->save())
				$this->redirect(array('/items/index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
        /**
	 * Sets a ListItems record as Completed.
	 * If update is successful, the browser will be redirected to the 'index' page.
         * Sends JSON if it is an AJAX request
	 * @param integer $id the ID of the ListItems model to be updated
	 */
	public function actionSetCompleted($id)
	{
		try{
                    $model =  ListItems::model()->postedBy(Yii::app()->user->id)->findByPk((int)$id);
                
                    if ($model === null)
                        throw new CException('The requested action could not be performed.'); //somebody tried to hack us
                    
                    if (!$model->setCompleted())
                        throw new CException('Could not save model' . CVarDumper::dumpAsString($model->getErrors()));
                    
                    if (Yii::app()->request->getParam('ajax'))
                        renderJson(array('response'=>1,'message'=>'Item succesfully set completed'));//to be implemented
                    else
                        $this->redirect('/items/index');
                } catch (CException $ex){
                    if (Yii::app()->request->getParam('ajax'))
                        renderJson(array('response'=>0,'message'=>$ex->getMessage()));//to be implemented
                    else {
                        $this->redirect('/items/index');
                    }
                }
	}
        
        /**
	 * Sets a ListItems record as Deleted.
	 * If update is successful, the browser will be redirected to the 'index' page.
         * Sends JSON if it is an AJAX request
	 * @param integer $id the ID of the ListItems model to be updated
	 */
	public function actionSetDeleted($id)
	{
		try{
                    $model =  ListItems::model()->postedBy(Yii::app()->user->id)->findByPk((int)$id);
                
                    if ($model === null)
                        throw new CException('The requested action could not be performed.'); //somebody tried to hack us
                    
                    if (!$model->setDeleted())
                        throw new CException('Could not save model' . CVarDumper::dumpAsString($model->getErrors()));
                    
                    if (Yii::app()->request->getParam('ajax'))
                        renderJson(array('response'=>1,'message'=>'Item succesfully deleted'));//to be implemented
                    else
                        $this->redirect('/items/index');
                } catch (CException $ex){
                    if (Yii::app()->request->getParam('ajax'))
                        renderJson(array('response'=>0,'message'=>$ex->getMessage()));//to be implemented
                    else {
                        $this->redirect('/items/index');
                    }
                }
	}

	/**
	 * Lists all items.
         * By default it lists all non-completed, non-deleted items
         * if status parameter is set it filters accordingly
	 */
	public function actionIndex()
	{
                $status = Yii::app()->request->getParam('status');
                $model = ListItems::model()->postedBy(Yii::app()->user->id);
                
                switch ($status) {
                    case ListItems::STATUS_COMPLETED:
                        $model->completed(true)->deleted(false);
                        break;
                    case ListItems::STATUS_DELETED:
                        $model->deleted(true);
                        break;
                    default:
                        $model->completed(false)->deleted(false);
                        break;
                }

		$this->render('index',array(
			'provider'=>$model->search(),
                        'status' => $status
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ListItems::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
