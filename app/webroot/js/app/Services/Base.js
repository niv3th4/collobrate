// Generated by CoffeeScript 1.7.1
<<
<<
<< < HEAD
  (function () {
    angular.module('Pyoopil.Services').factory('Base', [
      '$http', '$q', 'Auth',
      function ($http, $q, Auth) {
        var Base;
        return Base = (function () {
          function Base() {
            this.path = 'http://localhost:8001/pyoopil/';
          }

          Base.prototype.getData = function (url, data) {
            var headers, xhr;
            headers = {
              'X-AuthTokenHeader': Auth.getAuthToken()
            };
            if (headers == null) {
              return false;
            }
            xhr = $http({
              method: 'GET',
              url: url,
              data: data,
              headers: headers
            });
            return xhr;
          };

          Base.prototype.getData = function (url, data) {
            var headers, xhr;
            headers = {
              'X-AuthTokenHeader': Auth.getAuthToken()
            };
            if (headers == null) {
              return false;
            }
            xhr = $http({
              method: 'POST',
              url: url,
              data: data,
              headers: headers
            });
            return xhr;
          };

          return Base;

        })();
      }
    ]);

  }).call(this);

//# sourceMappingURL=Base.map
===
===
=
angular.module('Pyoopil.Services').factory('Base', [
  '$http', '$q', 'Auth', '$window',
  function ($http, $q, Auth, $window) {
    var Base;
    return Base = (function () {
      function Base() {
        this.path = $window.location.origin + $window.location.pathname;
      }

      Base.prototype.getData = function (url, data) {
        var headers, xhr;
        headers = {
          'X-AuthTokenHeader': Auth.getAuthToken()
        };
        if (headers == null) {
          return false;
        }
        xhr = $http({
          method: 'GET',
          url: url,
          data: data,
          headers: headers
        });
        return xhr;
      };

      Base.prototype.getData = function (url, data) {
        var headers, xhr;
        headers = {
          'X-AuthTokenHeader': Auth.getAuthToken()
        };
        if (headers == null) {
          return false;
        }
        xhr = $http({
          method: 'POST',
          url: url,
          data: data,
          headers: headers
        });
        return xhr;
      };

      return Base;

    })();
  }
]); >>>
>>>
> 1417 ba109b757fd452454e01b34a5c585e1d41c0