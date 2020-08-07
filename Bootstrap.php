<?php
/**
 * @link https://github.com/jeremyltn/yii2-scheduler
 * @copyright Copyright (c) 2015 Jeremy Litten
 * @license https://github.com/jeremyltn/yii2-scheduler/blob/master/LICENSE.md
 */

namespace jeremyltn\scheduler;

use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

/**
 * Bootstrap yii2-scheduler module.
 *
 * @author Jeremy Litten <jeremy.litten@gmail.com>
 * @since 0.1
 */
class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('scheduler') && ($module = $app->getModule('scheduler')) instanceof SchedulerModule) {
            
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'jeremyltn\scheduler\commands';
            }
        }
        
    }
}