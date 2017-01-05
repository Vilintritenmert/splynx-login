<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use splynx\helpers\IPHelper;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InstallController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        echo 'Start install..' . "\n";

        $baseDir = \Yii::$app->getBasePath();
        // Create API key

        // Set Splynx dir
        $splynxDir = '/var/www/splynx/';

        $apiKeyId = (int)exec($splynxDir . 'system/script/addon add-or-get-api-key --title="Cashdesk"');
        if (!$apiKeyId) {
            exit("Error: Create API key failed!\n");
        }

        $result = exec($splynxDir . 'system/script/addon get-api-key-and-secret --id=' . $apiKeyId);
        if (!$result) {
            exit("Error: Get API key anf secret failed!\n");
        }

        list($apiKeyKey, $apiKeySecret) = explode(',', $result);

        $ips = array_keys(IPHelper::getIpsArray());
        $baseIP = reset($ips);
        exec($splynxDir . 'system/script/addon api-key-white-list --id=' . $apiKeyId . ' --list="' . implode(',', $ips) . '"');

        $baseParamsFile = \Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'params.example.php';
        $paramsFilePath = $baseDir . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'params.php';
        $params = file_get_contents($baseParamsFile);

        // Set Api host to config
        $params = preg_replace('/(("|\')api_domain("|\')\s*=>\s*)(""|\'\')/', "\\1'http://$baseIP/'", $params);

        // Set Api key to config
        $params = preg_replace('/(("|\')api_key("|\')\s*=>\s*)(""|\'\')/', "\\1'$apiKeyKey'", $params);

        // Set Api secret to config
        $params = preg_replace('/(("|\')api_secret("|\')\s*=>\s*)(""|\'\')/', "\\1'$apiKeySecret'", $params);

        file_put_contents($paramsFilePath, $params);

        exec($splynxDir . 'system/script/addon set-api-key-permission --id="' . $apiKeyId . '" --controller="api\admin\customers\Customer" --action="index" --rule="allow"');


        // Chmod
        $paths = [
            \Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'runtime' => '0777',
            \Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'assets' => '0777',
            \Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'yii' => '0755'
        ];
        self::chmodFiles($paths);

        $splynxDir = '/var/www/splynx/';


        // Add additional fields
        $fields = [
            [
                'name' => 'SocialLogin',
                'title' => 'SocialLogin',
                'type' => 'boolean'
            ],
            [
                'name' => 'Social_Login',
                'title' => 'Scial Login',
                'type' => 'numeric',
            ]
        ];
        foreach ($fields as $field) {
            $result = exec($splynxDir . 'system/script/addon add-or-get-additional-field --main_module="admins" --name="' . $field['name'] . '" --title="' . $field['title'] . '" --type="' . $field['type'] . '" --required=0 --is_add=1');
            if (!$result) {
                exit('Error: Add AF failed!' . "\n");
            }
        }


        // Reload nginx
        if (file_exists('/etc/init.d/nginx')) {
            exec('/etc/init.d/nginx restart  > /dev/null 2>&1 3>/dev/null');
        }

        // Reload apache
        if (file_exists('/etc/init.d/apache2')) {
            exec('/etc/init.d/apache2 restart  > /dev/null 2>&1 3>/dev/null');
        }

        echo 'Installed!' . "\n";

    }


    protected static function chmodFiles($paths)
    {
        foreach ($paths as $path => $permission) {
            echo "chmod('$path', $permission)...";
            if (is_dir($path) || is_file($path)) {
                try {
                    if (chmod($path, octdec($permission))) {
                        echo "done.\n";
                    };
                } catch (\Exception $e) {
                    echo $e->getMessage() . "\n";
                }
            } else {
                echo "file not found.\n";
            }
        }
    }

}
