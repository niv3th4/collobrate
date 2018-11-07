app = angular.module('Pyoopil.Controllers')

class loginCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'Auth', 'Notify', 'UserService', '$state', 'Utilities'

  initialize : ->

    @$scope.login = {}
    @$scope.submit = @submit

  submit : (form) =>

    if form.email.$invalid
      @Notify.alert 'Please enter a valid email', 'error'
      return

    if form.password.$invalid
      @Notify.alert 'Please enter a valid password', 'error'
      return

    if form.$valid
      data = {
        "AppUser":{
          "email": @$scope.login.email,
          "password": @$scope.login.password
        }
      }

    promise = @UserService.login data

    promise.then(
      (data) =>
        @Utilities.closeModal()
        @$state.transitionTo 'Views.Classrooms'
    )



