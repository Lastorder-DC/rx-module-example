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
class Index extends Base
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
		Context::set('radio_config', $config->radio_config ?? '');
		Context::set('checkbox_config', $config->checkbox_config ?? []);
		Context::set('input_config', $config->input_config ?? '');
		Context::set('input_mlang_config', $config->input_mlang_config ?? '');
		Context::set('textarea_config', $config->textarea_config ?? '');
		Context::set('textarea_mlang_config', $config->textarea_mlang_config ?? '');
	}
	
	/**
	 * 메인 화면 예제
	 */
	public function dispExampleIndex()
	{
		// 뷰 파일명 지정
		$this->setTemplateFile('index');
	}
}
