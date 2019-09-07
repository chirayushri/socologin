// var BASE_URL = "http://localhost/code/soczingo/";

function socNotify(msg, status) {
    $(".alert-positions").remove();
    var option = '';
    var icon = '';
    switch (status) {
        case 'success':
            option = 'success';
            icon = 'check';
            break;
        case 'error':
            option = 'danger';
            icon = 'exclamation';
            break;
        case 'warning':
            option = 'warning';
            icon = 'exclamation';
            break;
    }
    $("body").append('<div class="alert alert-positions alert-' + option + '"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-' + icon + '-circle " aria-hidden="true"></i>  ' + status + '!</strong><br>' + msg + '.</div>');
    window.setTimeout(function() {
        $(".alert-positions").fadeTo(1000, 0).slideUp(500, function() {
            $(this).slideUp();
        });
    }, 2000);
}

function toastShow(msg, status) {
    toastr.clear();
    switch (status) {
        case 'success':
            option = 'success';
            icon = 'check';
            break;
        case 'error':
            option = 'danger';
            icon = 'exclamation';
            break;
        case 'warning':
            option = 'warning';
            icon = 'exclamation';
            break;
    }
    toastr[status](msg, status)

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
}

function zingoCrypt(msg, action = 'e') {
    // Create Base64 Object
    var Base64 = {
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        encode: function(e) {
            var t = "";
            var n, r, i, s, o, u, a;
            var f = 0;
            e = Base64._utf8_encode(e);
            while (f < e.length) {
                n = e.charCodeAt(f++);
                r = e.charCodeAt(f++);
                i = e.charCodeAt(f++);
                s = n >> 2;
                o = (n & 3) << 4 | r >> 4;
                u = (r & 15) << 2 | i >> 6;
                a = i & 63;
                if (isNaN(r)) { u = a = 64 } else if (isNaN(i)) { a = 64 }
                t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
            }
            return t
        },
        decode: function(e) {
            var t = "";
            var n, r, i;
            var s, o, u, a;
            var f = 0;
            e = e.replace(/[^A-Za-z0-9+/=]/g, "");
            while (f < e.length) {
                s = this._keyStr.indexOf(e.charAt(f++));
                o = this._keyStr.indexOf(e.charAt(f++));
                u = this._keyStr.indexOf(e.charAt(f++));
                a = this._keyStr.indexOf(e.charAt(f++));
                n = s << 2 | o >> 4;
                r = (o & 15) << 4 | u >> 2;
                i = (u & 3) << 6 | a;
                t = t + String.fromCharCode(n);
                if (u != 64) { t = t + String.fromCharCode(r) }
                if (a != 64) { t = t + String.fromCharCode(i) }
            }
            t = Base64._utf8_decode(t);
            return t
        },
        _utf8_encode: function(e) {
            e = e.replace(/rn/g, "n");
            var t = "";
            for (var n = 0; n < e.length; n++) {
                var r = e.charCodeAt(n);
                if (r < 128) { t += String.fromCharCode(r) } else if (r > 127 && r < 2048) {
                    t += String.fromCharCode(r >> 6 | 192);
                    t += String.fromCharCode(r & 63 | 128)
                } else {
                    t += String.fromCharCode(r >> 12 | 224);
                    t += String.fromCharCode(r >> 6 & 63 | 128);
                    t += String.fromCharCode(r & 63 | 128)
                }
            }
            return t
        },
        _utf8_decode: function(e) {
            var t = "";
            var n = 0;
            var r = c1 = c2 = 0;
            while (n < e.length) {
                r = e.charCodeAt(n);
                if (r < 128) {
                    t += String.fromCharCode(r);
                    n++
                } else if (r > 191 && r < 224) {
                    c2 = e.charCodeAt(n + 1);
                    t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                    n += 2
                } else {
                    c2 = e.charCodeAt(n + 1);
                    c3 = e.charCodeAt(n + 2);
                    t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                    n += 3
                }
            }
            return t
        }
    }

    if (action == 'e') {
        var output = Base64.encode(Base64.encode(Base64.encode(Base64.encode(msg))));
    } else if (action == 'd') {
        var output = Base64.decode(Base64.decode(Base64.decode(Base64.decode(msg))));
    }
    return output;

}

// To Check Custom Checkbox Button
function checkCustomStatus(id) {
    var checkBoxes = $('.check-' + id);
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    if ($('.check-account').is(':checked')) {
        $(".table-options").show();
        $(".table-cols").hide();
    } else {
        $(".table-options").hide();
        $(".table-cols").show();
        $('#check-All').prop('checked', false);
    }
    if ($('.check-account').length == $('.check-account:checked').length) {
        $('#check-All').prop('checked', true);
    } else {
        $('#check-All').prop('checked', false);
    }

    $('#check-All').on('change', function() {
        $('.check-account').prop('checked', $(this).prop("checked"));
    });

    $('.check-account').change(function() {
        if ($('.check-account:checked').length == $('.check-account').length) {
            $('#check-All').prop('checked', true);
        } else {
            $('#check-All').prop('checked', false);
        }
    });
}

// To Check Check-All Checkbox Button
function checkAllStatus() {
    var checkBoxes = $('.check-account');
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));;
    if ($('#check-All').is(':checked')) {
        $(".table-options").show();
        $(".table-cols").hide();
    } else {
        $(".table-options").hide();
        $(".table-cols").show();
    }

}

function get_filter_date_option(param){
    var data = [];
	switch (param) {
        case 'weekly':
            data['end_date'] = Math.floor(Date.now() / 1000);
            data['start_date'] =data['end_date'] - 604800;
            break;
        case 'monthly':
            data['end_date'] = Math.floor(Date.now() / 1000);
            data['start_date'] = data['end_date'] - 2629746;
            break;
        case 'added':
            data['end_date'] = Math.floor(Date.now() / 1000);
            data['start_date'] = data['end_date'] - 86400;
            break;
        case 'updated':
            data['end_date'] = Math.floor(Date.now() / 1000);
            data['start_date'] =data['end_date'] - 86400;
            data['end_date'] = data['end_date'] + '&date_filter_type=modified';
            break;
        default:
            data['end_date'] = '';
            data['start_date'] = '';
    }
    return data;
}

function refresh_lists(){
    $(".table-options").hide();
    $(".table-cols").show();
    $('#check-All').prop('checked', false);
    $('.check-account').prop('checked', false);
}