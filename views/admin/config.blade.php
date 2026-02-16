@load('config.scss')
@load('config.js')

{{-- 템플릿 v2 문법은 https://rhymix.org/manual/theme/template_v2 참고하세요 --}}

<div class="x_page-header">
	<h1>{{ $lang->cmd_module_example }}</h1>
</div>

<ul class="x_nav x_nav-tabs">
	<li @class(['x_active' => $act === 'dispModule_exampleAdminConfig'])>
		<a href="@url(['module' => 'admin', 'act' => 'dispModule_exampleAdminConfig'])">{{ $lang->cmd_module_example_general_config }}</a>
	</li>
</ul>

<form class="x_form-horizontal" action="./" method="post" id="module_example">
	<input type="hidden" name="module" value="module_example" />
	<input type="hidden" name="act" value="procModule_exampleAdminInsertConfig" />
	<input type="hidden" name="success_return_url" value="{{ getRequestUriByServerEnviroment() }}" />
	<input type="hidden" name="xe_validator_id" value="modules/module_example/views/admin/config/1" />

	@if (!empty($XE_VALIDATOR_MESSAGE) && $XE_VALIDATOR_ID == 'modules/module_example/views/admin/config/1')
		<div class="message {{ $XE_VALIDATOR_MESSAGE_TYPE }}">
			<p>{{ $XE_VALIDATOR_MESSAGE }}</p>
		</div>
	@endif

	<section class="section">
		<div class="x_control-group">
			<label class="x_control-label" for="example_config">{{ $lang->cmd_module_example_example_config}} </label>
			<div class="x_controls">
				<select name="example_config" id="example_config">
					<option value="Y" @selected($config->example_config !== 'N')>{{ $lang->cmd_yes }}</option>
					<option value="N" @selected($config->example_config === 'N')>{{ $lang->cmd_no }}</option>
				</select>
			</div>
		</div>

		{{-- 라디오박스 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label">{{ $lang->cmd_module_example_radio_config }}</label>
			<div class="x_controls">
				<label class="x_inline">
					<input type="radio" name="radio_config" value="A" @checked(($config->radio_config ?? 'A') === 'A') /> {{ $lang->cmd_module_example_option_a }}
				</label>
				<label class="x_inline">
					<input type="radio" name="radio_config" value="B" @checked(($config->radio_config ?? '') === 'B') /> {{ $lang->cmd_module_example_option_b }}
				</label>
				<label class="x_inline">
					<input type="radio" name="radio_config" value="C" @checked(($config->radio_config ?? '') === 'C') /> {{ $lang->cmd_module_example_option_c }}
				</label>
				<p class="x_help-block">{{ $lang->cmd_module_example_radio_config_desc }}</p>
			</div>
		</div>

		{{-- 체크박스 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label">{{ $lang->cmd_module_example_checkbox_config }}</label>
			<div class="x_controls">
				<label class="x_inline">
					<input type="checkbox" name="checkbox_config[]" value="item1" @checked(is_array($config->checkbox_config ?? null) && in_array('item1', $config->checkbox_config)) /> {{ $lang->cmd_module_example_checkbox_item1 }}
				</label>
				<label class="x_inline">
					<input type="checkbox" name="checkbox_config[]" value="item2" @checked(is_array($config->checkbox_config ?? null) && in_array('item2', $config->checkbox_config)) /> {{ $lang->cmd_module_example_checkbox_item2 }}
				</label>
				<label class="x_inline">
					<input type="checkbox" name="checkbox_config[]" value="item3" @checked(is_array($config->checkbox_config ?? null) && in_array('item3', $config->checkbox_config)) /> {{ $lang->cmd_module_example_checkbox_item3 }}
				</label>
				<p class="x_help-block">{{ $lang->cmd_module_example_checkbox_config_desc }}</p>
			</div>
		</div>

		{{-- 한줄 input 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label" for="input_config">{{ $lang->cmd_module_example_input_config }}</label>
			<div class="x_controls">
				<input type="text" name="input_config" id="input_config" value="{{ $config->input_config ?? '' }}" />
				<p class="x_help-block">{{ $lang->cmd_module_example_input_config_desc }}</p>
			</div>
		</div>

		{{-- 한줄 input 다국어 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label" for="input_mlang_config">{{ $lang->cmd_module_example_input_mlang_config }}</label>
			<div class="x_controls">
				<input type="text" name="input_mlang_config" id="input_mlang_config" value="{{ $config->input_mlang_config ?? '' }}" class="lang_code" />
				<p class="x_help-block">{{ $lang->cmd_module_example_input_mlang_config_desc }}</p>
			</div>
		</div>

		{{-- textarea 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label" for="textarea_config">{{ $lang->cmd_module_example_textarea_config }}</label>
			<div class="x_controls">
				<textarea name="textarea_config" id="textarea_config" rows="8" cols="42">{{ $config->textarea_config ?? '' }}</textarea>
				<p class="x_help-block">{{ $lang->cmd_module_example_textarea_config_desc }}</p>
			</div>
		</div>

		{{-- textarea 다국어 예제 --}}
		<div class="x_control-group">
			<label class="x_control-label" for="textarea_mlang_config">{{ $lang->cmd_module_example_textarea_mlang_config }}</label>
			<div class="x_controls">
				<textarea name="textarea_mlang_config" id="textarea_mlang_config" class="lang_code" rows="8" cols="42">{{ $config->textarea_mlang_config ?? '' }}</textarea>
				<p class="x_help-block">{{ $lang->cmd_module_example_textarea_mlang_config_desc }}</p>
			</div>
		</div>
	</section>

	<div class="btnArea x_clearfix">
		<button type="submit" class="x_btn x_btn-primary x_pull-right">{{ $lang->cmd_registration }}</button>
	</div>

</form>
