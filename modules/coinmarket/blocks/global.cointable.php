<?php

if (!nv_function_exists('nv_coinmarket_cointable')) {
    function nv_coinmarket_cointable()
    {
        global $global_config, $lang_global, $db, $module_file;
        $xlpt = new XTemplate('global.cointable.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/coinmarket/');
        $xlpt->assign('LANG', $lang_global);

        $query = "SELECT * FROM " . NV_PREFIXLANG . '_' . 'coinmarket' . " WHERE 1";
        $result = $db->query($query)->fetchAll();


        $coincode = "";
        if (!empty($result)) {
            foreach ($result as $row) {
                $coincode .= $row['coincode'] . '' . ',';
            }
        }

        $xlpt->assign('COINCODE',rtrim($coincode,','));

        $xlpt->parse('main');
        return $xlpt->text('main');
    }


    $content = nv_coinmarket_cointable();
}
if (defined('NV_SYSTEM')) {
    $content = nv_coinmarket_cointable();
}
