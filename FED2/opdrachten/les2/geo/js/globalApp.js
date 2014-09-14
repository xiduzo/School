var app = app || {};

var SANDBOX = "SANDBOX";
var LINEAIR = "LINEAIR";
var GPS_AVAILABLE = 'GPS_AVAILABLE';
var GPS_UNAVAILABLE = 'GPS_UNAVAILABLE';
var POSITION_UPDATED = 'POSITION_UPDATED';
var REFRESH_RATE = 10000;
var currentPosition = currentPositionMarker = customDebugging = debugId = map = interval =intervalCounter = updateMap = false;
var locatieRij = markerRij = [];