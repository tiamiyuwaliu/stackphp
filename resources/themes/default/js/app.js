
window.previousUrl = [];
window.previousUrl.push(window.location.href);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var App = {
    initScripts: function() {
        var options = {
            series: [{
                name: 'TEAM A',
                type: 'column',
                data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
            }, {
                name: 'TEAM B',
                type: 'area',
                data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
            }, {
                name: 'TEAM C',
                type: 'line',
                data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
            },
            stroke: {
                width: [0, 2, 5],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '20%'
                }
            },

            fill: {
                opacity: [0.85, 0.25, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
                '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
            ],
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                title: {
                    text: 'Points',
                },
                min: 0
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;

                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#admin-chart"), options);
        chart.render();

        $('.form-auto-submit').each(function() {
            var form = $(this);
            $(this).find('input[type=checkbox],input[type=text],select,input[type=role],input[type=file]').change(function() {
                form.submit();
            })

        })
    },
    openMenu: function(t) {

        if(!$(t).parent().hasClass('opened'))  {
            $('.user-menu li').removeClass('opened')
            $(t).parent().addClass('opened');
        } else{
            $('.user-menu li').removeClass('opened')
        }
        return false;
    },
    toggleAdminMenu: function() {
        $('#admin-container .left-pane').fadeIn();
        return false;
    },
    openOffCanvas: function(id) {
        var myOffcanvas = document.getElementById(id)
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
        bsOffcanvas.show();
        return false;
    },
    closeOffCanvas: function(id) {
        var myOffcanvas = document.getElementById(id)
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
        bsOffcanvas.hide();
        return false;
    },
    notify: function(m, type) {
        if (m === ' ' || m === '') return false;
        var notyf = new Notyf({
            types: [
                {
                    type: 'warning',
                    background: 'orange',
                    icon: {
                        className: 'material-icons',
                        tagName: 'i',
                        text: 'warning'
                    }
                },
                {
                    type: 'info',
                    background: '#1773CC',
                }
            ]
        });
        if (type === 'error') {
            notyf.error({
                message: m,
                position: {
                    x: 'right',
                    y: 'top',
                },
            })
        } else if(type === 'success') {
            notyf.success({
                message: m,
                position: {
                    x: 'center',
                    y: 'top',
                },
            });
        } else {
            notyf.open({
                type: 'info',
                message: m
            });
        }
    },
    confirm: function(url, mess, ajax, functionName) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary shadow-none',
                cancelButton: 'btn btn-light shadow-none'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: '',
            text: (mess === undefined || mess === '') ? strings.are_your_sure : mess,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: strings.yes,
            cancelButtonText: strings.cancel,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                if (ajax === undefined || !ajax) {
                    window.location.href = url;
                } else {
                    if (ajax === 'function') {

                        functionName.call();
                    } else {
                        App.ajaxAction(url);
                    }
                }
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

            }
        })

        return false;
    },
    showLoader: function(full) {
        $('#top-loading').show().animate({width:20 + 80  + "%"}, 200);
        if (full != undefined) $("#cover-loader").fadeIn();
    },
    hideLoader: function() {
        $('#top-loading').animate({width:"100%"}, 200).fadeOut(300, function() {
            $(this).width("0");
        });
        $("#cover-loader").fadeOut();
    },
    loadPage: function(url, f, cont) {
        window.onpopstate = function(e) {
            window.previousUrl.pop();
            var url = window.previousUrl[window.previousUrl.length - 1];
            if (url === undefined) url = window.previousUrl[window.previousUrl.length - 1];
            App.loadPage(url, true);

        };

        App.showLoader();
        $.ajax({
            url: url,
            cache: false,
            type: 'GET',
            success: function(data) {
                if(data === 'login') {
                    App.hideLoader();
                } else {
                    $(".modern-scroll").each(function() {
                        //$(this).getNiceScroll().remove()
                    });
                    try {
                        data = jQuery.parseJSON(data);
                        //console.log(data)
                        if (data.type !== undefined) {
                            if (data.type == 'error') {
                                App.notify(data.message, data.type);
                                App.hideLoader()
                                return false;
                            }
                        }
                        var content = data.content;
                        var container = (cont == undefined) ? data.container : cont;
                        var title = data.title;

                        $(container).html(content);
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                    } catch(e) {
                       // console.log(e)
                    }
                    document.title = title;
                    if (f == undefined) window.previousUrl.push(url);
                    window.history.pushState({}, data.title + ':' + url, url);
                    $(window).scrollTop(0);
                    ///hideMenu();
                    App.initScripts()

                    App.hideLoader();

                    $('body').click();
                }

            },
            error: function() {
                App.hideLoader();
            }
        });
        return false;
    },
    url: function(link, param) {
        var result = baseUrl;
        var append = "";
        if (param !== undefined) {
            for(var i=0;i<param.length;i++) {
                append += (append.length > 0) ? '&'+param[i].key+'='+param[i].value : param[i].key+'='+param[i].value;
            }
        }
        result += link;
        if(param !== undefined) {
            result += '?'+append;
        }
        return result;
    },
    ajaxAction: function(url) {
        App.showLoader(true);
        $.ajax({
            url : url,
            success : function(d) {
                App.hideLoader();
                if (d === 'login') {

                }
                try{
                    var r = jQuery.parseJSON(d);
                    $('body').click()//to remove unwanted dropdowns
                    var m = r.message;var t = r.type;var v = r.value;var c = r.content,modal = r.modal,table=r.table;
                    if (t === 'url') {
                        App.loadPage(v);
                    } else if(t === 'normal-url') {

                        window.location.href = v;
                    }else if(t === 'function') {
                        if (v !== undefined && v !== '') eval(v)(c);
                    } else if(t === 'modal-function') {
                        $(modal).modal("hide");
                        if (v !== undefined && v !== '') eval(v)(c);
                    } else if(t === 'modal-url') {
                        $(c).modal("hide");
                        App.loadPage(v)
                    } else if(t === 'reload') {
                        App.loadPage(window.location.href);
                    } else if(t === 'reload-modal') {
                        $(c).modal("hide");
                        App.loadPage(window.location.href);
                    } else if(t === 'canvas-function') {
                        App.closeOffCanvas(modal)
                        if (v !== undefined && v !== '') eval(v)(c);
                    } else if(t === 'canvas-url') {
                        App.closeOffCanvas(c)
                        App.loadPage(v)
                    } else if(t === 'reload-canvas') {
                        App.closeOffCanvas(c);
                        App.loadPage(window.location.href);
                    }
                    if (t === 'error') {
                        App.notify(m, 'error');
                    } else {
                        if (m !== '' ) App.notify(m, 'success');
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        })
    },

    setCookie:  function (cname, cvalue, exdays) {
        if(exdays === undefined) exdays = 365;
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    getCookie: function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while(c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if(c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    deleteCookie: function(cname) {
        document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
    }
}

$(function() {
    App.initScripts();
    $(document).on("click", ".confirm", function() {
        return App.confirm($(this).attr('href'), $(this).data('message'), $(this).data('ajax-action'));
    });

    $(document).on('submit','.general-form',function() {
        var url = $(this).attr('action');
        var f = $(this);

        if ($(this).data('validate') !== undefined) {
            var result = eval($(this).data('validate') + "()");
            if (!result) return false;
        }

        if (f.data('not-ready') !== undefined && f.data('not-ready')) return false;
        if (f.data('no-loader') === undefined) App.showLoader(true);



        var progress = null;
        if (f.data('upload')) {
            progress = $(f.data('upload'));
            var progressPercent = 0;
        }
        f.ajaxSubmit({
            url : url,
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete;

                if (progress !== null) {
                    progress.find('.progress-bar').css('width', percentVal + '%');
                    progress.find('.progress-bar').html(percentVal + '%');
                    progress.show();
                }
            },
            success : function(d) {
                try{
                    var r = jQuery.parseJSON(d);
                    $('body').click()//to remove unwanted dropdowns
                    var m = r.message;var t = r.type;var v = r.value;var c = r.content,modal = r.modal,table=r.table;
                    if (t === 'url') {
                        App.loadPage(v);

                    } else if(t === 'normal-url') {

                        window.location.href = v;
                    } else if(t === 'function') {
                        if (v != undefined && v != '') eval(v)(c);
                    } else if(t === 'modal-function') {
                        $(modal).modal("hide");
                        if (v !== undefined && v !== '') eval(v)(c);
                    } else if(t === 'modal-url') {
                        $(c).modal("hide");
                        App.loadPage(v)
                    } else if(t === 'reload') {
                        App.loadPage(window.location.href);
                    } else if(t === 'reload-modal') {
                        $(c).modal("hide");
                        App.loadPage(window.location.href);
                    } else if(t === 'normal-url') {
                        $(c).modal("hide");
                        window.location.href=v;
                    } else if(t === 'canvas-function') {
                        App.closeOffCanvas(modal)
                        if (v !== undefined && v !== '') eval(v)(c);
                    } else if(t === 'canvas-url') {
                        App.closeOffCanvas(c)
                        App.loadPage(v)
                    } else if(t === 'reload-canvas') {
                        App.closeOffCanvas(c);
                        App.loadPage(window.location.href);
                    }
                    if (t === 'error' || t === 'error-function') {
                        App.notify(m, 'error');
                        if (v != undefined && v != '') eval(v)(c);
                    } else {
                        if (m !== '' && m !== undefined ) App.notify(m, 'success');

                    }
                    App.hideLoader();
                } catch (e) {
                    App.hideLoader();
                }

                if (progress !== null) {
                    progress.hide();
                    progress.find('.progress-bar').css('width', '0%');
                    progress.find('.progress-bar').html('0%');
                }
                window.globalFormSubmitting = false;

            }
        });
        return false;
    });

    $(document).on('click', '[data-ajax=true]', function() {
        App.loadPage($(this).attr('href'));
        return false;
    });

    $(document).on('click', '.page-link', function() {
        App.loadPage($(this).attr('href'));
        return false;
    });
    $(document).on('click', '.ajax-action', function() {
        App.ajaxAction($(this).attr('href'));
        return false;
    });


})
