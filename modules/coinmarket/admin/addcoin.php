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

$page_title = $lang_module['addcoin'];

$coin = [];
$error = [];
$coin['coinname'] = $nv_Request->get_title('coinname', 'post', '');
$coin['coincode'] = $nv_Request->get_title('coincode', 'post', '');
$coin['submit'] = $nv_Request->get_title('submit', 'post', '');


if (!empty($coin['submit'])) {
    if (empty($coin['coincode'])) {
        $error[] = $lang_module['error_donot_empty'];
    }

    if (empty($error)) {

        $query = "SELECT * FROM " . NV_PREFIXLANG . '_' . $module_data . " WHERE coincode = " . $db->quote($coin['coincode']);

        $result = $db->query($query)->fetchAll();

        if (empty($result)) {
            $query = "INSERT INTO " . NV_PREFIXLANG . '_' . $module_data . "(coinname,coincode) VALUES (" . $db->quote($coin['coinname']) . "," . $db->quote($coin['coincode']) . ")";
            $db->query($query);
        } else {
            $error[] = $lang_module['error_duplicate'];
        }
    }
}



$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.coincap.io/v2/assets',
    CURLOPT_USERAGENT => 'Request',
    CURLOPT_SSL_VERIFYPEER => false
));


$res = curl_exec($curl);

$listcoin = json_decode($res);

curl_close($curl);



$xtpl = new XTemplate('addcoin.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('COIN', $coin);
$xtpl->assign('ERROR', implode('<br>', $error));


if (!empty($error)) {
    $xtpl->parse('main.error');
}

if (!empty($listcoin)) {
    foreach ($listcoin->data as $row) {
        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.coinloop');
    }
}

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
