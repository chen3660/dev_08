<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
/**
* 
*/
class QqController extends Controller
{
	public function actionQq_login()
	{
		return $this -> render('login');
	}

	public function actionDo_login()
	{
		include 'qq/API/qq.php';

		$qq = new \QC();

		$qq -> qq_login();
	}

	public function actionLogin()
	{
		include 'qq/API/qq.php';

		$qq = new \QC();

		$access_tocken = $qq -> qq_callback();

		$open_id = $qq -> get_openid();

		$qq = new \QC($access_tocken,$open_id);

		$info = $qq -> get_user_info();

		var_dump($info);
	}

	public function actionIndex()
	{
		return $this -> render('index');
	}

	public function actionWeather()
	{
		$address = Yii::$app->request->post('title');

		$redis = new \Redis();
		$redis->connect('127.0.0.1', 6379);
		$redis -> select(2);

		if ($redis->hexists("weather","$address")) {
			$data = $redis->hget("weather","$address");

			$data = json_decode($data,true);



			return $this -> render('weather',['data'=>$data,'address'=>$address]);
		}else{
			$data = file_get_contents("http://api.k780.com/?app=weather.future&weaid=1&appkey=43782&sign=dde17e9e5e8b0363694751713f341d0b&format=json");

			$data = json_decode($data,true);

			$weather = $data['result'];

			$r = json_encode($weather);

			$redis -> hset("weather","$address","$r");

			$connection = \Yii::$app->db;

			$sql = "insert into weather values";

			foreach ($weather as $key => $v) {
				$sql .= "(null,'$address','$v[temp_high]','$v[temp_low]','$v[week]'),";
			}

			$sql = substr($sql, 0,-1);

			$ll = $sql.";";

		

			$command = $connection->createCommand($ll);
			$command->execute();

			return $this -> render('weather',['data'=>$data['result'],'address'=>$address]);

		}

		
	}

	public function actionMap()
	{
		return $this -> render('map');
	}

	public function actionShowmap()
	{
		$address = Yii::$app->request->post('address');

		$data = file_get_contents("http://api.map.baidu.com/geocoding/v3/?address=$address&output=json&ak=aG4qQRhZyiPfZqSudtHQLQDICv4LGUYl");
		$data = json_decode($data,true);

		return $this -> render('showmap',['lng'=>$data['result']['location']['lng'],'lat'=>$data['result']['location']['lat']]);

	}

	public function actionRedis()
	{
		$redis = new \Redis();
		$redis->connect('127.0.0.1', 6379);

		$a = "chen";

		$redis -> set("test","$a");

		$data = $redis -> get("test");

		echo $data;

	}


}