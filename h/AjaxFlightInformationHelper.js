
// Provide a default path to dwr.engine
if (dwr == null) var dwr = {};
if (dwr.engine == null) dwr.engine = {};
if (DWREngine == null) var DWREngine = dwr.engine;

if (AjaxFlightInformationHelper == null) var AjaxFlightInformationHelper = {};
AjaxFlightInformationHelper._path = 'http://www.heathrowairport.com/FlightInformationJSRPortlet/dwr';
AjaxFlightInformationHelper.findFlights = function(p0, p1, p2, p3, p4, p5, p6, callback) {
  dwr.engine._execute(AjaxFlightInformationHelper._path, 'AjaxFlightInformationHelper', 'findFlights', p0, p1, p2, p3, p4, p5, p6, callback);
}
AjaxFlightInformationHelper.getCities = function(callback) {
  dwr.engine._execute(AjaxFlightInformationHelper._path, 'AjaxFlightInformationHelper', 'getCities', callback);
}
AjaxFlightInformationHelper.getCitiesByAirport = function(p0, callback) {
  dwr.engine._execute(AjaxFlightInformationHelper._path, 'AjaxFlightInformationHelper', 'getCitiesByAirport', p0, callback);
}
