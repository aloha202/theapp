/**
 * Created by alexradyuk on 7/2/19.
 */

var TheApp = {
    waitFor: function (selector, callback) {
        if($(selector).size()){
            if(this._waitForInterval){
                clearTimeout(this._waitForTimeout);
                this._waitForTimeout = null;
            }
            callback($(selector));
        }else{
            setTimeout(function () {
                TheApp.waitFor(selector, callback);
            }, 1000);
        }
    },
    _waitForTimeout: null
};