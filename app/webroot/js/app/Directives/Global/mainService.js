// Generated by CoffeeScript 1.7.1
(function() {
  angular.module('Pyoopil.Services').factory('mainService', [
    '$http', '$window', '$q', 'Auth', function($http, $window, $q, Auth) {
      var mainService;
      mainService = (function() {
        var self;

        self = mainService;

        function mainService() {
          self.url = $window.location.origin + $window.location.pathname;
        }

        mainService.prototype.postData = function(url, data, isLogin) {
          var headers, xhr;
          if (isLogin) {
            headers = '';
          } else {
            headers = {
              'X-AuthTokenHeader': Auth.getAuthToken()
            };
          }
          xhr = $http({
            method: 'POST',
            url: url,
            data: data,
            headers: headers
          });
          return xhr;
        };

        mainService.prototype.getData = function(url) {
          var xhr;
          xhr = $http({
            method: 'GET',
            url: url,
            headers: {
              'X-AuthTokenHeader': Auth.getAuthToken()
            }
          });
          return xhr;
        };

        mainService.prototype.postLogin = function(data) {
          var url;
          url = self.url + 'login';
          return this.postData(url, data, true);
        };

        mainService.prototype.postRegistration = function(data) {
          var d;
          d = $q.defer();
          d.resolve();
          return d.promise;
        };

        mainService.prototype.newClassroom = function(data) {
          var url;
          url = self.url + 'classrooms/add.json';
          return this.postData(url, data, false);
        };

        mainService.prototype.joinClassroom = function(data) {
          var url;
          url = self.url + 'classrooms/join.json';
          return this.postData(url, data, false);
        };

        return mainService;

      })();
      return new mainService();
    }
  ]);

}).call(this);

//# sourceMappingURL=mainService.map
