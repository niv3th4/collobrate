app = angular.module('Pyoopil.Controllers')

class libraryCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'libraryService', 'FileUploader'

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










