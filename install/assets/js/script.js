
var Install = {
    go: function(step) {
        $('.step-content').hide();
        $('.step-'+step+'-container').fadeIn();
        var i = 1;
        $('.steps-container .each').removeClass('active');
        while(i <= step) {
            $('.steps-container .step-'+i).addClass('active');
            i++;
        }
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
    finish: function() {
        $('#loader').show();
        var form = $("#installForm");
        form.ajaxSubmit({
            url: window.location.href,
            success: function(r) {
                $('#loader').hide();
                if (r === '1') {
                    Install.notify("Database Installation successful", 'success')
                    Install.go(5);
                } else {
                    Install.notify("There is something wrong with the database details please confirm and try again", 'error')
                }
            }
        })
        return false;
    }
}
