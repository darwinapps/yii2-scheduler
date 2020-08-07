<?php
/**
 * @link https://github.com/jeremyltn/yii2-scheduler
 * @copyright Copyright (c) 2015 Jeremy Litten
 * @license https://github.com/jeremyltn/yii2-scheduler/blob/master/LICENSE.md
 */

namespace jeremyltn\scheduler\commands;

use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\Console;
use jeremyltn\scheduler\models\Schedule;
use Yii;

/**
 * Test console command.
 *
 * Test console command for testing functionality of module.
 *
 * @author Jeremy Litten <jeremy.litten@gmail.com>
 * @since 0.1
 */
class TestController extends Controller
{

    public $test1;

    public $test2;

    public function options($actionID) {

        if($actionID == 'with-params') {
            return ['test1','test2'];
        } else {
            return [];
        }
    }

    public function actionNoParams()
    {
        echo "This is a test console command.\n";
        return Controller::EXIT_CODE_NORMAL;

    }

    public function actionWithParams()
    {
        echo "This is a test console command with 2 params.\n";
        echo "Param test1 = $this->test1\n";
        echo "Param test2 = $this->test2\n";
        return Controller::EXIT_CODE_NORMAL;

    }

}