/* Provides an easier cross-browser way to handle events
Source: Haverbeke, Martijn, Eloquent JavaScript, Chapter 11 */
/*jslint browser: true, vars: true*/
/*globals console,confirm,prompt,alert,document,window*/

(function () {
    'use strict';

    var registerEventHandler = function (node, event, handler) {
        if (typeof node.addEventListener === "function") {
            node.addEventListener(event, handler, false);
        } else {
            node.attachEvent("on" + event, handler);
        }
    };
    var unregisterEventHandler = function (node, event, handler) {
        if (typeof node.removeEventListener === "function") {
            node.removeEventListener(event, handler, false);
        } else {
            node.detachEvent("on" + event, handler);
        }
    };
    var normaliseEvent = function (event) {
        if (!event.stopPropagation) {
            event.stopPropagation = function () {
                this.cancelBubble = true;
            };
            event.preventDefault = function () {
                this.returnValue = false;
            };
        }
        if (!event.stop) {
            event.stop = function () {
                this.stopPropagation();
                this.preventDefault();
            };
        }

        if (event.srcElement && !event.target) {
            event.target = event.srcElement;
        }
        if ((event.toElement || event.fromElement) && !event.relatedTarget) {
            event.relatedTarget = event.toElement || event.fromElement;
        }
        if (event.clientX !== undefined && event.pageX === undefined) {
            event.pageX = event.clientX + document.body.scrollLeft;
            event.pageY = event.clientY + document.body.scrollTop;
        }
        if (event.type === "keypress") {
            if (event.charCode === 0 || event.charCode === undefined) {
                event.character = String.fromCharCode(event.keyCode);
            } else {
                event.character = String.fromCharCode(event.charCode);
            }
        }
        return event;
    };
    var addHandler = function (node, type, handler) {
        function wrapHandler(event) {
            handler(normaliseEvent(event || window.event));
        }
        registerEventHandler(node, type, wrapHandler);
        return {node: node, type: type, handler: wrapHandler};
    };
    var removeHandler = function (object) {
        unregisterEventHandler(object.node, object.type, object.handler);
    };
    var forEachIn = function (object, action) {
        for (var property in object) {
            if (object.hasOwnProperty(property)) {
                action(property, object[property]);
            }
        }
    };
    var provide = function (values) {
        forEachIn(values, function (name, value) {
            window[name] = value;
        });
    };
    provide({
        addHandler: addHandler,
        removeHandler: removeHandler
    });
}());