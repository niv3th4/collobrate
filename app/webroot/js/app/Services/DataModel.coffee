angular.module 'Pyoopil.Services'
.factory 'DataModel', [()->

  new class DataModel

    init : (scope)->

      @scope = scope

    setWatcher : (args)->

      subject = args

      if angular.isDefined(subject)
        @scope.$watch subject, (newVal, oldVal)=>
          if newVal isnt oldVal
            console.log newVal
            @scope.$broadcast('UPDATE.' + subject, newVal)
        , true





]