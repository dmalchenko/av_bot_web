<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Link;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{
    /**
     * disabled links with expired time
     * @throws \yii\db\Exception
     */
    public function actionDisableLinks()
    {
        Yii::$app->db->createCommand()->update(Link::tableName(), ['status' => Link::STATUS_DISABLE], ['<', 'expired_at', time()])->execute();
        return ExitCode::OK;
    }
}
