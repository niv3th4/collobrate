angular.module 'Pyoopil.Services'
.factory 'Form', ['$window', '$http', 'Utilities', ($window, $http, Utilities)->

  new class Form

    self = @

    constructor : ->

#      TO BE UPDATED FROM Back-end
      self.url = Utilities.getPath()

    init : (scope)->
      @scope = scope


    postData : (data, url)->

      xhr = $http({
        method: 'POST',
        url: url,
        data: data
      })

      xhr

    getData : (url)->

      xhr = $http({
        method: 'GET',
        url: url
      })

      xhr






]