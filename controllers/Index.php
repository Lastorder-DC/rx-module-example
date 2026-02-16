<?php

namespace Rhymix\Modules\Module_example\Controllers;

/**
 * 라이믹스 모듈 예제
 * 
 * Copyright (c) Developer
 * 
 * Generated with https://www.poesis.dev/tools/rxmodulegen
 */
class Index extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 스킨 또는 뷰 경로 지정
		$this->setTemplatePath($this->module_path . 'skins/' . ($this->module_info->skin ?: 'default'));
	}
	
	/**
	 * 메인 화면 예제
	 */
	public function dispModule_exampleIndex()
	{
		// 뷰 파일명 지정
		$this->setTemplateFile('index');
	}
}
