<?php

namespace Rhymix\Modules\Module_example\Controllers;

use Rhymix\Framework\Cache;
use Rhymix\Framework\DB;
use Rhymix\Framework\Exception;
use Rhymix\Framework\Storage;
use Rhymix\Modules\Module_example\Models\Config as ConfigModel;
use BaseObject;
use Context;

/**
 * 라이믹스 모듈 예제
 *
 * Copyright (c) Developer
 *
 * Generated with https://www.poesis.dev/tools/rxmodulegen
 */
class Admin extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 관리자 화면 템플릿 경로 지정
		$this->setTemplatePath($this->module_path . 'views/admin/');
	}

	/**
	 * 관리자 설정 화면 예제
	 */
	public function dispModule_exampleAdminConfig()
	{
		// 현재 설정 상태 불러오기
		$config = ConfigModel::getConfig();

		// Context에 세팅
		Context::set('config', $config);

		// 스킨 파일 지정
		$this->setTemplateFile('config');
	}

	/**
	 * 관리자 설정 저장 액션 예제
	 */
	public function procModule_exampleAdminInsertConfig()
	{
		// 현재 설정 상태 불러오기
		$config = ConfigModel::getConfig();

		// 제출받은 데이터 불러오기
		$vars = Context::getRequestVars();

		// 제출받은 데이터를 각각 적절히 필터링하여 설정 변경
		if (in_array($vars->example_config, ['Y', 'N']))
		{
			$config->example_config = $vars->example_config;
		}
		else
		{
			return new BaseObject(-1, '설정값이 이상함');
		}

		// 라디오박스 설정 저장
		if (in_array($vars->radio_config, ['A', 'B', 'C']))
		{
			$config->radio_config = $vars->radio_config;
		}

		// 체크박스 설정 저장
		$config->checkbox_config = is_array($vars->checkbox_config) ? array_values(array_intersect($vars->checkbox_config, ['item1', 'item2', 'item3'])) : [];

		// 한줄 input 설정 저장
		$config->input_config = strval($vars->input_config ?? '');

		// 한줄 input 다국어 설정 저장
		$config->input_mlang_config = $vars->input_mlang_config ?? '';

		// textarea 설정 저장
		$config->textarea_config = strval($vars->textarea_config ?? '');

		// textarea 다국어 설정 저장
		$config->textarea_mlang_config = $vars->textarea_mlang_config ?? '';

		// 변경된 설정을 저장
		$output = ConfigModel::setConfig($config);
		if (!$output->toBool())
		{
			return $output;
		}

		// 설정 화면으로 리다이렉트
		$this->setMessage('success_registed');
		$this->setRedirectUrl(Context::get('success_return_url'));
	}
}
