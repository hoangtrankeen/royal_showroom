// SmartMenus init
$(function() {
    $('#main-menu-sidebar').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

// Set proper max-height for sub menus in desktop view
$('#main-menu-sidebar').bind('beforeshow.smapi', function(e, menu) {
    var $sub = $(menu),
        hasSubMenus = $sub.find('ul').length && !$sub.hasClass('mega-menu');
    // if the sub doesn't have any deeper sub menus, apply max-height
    if (!hasSubMenus) {
        var obj = $(this).data('smartmenus');
        if (obj.isCollapsible()) {
            $sub.css({
                'overflow-y': '',
                'max-height': ''
            });
        } else {
            var $a = $sub.dataSM('parent-a'),
                $li = $a.closest('li'),
                $ul = $li.parent(),
                level = $sub.dataSM('level'),
                $win = $(window),
                winH = $win.height(),
                winY = $win.scrollTop(),
                subY = winY;
            // if the parent menu is horizontal
            if ($ul.parent().is('[data-sm-horizontal-sub]') || level == 2 && !$ul.hasClass('sm-vertical')) {
                var itemY = $a.offset().top,
                    itemH = obj.getHeight($a),
                    subOffsetY = level == 2 ? obj.opts.mainMenuSubOffsetY : obj.opts.subMenusSubOffsetY,
                    subY = itemY + itemH + subOffsetY;
            }
            $sub.css({
                'max-height': winH + winY - subY
            });
        }
    }
});

// Set overflow-y: auto for sub menus in desktop view
// this needs to be done on the 'show.smapi' event because the script resets overflow on menu show
$('#main-menu-sidebar').bind('show.smapi', function(e, menu) {
    var $sub = $(menu),
        hasSubMenus = $sub.find('ul').length && !$sub.hasClass('mega-menu');
    // if the sub doesn't have any deeper sub menus, apply overflow-y: auto
    if (!hasSubMenus) {
        var obj = $(this).data('smartmenus');
        if (!obj.isCollapsible()) {
            $sub.css('overflow-y', 'auto');
        }
    }
});