// Generated by CoffeeScript 1.7.1
(function () {
  angular.module('Pyoopil.Directives').directive('people', [
    'peopleService',
    function (peopleService) {
      return {
        restrict: 'A',
        templateUrl: '/pyoopil/js/app/partials/classrooms/people.html',
        scope: {
          people: '='
        },
        link: function (scope, elem, attrs) {
          return scope.$on('UPDATE.Moderator', function (evt) {
            return console.log('people');
          });
        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=people.map