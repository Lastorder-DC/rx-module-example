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
class Write extends Base
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
	 * 글쓰기 화면 예제
	 */
	public function dispExampleWrite()
	{
		// 수정 모드인 경우 기존 글 데이터 가져오기
		$item_srl = Context::get('item_srl');
		if ($item_srl)
		{
			$args = new \stdClass;
			$args->item_srl = $item_srl;
			$output = executeQuery('example.getItem', $args);
			if ($output->toBool() && $output->data)
			{
				// 작성자 본인 확인
				$logged_info = Context::get('logged_info');
				if (!$logged_info || ($output->data->member_srl != $logged_info->member_srl && !$logged_info->is_admin))
				{
					return $this->stop('msg_not_permitted');
				}
				Context::set('item', $output->data);
			}
		}

		// 뷰 파일명 지정
		$this->setTemplateFile('write');
	}
	
	/**
	 * 글쓰기 POST 액션 예제
	 */
	public function procExampleWrite()
	{
		// 로그인 확인
		$logged_info = Context::get('logged_info');
		if (!$logged_info)
		{
			return new \BaseObject(-1, 'msg_not_logged');
		}

		// 제출받은 데이터 불러오기
		$vars = Context::getRequestVars();

		// 제목 필수값 확인
		$title = escape(trim($vars->title ?? ''), false);
		if (!$title)
		{
			return new \BaseObject(-1, 'msg_invalid_request');
		}

		$content = escape(trim($vars->content ?? ''), false);
		$item_srl = intval($vars->item_srl ?? 0);

		// 수정 모드
		if ($item_srl)
		{
			// 기존 글 확인
			$args = new \stdClass;
			$args->item_srl = $item_srl;
			$output = executeQuery('example.getItem', $args);
			if (!$output->toBool() || !$output->data)
			{
				return new \BaseObject(-1, 'msg_not_founded');
			}

			// 작성자 본인 확인
			if ($output->data->member_srl != $logged_info->member_srl && !$logged_info->is_admin)
			{
				return new \BaseObject(-1, 'msg_not_permitted');
			}

			// 업데이트
			$update_args = new \stdClass;
			$update_args->item_srl = $item_srl;
			$update_args->title = $title;
			$update_args->content = $content;
			$update_args->last_update = date('YmdHis');
			$output = executeQuery('example.updateItem', $update_args);
			if (!$output->toBool())
			{
				return $output;
			}
		}
		// 신규 작성
		else
		{
			$item_srl = getNextSequence();

			$args = new \stdClass;
			$args->item_srl = $item_srl;
			$args->module_srl = $this->module_info->module_srl;
			$args->member_srl = $logged_info->member_srl;
			$args->user_id = $logged_info->user_id;
			$args->user_name = $logged_info->user_name;
			$args->nick_name = $logged_info->nick_name;
			$args->title = $title;
			$args->content = $content;
			$args->regdate = date('YmdHis');
			$args->last_update = date('YmdHis');
			$args->ipaddress = \RX_CLIENT_IP;
			$output = executeQuery('example.insertItem', $args);
			if (!$output->toBool())
			{
				return $output;
			}
		}

		// 작성된 글로 리다이렉트
		$this->setMessage('success_registed');
		$this->setRedirectUrl(getNotEncodedUrl('', 'mid', $this->mid, 'act', 'dispExampleRead', 'item_srl', $item_srl));
	}
}
