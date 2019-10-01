<?php ! isset( $_SESSION['user_admin'] ) && get_iframe( '013','Доступ закрыт' )?>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="badge"><?php echo $Modules->get_translate_module_phrase( 'module_page_adminpanel','_Module_loading')?></h5>
            <div class="select-panel select-panel-pages badge">
                <select onChange="window.location.href=this.value">
                    <option style="display:none" value="" disabled selected><?php echo get_section( 'module_page', 'home' )?></option>
                    <?php for ($i = 0;$i < $Modules->arr_module_init_page_count;$i++) {$id_module = array_keys( $Modules->arr_module_init['page'] )[ $i ]?>
                        <option value="<?php echo set_url_section(get_url(2), 'module_page', $id_module) ?>">
                            <a href="<?php echo set_url_section(get_url(2), 'module_page', $id_module) ?>">Страница: <?php echo $id_module?></a></option>
                    <?php } ?>
                    <option value="<?php echo set_url_section(get_url(2), 'module_page', 'sidebar') ?>">
                        <a href="<?php echo set_url_section(get_url(2), 'module_page', 'sidebar') ?>">sidebar</a></option>
                </select>
            </div>
        </div>
        <div class="card-container">
    <?php if( get_section( 'module_page', 'home' ) != '' ):?>
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php
                        $c_m_p = ( get_section( 'module_page', 'home' ) == 'sidebar' ) ? sizeof( $Modules->arr_module_init['sidebar'] ) : sizeof( $Modules->arr_module_init['page'][ get_section( 'module_page', 'home' ) ] ['interface'] );
                        for ( $i = 0; $i < $c_m_p; $i++ ) {
                            $data_id = ( get_section( 'module_page', 'home' ) == 'sidebar' ) ? $Modules->arr_module_init['sidebar'][ $i ] : $Modules->arr_module_init['page'][ get_section( 'module_page', 'home' ) ]['interface'][ $i ];
                            $data_title = ( get_section( 'module_page', 'home' ) == 'sidebar' ) ? $Modules->array_modules[$Modules->arr_module_init['sidebar'][ $i ]]['title'] : $Modules->array_modules[$Modules->arr_module_init['page'][ get_section( 'module_page', 'home' ) ]['interface'][ $i ]]['title']?>
                            <li class="dd-item" data-id="<?php echo $data_id?>">
                                <a class="module_setting" href="<?php echo $General->arr_general['site']?>?page=adminpanel&section=modules&options=<?php echo $data_id?>"><i class="zmdi zmdi-chevron-right zmdi-hc-fw"></i></a>
                                <div class="dd-handle"><?php echo $data_title?></div>
                            </li>
                        <?php } ?>
                    </ol>
                    <input type="hidden" id="nestable-output">
                </div>
    <?php endif; ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="badge"><?php echo $Modules->get_translate_module_phrase( 'module_page_adminpanel','_Options')?></h5>
        </div>
        <div class="card-container">
            <div class="btn_form">
            <form enctype="multipart/form-data" method="post">
                <input class="btn" type="submit" name="clear_cache_modules" Value="<?php echo $Modules->get_translate_module_phrase( 'module_page_adminpanel','_Refresh_cache_modules')?>">
            </form>
            </div>
            <div class="btn_form">
                <form enctype="multipart/form-data" method="post">
                    <input class="btn" type="submit" name="clear_translator_cache" Value="<?php echo $Modules->get_translate_module_phrase( 'module_page_adminpanel','_Refresh_cache_translations')?>">
                </form>
            </div>
            <div class="btn_form">
            <form enctype="multipart/form-data" method="post">
                <input class="btn" type="submit" name="clear_modules_initialization" Value="<?php echo $Modules->get_translate_module_phrase( 'module_page_adminpanel','_Update_list_modules')?>">
            </form>
            </div>
        </div>
        </div>
    </div>
<?php if ( ! empty( $_GET['options'] ) ):?>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="badge">Настройки модуля: <?php echo $Modules->array_modules[ $_GET['options'] ]['title']?></h5>
        </div>
        <form enctype="multipart/form-data" method="post">
            <div class="card-container module_block">
                <div class="info_form info_form_left">
                    <div class="info_form_line">Автор:</div>
                    <div class="info_form_line_value"><?php echo $Modules->array_modules[ $_GET['options'] ]['author']?></div>
                </div>
                <div class="info_form info_form_right">
                    <div class="info_form_line">Мин. версия ядра:</div>
                    <div class="info_form_line_value"><?php echo $Modules->array_modules[ $_GET['options'] ]['required']['core']?></div>
                </div>
                <div class="info_form info_form_left">
                    <div class="info_form_line">Версия модуля:</div>
                    <div class="info_form_line_value"><?php echo $Modules->array_modules[ $_GET['options'] ]['version']?></div>
                </div>
                <div class="info_form info_form_right">
                    <div class="info_form_line">Мин. версия PHP:</div>
                    <div class="info_form_line_value"><?php echo $Modules->array_modules[ $_GET['options'] ]['required']['php']?></div>
                </div>
                <div class="info_form">
                    <div class="info_form_line">Описание:</div>
                    <div class="info_form_line_value"><?php echo $Modules->array_modules[ $_GET['options'] ]['info']?></div>
                </div>
                <div class="input-form"><div class="input_text">Активная страница:</div><input name="module_page" value="<?php echo $Modules->array_modules[ $_GET['options'] ]['page']?>"></div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_offon" id="module_offon" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['status'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_offon">Модуль вкл. / выкл.</label>
                </div>
                <div class="input-form"><div class="input_text">Режим модуля</div>
                    <select name="module_type">
                        <option style="display:none" value="<?php echo (int) $Modules->array_modules[ $_GET['options'] ]['setting']['type']?>"><?php echo (int) $Modules->array_modules[ $_GET['options'] ]['setting']['type']?></option>
                        <?php for ( $ia = 0, $cia = sizeof( $_cia = explode(";", $Modules->array_modules[ $_GET['options'] ]['setting']['available_types'] ) ); $ia < $cia; $ia++ ):?>
                            <option value="<?php echo $_cia[$ia]?>"><?php echo $_cia[$ia]?></option>
                        <?php endfor?>
                    </select>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_interface" id="module_interface" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['interface'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_interface">Графическая часть</label>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_data" id="module_data" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['data'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_data">Пре-инициализация</label>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_data_always" id="module_data_always" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['data_always'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_data_always">Дополнтельная пре-инициализацию связанная с основным потоком</label>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_cache_enable" id="module_cache_enable" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['cache_enable'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_cache_enable">Использование кэша</label>
                </div>
                <div class="input-form"><div class="input_text">Время кэширования(Сек.):</div><input name="module_cache_time" value="<?php echo $Modules->array_modules[ $_GET['options'] ]['setting']['cache_time']?>"></div>

                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_translation" id="module_translation" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['translation'] == 1 && print 'checked';?>>
                    <label class="border-checkbox-label" for="module_translation">Собственный файл перевода</label>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_css" id="module_css" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['css'] == 1 && print 'checked'?>>
                    <label class="border-checkbox-label" for="module_css">Собственный CSS стиль</label>
                </div>
                <div class="input-form">
                    <input class="border-checkbox" type="checkbox" name="module_js" id="module_js" <?php $Modules->array_modules[ $_GET['options'] ]['setting']['js'] == 1 && print 'checked'?>>
                    <label class="border-checkbox-label" for="module_js">Собственная JS библиотека</label>
                </div>
            </div>
            <div class="card-bottom">
                <div class="select-panel-pages">
                    <input class="btn" name="module_save" type="submit" value="Сохранить">
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif?>