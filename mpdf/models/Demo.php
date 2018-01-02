<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Demo extends Model
{
    public $header, $footer, $orient, $size, $content, $images;
    
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['header', 'footer', 'orient', 'size', 'images'], 'safe'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'orient' => 'Orientation',
        ];
    }

}
