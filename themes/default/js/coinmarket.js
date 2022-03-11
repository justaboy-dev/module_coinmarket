/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

function fetchData(coin) {
    $(document).ready(function () {
        var str = "";
        console.log(coin.length);
        console.log(coin);
        var connect = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin,ethereum,monero,litecoin');
        connect.onopen = function () {
            console.log('Kết nối thành công');
        }
        connect.onerror = function (error) {
            console.log('Lỗi' + JSON.stringify(error));
        }
        connect.onmessage = function (msg) {
            // $("#tbody").append(html);
            // var obj = JSON.parse(msg.data);
            // console.log(msg.data);
            // var html = "<td class = 'text-left' >" + obj[0] + "</td><td class = 'text-left' >" + obj[1] + "</td>";
        }
        connect.onclose = function () {
            console.log('Kết nối đã đóng lại');
        }
    });
}
