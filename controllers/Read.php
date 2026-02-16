<?php

namespace Rhymix\Modules\Module_example\Controllers;

use Rhymix\Modules\Module_example\Models\Config as ConfigModel;
use Context;

/**
 * 라이믹스 모듈 예제
 * 
 * Copyright (c) Developer
 * 
 * Generated with https://www.poesis.dev/tools/rxmodulegen
 */
class Read extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 스킨 또는 뷰 경로 지정
		$this->setTemplatePath($this->module_path . 'skins/' . ($this->module_info->skin ?: 'default'));

		// 관리자 설정값을 Context에 세팅
		$config = ConfigModel::getConfig();
		Context::set('config', $config);
	}
	
	/**
	 * 글읽기 화면 예제
	 */
	public function dispModule_exampleRead()
	{
		// 글번호 받아오기
		$item_srl = \Context::get('item_srl');
		
		// 뷰 파일명 지정
		$this->setTemplateFile('read');
	}
}
