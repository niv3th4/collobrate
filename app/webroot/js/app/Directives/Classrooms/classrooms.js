// Generated by CoffeeScript 1.7.1
(function () {
  angular.module('Pyoopil.Directives').directive('classrooms', [
    'EventEmitter', 'Notify',
    function (EventEmitter, Notify) {
      return {
        restrict: 'E',
        templateUrl: '/pyoopil/js/app/partials/Classrooms/classroom-tile.html',
        link: function (scope, elem, attrs) {
          var Classrooms;
          return new(Classrooms = (function () {
            function Classrooms() {
              scope.classrooms = [];
              this.isInitial = true;
              this.addListeners();
            }

            Classrooms.prototype.addListeners = function () {
              scope.$on('READ.Classrooms', (function (_this) {
                return function (evt, data) {
                  return _this.renderClassrooms(evt, data);
                };
              })(this));
              return scope.$on('READ.Classroom', (function (_this) {
                return function (evt, data) {
                  return _this.renderClassroom(evt, data);
                };
              })(this));
            };

            Classrooms.prototype.renderClassrooms = function (evt, classrooms) {
              if (_.isEmpty(classrooms)) {
                Notify.alert('No More classrooms to load', 'error');
                return;
              }
              return angular.forEach(classrooms, function (classroom) {
                return scope.classrooms.push(classroom);
              });
            };

            Classrooms.prototype.renderClassroom = function (evt, classroom) {
              console.log(classroom);
              if (_.isEmpty(classroom)) {
                Notify.alert('No More classrooms to load', 'error');
                return;
              }
              return scope.classrooms.unshift(classroom);
            };

            return Classrooms;

          })());
        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=classrooms.map