angular.module 'Pyoopil.Services'
.factory 'EventEmitter', ['$document', ($document)->

  class EventEmitter

    init : (scope)->

      @$scope = scope


    emit : (evt, data, scope)->

      if angular.isDefined scope
        scope.$broadcast evt, data
      else
        @$scope.$broadcast evt, data

    broadcast : (evt, data, scope)->

      if angular.isDefined scope
        scope.$emit evt, data
      else
        @$scope.$emit evt, data



]