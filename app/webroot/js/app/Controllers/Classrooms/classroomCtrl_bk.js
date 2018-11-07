// Generated by CoffeeScript 1.7.1
(function() {
  angular.module('Pyoopil.Controllers').controller('classroomCtrl', [
    '$scope', '$templateCache', 'classroomService', '$state', '$timeout', function($scope, $templateCache, classroomService, $state, $timeout) {
      var $tinyscrollbar, $tsb, $vp, promise;
      $scope.pageNo = 1;
      $scope.permissions = {};
      $scope.classrooms = [];
      $scope.scrollReached = false;
      promise = classroomService.getClassrooms($scope.pageNo);
      promise.then(function(data) {
        $scope.data = data.data.data;
        $scope.permissions = data.data.permissions;
        if (!$scope.$$phase) {
          return $scope.$digest();
        }
      }, function(error) {
        if (error.status === 403) {
          return toastr.error('You are not Allowed to view this page');
        }
      });
      $scope.$on('Classroom.CREATE', function(e, classroom) {
        e.preventDefault();
        $scope.data.unshift(classroom.data);
        if (!$scope.$$phase) {
          return $scope.$digest();
        }
      });
      $tsb = $('#classrooms').find('.tinyscrollbar');
      $vp = $tsb.find('.viewport');
      $tsb.tinyscrollbar({
        thumbSize: 34
      });
      $tinyscrollbar = $tsb.data("plugin_tinyscrollbar");
      $scope.showJoinClassroom = function() {
        $(".newjoin").remove();
        $(".accessclass").show();
        return '';
      };
      $scope.joinClassroom = function() {
        var data;
        if ($scope.accessCode == null) {
          toastr.error('Please enter a valid Access Code');
          return;
        }
        data = {
          'Classroom': {
            'access_code': $scope.accessCode
          }
        };
        promise = mainService.joinClassroom(data);
        return promise.then(function(data) {
          var classroom;
          $scope.accessCode = '';
          classroom = data.data.data;
          if (classroom.length <= 0) {
            toastr.error(data.data.message);
            return;
          }
          $scope.data.unshift(classroom);
          if (!$scope.$$phase) {
            return $scope.$digest();
          }
        });
      };
      $scope.$on('classroom.RENDER', function() {
        return $timeout(function() {
          $tinyscrollbar.update('relative');
          return $scope.scrollReached = false;
        }, 100);
      });
      return $vp.on('endOfScroll', function(e) {
        if ($scope.scrollReached) {
          return;
        }
        $scope.scrollReached = true;
        $scope.pageNo += 1;
        promise = classroomService.getClassrooms($scope.pageNo);
        return promise.then(function(data) {
          var classrooms;
          classrooms = data.data.data;
          if (classrooms.length <= 0) {
            toastr.error('No More Classrooms to load');
            return;
          }
          _.each(classrooms, function(classroom) {
            return $scope.data.push(classroom);
          });
          if (!$scope.$$phase) {
            return $scope.$digest();
          }
        });
      });
    }
  ]);

}).call(this);

//# sourceMappingURL=classroomCtrl_bk.map
