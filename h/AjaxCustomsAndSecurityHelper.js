
// Provide a default path to dwr.engine
if (dwr == null) var dwr = {};
if (dwr.engine == null) dwr.engine = {};
if (DWREngine == null) var DWREngine = dwr.engine;

if (AjaxCustomsAndSecurityHelper == null) var AjaxCustomsAndSecurityHelper = {};
AjaxCustomsAndSecurityHelper._path = 'http://www.heathrowairport.com/CustomsAndSecurityJSRPortlet/dwr';
AjaxCustomsAndSecurityHelper.getSecurityCountryList = function(callback) {
  dwr.engine._execute(AjaxCustomsAndSecurityHelper._path, 'AjaxCustomsAndSecurityHelper', 'getSecurityCountryList', callback);
}
AjaxCustomsAndSecurityHelper.getSecurityInformationByCountry = function(p0, p1, callback) {
  dwr.engine._execute(AjaxCustomsAndSecurityHelper._path, 'AjaxCustomsAndSecurityHelper', 'getSecurityInformationByCountry', p0, p1, callback);
}
AjaxCustomsAndSecurityHelper.getDefaultSecurityInformation = function(p0, callback) {
  dwr.engine._execute(AjaxCustomsAndSecurityHelper._path, 'AjaxCustomsAndSecurityHelper', 'getDefaultSecurityInformation', p0, callback);
}
