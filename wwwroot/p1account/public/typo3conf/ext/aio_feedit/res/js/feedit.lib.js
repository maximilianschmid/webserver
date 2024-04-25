/**
 * @param {Object} options
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 */


//create own jQuery namespace to not conflict with existing JS-Code on page
// defined in galleria-1.2.3.js to assign the correct jQuery to galleria
//var jQuery_pangallery = $.noConflict(true);


(function($) {
    
  
  /* Cross-Browser Split 1.0.1
  (c) Steven Levithan <stevenlevithan.com>; MIT License
  An ECMA-compliant, uniform cross-browser split method */
  
  var cbSplit;
  
  // avoid running twice, which would break `cbSplit._nativeSplit`'s reference to the native `split`
  if (!cbSplit) {
  
  cbSplit = function (str, separator, limit) {
      // if `separator` is not a regex, use the native `split`
      if (Object.prototype.toString.call(separator) !== "[object RegExp]") {
          return cbSplit._nativeSplit.call(str, separator, limit);
      }
  
      var output = [],
          lastLastIndex = 0,
          flags = (separator.ignoreCase ? "i" : "") +
                  (separator.multiline  ? "m" : "") +
                  (separator.sticky     ? "y" : ""),
          separator = RegExp(separator.source, flags + "g"), // make `global` and avoid `lastIndex` issues by working with a copy
          separator2, match, lastIndex, lastLength;
  
      str = str + ""; // type conversion
      if (!cbSplit._compliantExecNpcg) {
          separator2 = RegExp("^" + separator.source + "$(?!\\s)", flags); // doesn't need /g or /y, but they don't hurt
      }
  
      /* behavior for `limit`: if it's...
      - `undefined`: no limit.
      - `NaN` or zero: return an empty array.
      - a positive number: use `Math.floor(limit)`.
      - a negative number: no limit.
      - other: type-convert, then use the above rules. */
      if (limit === undefined || +limit < 0) {
          limit = Infinity;
      } else {
          limit = Math.floor(+limit);
          if (!limit) {
              return [];
          }
      }
  
      while (match = separator.exec(str)) {
          lastIndex = match.index + match[0].length; // `separator.lastIndex` is not reliable cross-browser
  
          if (lastIndex > lastLastIndex) {
              output.push(str.slice(lastLastIndex, match.index));
  
              // fix browsers whose `exec` methods don't consistently return `undefined` for nonparticipating capturing groups
              if (!cbSplit._compliantExecNpcg && match.length > 1) {
                  match[0].replace(separator2, function () {
                      for (var i = 1; i < arguments.length - 2; i++) {
                          if (arguments[i] === undefined) {
                              match[i] = undefined;
                          }
                      }
                  });
              }
  
              if (match.length > 1 && match.index < str.length) {
                  Array.prototype.push.apply(output, match.slice(1));
              }
  
              lastLength = match[0].length;
              lastLastIndex = lastIndex;
  
              if (output.length >= limit) {
                  break;
              }
          }
  
          if (separator.lastIndex === match.index) {
              separator.lastIndex++; // avoid an infinite loop
          }
      }
  
      if (lastLastIndex === str.length) {
          if (lastLength || !separator.test("")) {
              output.push("");
          }
      } else {
          output.push(str.slice(lastLastIndex));
      }
  
      return output.length > limit ? output.slice(0, limit) : output;
  };
  
  cbSplit._compliantExecNpcg = /()??/.exec("")[1] === undefined; // NPCG: nonparticipating capturing group
  cbSplit._nativeSplit = String.prototype.split;
  
  } // end `if (!cbSplit)`
  
  // for convenience...
  String.prototype.split = function (separator, limit) {
      return cbSplit(this, separator, limit);
  };
  
  
  /**
   * Cookie plugin
   *
   * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
   * Dual licensed under the MIT and GPL licenses:
   * http://www.opensource.org/licenses/mit-license.php
   * http://www.gnu.org/licenses/gpl.html
   *
   */
  
  /**
   * Create a cookie with the given name and value and other optional parameters.
   *
   * @example $.cookie('the_cookie', 'the_value');
   * @desc Set the value of a cookie.
   * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
   * @desc Create a cookie with all available options.
   * @example $.cookie('the_cookie', 'the_value');
   * @desc Create a session cookie.
   * @example $.cookie('the_cookie', null);
   * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
   *       used when the cookie was set.
   *
   * @param String name The name of the cookie.
   * @param String value The value of the cookie.
   * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
   * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
   *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
   *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
   *                             when the the browser exits.
   * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
   * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
   * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
   *                        require a secure protocol (like HTTPS).
   * @type undefined
   *
   * @name $.cookie
   * @cat Plugins/Cookie
   * @author Klaus Hartl/klaus.hartl@stilbuero.de
   */
  
  /**
   * Get the value of a cookie with the given name.
   *
   * @example $.cookie('the_cookie');
   * @desc Get the value of a cookie.
   *
   * @param String name The name of the cookie.
   * @return The value of the cookie.
   * @type String
   *
   * @name $.cookie
   * @cat Plugins/Cookie
   * @author Klaus Hartl/klaus.hartl@stilbuero.de
   */
  $.cookie = function(name, value, options) {
      if (typeof value != 'undefined') { // name and value given, set cookie
          options = options || {};
          if (value === null) {
              value = '';
              options.expires = -1;
          }
          var expires = '';
          if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
              var date;
              if (typeof options.expires == 'number') {
                  date = new Date();
                  date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
              } else {
                  date = options.expires;
              }
              expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
          }
          // CAUTION: Needed to parenthesize options.path and options.domain
          // in the following expressions, otherwise they evaluate to undefined
          // in the packed version for some reason...
          var path = options.path ? '; path=' + (options.path) : '';
          var domain = options.domain ? '; domain=' + (options.domain) : '';
          var secure = options.secure ? '; secure' : '';
          document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
      } else { // only name given, get cookie
          var cookieValue = null;
          if (document.cookie && document.cookie != '') {
              var cookies = document.cookie.split(';');
              for (var i = 0; i < cookies.length; i++) {
                  var cookie = $.trim(cookies[i]);
                  // Does this cookie string begin with the name we want?
                  if (cookie.substring(0, name.length + 1) == (name + '=')) {
                      cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                      break;
                  }
              }
          }
          return cookieValue;
      }
  };
  
  
  
  // define and expose our format function
  //
  $.fn.aio_getcookiedomain = function() {
    // improve FE-Edit
    // cookie tutorial
    // http://www.electrictoolbox.com/jquery-cookies/
    
    hostname_array = location.hostname.split(".")
    hostname_array.reverse();
    if (hostname_array[0] === "local"){
        return hostname_array[2] + "." + hostname_array[1] + "." + hostname_array[0];
    } else if (hostname_array[0] === "info"){
        return hostname_array[2] + "." + hostname_array[1] + "." + hostname_array[0];
    } else{
        return hostname_array[1] + "." + hostname_array[0];
    }
    
  };

})(jQuery_aio_feedit);

  
  
/**
 * anorak.io function for debugging
 * IE safe, production server double safety
*/
function debug($obj){
  var io_anorak_window = window;
  if (io_anorak_window.console && io_anorak_window.console.log){
      io_anorak_window.console.log($obj);
  }
}
