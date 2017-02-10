var Layout = function () {
    //BEGIN MENU MAIN
    var handleSidebarMain = function () {
        $('#sidebar-main').metisMenu();
    }
    //END MENU MAIN

    //BEGIN TEMPLATE SETTING
    var handleTemplateSetting = function () {
        $('a.btn-template-setting').click(function () {
            if ($('#template-setting').css('right') < '0') {
                $('#template-setting').css('right', '0');
            } else {
                $('#template-setting').css('right', '-255px');
            }
        });

        $('ul.sidebar-color > li').click(function () {
            var color = $(this).attr('data-style');
            $('ul.sidebar-color > li').removeClass('active');
            $(this).addClass('active');
            switch (color) {
                case 'default':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    });
                    break;
                case 'orange':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    }).addClass('sidebar-color-orange');
                    break;
                case 'green':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    }).addClass('sidebar-color-green');
                    break;
                case 'white':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    }).addClass('sidebar-color-white');
                    break;
                case 'blue':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    }).addClass('sidebar-color-blue');
                    break;
                case 'grey':
                    $('body').removeClass(function (index, css) {
                        return (css.match(/(^|\s)sidebar-color-\S+/g) || []).join(' ');
                    }).addClass('sidebar-color-grey');
                    break;
            }
        });

        $('#setting-sidebar-collapsed').on('switch-change', function () {           
            $('body').toggleClass('layout-sidebar-collapsed');
            if ($('body').hasClass('layout-sidebar-fixed')) {
                alert('Please go on "Layout sidebar fixed & collapsed" menu');
            }
            save_setting();
        });

        $('#setting-sidebar-fixed').on('switch-change', function () {
            if ($('body').hasClass('layout-sidebar-collapsed')) {
                alert('Please go on "Layout sidebar fixed & collapsed" menu to use this option');
                //return false;
            } else if ($('.fluid').hasClass('container')) {
                alert('Unfortunately, you have to edit litte to use this option');
            } else {
                $('body').toggleClass('layout-sidebar-fixed');
                if ($("#sidebar-main").parent().hasClass('slimScrollDiv') || $('body').hasClass('layout-sidebar-collapsed')) {
                    destroySlimscroll('sidebar-main');
                } else {
                    handleSidebarFixed();
                }
            }
        });

        $('#setting-sidebar-hide').on('switch-change', function () {
            $('body').toggleClass('layout-sidebar-hide');
        });


        $('#setting-header-fixed').on('switch-change', function () {
            $('body').toggleClass('layout-header-fixed');
        });

        $('#setting-header-dark').on('switch-change', function () {
            $('body').toggleClass('layout-header-dark');
        });

        $('#setting-horizontal-menu').on('switch-change', function () {
            $('body').toggleClass('layout-full-width');
            $('.logo-wrapper').removeClass('in-sidebar');
        });

        $('#setting-layout-boxed').on('switch-change', function () {
            if ($('body').hasClass('layout-sidebar-fixed')) {
                alert('Unfortunately, you have to edit litte to use this option');
            } else {
                $('.fluid').toggleClass('container');
            }
        });

        $('#setting-logo-status').on('switch-change', function () {
            $('#topbar .logo-wrapper').toggleClass('in-sidebar');
        });

        $('#setting-toggle-status').on('switch-change', function () {
            $('#menu-toggle').toggleClass('show-collapsed');
            $('#menu-toggle').toggleClass('show-hide');
        });

        $('#setting-theme-chat').on('switch-change', function () {
            $('.chat-form-wrapper').toggleClass('light');
        });

        $("select#font-select")
            .change(function () {
                var value;
                var $font_link = $('#font-layout');
                $("select#font-select option:selected").each(function () {
                    value = $(this).val();
                });

                switch (value) {
                    case 'open-sans':
                        handleRemoveClassFont();
                        break;
                    case 'roboto':
                        handleRemoveClassFont();
                        $font_link.attr('href', 'http://fonts.googleapis.com/css?family=Roboto');
                        $('body').addClass('font-roboto');
                        break;
                    case 'lato':
                        handleRemoveClassFont();
                        $font_link.attr('href', 'http://fonts.googleapis.com/css?family=Lato');
                        $('body').addClass('font-lato');
                        break;
                    case 'source-sans-pro':
                        handleRemoveClassFont();
                        $font_link.attr('href', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro');
                        $('body').addClass('font-source-sans-pro');
                        break;
                    case 'helvetica':
                        handleRemoveClassFont();
                        $('body').addClass('font-helvetica');
                        break;
                    case 'lora':
                        handleRemoveClassFont();
                        $font_link.attr('href', 'http://fonts.googleapis.com/css?family=Lora');
                        $('body').addClass('font-lora');
                        break;

                }
            });

        //set cookie when click save
        function save_setting() {
            var cookie_sidebar_color = $('.sidebar-color li.active').attr('data-style');
            var cookie_font = $('select#font-select').val();
            var cookie_array = [];
            if ($('#setting-header-fixed > div').hasClass('switch-on')) {     
                cookie_array.push('layout-header-fixed');
            }
            if ($('#setting-sidebar-collapsed > div').hasClass('switch-on')) {
                cookie_array.push('layout-sidebar-collapsed');
            }
            if ($('#setting-sidebar-hide > div').hasClass('switch-on')) {
                cookie_array.push('layout-sidebar-hide');
            }
            if ($('#setting-sidebar-fixed > div').hasClass('switch-on')) {
                cookie_array.push('layout-sidebar-fixed');
            }
            if ($('#setting-toggle-status > div').hasClass('switch-on')) {
                cookie_array.push('layout-toggle-status');
            }
            if ($('#setting-header-dark > div').hasClass('switch-on')) {
                cookie_array.push('layout-header-dark');
            }
            if ($('#setting-logo-status > div').hasClass('switch-on')) {
                cookie_array.push('layout-logo-status');
            }
            if ($('#setting-horizontal-menu > div').hasClass('switch-on')) {
                cookie_array.push('layout-full-width');
            }
            if ($('#setting-footer-light > div').hasClass('switch-on')) {
                cookie_array.push('layout-footer-light');
            }

            $.cookie('sidebar-color', cookie_sidebar_color);
            $.cookie('font-layout', cookie_font);
            $.cookie('setting', cookie_array.join(' '));            
        }
        //load cookie on document ready
        if ($.cookie('setting')) {
            var cookie_load_array = $.cookie('setting').split(' ');
            if ($.inArray('layout-header-fixed', cookie_load_array) !== -1) {
                $('#setting-header-fixed').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-sidebar-collapsed', cookie_load_array) !== -1) {
                $('#setting-sidebar-collapsed').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-sidebar-fixed', cookie_load_array) !== -1) {
                $('#setting-sidebar-fixed').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-sidebar-hide', cookie_load_array) !== -1) {
                $('#setting-sidebar-hide').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-header-dark', cookie_load_array) !== -1) {
                $('#setting-header-dark').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-toggle-status', cookie_load_array) !== -1) {
                $('#setting-toggle-status').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-logo-status', cookie_load_array) !== -1) {
                $('#setting-logo-status').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-full-width', cookie_load_array) !== -1) {
                $('#setting-horizontal-menu').bootstrapSwitch('toggleState');
            }
            if ($.inArray('layout-footer-light', cookie_load_array) !== -1) {
                $('#setting-footer-light').bootstrapSwitch('toggleState');
            }
        }

        if ($.cookie('sidebar-color')) {
            $('body').addClass('sidebar-color-' + $.cookie('sidebar-color'));
            $('.sidebar-color li').removeClass('active');
            $('.sidebar-color li.' + $.cookie('sidebar-color')).addClass('active');
        }

        if ($.cookie('font-layout')) {
            $('select#font-select').val($.cookie('font-layout'));
            setFont($.cookie('font-layout'));
        }

        function setFont(value) {
            var $font_layout = $('#font-layout');
            switch (value) {
                case 'open-sans':
                    handleRemoveClassFont();
                    break;
                case 'roboto':
                    handleRemoveClassFont();
                    $font_layout.attr('href', 'http://fonts.googleapis.com/css?family=Roboto');
                    $('body').addClass('font-roboto');
                    break;
                case 'lato':
                    handleRemoveClassFont();
                    $font_layout.attr('href', 'http://fonts.googleapis.com/css?family=Lato');
                    $('body').addClass('font-lato');
                    break;
                case 'source-sans-pro':
                    handleRemoveClassFont();
                    $font_layout.attr('href', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro');
                    $('body').addClass('font-source-sans-pro');
                    break;
                case 'helvetica':
                    handleRemoveClassFont();
                    $('body').addClass('font-helvetica');
                    break;
                case 'lora':
                    handleRemoveClassFont();
                    $font_layout.attr('href', 'http://fonts.googleapis.com/css?family=Lora');
                    $('body').addClass('font-lora');
                    break;
            }
        }
    }
    //END TEMPLATE SETTING

    var handleRemoveClassFont = function () {
        $("body").removeClass(function (index, css) {
            return (css.match(/(^|\s)font-\S+/g) || []).join(' ');
        });
    }

    var handleSidebarFixed = function () {
        if ($('body.layout-sidebar-fixed').hasClass('layout-sidebar-collapsed')) {
            destroySlimscroll('sidebar-main');
        } else {
            $('#sidebar-main').slimScroll({
                'width': '100%',
                'height': $(window).height() - 80,
                "wheelStep": 25
            });
        }
    }

    return {
        init: function () {
            handleSidebarMain();
            handleTemplateSetting();          
        }
    }

}(jQuery);


