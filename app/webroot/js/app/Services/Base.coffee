angular.module 'Pyoopil.Services'
  .factory 'Base', ['$http', '$q', 'Auth', ($http, $q, Auth)->

    class Base

      constructor : ->

        @path = 'http://localhost:8001/pyoopil/'

      getData : (url, data)->

        headers = {'X-AuthTokenHeader' : Auth.getAuthToken() }
#        headers = ''

        if not headers?
          return false

        xhr = $http({
          method: 'GET',
          url: url,
          data: data,
          headers : headers
        })

        xhr

      getData : (url, data)->

        headers = {'X-AuthTokenHeader' : Auth.getAuthToken() }
        #        headers = ''

        if not headers?
          return false

        xhr = $http({
          method: 'POST',
          url: url,
          data: data,
          headers : headers
        })

        xhr


  ]