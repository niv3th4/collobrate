// Generated by CoffeeScript 1.7.1
(function() {
  angular.module('Pyoopil.Services').factory('Notify', [
    function() {
      var Notify;
      return new (Notify = (function() {
        function Notify() {}

        Notify.prototype.alert = function(message, type) {
          toastr.clear();
          return toastr[type](message);
        };

        return Notify;

      })());
    }
  ]);

}).call(this);

//# sourceMappingURL=notify.map
