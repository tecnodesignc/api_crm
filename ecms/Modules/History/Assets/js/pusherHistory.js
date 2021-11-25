;(function ($, window, document, undefined) {
    "use strict";
    var pluginName = "pusherHistories",
        defaults = {
            historiesCounter: ".historiesCounter",
            noHistories: ".noHistories"
        };

    function pusherHistories(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    $.extend(pusherHistories.prototype, {
        getTemplate: function () {
            return '<li>' +
                '<a href="#">' +
                '<div class="pull-left historyIcon"><i class="iconClass"></i></div>' +
                '<h4>' +
                'historyTitle' +
                '<small><i class="fa fa-clock-o"></i> timeAgo</small>' +
                '</h4>' +
                '<p>historyMessage</p>' +
                '</a>' +
                '</li>';
        },
        prepareTemplate: function (message) {
            var template = this.getTemplate();
            template = template.replace('iconClass', message.history.icon_class);
            template = template.replace('#', message.history.link);
            template = template.replace('historyTitle', message.history.title);
            template = template.replace('historyMessage', message.history.message);
            template = template.replace('timeAgo', message.history.time_ago);

            return template;
        },
        incrementCounter: function () {
            var self = this;
            var count = parseInt($(self.settings.historiesCounter).text());
            $(self.settings.historiesCounter).text(count + 1);
            $(self.settings.historiesCounter).addClass('bounce');
            setTimeout(function () {
                $(self.settings.historiesCounter).removeClass('bounce');
            }, 1000);
        },
        init: function () {
            var self = this;
            this.pusher = new Pusher(this.settings.pusherKey, {
                cluster: this.settings.pusherCluster,
                encrypted: this.settings.pusherEncrypted,
            });
            this.pusherChannel = this.pusher.subscribe('histories.' + this.settings.loggedInUserId);
            this.pusherChannel.bind('Modules\\History\\Events\\BroadcastHistory', function (message) {
                if ($(self.settings.noHistories).length) {
                    $(self.settings.noHistories).remove();
                }
                $(self.element).prepend(self.prepareTemplate(message));
                $(self.element).find('li').first().addClass('animated pulse');
                self.incrementCounter();
            });
        }
    });

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new pusherHistories(this, options));
            }
        });
    };

})(jQuery, window, document);
