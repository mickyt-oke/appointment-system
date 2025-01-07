; (function ($, window, document, undefined) {
    "use strict"; var pluginName = "pincodeInput"; var defaults = { placeholders: undefined, inputs: 4, hidedigits: true, patern: '[0-9]*', inputtype: 'number', inputmode: 'numeric', keydown: function (e) { }, change: function (input, value, inputnumber) { }, complete: function (value, e, errorElement) { } }; function Plugin(element, options) { this.element = element; this.settings = $.extend({}, defaults, options); this._defaults = defaults; this._name = pluginName; this.init(); }
    $.extend(Plugin.prototype, {
        init: function () { this.buildInputBoxes(); }, updateOriginalInput: function () { var newValue = ""; $('.pincode-input-text', this._container).each(function (index, value) { newValue += $(value).val().toString(); }); $(this.element).val(newValue); }, check: function () { var isComplete = true; var code = ""; $('.pincode-input-text', this._container).each(function (index, value) { code += $(value).val().toString(); if (!$(value).val()) { isComplete = false; } }); if (this._isTouchDevice()) { if (code.length == this.settings.inputs) { return true; } } else { return isComplete; } }, buildInputBoxes: function () {
            this._container = $('<div />').addClass('pincode-input-container'); var currentValue = []; var placeholders = []; var touchplaceholders = ""; if (this.settings.placeholders) { placeholders = this.settings.placeholders.split(" "); touchplaceholders = this.settings.placeholders.replace(/ /g, ""); }
            if (this.settings.hidedigits == false && $(this.element).val() != "") { currentValue = $(this.element).val().split(""); }
            if (this.settings.hidedigits) { this._pwcontainer = $('<div />').css("display", "none").appendTo(this._container); this._pwfield = $('<input>').attr({ 'type': 'password', 'pattern': this.settings.pattern, 'inputmode': this.settings.inputmode, 'id': 'preventautofill', 'autocomplete': 'off' }).appendTo(this._pwcontainer); }
            if (this._isTouchDevice()) {
                $(this._container).addClass("touch"); var wrapper = $('<div />').addClass('touchwrapper touch' + this.settings.inputs).appendTo(this._container); var input = $('<input>').attr({ 'type': this.settings.inputtype, 'pattern': this.settings.pattern, 'inputmode': this.settings.inputmode, 'placeholder': touchplaceholders, 'maxlength': this.settings.inputs, 'autocomplete': 'off' }).addClass('form-control pincode-input-text').appendTo(wrapper); var touchtable = $('<table>').addClass('touchtable').appendTo(wrapper); var row = $('<tr/>').appendTo(touchtable); for (var i = 0; i < this.settings.inputs; i++) { if (i == (this.settings.inputs - 1)) { $('<td/>').addClass('last').appendTo(row); } else { $('<td/>').appendTo(row); } }
                if (this.settings.hidedigits) { input.attr('type', 'password'); } else { input.val(currentValue[i]); }
                this._addEventsToInput(input, 1);
            } else {
                for (var i = 0; i < this.settings.inputs; i++) {
                    var input = $('<input>').attr({ 'type': 'text', 'maxlength': "1", 'autocomplete': 'off', 'placeholder': (placeholders[i] ? placeholders[i] : undefined) }).addClass('form-control pincode-input-text').appendTo(this._container); if (this.settings.hidedigits) { input.attr('type', 'password'); } else { input.val(currentValue[i]); }
                    if (i == 0) { input.addClass('first'); } else if (i == (this.settings.inputs - 1)) { input.addClass('last'); } else { input.addClass('mid'); }
                    this._addEventsToInput(input, (i + 1));
                }
            }
            this._error = $('<div />').addClass('text-danger pincode-input-error').appendTo(this._container); $(this.element).css("display", "none"); this._container.insertBefore(this.element);
        }, enable: function () { $('.pincode-input-text', this._container).each(function (index, value) { $(value).prop('disabled', false); }); }, disable: function () { $('.pincode-input-text', this._container).each(function (index, value) { $(value).prop('disabled', true); }); }, focus: function () { $('.pincode-input-text', this._container).first().select().focus(); }, clear: function () { $('.pincode-input-text', this._container).each(function (index, value) { $(value).val(""); }); this.updateOriginalInput(); }, _isTouchDevice: function () { if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { return true; } }, _addEventsToInput: function (input, inputnumber) {
            input.on('focus', function (e) { this.select(); }); input.on('keydown', $.proxy(function (e) {
                if (this._pwfield) { $(this._pwfield).attr({ 'type': 'text' }); $(this._pwfield).val(""); }
                if (this._isTouchDevice()) { if (e.keyCode == 8 || e.keyCode == 46) { } else { if ($(this.element).val().length == this.settings.inputs) { e.preventDefault(); e.stopPropagation(); } } } else { if (!(e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 46 || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (this.settings.inputtype != 'number' && e.keyCode >= 65 && e.keyCode <= 90))) { e.preventDefault(); e.stopPropagation(); } }
                this.settings.keydown(e);
            }, this)); input.on('keyup', $.proxy(function (e) {
                if (!this._isTouchDevice()) { if (e.keyCode == 8 || e.keyCode == 46) { $(e.currentTarget).prev().select(); $(e.currentTarget).prev().focus(); } else { if ($(e.currentTarget).val() != "") { $(e.currentTarget).next().select(); $(e.currentTarget).next().focus(); } } }
                this.updateOriginalInput(); if (this.check()) { this.settings.complete($(this.element).val(), e, this._error); }
                if (this.settings.change) { this.settings.change(e.currentTarget, $(e.currentTarget).val(), inputnumber); }
                if (this._isTouchDevice()) { if (e.keyCode == 8 || e.keyCode == 46) { } else { if ($(this.element).val().length == this.settings.inputs) { $(e.currentTarget).blur(); } } }
            }, this));
        }
    }); $.fn[pluginName] = function (options) { return this.each(function () { if (!$.data(this, "plugin_" + pluginName)) { $.data(this, "plugin_" + pluginName, new Plugin(this, options)); } }); };
})(jQuery, window, document);