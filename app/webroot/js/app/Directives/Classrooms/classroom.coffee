angular.module 'Pyoopil.Directives'
.directive 'classroom', ['classroomService', (classroomService)->

  restrict : 'A'
  scope: {
    classroom : '='
  }
  link : (scope, elem, attrs)->

    if scope.$parent.$last
      classroomService.rendered()

    elem.on 'click', ->

      classroomService.setCurrentClassroom scope.classroom.UsersClassroom.classroom_id



]