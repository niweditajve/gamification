<?php

use common\models\Report;
//use Yii;
use linslin\yii2\curl;

////**********************************************************
// this works
//$schedule->command('runschedule')->cron('*/2 * * * *');
//**********************************************************
//this works
//$cron = '*/2 * * * *';
//$schedule->call(function() {
//    $id = 123;
//    $report = Report::findOne($id);
//    $path = $report->reportpath;
//    $reportserver = Yii::$app->params['reportserver'];
//    $reporturi = "http://{$reportserver}/{$path}";
//    $curl = new curl\Curl();
//    $response = $curl->get($reporturi);
//    return $response;
//}
//)->cron($cron);
//**********************************************************
//for ($i = 0; $i < 1; $i++) {
//
//    $cron = '*/5 * * * *';
//    $schedule->call(function() {
//        $id = 123;
//        $report = Report::findOne($id);
//        $path = $report->reportpath;
//        $reportserver = Yii::$app->params['reportserver'];
//        $reporturi = "http://{$reportserver}/{$path}";
//        $curl = new curl\Curl();
//        $response = $curl->get($reporturi);
//        return $response;
//    }
//    )->cron($cron);
//}


$report = new Report();
$reports = $report->getReportsToRun();

foreach ($reports as $r) {
    if ($r['reporttype'] === 'internal' || $r['reporttype'] === 'scheduled') {
    //if ($r['reporttype'] === 'internal') {
        switch ($r['schedulemode']) {
            case 'cron':
                $cron = str_replace(";", " ", $r['schedulevalue']); // value was saved as '*;*;*;*;*'
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->cron($cron);
                break;
            case 'hourly':
                $min = $r['schedulevalue']; // value saved as '59'
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->cron($min . ' * * * *');
                break;
            case 'daily':
                $time = $r['schedulevalue']; // value saved as '04:59'
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->dailyAt($time);
                break;
            case 'weekly':
                $day = explode(",", $r['schedulevalue'])[0]; // value saved as '3,04:59'
                $time = explode(",", $r['schedulevalue'])[1]; // value saved as '3,04:59'
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->weeklyOn($day, $time);
                break;
            case 'monthly':
                $day = explode(",", $r['schedulevalue'])[0]; // value saved as '3,04:59'
                $time = explode(",", $r['schedulevalue'])[1]; // value saved as '3,04:59'
                $segments = explode(':', $time);
                $hr = $segments[0];
                $min = $segments[1];
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->cron($min . ' ' . $hr . ' ' . $day . '  * * *');
                break;
            case 'frequently':
                $frequency = $r['schedulevalue']; // value saved as 10 for every '10 minutes'
                $call = $schedule->call(function() use($r) {
                            $path = $r['reporttype'] . "/" . $r['reportpath'];
                            $reportserver = Yii::$app->params['reportserver'];
                            $reporturi = "{$reportserver}/{$path}";
                            $curl = new curl\Curl();
                            $response = $curl->get($reporturi);
                            return $response;
                        }
                        )->everyNMinutes($frequency);


                break;
        }
//        $cron = str_replace(",", " ", $r['schedulevalue']);
//        $call = $schedule->call(function() use($r) {
//                    $path = $r['reportpath'];
//                    $reportserver = Yii::$app->params['reportserver'];
//                    $reporturi = "http://{$reportserver}/{$path}";
//                    $curl = new curl\Curl();
//                    $response = $curl->get($reporturi);
//                    return $response;
//                }
//                )->cron($cron);
    }
}