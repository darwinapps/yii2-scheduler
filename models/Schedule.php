<?php
/**
 * @link https://github.com/jeremyltn/yii2-scheduler
 * @copyright Copyright (c) 2015 Jeremy Litten
 * @license https://github.com/jeremyltn/yii2-scheduler/blob/master/LICENSE.md
 */

namespace jeremyltn\scheduler\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Model class for yii2-scheduler.
 *
 * @author Jeremy Litten <jeremy.litten@gmail.com>
 * @since 0.1
 */
class Schedule extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%schedule}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function rules()
    {
        return [
            [['created', 'updated', 'last_run', 'next_run'], 'safe'],
            ['command', 'required'],
            [['command', 'interval'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'                => 'Id',
            'command'           => 'Command',
            'interval'          => 'Interval',
            'last_run'          => 'Last Run',
            'next_run'          => 'Next Run',
            'updated'           => 'Updated',
            'created'           => 'Created'
        ];
    }

    public function begin() {

        $this->next_run = null;
        return $this->save();

    }

    public function end() {

        $lastRunDate = new \DateTime('NOW');
        $this->last_run = $lastRunDate->format('Y-m-d H:i:s');

        if($this->interval !== null && $this->interval !== '') {

            $interval = \DateInterval::createFromDateString( $this->interval );
            $nextRunDate = $lastRunDate->add( $interval );
            $this->next_run = $nextRunDate->format('Y-m-d H:i:s');

        }

        return $this->save();

    }

    public static function add($command, $interval = null, $nextRun = null) {

        $model = new self;

        $model->command = $command;

        $model->interval = $interval;

        if($nextRun === null) {
            $nextRunDate = new \DateTime('NOW');
        } else {
            $nextRunDate = new \DateTime( $nextRun );   
        }

        $model->next_run = $nextRunDate->format('Y-m-d H:i:s');

        return $model->save();

    }
}
