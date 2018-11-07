// Generated by CoffeeScript 1.7.1
(function () {
  angular.module('Pyoopil.Directives').directive('classroomHeader', [
    'Utilities', '$timeout',
    function (Utilities, $timeout) {
      return {
        restrict: 'E',
        replace: true,
        scope: {},
        templateUrl: '/pyoopil/js/app/partials/Classrooms/header.html',
        link: function (scope, elem, attrs) {
          $timeout(function () {
            return scope.permissions = scope.$parent.permissions;
          }, 100);
          return elem.on('click', '#newClassroom', function (e) {
            Utilities.openModal('create-classroom-form');
            return false;
          });
        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=classroom-header.map