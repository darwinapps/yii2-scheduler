<?php
/**
 * @link https://github.com/jeremyltn/yii2-scheduler
 * @copyright Copyright (c) 2015 Jeremy Litten
 * @license https://github.com/jeremyltn/yii2-scheduler/blob/master/LICENSE.md
 */

use yii\db\Schema;
use yii\db\Migration;
use jeremyltn\scheduler\models\Schedule;

/**
 * Migration for creating and removing yii2-scheduler tables.
 *
 * @author Jeremy Litten <jeremy.litten@gmail.com>
 * @since 0.1
 */
class m150310_210645_scheduler extends Migration
{
    public function up()
    {
        $this->createTable(Schedule::tableName(), [
            'id'                   => Schema::TYPE_PK,
            'command'              => Schema::TYPE_STRING,
            'interval'             => Schema::TYPE_STRING,
            'last_run'             => Schema::TYPE_DATETIME,
            'next_run'             => Schema::TYPE_DATETIME,
            'created'              => Schema::TYPE_DATETIME,
            'updated'              => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        $this->dropTable(Schedule::tableName());
    }
    
}
