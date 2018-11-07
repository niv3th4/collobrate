angular.module 'Pyoopil.Directives'
  .directive 'classrooms', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

      restrict : 'E',
      templateUrl : '/pyoopil/js/app/partials/Classrooms/classroom-tile.html',
      link : (scope, elem, attrs)->

        new class Classrooms

          constructor : ->

            scope.classrooms = []
            @isInitial = true

            @addListeners()

          addListeners : ->

            scope.$on 'READ.Classrooms', (evt, data) => @renderClassrooms evt, data
            scope.$on 'READ.Classroom', (evt, data) => @renderClassroom evt, data


          renderClassrooms : (evt, classrooms) ->

            if _.isEmpty(classrooms)
              Notify.alert 'No More classrooms to load', 'error'
              return

            angular.forEach(classrooms, (classroom)->
              scope.classrooms.push classroom
            )

          renderClassroom : (evt, classroom) ->

            console.log classroom

            if _.isEmpty(classroom)
              Notify.alert 'No More classrooms to load', 'error'
              return

            scope.classrooms.unshift classroom
  ]