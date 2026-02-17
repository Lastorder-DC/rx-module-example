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
class ItemList extends Base
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
	 * 글 목록 화면
	 */
	public function dispExampleList()
	{
		// 페이지 번호
		$page = max(1, intval(Context::get('page')));

		// DB에서 글 목록 가져오기
		$args = new \stdClass;
		$args->module_srl = $this->module_info->module_srl;
		$args->page = $page;
		$args->list_count = 20;
		$args->page_count = 10;
		$args->sort_index = 'item_srl';
		$output = executeQuery('example.getItemList', $args);

		// 목록 데이터를 Context에 세팅
		Context::set('item_list', $output->data ?: []);
		Context::set('total_count', $output->total_count ?? 0);
		Context::set('total_page', $output->total_page ?? 1);
		Context::set('page', $page);
		Context::set('page_navigation', $output->page_navigation);

		// 뷰 파일명 지정
		$this->setTemplateFile('list');
	}
}
