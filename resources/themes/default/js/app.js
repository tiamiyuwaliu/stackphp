
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

        if ($('#admin-chart').length > 0) {
            var chart = new ApexCharts(document.querySelector("#admin-chart"), options);
            chart.render();
        }


        $('.form-auto-submit').each(function() {
            var form = $(this);
            $(this).find('input[type=checkbox],input[type=radio],input[type=text],select,input[type=role],input[type=file],input[type=number]').change(function() {
                form.submit();
            })

        });

        if ($('#schedule-calender').length > 0) {
            var calendarEl = document.getElementById('schedule-calender');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: { end: 'prev,title,next', left:'' },
                //firstDay: startDay,
                //locale : locale,
                stickyHeaderDates: true,
                editable: true,
                eventDisplay: 'block',
                buttonText: {
                    // today:    strings.today,
                },
                datesSet: function() {
                    $('.calendar-post-preview').remove();
                },
                eventDidMount: function(info) {
                    if (info.event._def.extendedProps.image !== undefined) {

                        var div = $('<div class="fc-post "></div>');

                        div.html(info.event._def.extendedProps.displayContent);
                        //div.append("<div class='status mtitle "+info.event._def.extendedProps.status_color+"' title='"+info.event._def.extendedProps.status_title+"'></div>")
                        $(info.el).find('.fc-event-main-frame .fc-event-title').html(div)
                        $('body').append(info.event._def.extendedProps.preview)
                    }
                },
                events: {
                    url: $('#schedule-calender').data('url'),
                    extraParams: function() {
                        return {
                            cachebuster: new Date().valueOf()
                        };
                    },
                    color: 'yellow',   // a non-ajax option
                    textColor: 'black'
                },
                eventDrop: function(info) {
                    var date = calendar.formatDate(info.event.start,{
                        month: '2-digit',
                        day: 'numeric',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    $.ajax({
                        url: App.url('publish'),
                        data:{action: 'change-date', id: info.event._def.extendedProps.postId, date: date}
                    })
                },
                eventClick: function(info) {
                    $("#calendarPostModal"+info.event._def.extendedProps.postId).modal('show')
                    return false;
                },
            });
            calendar.render();
        }


        $(".modern-scroll").niceScroll();
        $('.emoji-text').each(function() {
            if ($(this).prop('nodeName').toLowerCase() === 'textarea' && $(this).css('display') !== 'none') {
                var obj = $(this);
                if ($(this).css('display') !== 'none') {
                    var el = $(this).emojioneArea({
                        pickerPosition: 'bottom',
                        emojiPlaceholder: ":smile_cat:",
                        attributes: {
                            spellcheck: true
                        }
                    });
                    el[0].emojioneArea.on("keyup", function(editor, event) {
                        ////refereshPreview();
                        if (obj.data('counter') !== undefined) {

                            $(obj.data('counter')).html(el[0].emojioneArea.getText().length)
                        }
                        if (obj.data('keyup')) eval(obj.data('keyup'))(obj, el[0].emojioneArea.getText())
                    });
                    el[0].emojioneArea.on("change", function(editor, event) {
                        ///refereshPreview()
                        if (obj.data('counter') !== undefined) {

                            $(obj.data('counter')).html(el[0].emojioneArea.getText().length)
                        }
                        if (obj.data('keyup')) eval(obj.data('keyup'))(obj,el[0].emojioneArea.getText())
                    });
                }
            }
        });

        $('.date-time-picker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        $('.date-rande-picker').flatpickr({
            mode: 'range',
            dateFormat: "Y-m-d",
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $('.color-input').each(function() {
            var id = $(this).attr('id');
            var target = $($(this).data('target'));
            pickr = Pickr.create({
                el: '#'+id,
                theme: 'classic', // or 'monolith', or 'nano'
                //useAsButton: true,
                default: target.val(),
                swatches: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(233, 30, 99, 0.95)',
                    'rgba(156, 39, 176, 0.9)',
                    'rgba(103, 58, 183, 0.85)',
                    'rgba(63, 81, 181, 0.8)',
                    'rgba(33, 150, 243, 0.75)',
                    'rgba(3, 169, 244, 0.7)',
                    'rgba(0, 188, 212, 0.7)',
                    'rgba(0, 150, 136, 0.75)',
                    'rgba(76, 175, 80, 0.8)',
                    'rgba(139, 195, 74, 0.85)',
                    'rgba(205, 220, 57, 0.9)',
                    'rgba(255, 235, 59, 0.95)',
                    'rgba(255, 193, 7, 1)'
                ],
                components: {
                    // Main components
                    preview: true,
                    opacity: true,
                    hue: true,
                    // Input / output Options
                    interaction: {
                        hex: true,
                        rgba: false,
                        hsla: false,
                        hsva: false,
                        cmyk: false,
                        input: true,
                        clear: true,
                        save: true
                    }
                }
            }).on('init', pickr => {
                target.val(pickr.getSelectedColor().toHEXA().toString(0));
                if (target.data('form') !== undefined) $(target.data('form')).submit();
            }).on('save', color => {
                target.val(color.toHEXA().toString(0));
                pickr.hide();
                if (target.data('form') !== undefined) $(target.data('form')).submit();
            })

        });

        $( ".bio-widgets-container" ).sortable({
            items: ".each-widget",
            handle: '.move',
            stop: function() {
                var url = $('.bio-widgets-container').data('url');
                var id = $('.bio-widgets-container').data('id');
                var ids = [];
                $('.widget-input').each(function() {
                    ids.push($(this).val());
                })
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {action: 'arrange', ids: ids, id: id}
                });
            }
        });

        if ($('#country-map').length > 0) {
            $('#country-map').vectorMap({
                map: 'world_en',
                backgroundColor: '#333333',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                scaleColors: ['#C8EEFF', '#006491'],
                values: sample_data,
                normalizeFunction: 'polynomial'
            });
        }

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
                        App.hideLoader();
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
    },
    validateFileupload: function (fileName, type) {
        var allowed_extensions = new Array("jpg","png","gif");
        allowed_extensions = allowImage.split(',');
        if (type === 'video') allowed_extensions = allowVideo.split(',');
        if (type === 'image-video')  {
            allowed_extensions = allowVideo+','+allowImage;
            allowed_extensions = allowed_extensions.split(',');
        }
        var file_extension = fileName.split('.').pop().toLowerCase();
        console.log(file_extension);
        console.log(allowed_extensions);
        for(var i = 0; i <= allowed_extensions.length; i++)
        {
            if(allowed_extensions[i] === file_extension)
            {
                return true; // valid file extension
            }
        }
        return false;
    },
    validateFileSize: function(input, type, func) {
        var files = input.files;
        for (var ii = 0; ii < files.length; ii++) {
            var file = files[ii];
            if (type === 'image') {
                if (!App.validateFileupload(file.name, 'image')) {
                    App.notify(strings.notImageError, 'error')
                    $(input).val('');//yes
                    return true;
                }
                if (file.size > allowFileSize) {
                    //this file is more than allow photo file
                    App.notify(strings.allowFileSizeError, 'error');
                    //empty the input
                    $(input).val('');//yes
                    return true;
                }
            } else if(type === 'image-video') {
                if (!App.validateFileupload(file.name, 'image-video')) {
                    App.notify(strings.notImageVideoError, 'error')
                    $(input).val('');//yes
                    return true;
                }
                if (file.size > allowFileSize) {
                    //this file is more than allow photo file
                    App.notify(strings.allowFileSizeError, 'error');
                    //empty the input
                    $(input).val('');//yes
                    return true;
                }
            }
        }
        if(func !== undefined) {
            eval(func)();
        }
    },
    submitFileUpload: function() {
        return $('.filemanager-uploader').submit();
    },
    openViewer: function(t) {
        var files = [];
        var file = $(t).data('path');
        var position = 1;
        var i = 0;
        $('.each-inner .media').each(function() {
            files.push({
                src : $(this).data('path'),
                isVid: ($(this).data('type') === 'image') ? false : true,
            });
            if (file === $(this).data('path')) {
                position = i;
            }
            i++
        });

        if (files.length < 2) {
            files.push(files[0]);
        }
        BigPicture({
            el:t,
            gallery: files,
            position: position
        })
        return false;
    },
    markMedia: function(t) {
        var parent = $(t).parent().parent()
        if (parent.hasClass('selected')) {
            parent.removeClass('selected');
        } else {
            parent.addClass('selected');
        }
        App.processMarked();
    },
    processMarked: function() {
        if ($('.selected').length > 0) {
            $('.select-btn').hide();
            $('.deselect-btn').show();
        }else {
            $('.select-btn').show();
            $('.deselect-btn').hide();
        }
    },
    selectAllMedia: function() {
        $('.each-inner').addClass('selected');
        $('.each-inner').find('input').prop('checked', 'checked');
        $('.each-inner').find('input').attr('checked', 'checked');
        App.processMarked();
        return false;
    },
    deselectAllMedia: function() {
        $('.each-inner').removeClass('selected');
        $('.each-inner').find('input').removeProp('checked');
        $('.each-inner').find('input').prop('checked', false);
        $('.each-inner').find('input').removeAttr('checked');
        App.processMarked();
        return false;
    },
    validateMediaDelete:function(d) {
        for(var i =0;i<d.length;i++) {
            $('.each-'+d[i]).remove();
        }
    },
    deleteSelectedMedia: function(url) {
        var ids = [];
        $('.each-inner.selected .media').each(function() {
            ids.push($(this).data('id'));
        })
        console.log(ids);
        url = url + '?action=delete'+'&id='+ids.join(',');
        App.ajaxAction(url);
        return false;
    },
    openDropboxPicker: function() {
        Dropbox.choose({
            linkType: "direct",
            multiselect: true,
            success: function(files) {
                App.showLoader(true);
                for(var i =0;i<files.length;i++) {
                    var file = files[i];
                    $.ajax({
                        type: "POST",
                        datatype: 'json',
                        url: App.url('media'),
                        data: {   file_name: file.name, file_size: file.bytes, file:file.link, dropbox: true },
                        success: function(result){
                            console.log(i);
                            if (i === files.length) {
                                App.hideLoader();
                                App.loadPage(window.location.href);
                            }
                        }
                    });
                }
            },
            extensions: ['.jpg', '.jpeg', '.mp4','.gif','.png']
        });
        return false;
    },
    openGoogleDrivePicker: function() {
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
        return false;
    },
    openCanva: function(t) {
        window.canvaAPI.createDesign({
            design: {
                type: t,
            },
            onDesignPublish: function (options) {
                // Triggered when design is published to an image.
                var exportUrl = options.exportUrl;
                App.showLoader(true);
                $.ajax({
                    url: App.url('media'),
                    type: 'POST',
                    data: {action: 'import-image', link: exportUrl,canva: true},
                    success: function(result) {
                        App.hideLoader();
                        App.loadPage(window.location.href);
                    }
                })
            },
            onDesignClose: function () {
                // Triggered when editor is closed.
            },
        });
        return false;
    },
    resizeScroll: function() {
        setTimeout(function() {
            $(".modern-scroll").getNiceScroll().resize();
        }, 200)
    },
    //Post editor functions
    togglePostEditorPane: function(w) {
        $('.composer-container .each-pane').hide();
        $(w).fadeIn();
        $(".modern-scroll").getNiceScroll().resize();
        return false;
    },
    closePostEditor: function(id) {
        if ($('.compose-content').css('display') === 'none') {
            return App.togglePostEditorPane('.compose-content')
        } else {
            if(id !== undefined) {
                $(id).modal('hide')
            } else {
                $('#composeModal').modal('hide')
            }
        }
        return false;
    },
    searchChannels: function(t, c) {
        var text = $(t).val();
        $.ajax({
            url : App.url('channels'),
            data: {action: 'search-channel', term: text},
            success: function(d) {
                $(c).html(d);
            }
        })
        return false;
    },
    postAddSelectedAccounts: function() {
        $('.post-edit-account-list .each').each(function() {
            if ($(this).find('input').is(':checked')) {
                if ( $(".composer-container .selected-accounts .each-account-"+$(this).data('id')+"").length < 1) {
                    $('.composer-container .selected-accounts').append("<div data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" class='each-account-"+$(this).data('id')+"' style='background-image:url("+$(this).data('avatar')+")' title='"+$(this).data('username')+"'><input type='hidden' name='val[account][]' value='"+$(this).data('id')+"'/><a onclick='return App.removePostEditAccount(this)' href=''><i class=\"bi bi-x-lg\"></i></a> </div>")
                }
            }
        })
        $('.post-edit-account-list .each input').prop('checked', false);
        $('.post-edit-account-list .each input').removeAttr('checked');
        $('.post-edit-account-list .each input').removeProp('checked');
        App.initScripts();
        return App.togglePostEditorPane('.compose-content');

    },
    removePostEditAccount: function(t) {
        $(t).parent().remove();
        return false;
    },
    openTemplatePicker: function(type) {
        window.templatePickerType = type;
        $.ajax({
            url : App.url('templates'),
            data: {action: 'search-template', term: '', type: type},
            success: function(d) {
                $('.templates-picker-container .modal-body').html(d);
            }
        })
        return App.togglePostEditorPane('.templates-picker-container')
    },
    searchTemplates: function(t) {
        var text = $(t).val();
        $.ajax({
            url : App.url('templates'),
            data: {action: 'search-template', term: text, type: window.templatePickerType},
            success: function(d) {
                $('.templates-picker-container .modal-body').html(d);
            }
        })
    },
    switchPostEditButton: function(t, title) {
        $('.post-submit-btn').html(title);
        $('.post-type-input').val(t);
        if (t === '0') {
            $('.schedule-date-selector').fadeIn();
        } else {
            $('.schedule-date-selector').hide();
        }
        return false;
    },
    postOpenMediaPicker: function() {
        $.ajax({
            url : App.url('media'),
            data: {action: 'popup'},
            success: function(d) {
                $('.media-library .modal-body').html(d);
            }
        })
        return App.togglePostEditorPane('.media-library')
    },
    postAddSelectedMedia: function() {
        $(".media-library .each-inner").each(function() {
            if ($(this).find('input').is(':checked')) {
                var input = $(this).find('input');
                if (input.data('type') === 'image') {
                    $('.post-media-list').append("<div  style='background-image:url("+input.data('path')+")'>" +
                        "<input type='hidden' name='val[media][]' value='"+input.data('id')+"'/><a href='' onclick='return App.postRemoveSelectedMedia(this)'><i class=\"bi bi-x-lg\"></i></a> </div>")
                } else {
                    $('.post-media-list').append("<div><video src='"+input.data('path')+"'></video> " +
                        "<input type='hidden' name='val[media][]' value='"+input.data('id')+"'/><a href='' onclick='return App.postRemoveSelectedMedia(this)'><i class=\"bi bi-x-lg\"></i></a> </div>")
                }
            }
        });
        if ($('.post-media-list').html() !== '') $('.post-media-list').fadeIn();
        $('.media-library .each-inner input').prop('checked', false);
        $('.media-library .each-inner input').removeAttr('checked');
        $('.media-library .each-inner input').removeProp('checked');
        return App.togglePostEditorPane('.compose-content');
    },
    postRemoveSelectedMedia: function(t) {
        $(t).parent().remove();
        if ($('.post-media-list').html() === '') $('.post-media-list').hide();
        return false;
    },
    useTemplate: function(t) {
        $('.post-modal').each(function() {
            if ($(this).css('display') !== 'none') {
                var editor = $('#'+$(this).find('.post-editor-textarea').attr('id')).emojioneArea();
                var text = editor[0].emojioneArea.getText() + $(t).find('div').html();
                editor[0].emojioneArea.setText(text);
                App.togglePostEditorPane('.compose-content');
                editor[0].emojioneArea.setFocus();
            }
        })

        return false;
    },
    validatePostSubmit: function(id) {
        if(id === undefined) {
            var editor = $('#post-editor-textarea').emojioneArea();
            var images = $('.post-media-list div').length;
            var account = $('.selected-accounts div').length;

            if (editor[0].emojioneArea.getText() === '' && images < 1) {
                this.notify(strings.empty_post_content, 'error');
                return false;
            }

            if (account < 1) {
                this.notify(strings.empty_post_account, 'error');
                return false;
            }

            $('#postEditorForm').submit();
        } else {
            $(id).find('form').submit();
        }
        return false;
    },
    postCompleted: function() {
        var editor = $('#post-editor-textarea').emojioneArea();
        var images = $('.post-media-list div').remove();
        var account = $('.selected-accounts div').remove();
        $('.post-media-list').hide();
        editor[0].emojioneArea.setText('')
        $('#composeModal').modal('hide');
        return false;
    },
    switchPostDisplay: function(t) {
        $.ajax({
            url: App.url('publish'),
            data: {display: t },
            success: function() {
                App.loadPage(window.location.href);
            }
        });
        return false;
    },
    duplicatePost: function(t, id) {
        var caption = $('.duplicate-caption-'+id).html();
        var medias = $('.duplicate-medias-'+id).html();
        $('#composeModal .post-media-list').html(medias);
        if ( $('#composeModal .post-media-list').html() !== '')  $('#composeModal .post-media-list').fadeIn();
        var editor = $('#post-editor-textarea').emojioneArea();
        editor[0].emojioneArea.setText('');
        editor[0].emojioneArea.setText(caption);
        $('#composeModal').modal('show');
        return false;
    },
    submitBulkUpload: function() {
        $('.bulk-uploader').submit();
    },
    switchBulkPane: function(t) {
        $('.bulk-upload-container .bulk-pane').hide();
        $('.bulk-upload-container .nav-link').removeClass('active');
        $('.bulk-upload-container .'+t+'-nav').addClass('active');
        $('.bulk-upload-container .'+t+'-pane').fadeIn();
        return false;
    },
    changeStatus: function(t, id) {
        var status = ($(t).is(':checked')) ? 1 : 0;
        $.ajax({
            url: $(t).data('url'),
            data: {action: 'change-status', id: id, status: status}
        });
    },
    switchPane: function(t, c, cl) {
        var v = $(t).val();
        $(c).find(cl).hide();
        $(c).find('.'+v+'-pane').fadeIn();
        return false;
    },
    switchPaneByLink: function(t,c,cl) {
        $(c).find(cl).hide();
        $(c).find('.'+t+'-pane').fadeIn();
        return false;
    },
    activateCheckInput: function(t, c, f) {
        $(c).find('.each').removeClass('active');
        $(c).find('input').prop('checked', false);
        $(c).find('input').removeAttr('checked');
        $(c).find('input').removeProp('checked');
        $(t).addClass('active');
        $(t).find('input').prop('checked', 'checked');
        if (f !== undefined) $(f).submit();
        return false;
    },
    closeAddWidget: function() {
        //$('body').click();

        //alert(window.location.href);
        App.loadPage(window.location.href);
        return false;
        var myOffcanvas = document.getElementById('addWidgetModal')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
        bsOffcanvas.hide();

    },
    openWidgetEditor: function(id) {
        var c = $('.each-widget-'+id);

        var editor = c.find('.edit-container');
        if (editor.css('display') === 'none') {
            $('.edit-container').hide();
            editor.slideDown();
        } else {
            editor.slideUp();
        }
        setTimeout(function() {
            App.resizeScroll()
        }, 200)
        return false;
    },
    closeEditorWidget: function(id) {
        App.openWidgetEditor(id);

        return false;
    },
    widgetDeleted: function(id) {
        $('.each-widget-'+id).remove();
        App.reloadBioPreview()
        return false;
    },
    reloadBioPreview: function() {

        document.getElementById('preview-iframe').contentDocument.location.reload(true);
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

function createPicker() {
    if (pickerApiLoaded && oauthToken) {
        $('.picker-dialog').remove();
        $('.picker-dialog-bg').remove();
        $('#ssIFrame_google').remove();
        var folderView = new google.picker.View(google.picker.ViewId.FOLDERS);
        //view.setMimeTypes("image/png,image/jpg,video/mp4");
        var picker = new google.picker.PickerBuilder()
            .enableFeature(google.picker.Feature.SUPPORT_DRIVES)
            .enableFeature(google.picker.Feature.NAV_HIDDEN)
            .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
            .setOAuthToken(oauthToken)
            //.addView(folderView)
            .addView(new google.picker.DocsView().setParent('root').setIncludeFolders(true))
            .addView(new google.picker.DocsUploadView())
            .setDeveloperKey(googleDriveDeveloperKey)
            .setCallback(pickerCallback)
            .build();
        picker.setVisible(true);
    }

}

// A simple callback implementation.
function pickerCallback(data) {
    var action = data[google.picker.Response.ACTION];
    if (action == google.picker.Action.PICKED) {
        if(data[google.picker.Response.DOCUMENTS] != undefined){
            var doc       = data[google.picker.Response.DOCUMENTS][0];
            var fileId    = doc[google.picker.Document.ID];
            var file_name = doc[google.picker.Document.NAME];
            var file_size = doc['sizeBytes'];
            if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
                App.showLoader(true);
                $.ajax({
                    type: "POST",
                    datatype: 'json',
                    url: App.url('media'),
                    data: {  file_id:fileId, file_name: file_name, file_size: file_size, oauthToken:oauthToken, google: true },
                    success: function(result){
                        App.hideLoader();
                        App.loadPage(window.location.href);
                    }
                });

            }
        }
    }else if (action == google.picker.Action.CANCEL) {

    }
}

var scope = ['https://www.googleapis.com/auth/drive.readonly'];
var pickerApiLoaded = false;
var oauthToken;
var fileSelectorType = 1; //0 - single 1 -multiple ;
var fileSelectorMediaType = 2; // 0 - image 1 - video - 2 - both
function onAuthApiLoad() {
    window.gapi.auth.authorize({
        'client_id': googleDriveClientId,
        'scope': scope,
        'immediate': false
    }, handleAuthResult);
}

function onPickerApiLoad() {
    pickerApiLoaded = true;
    createPicker();
}

function handleAuthResult(authResult) {
    if (authResult && !authResult.error) {
        oauthToken = authResult.access_token;
        createPicker();
    }

}
