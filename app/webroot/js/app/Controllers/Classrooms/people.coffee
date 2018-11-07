app = angular.module('Pyoopil.Controllers')

class peopleCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'peopleService', 'Utilities', 'Notify'

  initialize : ->

    @peopleService.init @$scope

    @$scope.$on 'READ.Peoples', (evt, data) => @$scope.users = data

  assignModerators : (evt)=>

    @Utilities.openModal('assign-moderators')

  restrictUsers : (evt)=>

    @Utilities.openModal('restrict-users')

  submitModerators : =>

    form = @$scope.assignForm

    if form.$invalid
      @Notify.alert 'Please enter valid users', 'error'
      return

    if form.$valid

      data = {
        'ids' : @$scope.selectedUsers.join(',')
      }

      @peopleService.postForm 'setModerator.json', data, (data)-> @emit 'UPDATE.Moderator'

      @Utilities.closeModal()

  restrictUser : =>

    form = @$scope.restrictForm

    if form.$invalid
      @Notify.alert 'Please enter valid users', 'error'
      return

    if form.$valid

      data = {
        'ids' : @$scope.selectedUsers.join(',')
      }

      @peopleService.postForm 'setRestricted.json', data, (data)-> @emit 'UPDATE.Restricted'

      @Utilities.closeModal()