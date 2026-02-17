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
class Delete extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
	}
	
	/**
	 * 글 삭제 POST 액션
	 */
	public function procExampleDelete()
	{
		// 로그인 확인
		$logged_info = Context::get('logged_info');
		if (!$logged_info)
		{
			return new \BaseObject(-1, 'msg_not_logged');
		}

		// 삭제할 글번호 확인
		$item_srl = intval(Context::get('item_srl'));
		if (!$item_srl)
		{
			return new \BaseObject(-1, 'msg_invalid_request');
		}

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

		// 삭제 실행
		$del_args = new \stdClass;
		$del_args->item_srl = $item_srl;
		$output = executeQuery('example.deleteItem', $del_args);
		if (!$output->toBool())
		{
			return $output;
		}

		// 목록으로 리다이렉트
		$this->setMessage('success_deleted');
		$this->setRedirectUrl(getNotEncodedUrl('', 'mid', $this->mid, 'act', 'dispExampleList'));
	}
}
