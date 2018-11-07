angular.module 'Pyoopil.Directives'
.directive 'peoples', ['peopleService', 'Utilities', (peopleService, Utilities)->

  restrict : 'E'
  template : '<ul><li class="follow-box" ng-repeat="people in peoples" people="people"></li></ul>'
  link : (scope, elem, attrs)->

    new class Peoples

      constructor : ->

        scope.peoples = []

        @addListeners()

      addListeners : ->

        scope.$on 'READ.Peoples', (evt, data) => @renderPeoples evt, data


      renderPeoples : (evt, peoples) ->

        if _.isEmpty(peoples)
          Notify.alert 'No More Peoples to load', 'error'
          return

        angular.forEach(peoples, (people)->
          scope.peoples.push people
        )




]