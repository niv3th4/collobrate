angular.module('Pyoopil.Services')
  .factory('mainService', ['$http', '$window', '$q', 'Auth', ($http, $window, $q, Auth)->

    class mainService

      self = @

      constructor : ->

        self.url = $window.location.origin + $window.location.pathname

      postData : (url, data, isLogin)->

        if isLogin
          headers = ''
        else
          headers = {'X-AuthTokenHeader' : Auth.getAuthToken() }

        xhr = $http({
          method: 'POST',
          url: url,
          data: data,
          headers : headers
        })

        xhr

      getData : (url)->

        xhr = $http({
          method: 'GET',
          url: url,
          headers : {'X-AuthTokenHeader' : Auth.getAuthToken() }
        })

        xhr

      postLogin : (data)->

        url = self.url + 'login'

        @postData(url, data, true)

      postRegistration : (data)->

        d = $q.defer()

        d.resolve()

        d.promise

      newClassroom : (data)->

        url = self.url + 'classrooms/add.json'

        @postData url, data, false

      joinClassroom : (data)->

        url = self.url + 'classrooms/join.json'

        @postData url, data, false


    new mainService()

  ])