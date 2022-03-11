<!-- BEGIN: main -->
<form
    class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <!-- BEGIN: error -->
    <div class="alert alert-warning" role="alert">
        <strong>{ERROR}</strong>
    </div>
    <!-- END: error -->
    <div class="form-group">
        <label class="control-label col-sm-3" for="email">{LANG.coinname}</label>
        <div class="col-sm-10">
            <select class="form-control" name="coincode" id="coincode" onchange="onval()" >
                    <option value="">Chọn loại tiền</option>
                <!-- BEGIN: coinloop -->
                    <option value='{ROW.id}'>{ROW.name}</option>
                <!-- END: coinloop -->
            </select>
            <input type="hidden" class="form-control" name="coinname" id="coinname" value=""></>
        </div>
    </div>
    <div class="text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.add}"/></div>
</form>
<script type="text/javascript">
  function onval(){
      let sl = document.getElementById("coincode");
      let slt = sl.options[sl.selectedIndex].text;
      document.getElementById("coinname").value = slt;
  }
</script>
<!-- END: main -->
