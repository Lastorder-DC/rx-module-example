<?php

namespace Rhymix\Modules\Example\Controllers;

use Rhymix\Modules\Example\Models\Config as ConfigModel;
use Context;

/**
 * 라이믹스 모듈 예제
 *
 * Copyright (c) Developer
 *
 * Generated with https://www.poesis.dev/tools/rxmodulegen
 */
class UserInput extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 스킨 또는 뷰 경로 지정
		$this->setTemplatePath($this->module_path . 'skins/' . ($this->module_info->skin ?: 'default'));

		// 필요한 설정값만 선택적으로 Context에 세팅
		$config = ConfigModel::getConfig();
		Context::set('example_config', $config->example_config ?? '');
	}

	/**
	 * 유저 입력 화면 예제
	 */
	public function dispExampleUserInput()
	{
		// 뷰 파일명 지정
		$this->setTemplateFile('user_input');
	}
}
