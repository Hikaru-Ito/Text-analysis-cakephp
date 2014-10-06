<?php
App::uses('AuthComponent', 'Controller/Component');
class ReadersController extends AppController {
    public $helpers = array('Html', 'Form');
    public function index() {
    	if($this->request->is('post')) {
    		$url = $this->request->data['url'];
            if($check) {
            	//認証成功の挙動
				function getBlogEntryBody($buf) {
				    $buf = substr($buf, strpos($buf, '</head>'));
				    $res = '';
				    $max = 0;
				    $match = preg_split("'(<td[^>]*?>)|(</td>)|(<div[^>]*?>)|(</div>)'i", $buf, -1, PREG_SPLIT_NO_EMPTY);
				    foreach ($match as $val) {
				        $cnt = 0;
				        $htmlVal = $val;
				        $val = trim(strip_tags($val, '<li><img><p><b><a><br /><span><h1><h2><h3><h4><h5><h6>'));

				        $cnt = $cnt + substr_count($val, "、");
				        $cnt = $cnt + substr_count($val, "。");
				        $cnt = $cnt + substr_count($val, "！");
				        $cnt = $cnt + substr_count($val, "？");

				        if ($max < $cnt) {
				            $max = $cnt;
				            $res = $val;
				        }
				    }
				    return $res;
				}
				$buf = mb_convert_encoding(file_get_contents($url), 'UTF-8', 'auto');
				$data = getBlogEntryBody($buf);
				if($data) {
                    //var_dump($user_data);
                    $result = array(
                        'Response' => 1,
                        'Data' => $data
                    );
                    //var_dump($result);
                    $this->viewClass = 'Json';//json定義
                    $this->set(compact('result'));
                    $this->set('_serialize', 'result');//json生成
                }
            }
        }
    }
}