<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">{LANG.coinname}</th>
                    <th class="text-center">{LANG.coincode}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: loop -->
                <tr class="">
                    <td class="text-left">
                        {ROW.coinname}
                    </td>
                    <td class="text-left">
                        {ROW.coincode}
                    </td>

                    <td class="text-center">
                        <em class="fa fa-trash-o fa-lg">&nbsp;</em>
                        <a href="{ROW.delete_url}">{LANG.delete}</a>
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- END: main -->
