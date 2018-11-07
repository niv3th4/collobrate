angular.module('Pyoopil.Controllers')
  .controller('mainCtrl', ['$scope', 'Utilities','EventEmitter',
    ($scope, Utilities, EventEmitter)->

      Utilities.init $scope

      $scope.$on 'Classroom', (evt, data)->
        if data.Classroom.is_private
          $scope.code = data.Classroom.access_code
          Utilities.openModal('private-classroom-success-message')
        else
          Utilities.openModal('public-classroom-success-message')
        $scope.$broadcast 'READ.Classroom', data
#
  ])