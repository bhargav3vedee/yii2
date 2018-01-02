<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use app\models\Demo;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    public function actionUpload()
    {
        if($_REQUEST['action'] == 'upload')
        {
            echo $_FILES['image']['name'];
            
        }

    }
    
    public function actionIndex()
    {
        //return $this->render('index');
        
        $model = new Demo();
        
        $config = [];
        
        if($model->load(Yii::$app->request->post()))
        {
            $config['mode'] = 'Pdf::MODE_CORE';
            $config['format'] = 'Pdf::FORMAT_'.$model->size;
            $config['orientation'] = 'Pdf::ORIENT_'.$model->orient;
            $config['methods']['SetHeader'] = $model->header;
            $config['methods']['SetFooter'] = $model->footer;
            
            $config['filename'] = 'test1.pdf';
            $content = $model->content;
            
        }
        
            if(!empty($config))
            {
                $pdf = new Pdf($config);
            }
            else
            {
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, 
                    'format' => Pdf::FORMAT_A3, 
                    'orientation' => Pdf::ORIENT_PORTRAIT, 
                    'destination' => Pdf::DEST_FILE,
                    'filename' => 'test1.pdf',
                    'methods' => [ 
                        'SetHeader'=>[date('d-m-Y', strtotime('now'))], 
                        'SetFooter'=>['{PAGENO}'],
                    ]
                ]);
            }
	    
            
		$pdf->content = $model->content;
                
		return $pdf->render();
        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    
    public function actionDemo()
    {
        $model = new Demo();
        
        return $this->render('demo',['model'=>$model]);
        
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
