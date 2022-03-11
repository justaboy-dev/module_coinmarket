<!--BEGIN:main-->
<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Tên loại tiền</th>
                    <th class="text-center">Giá</th>
                </tr>
            </thead>
            <tbody id = "coin-content">
                
            </tbody>
        </table>
</div>
<script type="text/JavaScript">
            const pricesWs = new WebSocket('wss://ws.coincap.io/prices?assets=' + '{COINCODE}');

            let coinContent = document.getElementById("coin-content");
            let currentCoin = {};
            pricesWs.onmessage = function (msg) {
                coinContent.innerHTML = "";
                let coin = JSON.parse(msg.data);
                let result = "";
                for(var name in coin) {
                    currentCoin[name] = coin[name];
                }
                for(var name in currentCoin) {
                    let template = `
                    <tr class="">
                        <td class="text-left">` + name + `</td>
                        <td class="text-right"><strong>` + currentCoin[name] + `$</strong></td>
                    </tr>
                    `;
                    result += template;   
                }
                coinContent.innerHTML = result;
            }
            </script>
<!--END:main-->
