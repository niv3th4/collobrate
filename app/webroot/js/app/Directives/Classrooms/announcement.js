// Generated by CoffeeScript 1.7.1
(function() {
  angular.module('Pyoopil.Directives').directive('announcement', [
    'announcementService', function(announcementService) {
      return {
        restrict: 'A',
        scope: {
          announcement: '='
        },
        link: function(scope, elem, attrs) {
          if (scope.$parent.$last) {
            return announcementService.rendered();
          }
        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=announcement.map
