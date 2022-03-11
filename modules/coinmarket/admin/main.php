<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hutech - IoT <nhattan.thsv@gmail.com>
 * @Copyright (C) 2022 Hutech - IoT. All rights reserved
 * @License: Not free read more
 * @Createdate Sat, 09 Mar 2022 02:20:33 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

if ($nv_Request->isset_request('action', 'post,get')) {
    $id = $nv_Request->get_int('id', 'post,get', 0);
    $checksess = $nv_Request->get_title('checksess', 'post,get', '');
    if ($id > 0 and $checksess == md5($id . NV_CHECK_SESSION)) {
        $db->query("DELETE FROM " . NV_PREFIXLANG . '_' . $module_data . " WHERE id=" . $id);
    }
}








$query = "SELECT * FROM " . NV_PREFIXLANG . '_' . $module_data . " WHERE 1";
$result = $db->query($query)->fetchAll();



$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------
if (!empty($result)) {
    foreach ($result as $row) {
        $row['delete_url'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=main&amp;id=' . $row['id'] . '&action=delete&checksess=' . md5($row['id'] . NV_CHECK_SESSION);
        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.loop');
    }
}



$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
