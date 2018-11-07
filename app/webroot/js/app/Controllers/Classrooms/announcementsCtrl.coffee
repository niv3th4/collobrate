app = angular.module('Pyoopil.Controllers')

class announcementsCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'announcementService', 'Notify', 'FileUploader'

  initialize : ->

    @$scope.pageNo = 1
    @$scope.permissions = {}
    @$scope.isSubmitted = false

    @$scope.uploader = new @FileUploader({
      filters : [{
        name : 'singleUpload',
        fn : (item, options) ->
          return @queue.length is 0
      }]
    })

    @announcementService.init @$scope

    @$scope.submit = =>

      @$scope.isSubmitted = true

      form = @$scope.announcementForm

      if form.$invalid
        @Notify.alert 'Please enter valid details', 'error'
        return

      if form.$valid
        data = {
          "Announcement" : @$scope.Announcements
        }

        @announcementService.postForm data

      ''








