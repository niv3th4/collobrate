angular.module 'Pyoopil.Directives'
.directive 'people', ['peopleService', (peopleService)->

  restrict : 'A'
  templateUrl : '/pyoopil/js/app/partials/classrooms/people.html',
  scope: {
    people: '='
  }
  link : (scope, elem, attrs)->

#    elem.addClass 'restrict'

    scope.$on 'UPDATE.Moderator', (evt)->
      console.log 'people'



]