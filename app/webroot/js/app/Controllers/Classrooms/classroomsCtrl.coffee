app = angular.module('Pyoopil.Controllers')

class classroomsCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'classroomService', 'Notify', 'Utilities', '$rootScope'

  initialize : ->

    @$scope.pageNo = 1
    @$scope.permissions = {}
    @$scope.isSubmitted = false

    @classroomService.init @$scope

  createClassroom : =>

    @$scope.isSubmitted = true

    form = @$scope.createClassroomForm

    if form.$valid
      data = {
        "Classroom" : @$scope.classroom
      }

      @classroomService.postForm 'add.json', data, (data)-> @broadcast 'Classroom', data, @$scope

  showJoinClassroom : ->
    $(".newjoin").hide()
    $(".accessclass").show()
    ''

  hideJoinClassroom : ->
    $(".newjoin").show()
    $(".accessclass").hide()
    ''

  joinClassroom : =>

    if not @$scope.accessCode?
      @Notify.alert 'Please enter a valid Access Code', 'error'
      return

    data = {
      'Classroom' : {
        'access_code' : @$scope.accessCode
      }
    }

    @classroomService.postForm 'join.json', data, (data)-> @emit 'READ.Classroom', data, @$scope

    @$scope.accessCode = ''












