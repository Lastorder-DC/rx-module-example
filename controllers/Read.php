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

		// 필요한 설정값만 선택적으로 Context에 세팅
		$config = ConfigModel::getConfig();
		Context::set('example_config', $config->example_config ?? '');
	}
	
	/**
	 * 글읽기 화면 예제
	 */
	public function dispModule_exampleRead()
	{
		// 글번호 받아오기
		$item_srl = Context::get('item_srl');
		if (!$item_srl)
		{
			return $this->stop('msg_invalid_request');
		}

		// DB에서 글 가져오기
		$args = new \stdClass;
		$args->item_srl = $item_srl;
		$output = executeQuery('module_example.getItem', $args);
		if (!$output->toBool() || !$output->data)
		{
			return $this->stop('msg_not_founded');
		}

		// 글 데이터를 Context에 세팅
		Context::set('item', $output->data);

		// 뷰 파일명 지정
		$this->setTemplateFile('read');
	}
}
