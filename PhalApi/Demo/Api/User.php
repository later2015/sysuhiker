<?php

class Api_User extends PhalApi_Api {

    public function getRules() {
        return array(
            'getBaseInfo' => array(
                'userId' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
            ),//userId是php里面的参数名，user_id是URL里的参数。TODO 登陆，修改个人信息，注册，重置密码
            'login' => array(
                'userEmail' => array('name' => 'user_email', 'type' => 'string', 'min' => 5, 'require' => true, 'desc' => '用户email'),
                'userPassword' => array('name' => 'user_psw', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '用户密码'),
            ),//用户登陆
            'register' => array(
                'userEmail' => array('name' => 'user_email', 'type' => 'string', 'min' => 5, 'require' => true, 'desc' => '用户email'),
                'userPassword' => array('name' => 'user_psw', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '用户密码'),
                'userName' => array('name' => 'user_name', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '真实姓名'),
                'userNick' => array('name' => 'user_nick', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '用户昵称'),
                'userGender' => array('name' => 'user_gender', 'type' => 'string', 'min' => 2, 'require' => true, 'desc' => '性别'),
                'userAddress' => array('name' => 'user_address', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '住址'),   
                'userPhone' => array('name' => 'user_phone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '电话'),   
                'userUrgentName' => array('name' => 'user_urgentname', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人'),   
                'userUrgentPhone' => array('name' => 'user_urgentphone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人电话'),  
                'userQQ' => array('name' => 'user_qq', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => 'QQ'), 
                'userInterest' => array('name' => 'user_interest', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '兴趣领域'),  
                'userComments' => array('name' => 'user_comments', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '备注'),                                                                
            ),//用户注册
            'update' => array(
                'userId' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
                'userEmail' => array('name' => 'user_email', 'type' => 'string', 'min' => 5, 'require' => true, 'desc' => '用户email'),
                'userPassword' => array('name' => 'user_psw', 'type' => 'string', 'min' => 0, 'require' => FALSE, 'desc' => '用户密码'),
                'userName' => array('name' => 'user_name', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '真实姓名'),
                'userNick' => array('name' => 'user_nick', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '用户昵称'),
                'userGender' => array('name' => 'user_gender', 'type' => 'string', 'min' => 2, 'require' => true, 'desc' => '性别'),
                'userAddress' => array('name' => 'user_address', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '住址'),   
                'userPhone' => array('name' => 'user_phone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '电话'),   
                'userUrgentName' => array('name' => 'user_urgentname', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人'),   
                'userUrgentPhone' => array('name' => 'user_urgentphone', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '紧急联系人电话'),  
                'userQQ' => array('name' => 'user_qq', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => 'QQ'), 
                'userInterest' => array('name' => 'user_interest', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '兴趣领域'),  
                'userComments' => array('name' => 'user_comments', 'type' => 'string', 'min' => 1, 'require' => FALSE, 'desc' => '备注'),    
            ),//用户修改个人资料
            'getMultiBaseInfo' => array(
                'userIds' => array('name' => 'user_ids', 'type' => 'array', 'format' => 'explode', 'require' => true, 'desc' => '用户ID，多个以逗号分割'),
            ),
        );
    }

    /**
     * 获取用户基本信息
     * @desc 用于获取单个用户基本信息，访问后缀 /PhalApi/Public/?service=User.GetBaseInfo&user_id=1
     * @return int code 操作码，0表示成功，1表示用户不存在
     * @return object info 用户信息对象
     * @return int info.user_id 用户ID
     * @return string info.user_name 用户名字
     * @return string info.... 包含用户表的所有信息，具体字段名参考用户表
     * @return string msg 提示信息
     */
    public function getBaseInfo() {
        DI()->logger->info('User.getBaseInfo api is call.',$this->userId);
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_User();
        $info = $domain->getBaseInfo($this->userId);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userId);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }
    /**
     * 登陆
     * @desc 用户登陆
     * @return int code 操作码，0表示成功，1表示用户不存在,2表示密码错误
     * @return string msg 提示信息
	 * @return string userid 用户id
     */
    public function login() {
        $rs = array('code' => 0, 'msg' => '','userid'=>'');
		$email=$this->userEmail;
		$password=$this->userPassword;
        DI()->logger->info('User.login api is call.',$email);

		//系统框架会自动检查必要的字段输入是否为空
        $domain = new Domain_User();
        $info = $domain->login($email,$password);//登陆成功返回userid

        if (empty($info)) {
            DI()->logger->debug('username or password not right');

            $rs['code'] = 1;
            $rs['msg'] = T('username or password not right');
            return $rs;
        }

        $rs['userid'] = $info;

        return $rs;
    }
    /**
     * 用户注册
     * @desc 用于用户注册
     * @return int code 操作码，0表示成功，1失败
     * @return string userid 用户id
     * @return string msg 提示信息
     */
    public function register() {
        $rs = array('code' => 0, 'msg' => '', 'userid' => '');
		$input = array('user_email' => $this->userEmail, 'user_psw' => $this->userPassword, 'user_name' => $this->userName,
		'user_nick' => $this->userNick, 'user_gender' => $this->userGender, 'user_address' => $this->userAddress,
		'user_phone' => $this->userPhone, 'user_urgentname' => $this->userUrgentName, 'user_urgentphone' => $this->userUrgentPhone,
		'user_qq' => $this->userQQ, 'user_interest' => $this->userInterest, 'user_comments' => $this->userComments);
        DI()->logger->info('User.register api is call.',$input);

        $domain = new Domain_User();
        $info = $domain->register($input);

        if (empty($info)) {
            DI()->logger->debug('register fail');

            $rs['code'] = 1;
            $rs['msg'] = T('register fail.');
            return $rs;
        }elseif(!empty($info['error'])){
        	$rs['code'] = 1;
            $rs['msg'] = T($info['error']);
            return $rs;
        }

        $rs['userid'] = $info['userid'];

        return $rs;
    }	
    /**
     * 更新用户资料
     * @desc 用于更新用户资料
     * @return int code 操作码，0表示成功，1失败
     * @return string msg 提示信息
     */
    public function update() {
        $rs = array('code' => 0, 'msg' => '');
		$input = array('user_id' => $this->userId,'user_email' => $this->userEmail, 'user_psw' => $this->userPassword, 'user_name' => $this->userName,
		'user_nick' => $this->userNick, 'user_gender' => $this->userGender, 'user_address' => $this->userAddress,
		'user_phone' => $this->userPhone, 'user_urgentname' => $this->userUrgentName, //'user_urgentphone' => $this->userUrgentPhone,
		'user_qq' => $this->userQQ, 'user_interest' => $this->userInterest, 'user_comments' => $this->userComments);

        DI()->logger->info('User.update api is call.',$input);

        $domain = new Domain_User();
        $info = $domain->update($input);

        if ($info===FALSE) {
            DI()->logger->debug('update fail');

            $rs['code'] = 1;
            $rs['msg'] = T('update fail');
            return $rs;
        }

        return $rs;
    }		
    /**
     * 批量获取用户基本信息
     * @desc 用于获取多个用户基本信息
     * @return int code 操作码，0表示成功
     * @return array list 用户列表
     * @return int list[].user_id 用户ID
     * @return string list[].user_name 用户名字
     * @return string list[]..... 其他字段参考用户信息表
     * @return string msg 提示信息
     */
    public function getMultiBaseInfo() {
        DI()->logger->info('User.getMultiBaseInfo api is call.',$this->userIds);

        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_User();
        foreach ($this->userIds as $userId) {
            $rs['list'][] = $domain->getBaseInfo($userId);
        }

        return $rs;
    }
}
