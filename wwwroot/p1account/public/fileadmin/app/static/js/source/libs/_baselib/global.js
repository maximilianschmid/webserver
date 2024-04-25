/**
 * @author Maximilian Schmid
 */


/**
 * anorak.io function for debugging
 * IE safe, production server double safety
*/
// usage: log('inside coolFunc',this,arguments);
// http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.debug = function(){
  debug.history = debug.history || [];   // store logs to an array for reference
  debug.history.push(arguments);
  if(this.console){
    if (arguments.length == 1)
      {
          console.log(arguments[0]);
      }
      else
      {
          console.log( Array.prototype.slice.call(arguments) );
      }
  }
};
