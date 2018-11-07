angular.module 'Pyoopil.Controllers'
  .controller 'classroomCtrl', ['$scope', '$templateCache', 'classroomService', '$state', '$timeout',
  ($scope, $templateCache, classroomService, $state, $timeout)->

    $scope.pageNo = 1
    $scope.permissions = {}
    $scope.classrooms = []
    $scope.scrollReached = false

    promise = classroomService.getClassrooms($scope.pageNo)

    promise.then(
      (data)->

        $scope.data = data.data.data
        $scope.permissions = data.data.permissions

        if not $scope.$$phase
          $scope.$digest()
      ,
      (error)->
        if error.status is 403
          toastr.error 'You are not Allowed to view this page'

    )

    $scope.$on 'Classroom.CREATE', (e, classroom)->
      e.preventDefault()
      $scope.data.unshift classroom.data

      if not $scope.$$phase
        $scope.$digest()

    $tsb = $('#classrooms').find '.tinyscrollbar'
    $vp = $tsb.find '.viewport'

    $tsb.tinyscrollbar({thumbSize: 34})
    $tinyscrollbar = $tsb.data("plugin_tinyscrollbar")

    $scope.showJoinClassroom = ()->
      $(".newjoin").remove()
      $(".accessclass").show()
      ''

    $scope.joinClassroom = ->

      if not $scope.accessCode?
        toastr.error 'Please enter a valid Access Code'
        return

      data = {
        'Classroom' : {
          'access_code' : $scope.accessCode
        }
      }

      promise = mainService.joinClassroom(data)

      promise.then(

        (data)->

          $scope.accessCode = ''

          classroom = data.data.data

          if classroom.length <= 0
            toastr.error data.data.message
            return

          $scope.data.unshift classroom

          if not $scope.$$phase
            $scope.$digest()
      )


    $scope.$on 'classroom.RENDER', ()->
      $timeout(->
        $tinyscrollbar.update 'relative'
        $scope.scrollReached = false
      ,100)

    $vp.on 'endOfScroll', (e)->

      if $scope.scrollReached
        return

      $scope.scrollReached = true
      $scope.pageNo += 1

      promise = classroomService.getClassrooms($scope.pageNo)

      promise.then(
        (data)->

          classrooms = data.data.data

          if classrooms.length <= 0
            toastr.error 'No More Classrooms to load'
            return

          _.each classrooms, (classroom)->
            $scope.data.push classroom

          if not $scope.$$phase
            $scope.$digest()


      )
  ]