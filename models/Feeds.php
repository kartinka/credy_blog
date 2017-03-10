<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feeds".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class Feeds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feeds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    public function beforeDelete()
    {   
        $allDeleted = true;
        
        $comments = $this->getComments()->all();
        foreach ($comments as $c) {
            if (!$c->delete())
                $allDeleted = false;                       
        }
        
        if ($allDeleted)
            return parent::beforeDelete();
        else
            return false;            
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id'])->inverseOf('users');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['feed_id' => 'id']);
    }         
}
