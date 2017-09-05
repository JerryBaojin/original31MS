<?php


class WeixinAction extends Action {
    private $token;
    private $IIIIIIIllllI;
    private $data = array();
    public $mykey;
    public $chatkey;
    private $IIIIIIlIlIIl = array();
    private $IIIIIIIlllll = '';
    public function index() {
        if (!class_exists('SimpleXMLElement')) {
            die('SimpleXMLElement class not exist');
        }
        if (!function_exists('dom_import_simplexml')) {
            die('dom_import_simplexml function not exist');
        }
        $this->token = $this->_get('token', 'htmlspecialchars');
        if (!preg_match('/^[0-9a-zA-Z]{3,42}$/', $this->token)) {
            die('error token');
        }
        $myurl = $this->_server('HTTP_HOST');
        C('site_url', $myurl);
        $this->mykey = trim(C('server_key'));
        $this->chatkey = trim(C('site_chatkey'));
        $weixin = new Wechat($this->token);
        $data = $weixin->request();
        $this->data = $weixin->request();
        //$this->data['FromUserName']='okjt3xOAZizojDAk2g1y4L4r2Eyc';
        if ($this->data) {
            $openid = $this->data['FromUserName'];
            if ($openid) {
                $user = M('fusers')->where(array(
                    'openid' => $openid
                ))->find();
                if (!$user) {
                    $appidsecret = M('diymen_set')->where(array(
                        'token' => $this->token
                    ))->find();
                    $tp_user = $this->getwuserinfo($appidsecret['id'], $appidsecret['appid'], $appidsecret['appsecret'], $openid);
                    $TP_user['nickname'] = $tp_user['nickname'];
                    $TP_user['sex'] = $tp_user['sex'];
                    $TP_user['city'] = $tp_user['city'];
                    $TP_user['country'] = $tp_user['country'];
                    $TP_user['province'] = $tp_user['province'];
                    $TP_user['headimgurl'] = $tp_user['headimgurl'];
                    $TP_user['openid'] = $openid;
                    $TP_user['gztime'] = time();
                   // $TP_user['is_gz'] = 1;
                    M('fusers')->add($TP_user);
                } else {
                    if ($user['is_gz'] == 0) {
                        $appidsecret = M('diymen_set')->where(array(
                            'token' => $this->token
                        ))->find();
                        $tp_user = $this->getwuserinfo($appidsecret['id'], $appidsecret['appid'], $appidsecret['appsecret'], $openid);
                        $TP_user['nickname'] = $tp_user['nickname'];
                        $TP_user['sex'] = $tp_user['sex'];
                        $TP_user['city'] = $tp_user['city'];
                        $TP_user['country'] = $tp_user['country'];
                        $TP_user['province'] = $tp_user['province'];
                        $TP_user['headimgurl'] = $tp_user['headimgurl'];
                        $TP_user['is_gz'] = 1;//关键字回复的都是关注的
                        M('fusers')->where(array(
                            'openid' => $openid
                        ))->save($TP_user);
                    }
                }
            }
            $this->IIIIIIIlllll = C('site_my');
            $IIIIIIlIlI1l = M('Token_open')->where(array(
                'token' => $this->_get('token')
            ))->find();
            $IIIIIIlIlI11 = M('vote')->where(array(
                'token' => $this->token
            ))->select();
            if (!empty($IIIIIIlIlI11)) {
                foreach ($IIIIIIlIlI11 as $IIIIIIIllIll => $IIIIIIlIllII) {
                    if ($IIIIIIlIllII['id'] != '') {
                        $this->IIIIIIlIlIIl[] = $IIIIIIlIllII['id'];
                    }
                }
                $this->IIIIIllI1l1l = $IIIIIIlIlI11[0]['id'];
            }
            $this->IIIIIIIllllI = $IIIIIIlIlI1l['queryname'];
            list($IIIIIIIl1II1, $IIIIIIlIllIl) = $this->reply($data);
            $weixin->response($IIIIIIIl1II1, $IIIIIIlIllIl);
        }
    }
    private function reply($data) {
        $myurl = $this->_server('HTTP_HOST');
        C('site_url', $myurl);
        if (isset($data['Event'])) {
            if ('CLICK' == $data['Event']) {
                $data['Content'] = $data['EventKey'];
                $this->data['Content'] = $data['EventKey'];
            }
            if ('subscribe' == $data['Event']) {
                $follow_data = M('Areply')->field('home,keyword,content')->where(array(
                    'token' => $this->token
                ))->find();
                $openid = $data['FromUserName'];
                if ($openid) {
                    $user = M('fusers')->where(array(
                        'openid' => $openid
                    ))->find();
                    if (!$user) {
                        $appidsecret = M('diymen_set')->where(array(
                            'token' => $this->token
                        ))->find();
                        $tp_user = $this->getwuserinfo($appidsecret['id'], $appidsecret['appid'], $appidsecret['appsecret'], $data['FromUserName']);
                        $TP_user['nickname'] = $tp_user['nickname'];
                        $TP_user['sex'] = $tp_user['sex'];
                        $TP_user['city'] = $tp_user['city'];
                        $TP_user['country'] = $tp_user['country'];
                        $TP_user['province'] = $tp_user['province'];
                        $TP_user['headimgurl'] = $tp_user['headimgurl'];
                        $TP_user['openid'] = $openid;
                        $TP_user['gztime'] = time();
                        $TP_user['is_gz'] = 1;
                        M('fusers')->add($TP_user);
                    } else {
                        if ($user['is_gz'] == 0) {
                            $appidsecret = M('diymen_set')->where(array(
                                'token' => $this->token
                            ))->find();
                            $tp_user = $this->getwuserinfo($appidsecret['id'], $appidsecret['appid'], $appidsecret['appsecret'], $data['FromUserName']);
                            $TP_user['nickname'] = $tp_user['nickname'];
                            $TP_user['sex'] = $tp_user['sex'];
                            $TP_user['city'] = $tp_user['city'];
                            $TP_user['country'] = $tp_user['country'];
                            $TP_user['province'] = $tp_user['province'];
                            $TP_user['headimgurl'] = $tp_user['headimgurl'];
                            $TP_user['is_gz'] = 1;
                            M('fusers')->where(array(
                                'openid' => $openid
                            ))->save($TP_user);
                        }
                    }
                }
                $follow_data['content'] = html_entity_decode($follow_data['content']);
                $key = trim($follow_data['content']);
                $like['keyword'] = array(
                    'like',
                    ('%' . $key) . '%'
                );
                $like['token'] = $this->token;
                $data = M('keyword')->where($like)->order('id desc')->find();
                if ($data != false) {
                    $Vote = M('Vote')->where(array(
                        'id' => $data['pid']
                    ))->order('id DESC')->find();
					
					$timenow = time();
					if($Vote['start_time']<$timenow && $timenow<$Vote['over_time']){
							return array(
							array(
								array(
									$Vote['title'],
									mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
									$Vote['wappicurl'],
									((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
								),
								 array(
									'点击立刻报名',
									mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
									$Vote['wappicurl'],
									((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=signup&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
								)
							) ,
							'news'
						);
					}else{
							return array(
							array(
								array(
									$Vote['title'],
									mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
									$Vote['wappicurl'],
									((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
								)
							) ,
							'news'
						);
					   
						return array(array(array($Vote['title'], mb_substr($this->handleIntro($Vote['qtxinxi']),0,58,'utf-8').'......', $Vote['wappicurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&tid=') . $data['pid']) . '&31cms=mp.weixin.qq.com')), 'news');
						
					}
                    
					 /*
                    return array(
                        array(
                            array(
                                $Vote['title'],
                                mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
                                $Vote['wappicurl'],
                                ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
                            )
                        ) ,
                        'news'
                    );
                   
                    return array(array(array($Vote['title'], mb_substr($this->handleIntro($Vote['qtxinxi']),0,58,'utf-8').'......', $Vote['wappicurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&tid=') . $data['pid']) . '&31cms=mp.weixin.qq.com')), 'news');
                    */
                } else {
                    return array(
                        $follow_data['content'],
                        'text'
                    );
                }
                /*
                if(strpos($follow_data['content'],'image')!== FALSE&&strpos($follow_data['content'],'link')!== FALSE){
                return array($follow_data['content'],'Pase_News_content');}
                else if(true)
                {  }
                else
                { return array($follow_data['content'],'text');}
                */
            } elseif ('unsubscribe' == $data['Event']) {
                $IIIIIIlIllll = M('Vote_record')->where(array(
                    'wecha_id' => $data['FromUserName'],
                    'qxgzys' => '0'
                ))->select();
                M('fusers')->where(array(
                    'openid' => $data['FromUserName']
                ))->save(array(
                    'is_gz' => '0'
                ));
                $ars= M('vote')->where(array('id'=>$id))->select();
                $isonlyweb=$ars[0]['isonlyweb'];
                if($isonlyweb==1){
                foreach ($IIIIIIlIllll as $key => $IIIIIIIlI11l) {
                    M('Vote_item')->where(array(
                        'id' => $IIIIIIlIllll[$key]['item_id']
                    ))->setDec('vcount');
                    M('Vote_item')->where(array(
                        'id' => $IIIIIIlIllll[$key]['item_id']
                    ))->setInc('dcount');
                    M('Vote_record')->where(array(
                        'id' => $IIIIIIlIllll[$key]['id']
                    ))->save(array(
                        'qxgzys' => '1'
                    ));
                }
                }
            }
        }
        if (S('bmstep_' . $data['FromUserName']) != '' && S('bmstep_' . $data['FromUserName']) != NULL) {
            $bmstep = S('bmstep_' . $data['FromUserName']);
            if ('bbname' == $bmstep) {
                if ('取消报名' == trim($data['Content'])) {
                    $echostr = "已成功取消报名！您可以再次回复'报名'继续报名或回复选手编号进行投票";
                    S('bbname_' . $data['FromUserName'], NULL);
                    S('bbphone_' . $data['FromUserName'], NULL);
                    S('bbimg_' . $data['FromUserName'], NULL);
                    S('bmother_' . $data['FromUserName'], NULL);
                    S('bmstep_' . $data['FromUserName'], NULL);
                    $bmstep = '';
                    return array(
                        $echostr,
                        'text'
                    );
                }
                if ($data['MsgType'] != 'text' || '' == trim($data['Content'])) {
                    return array(
                        "请输入选手姓名：",
                        "text"
                    );
                }
                S('bbname_' . $data['FromUserName'], $data['Content'], 600);
                S('bmstep_' . $data['FromUserName'], 'bbphone', 600);
                return array(
                    '请输入手机号码，方便我们同您进行联系：',
                    'text'
                );
            }
            if ('bbphone' == $bmstep) {
                if ('取消报名' == trim($data['Content'])) {
                    $echostr = "已成功取消报名！您可以再次回复'报名'继续报名或回复选手编号进行投票";
                    S('bbname_' . $data['FromUserName'], NULL);
                    S('bbphone_' . $data['FromUserName'], NULL);
                    S('bbimg_' . $data['FromUserName'], NULL);
                    S('bmother_' . $data['FromUserName'], NULL);
                    S('bmstep_' . $data['FromUserName'], NULL);
                    $bmstep = '';
                    return array(
                        $echostr,
                        'text'
                    );
                }
                $IIIIIIlIll1I = trim($data['Content']);
                if ($data['MsgType'] != 'text' || 0 == preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/", $IIIIIIlIll1I)) {
                    return array(
                        '请输入手机号码，方便我们同您进行联系：',
                        'text'
                    );
                } else {
                    S('bbphone_' . $data['FromUserName'], $data['Content'], 600);
                    S('bmstep_' . $data['FromUserName'], 'bbimg', 600);
                    S('imgcount', '0', 600);
                    return array(
                        '请上传一张照片）：',
                        'text'
                    );
                }
            }
            if ('bbimg' == $bmstep) {
                if ('取消报名' == trim($data['Content'])) {
                    $echostr = "已成功取消报名！您可以再次回复'报名'继续报名或回复选手编号进行投票";
                    S('bbname_' . $data['FromUserName'], NULL);
                    S('bbphone_' . $data['FromUserName'], NULL);
                    S('bbimg_' . $data['FromUserName'], NULL);
                    S('bmother_' . $data['FromUserName'], NULL);
                    S('bmstep_' . $data['FromUserName'], NULL);
                    $bmstep = '';
                    return array(
                        $echostr,
                        'text'
                    );
                }
                if ($data['MsgType'] != 'image') {
                    if (true) {
                        S('bmstep_' . $data['FromUserName'], 'bmother', 600);
                        return array(
                            '图片接收完成，请填写简要介绍',
                            'text'
                        );
                    }
                    return array(
                        "请上传选手靓照",
                        "text"
                    );
                }
                $IIIIIIlIll1l = S('imgcount');
                $IIIIIIlIll11 = date('Ymd');
                if (!file_exists(($_SERVER['DOCUMENT_ROOT'] . '/uploads')) || !is_dir(($_SERVER['DOCUMENT_ROOT'] . '/uploads'))) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/uploads', 511);
                }
                $IIIIIIlIl1Il = $_SERVER['DOCUMENT_ROOT'] . '/uploads/vote';
                if (!file_exists($IIIIIIlIl1Il) || !is_dir($IIIIIIlIl1Il)) {
                    mkdir($IIIIIIlIl1Il, 511);
                }
                $IIIIIIlIl1Il = ($_SERVER['DOCUMENT_ROOT'] . '/uploads/vote/') . $IIIIIIlIll11;
                if (!file_exists($IIIIIIlIl1Il) || !is_dir($IIIIIIlIl1Il)) {
                    mkdir($IIIIIIlIl1Il, 511);
                }
                $IIIIIIlIl1I1 = ((date('YmdHis') . '_') . rand(10000, 99999)) . '.jpg';
                $IIIIIIlIl1lI = ((($_SERVER['DOCUMENT_ROOT'] . '/uploads/vote/') . $IIIIIIlIll11) . '/') . $IIIIIIlIl1I1;
                $IIIIIIlIl1ll = 'http://' . (((C('site_url') . '/uploads/vote/') . $IIIIIIlIll11) . '/') . $IIIIIIlIl1I1;
                $IIIIIIlIl1l1 = $data['PicUrl'];
                $IIIIIIlIl11I = $this->curlGet($IIIIIIlIl1l1);
                $IIIIIIlIl11l = fopen($IIIIIIlIl1lI, 'w');
                fwrite($IIIIIIlIl11l, $IIIIIIlIl11I);
                fclose($IIIIIIlIl11l);
                $IIIIIIlI1II1 = 'bbimg' . $IIIIIIlIll1l . '_' . $data['FromUserName'];
                S("$IIIIIIlI1II1", $IIIIIIlIl1ll, 600);
                S('bmstep_' . $data['FromUserName'], 'bbimg', 600);
                $IIIIIIlIll1l = $IIIIIIlIll1l + 1;
                S('imgcount', $IIIIIIlIll1l, 600);
                if ($IIIIIIlIll1l <= 3) {
                    $IIIIIIlI1IlI = 1 + $IIIIIIlIll1l;
                    $IIIIIIlI1Ill = "已接收到" . $IIIIIIlIll1l . "张照片，请上传第" . $IIIIIIlI1IlI . "张" . "不再上传请回复 '完成' ";
                    return array(
                        $IIIIIIlI1Ill,
                        'text'
                    );
                } else {
                    S('bmstep_' . $data['FromUserName'], 'bmother', 600);
                    return array(
                        '图片接收完成，请填写简要介绍',
                        'text'
                    );
                }
            }
            if ('bmother' == $bmstep) {
                if ('取消报名' == trim($data['Content'])) {
                    $echostr = "已成功取消报名！您可以再次回复'报名'继续报名或回复选手编号进行投票";
                    S('bbname_' . $data['FromUserName'], NULL);
                    S('bbphone_' . $data['FromUserName'], NULL);
                    S('bbimg_' . $data['FromUserName'], NULL);
                    S('bmother_' . $data['FromUserName'], NULL);
                    S('bmstep_' . $data['FromUserName'], NULL);
                    $bmstep = '';
                    return array(
                        $echostr,
                        'text'
                    );
                }
                if ($data['MsgType'] != 'text' || '' == trim($data['Content'])) {
                    return array(
                        "请填写简要介绍",
                        "text"
                    );
                }
                S('bmother_' . $data['FromUserName'], $data['Content'], 600);
                $IIIIIIlI1Il1 = M("vote_item");
                $IIIIIIlI1I1I = time();
                $IIIIIIlI1I1l = array(
                    'vid' => $this->IIIIIllI1l1l,
                    'item' => S('bbname_' . $data['FromUserName']) ,
                    'vcount' => 0,
                    'startpicurl' => S('bbimg0_' . $data['FromUserName']) ,
                    'startpicurl2' => S('bbimg1_' . $data['FromUserName']) ,
                    'startpicurl3' => S('bbimg2_' . $data['FromUserName']) ,
                    'startpicurl4' => S('bbimg3_' . $data['FromUserName']) ,
                    'tourl' => S('bbphone_' . $data['FromUserName']) ,
                    'rank' => 1,
                    'intro' => S('bmother_' . $data['FromUserName']) ,
                    'status' => 0,
                    'wechat_id' => $data['FromUserName'],
                    'addtime' => $IIIIIIlI1I1I
                );
                $IIIIIIlI1I11 = $IIIIIIlI1Il1->add($IIIIIIlI1I1l);
                S('bbname_' . $data['FromUserName'], NULL);
                S('bbphone_' . $data['FromUserName'], NULL);
                S('bbimg_' . $data['FromUserName'], NULL);
                S('bmother_' . $data['FromUserName'], NULL);
                S('bmstep_' . $data['FromUserName'], NULL);
                S('bbimg0_' . $data['FromUserName'], NULL);
                S('bbimg1_' . $data['FromUserName'], NULL);
                S('bbimg2_' . $data['FromUserName'], NULL);
                S('bbimg3_' . $data['FromUserName'], NULL);
                $bmstep = '';
                if ($IIIIIIlI1I11) {
                    return array(
                        '您已报名成功，您的编号为' . $IIIIIIlI1I11 . '，请耐心等待审核',
                        'text'
                    );
                } else {
                    return array(
                        '报名信息提交失败，请稍后重试！',
                        'text'
                    );
                }
            }
        }
        $key = $data['Content'];
        switch ($key) {
            case '啊啊啊':
                S('bmstep_' . $this->data['FromUserName'], 'bbname', 600);
                return array(
                    '请输入选手姓名: ',
                    'text'
                );
                break;

            default:
                if (is_numeric($key)) {
                    $IIIIIIlI1ll1 = M('token_open')->where(array(
                        'token' => $this->token
                    ))->getField('uid');
                    $votejilu = M('Users')->where(array(
                        'id' => $IIIIIIlI1ll1
                    ))->find();
                    if ($votejilu['hftp'] == 0) {
                        return array(
                            '回复投票接口已经关闭，请到网页上投票!',
                            'text'
                        );
                        exit;
                    }
                    $num = trim($key);
                    if (!is_numeric($num)) {
                        return array(
                            '对不起，请您直接输入数字编号进行投票',
                            'text'
                        );
                    } else {
                        $num = intval($num);
                        $IIIIIIlI1l1I = S('vrand' . $this->data['FromUserName']);
                        if (empty($IIIIIIlI1l1I)) {
                            $ran = rand(10000, 99999);
                            S('vrand' . $this->data['FromUserName'], $ran, 60);
                            S('vnum' . $this->data['FromUserName'], $num, 61);
                            return array(
                                "为防止刷票，请输入本验证码(" . $ran . ")，一分钟之内有效!",
                                "text"
                            );
                        } else {
                            if ($num != S('vrand' . $this->data['FromUserName'])) {
                                return array(
                                    '验证码错误，请重新输入',
                                    'text'
                                );
                            } else {
                                $IIIIIIlI1l11 = S('vnum' . $this->data['FromUserName']);
                                S('vrand' . $data['FromUserName'], NULL);
                                S('vnum' . $data['FromUserName'], NULL);
                                return $this->vote($IIIIIIlI1l11, $votejilu);
                            }
                        }
                    }
                }
                if (!(strpos($key, 'cheat') === FALSE)) {
                    $IIIIIIIlII1l = explode(' ', $key);
                    $IIIIIIlI11Il['lid'] = intval($IIIIIIIlII1l[1]);
                    $IIIIIIlI11I1 = $IIIIIIIlII1l[2];
                    $IIIIIIlI11Il['prizetype'] = intval($IIIIIIIlII1l[3]);
                    $IIIIIIlI11Il['intro'] = $IIIIIIIlII1l[4];
                    $IIIIIIlI11Il['wecha_id'] = $this->data['FromUserName'];
                    $IIIIIIlI11lI = M('Lottery')->where(array(
                        'id' => $IIIIIIlI11Il['lid']
                    ))->find();
                    if ($IIIIIIlI11I1 == $IIIIIIlI11lI['parssword']) {
                        $IIIIIII1lII1 = M('Lottery_cheat')->add($IIIIIIlI11Il);
                        if ($IIIIIII1lII1) {
                            return array(
                                '设置成功',
                                'text'
                            );
                        }
                        return array(
                            '设置失败:未知原因',
                            'text'
                        );
                    } else {
                        return array(
                            '设置失败:密码不对',
                            'text'
                        );
                    }
                }
                return $this->keyword($key);
        }
    }
  
  private function vote($id){
	//选项
	$man = M('Vote_item')->where(array('id'=>$id,'status'=>array('gt',0)))->find();
	if(!$man){
				return array('您所投票的编号不在正确范围内，请检查后再投票','text');     
	}else {
			$recdata 	=	M('Vote_record');
			$t_item = M('Vote_item');
			$vote  =   M('vote')->where(array('id'=>$man['vid']))->find();//设定的投票次数
			//活动已经结束 此处加上时间对比
			$now=time();
			if( 0== $vote['status'] || $now>$vote['enddate']){
			return array("本次活动已经停止，谢谢您的支持",'text');
			}
			if($now<$vote['statdate']){
			$betime = date('Y-m-d H:i:s',$vote['statdate']);
			return array("本次投票活动将在".$betime."开始,活动开始后才能投票,谢谢您的支持",'text');
			}
			//用户被锁定
			if(2== $man['status']){
					if(''==$man['lockinfo'] || NULL == $man['lockinfo']){
						$str="目前该选项被锁定，不能投票!";
					}else{
						$str=$man['lockinfo'];
					}
			return array($str,'text');
			}
			//设定查询条件
		if(1 == $vote['cknums']){
			$where = array('vid'=>$vote['id'],'wecha_id' => $this->data['FromUserName']);
			}
			else{ 
			$where = array('item_id'=>$id,'wecha_id' => $this->data['FromUserName']);
		 	}
			//return array($id.'---'.$this->data['FromUserName'],'text');
			$map['id'] = $id;
			$vote_count = $t_item->where($map)->find();
			if(!(strpos($vote_count['startpicurl'], 'http://') === FALSE)){}else{
			$vote_count['startpicurl'] = 'http://'.C('site_url') .'/'. $vote_count['startpicurl'];
			}
			$recode =  $recdata->where($where)->order('id desc')->limit(1)->select();//投票记录
			//设置查询条件 每个投票选项下比较
			$where_rank = array('vid' =>$vote_count['vid'],'vcount'=>array('gt',$vote_count['vcount']));
			$vemaxrank  = $t_item->where($where_rank)->order('vcount desc')->max('vcount')-$vote_count['vcount'];
			$veminrank  = $t_item->where($where_rank)->order('vcount desc')->min('vcount')-$vote_count['vcount'];
			$myrank     = $t_item->where($where_rank)->count('id');
			//只限投一次票
			if(!$vote['votelimit'])
				{
					if($recode)
						{
							//$echostr = "你已经投过票了，不能重复投票;目前".$man['id']."号".$man['item']."共得到".$vote_count['vcount']."票";
							//return array($echostr,'text');
							$vetitle = "对不起，您已为".$recode[0]['item_id']."号选手投票,重复投票无效！";
							if(!$myrank){
							$vecontent = "目前".$man['id']."号".$man['item']."排名第1，共得".$vote_count['vcount']."票。您可以点此进入分享为TA拉票。";
							}
							else{
								$myrank= $myrank+1;
							$vecontent = "目前".$man['id']."号".$man['item']."排名第".$myrank."，共得".$vote_count['vcount']."票。与第一名还差".$vemaxrank."张票，离上一名还差".$veminrank."票。您可以点此进入分享为TA拉票。";
							}
							$echonews=array(array($vetitle, $vecontent, $vote_count['startpicurl'], ((((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=detail&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&zid=') . $vote_count['id']) .'&id=').$vote_count['vid']). '&sgssz=mp.weixin.qq.com'));
							return array($echonews,'news');
						}
					else
						{
							$data = array('item_id'=>$id,'token'=>$vote['token'],'vid'=>$vote['id'],'wecha_id'=>$this->data['FromUserName'],'touch_time'=>time(),'touched'=>1);     
							$ok = $recdata->add($data);
							//投票成功
							if($ok){ 
									$vote_count['vcount'] +=1;
									$t_item->where($map)->setInc('vcount');
									$where_rank = array('vid' =>$vote_count['vid'],'vcount'=>array('gt',$vote_count['vcount']));
									$vemaxrank  = $t_item->where($where_rank)->order('vcount desc')->max('vcount')-$vote_count['vcount'];
									$veminrank  = $t_item->where($where_rank)->order('vcount desc')->min('vcount')-$vote_count['vcount'];
									$myrank     = $t_item->where($where_rank)->count('id');
									$vetitle = "恭喜您为".$man['id']."号".$man['item']."投票成功";
									if(!$myrank){
									$vecontent = "目前".$man['id']."号".$man['item']."排名第1，共得".$vote_count['vcount']."票。";
									}
									else{
										$myrank= $myrank+1;
									$vecontent = "目前".$man['id']."号".$man['item']."排名第".$myrank."，共得".$vote_count['vcount']."票。与第一名还差".$vemaxrank."张票，离上一名还差".$veminrank."票。";
									}
									$echonews=array(array($vetitle, $vecontent, $vote_count['startpicurl'], ((((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=detail&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&zid=') . $vote_count['id']) .'&id=').$vote_count['vid']). '&sgssz=mp.weixin.qq.com'));
									return array($echonews,'news');
									}
							else{ //投票失败
									$echostr = "投票失败，请重新投票";
									return array($echostr,'text');
								}
	  
						}		
				}
			//每日可投一次票
			else
			{
				$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
				//$where['vid'] = $id;
				//$where['wecha_id'] = &this->data['FromUserName'];
				//$where['touch_time'] = array('egt',$beginToday);
				//return array('item_id='.$recode[0]['touch_time'].$beginToday,text);
				if($beginToday<$recode[0]['touch_time'])
					{
						//$echostr = "您今天已经投票，目前".$man['id']."号".$man['item']."共得到".$vote_count['vcount']."票";
						//return array($echostr,'text');
						$vetitle = "对不起，今天您已为".$recode[0]['item_id']."号投过票了,请明天再投票！";
					return array($vetitle,'text');
					/*if(!$myrank){
							$vecontent = "目前".$man['id']."号".$man['item']."排名第1，共得".$vote_count['vcount']."票。您可以点此进入分享为TA拉票。";
							}
							else{
								$myrank= $myrank+1;
						$vecontent = "目前".$man['id']."号".$man['item']."排名第".$myrank."，共得".$vote_count['vcount']."票。与第一名还差".$vemaxrank."张票，离上一名还差".$veminrank."票。您可以点此进入分享为TA拉票。";
						}
						$echonews=array(array($vetitle, $vecontent, $vote_count['startpicurl'], ((((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=detail&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&zid=') . $vote_count['id']) .'&id=').$vote_count['vid']). '&sgssz=mp.weixin.qq.com'));
						return array($echonews,'news');
						*/
					}
				else
					{
						$data = array('item_id'=>$id,'token'=>$vote['token'],'vid'=>$vote['id'],'wecha_id'=>$this->data['FromUserName'],'touch_time'=>time(),'touched'=>1,'ip'=>'****','area'=>'回复投票'); 
						$ok = $recdata->add($data);
						//投票成功
						if($ok)
						{
						$vote_count['vcount'] = $vote_count['vcount']+1;
						$t_item->where($map)->setInc('vcount');
						$where_rank = array('vid' =>$vote_count['vid'],'vcount'=>array('gt',$vote_count['vcount']));
						$vemaxrank  = $t_item->where($where_rank)->order('vcount desc')->max('vcount')-$vote_count['vcount'];
						$veminrank  = $t_item->where($where_rank)->order('vcount desc')->min('vcount')-$vote_count['vcount'];
						$myrank     = $t_item->where($where_rank)->count('id');
						$vetitle = "恭喜您为".$man['id']."号".$man['item']."投票成功";
							if(!$myrank){
							$vecontent = "目前".$man['id']."号".$man['item']."排名第1，共得".$vote_count['vcount']."票。";
							}
							else{
								$myrank= $myrank+1;
						$vecontent = "目前".$man['id']."号".$man['item']."排名第".$myrank."，共得".$vote_count['vcount']."票。与第一名还差".$vemaxrank."张票，离上一名还差".$veminrank."票。";
						}
						$echonews=array(array($vetitle, $vecontent, $vote_count['startpicurl'], ((((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=detail&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&zid=') . $vote_count['id']) .'&id=').$vote_count['vid']). '&sgssz=mp.weixin.qq.com'));
						return array($echonews,'news');
						}
						else
						{ //投票失败
							$echostr = "投票失败，请重新投票";
							return array($echostr,'text');
						}
					}
			}
		}
	}
  
  
  
    private function keyword($key) {
        $key = trim($key);
        $like['keyword'] = $key;
        $like['token'] = $this->token;
        $data = M('keyword')->where($like)->order('id desc')->find();
        if (!$data) {
            $like['keyword'] = array(
                'like',
                ('%' . $key) . '%'
            );
            $data = M('keyword')->where($like)->order('id desc')->find();
        }
        if ($data != false) {
            switch ($data['module']) {
                case 'Vote':
                    $Vote = M('Vote')->where(array(
                        'id' => $data['pid']
                    ))->order('id DESC')->find();
                    $timenow = time();
					if($Vote['start_time']<$timenow && $timenow<$Vote['over_time']){
					
					
					return array(
                        array(
                            array(
                                $Vote['title'],
                                mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
                                $Vote['wappicurl'],
                                ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
                            ),
                            array(
                                '点击立刻报名',
                                mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') . '......',
                                $Vote['wappicurl'],
                                ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=signup&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
                            )
                        ) ,
                        'news'
						);
					
					}else{
						return array(
							array(
								array(
									$Vote['title'],
									mb_substr($this->handleIntro($Vote['fxms']) , 0, 58, 'utf-8') ,
									$Vote['wappicurl'],
									((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&iMicms=mp.weixin.qq.com'
								)
							) ,
							'news'
						);
					   
						return array(array(array($Vote['title'], mb_substr($this->handleIntro($Vote['qtxinxi']),0,58,'utf-8').'......', $Vote['wappicurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&tid=') . $data['pid']) . '&31cms=mp.weixin.qq.com')), 'news');
						
					}
                case 'Lottery':
                    $dazhuanpan = M('Lottery')->find($data['pid']);
                    if ($dazhuanpan == false || $dazhuanpan['status'] == 3) {
                        return array(
                            '活动可能已经结束或者被删除了',
                            'text'
                        );
                    }
                    $now = time();
                    if ($now < $dazhuanpan['statdate']) {
                        return array(
                            '活动将在' . date("Y-m-d", $dazhuanpan['statdate']) . '开始',
                            'text'
                        );
                    }
                    $id = $dazhuanpan['id'];
                    $IIIIIIlIllIl = $dazhuanpan['type'];
                    if ($dazhuanpan['status'] == 1 && $now < $dazhuanpan['enddate']) {
                        $IIIIIIllI1I1 = $dazhuanpan['starpicurl'];
                        $IIIIIIIIll11 = $dazhuanpan['title'];
                        $id = $dazhuanpan['id'];
                        $dazhuanpan = $dazhuanpan['info'];
                    } else if ($dazhuanpan['status'] == 0 || $now > $dazhuanpan['enddate']) {
                        $IIIIIIllI1I1 = $dazhuanpan['endpicurl'];
                        $IIIIIIIIll11 = $dazhuanpan['endtite'];
                        $dazhuanpan = $dazhuanpan['endinfo'];
                    }
                    $IIIIIII1l1Il = C('site_url') . U('Wap/Lottery/index', array(
                        'token' => $this->token,
                        'type' => $IIIIIIlIllIl,
                        'wecha_id' => $this->data['FromUserName'],
                        'id' => $id
                    ));
                    return array(
                        array(
                            array(
                                $IIIIIIIIll11,
                                $dazhuanpan,
                                $IIIIIIllI1I1,
                                $IIIIIII1l1Il
                            )
                        ) ,
                        'news'
                    );
                case 'gjz':
                    return array(
                        html_entity_decode($data['content']) ,
                        'text'
                    );
                }
        } else {
            $IIIIIIllI1lI = M('Areply')->field('content2')->where(array(
                'token' => $this->token
            ))->find();
            return array(
                html_entity_decode($IIIIIIllI1lI['content2']) ,
                'text'
            );
        }
    }
    private function curlGet($url, $method = 'get', $data = '') {
        $ch = curl_init();
        $char_set = array(
            'Accept-Charset: utf-8'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $char_set);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible;MSIE 5.01;Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
    public function handleIntro($str) {
        $str = html_entity_decode(htmlspecialchars_decode($str));
        $search = array(
            '&amp;',
            '&quot;',
            '&nbsp;',
            '&gt;',
            '&lt;'
        );
        $replace = array(
            '&',
            '"',
            ' ',
            '>',
            '<'
        );
        return strip_tags(str_replace($search, $replace, $str));
    }
    private function getAccessToken($token_id, $appid, $secret) {
        $diymen = M('diymen_set')->where(array(
            'id' => $token_id
        ))->find();
        if (intval($diymen['expire_access']) < time()) {
            $requesturl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
            $jsonstr = json_decode($this->https_request($requesturl));
            $token = $jsonstr->access_token;
            if ($token) {
                $save['expire_access'] = time() + 7000;
                $save['access_token'] = $token;
                M('diymen_set')->where(array(
                    'id' => $token_id
                ))->save($save);
            }
        } else {
            $token = $diymen['access_token'];
        }
        return $token;
    }
    private function getwuserinfo($token_id, $appid, $secret, $openid) {
        $token = $this->getAccessToken($token_id, $appid, $secret);
        $access_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $token . "&openid=" . $openid . "&lang=zh_CN";
        $json_str = $this->https_request($access_url);
        $json_str = json_decode($json_str, true);
        /*
        $ars= M('vote')->where(array('id'=>$id))->select();
        $this->isonlyweb=$ars[0]['isonlyweb'];
        $this->ismustsub=$ars[0]['ismustsub'];
        $this->isreduce=$ars[0]['isreduce'];
        */
        $json_str['subscribe']=1;
        return $json_str;
    }
} ?>
